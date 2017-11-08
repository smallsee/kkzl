<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform($tag){
        return [
          'id' => $tag['id'],
          'name' => $tag['name'],
        ];
    }

}