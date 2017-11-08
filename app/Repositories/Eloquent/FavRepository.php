<?php
namespace App\Repositories\Eloquent;

use App\Fav;

class FavRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Fav::class;
    }

    public function hasFav($attributes){
        $model = new $this->model;
        $hasfav = $model->where([
            ['user_id',$attributes['user_id']],
            ['fav_type',$attributes['fav_type']],
            ['fav_id',$attributes['fav_id']],
        ])->first();

        if ($hasfav){
            return 0;
        }else{
            return 1;
        }
    }


    function findUserFav(array $attributes){

        $user_id = $attributes['user_id'];
        $fav_type = $attributes['fav_type'];

        return $this->model->where([
            ['user_id',$user_id],
            ['fav_type',$fav_type],
        ])->get();


    }

}