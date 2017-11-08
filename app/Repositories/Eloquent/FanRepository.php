<?php
namespace App\Repositories\Eloquent;

use App\Fan;

class FanRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Fan::class;
    }

    public function hasFan(array $attributes){
        $hasfan = $this->model->where([
            ['fan_id',$attributes['fan_id']],
            ['star_id',$attributes['star_id']]
        ])->first();

        if ($hasfan){
            return 0;
        }else{
            return 1;
        }
    }

    public function findUserFind(array $attributes){
        $fan = $this->model->where([
            [$attributes['type'],$attributes['user_id']],
        ])->get();

        return $fan;
    }


}