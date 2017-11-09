<?php
namespace App\Repositories\Eloquent;


use App\Anime;
use App\Article;
use App\Movie;
use App\Picture;
use App\Tv;


class SearchRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Anime::class;
    }

    function findLikeTitle(array $attributes) {
        $type = $attributes['type'];
        $title = $attributes['title'];

        if ($type === 'anime'){
            $data = Anime::where('title','like','%'.$title.'%')->get();
        }elseif ($type === 'article'){
            $data = Article::where('title','like','%'.$title.'%')->get();
        }elseif ($type === 'tv'){
            $data = Tv::where('title','like','%'.$title.'%')->get();
        }elseif ($type === 'movie'){
            $data = Movie::where('title','like','%'.$title.'%')->get();
        }elseif ($type === 'picture'){
            $data = Picture::where('title','like','%'.$title.'%')->get();
        }else{
            return 0;
        }

        return $data;
    }

}