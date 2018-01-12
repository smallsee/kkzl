<?php
namespace App\Repositories\Eloquent;

use App\Xcx;

class XcxRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Xcx::class;
    }

    public function createXcx($attributes){

        $server = $attributes['server'];
        $phone = $attributes['phone'];

        if (preg_match('/^\d+$/i', $phone) && strlen($phone) == 11){
            $server_data = [
                'name' => $attributes['name'],
                'phone' => $phone,
                'desc' => $attributes['desc'],
                'server' => $server,
            ];
            $server= $this->model->create($server_data);
            return $server;
        }else{
            return 0;
        }





    }
}