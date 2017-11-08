<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;



class ReplyTransformer
{
    public function error($status, $message){
        return response([

            'message' => $message,
            'meta' => [
                'errno' => $status,
            ]
        ]);
    }

    public function data($status, $message){
        return response([

            'data' => $message,
            'meta' => [
                'errno' => $status,
            ]
        ]);
    }

}