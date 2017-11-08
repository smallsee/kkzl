<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class FavTransformer extends TransformerAbstract
{
    public function transform($fav){
        return [
            'id' => $fav['fav']['id'],
            'thumb' => $fav['fav']['thumb'],
            'title' => $fav['fav']['title'],
        ];
    }

}