<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class FanStarTransformer extends TransformerAbstract
{
    public function transform($star){
        return [
          'id' => isset($star['star']['id']) ? $star['star']['id'] : $star['star']['id'],
          'name' => isset($star['star']['name'])  ? $star['star']['name'] : $star['star']['name'],
          'thumb' => isset($star['star']['thumb'])  ? $star['star']['thumb'] : $star['star']['thumb'],
        ];
    }

} 