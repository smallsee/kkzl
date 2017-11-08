<?php
namespace App\Repositories\Eloquent;

use App\Anime;
use App\AnimeFile;


class AnimeRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Anime::class;
    }


    public function createAnimeWithOther(array $attributes){

        $akiras = $attributes['akira'];
        $tags = $attributes['tag'];
        $files = $attributes['files'];

        $anime_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'introduction' => $attributes['introduction'],
            'episodes' => count($files) ? count($files) : '未知集数',
            'status' => 1,
            'issue_date' => $attributes['issue_date'],
            'tag' => implode(',',$tags),
            'akira' => implode(',',$akiras),
        ];

        $anime  = $this->model->create($anime_data);

        foreach ($files as $file){
                AnimeFile::firstOrCreate([
                    'file_name' =>  $file['file_name'],
                    'file_url' =>   $file['file_url'],
                    'anime_id' => $anime->id
                ]);
        }

        return $anime;
    }


    public function updateAnimeWithOther(array $attributes) {
        $akiras = $attributes['akira'];
        $tags = $attributes['tag'];
        $files = $attributes['files'];

        $anime = $this->model->find($attributes['id']);

        $anime_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'introduction' => $attributes['introduction'],
            'episodes' => count($files) ? count($files) : '未知集数',
            'status' => 1,
            'issue_date' => $attributes['issue_date'],
            'tag' => implode(',',$tags),
            'akira' => implode(',',$akiras),
        ];

        $anime->update($anime_data);




        AnimeFile::where('anime_id',$anime->id)->delete();


        foreach ($files as $file){
            AnimeFile::firstOrCreate([
                'file_name' =>  $file['file_name'],
                'file_url' =>   $file['file_url'],
                'anime_id' => $anime->id
            ]);
        }


        return $anime;



    }

    public function findById($id)
    {
        $anime = $this->model->find($id);
        $anime->increment('see');
        return $anime;
    }




    public function findLikeTitle($title){
        return $this->model->where('title','like','%'.$title.'%')->get();
    }


}