<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class StarTransformer extends TransformerAbstract
{
    public function transform($akira){
        return [
          'id' => $akira['id'],
          'name' => $akira['name'],
        ];
    }

}