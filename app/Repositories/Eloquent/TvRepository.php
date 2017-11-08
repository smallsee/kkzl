<?php
namespace App\Repositories\Eloquent;

use App\Tv;
use App\TvFile;


class TvRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Tv::class;
    }

    public function createTvWithOther(array $attributes){

        $stars = $attributes['star'];
        $tags = $attributes['tag'];
        $files = $attributes['files'];

        $tv_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'introduction' => $attributes['introduction'],
            'episodes' => count($files) ? count($files) : '未知集数',
            'status' => 1,
            'country' => $attributes['country'],
            'tag' => implode(',',$tags),
            'star' => implode(',',$stars),
        ];

        $tv  = $this->model->create($tv_data);

        foreach ($files as $file){
            TvFile::firstOrCreate([
                'file_name' =>  $file['file_name'],
                'file_url' =>   $file['file_url'],
                'tv_id' => $tv->id
            ]);
        }

        return $tv;
    }


    public function updateTvWithOther(array $attributes) {
        $stars = $attributes['star'];
        $tags = $attributes['tag'];
        $files = $attributes['files'];

        $tv = $this->model->find($attributes['id']);

        $tv_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'introduction' => $attributes['introduction'],
            'episodes' => count($files) ? count($files) : '未知集数',
            'status' => 1,
            'country' => $attributes['country'],
            'tag' => implode(',',$tags),
            'star' => implode(',',$stars),
        ];

        $tv->update($tv_data);




        TvFile::where('tv_id',$tv->id)->delete();


        foreach ($files as $file){
            TvFile::firstOrCreate([
                'file_name' =>  $file['file_name'],
                'file_url' =>   $file['file_url'],
                'tv_id' => $tv->id
            ]);
        }


        return $tv;



    }

    public function findById($id)
    {
        $video = $this->model->find($id);
        $video->increment('see');
        return $video;
    }




    public function findLikeTitle($title){
        return $this->model->where('title','like','%'.$title.'%')->get();
    }


}