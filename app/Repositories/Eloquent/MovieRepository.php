<?php
namespace App\Repositories\Eloquent;

use App\Movie;

class MovieRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Movie::class;
    }

    public function createMovieWithOther(array $attributes){
        $star = $attributes['star'];
        $tags = $attributes['tag'];
        $director = $attributes['director'];


        $movie_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'url' => $attributes['url'],
            'introduction' => $attributes['introduction'],
            'status' => 1,
            'tag' => implode(',',$tags),
            'star' => implode(',',$star),
            'director' => implode(',',$director),
        ];

        $movie = $this->model->create($movie_data);


        return $movie;

    }


    public function updateMovieWithOther(array $attributes) {
        $star = $attributes['star'];
        $tags = $attributes['tag'];
        $director = $attributes['director'];

        $movie = $this->model->find($attributes['id']);

        $movie_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'url' => $attributes['url'],
            'introduction' => $attributes['introduction'],
            'status' => 1,
            'tag' => implode(',',$tags),
            'star' => implode(',',$star),
            'director' => implode(',',$director),
        ];

        $movie->update($movie_data);


        return $movie;



    }

    public function findById($id)
    {
        $movie = $this->model->find($id);
        $movie->increment('see');
        return $movie;
    }




    public function findLikeTitle($title){
        return $this->model->where('title','like','%'.$title.'%')->get();
    }


}