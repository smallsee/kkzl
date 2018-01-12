<?php
namespace App\Repositories\Eloquent;

use App\BRFloor;

class BrfloorRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return BRFloor::class;
    }

    public function createBrfloor($attributes){

        $phone = $attributes['phone'];
        if (preg_match('/^\d+$/i', $phone) && strlen($phone) == 11){
            $server_data = [
                'name' => $attributes['name'],
                'phone' => $phone,
                'desc' => $attributes['desc'],
                'company' => $attributes['company'],
                'reason' => $attributes['reason'],
            ];
            $server= $this->model->create($server_data);
            return $server;
        }else{
            return 0;
        }
    }
}