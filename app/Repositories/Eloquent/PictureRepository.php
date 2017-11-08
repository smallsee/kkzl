<?php
namespace App\Repositories\Eloquent;
use App\Picture;
use App\Topic;
use JWTAuth;

class PictureRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Picture::class;
    }

    public function findAll()
    {
        return $this->model->orderBy('created_at','desc')->get();
    }

    function createPictureAndTopic(array $attributes){

        $topics = $attributes['topic'];


        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $picture_data = [
            'title' => $attributes['title'],
            'big_thumb' => $attributes['big_thumb'],
            'thumb' => $attributes['thumb'],
            'topic' => json_encode($topics),
            'user_id' => $user->id,
            'status' => 1,
        ];

        $picture = $this->model->firstOrCreate($picture_data);

        foreach ($topics as $mtopic){

            $topic = Topic::where('name', $mtopic['name'])->first();

            if (!$topic){
                $topic_data = [
                    'user_Id' => $user->id,
                    'name' => $mtopic['name'],
                    'use_count' => $user->id,
                ];
                $topic = Topic::firstOrCreate($topic_data);
            }else{
                $topic->increment('use_count');
            }

        }


        return $picture;


    }

    function updatePictureAndTopic(array $attributes){

        $topics = $attributes['topic'];


        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }


        $picture  = $this->model->find($attributes['id']);


        if (!$picture){
            return response()->json(['user_not_found'], 404);
        }

        $picture['title'] = $attributes['title'];
        $picture['thumb'] = $attributes['thumb'];
        $picture['big_thumb'] = $attributes['big_thumb'];
        $picture['topic'] = json_encode($topics);
        $picture->save();



        foreach ($topics as $mtopic){

            $topic = Topic::where('name', $mtopic['name'])->first();

            if (!$topic){
                $topic_data = [
                    'user_Id' => $user->id,
                    'name' => $mtopic['name'],
                    'use_count' => 0
                ];
                $topic = Topic::firstOrCreate($topic_data);
            }else{
                $topic->increment('use_count');
            }
        }


        return $picture;


    }

    public function findById($id)
    {
        $picture = $this->model->find($id);
        $picture->increment('see');
        return $picture;
    }
}