<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class XcxTransformer extends TransformerAbstract
{
    public function transform($xcx){
        return [
          'id' => $xcx['id'],
          'name' => $xcx['name'],
          'phone' => $xcx['phone'],
          'desc' => $xcx['desc'],
            'server' => explode(',',$xcx['server']),
        ];
    }

}