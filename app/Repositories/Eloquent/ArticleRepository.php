<?php
namespace App\Repositories\Eloquent;
use App\Article;
use App\ArticleTopic;
use App\Topic;
use JWTAuth;

class ArticleRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Article::class;
    }

    public function findAll()
    {
        return $this->model->orderBy('created_at','desc')->get();
    }

    function createArticleAndTopic(array $attributes){

        $topics = $attributes['topic'];


        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $article_data = [
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'thumb' => $attributes['thumb'],
            'topic' => json_encode($topics),
            'user_id' => $user->id,
            'status' => 1,
        ];

        $article = $this->model->firstOrCreate($article_data);

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


        return $article;


    }

    function updateArticleAndTopic(array $attributes){

        $topics = $attributes['topic'];


        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }


        $article  = $this->model->find($attributes['id']);


        if (!$article){
            return response()->json(['user_not_found'], 404);
        }

        $article['title'] = $attributes['title'];
        $article['thumb'] = $attributes['thumb'];
        $article['topic'] = json_encode($topics);
        $article['content'] = $attributes['content'];
        $article->save();



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


        return $article;


    }

    public function findById($id)
    {
        $article = $this->model->find($id);
        $article->increment('see');
        return $article;
    }
}