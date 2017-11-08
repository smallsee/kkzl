<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class FanTransformer extends TransformerAbstract
{
    public function transform($fan){
        return [
          'id' => isset($fan['fan']['id']) ? $fan['fan']['id'] : $fan['fan']['id'],
          'name' => isset($fan['fan']['name'])  ? $fan['fan']['name'] : $fan['fan']['name'],
          'thumb' => isset($fan['fan']['thumb'])  ? $fan['fan']['thumb'] : $fan['fan']['thumb'],
        ];
    }

}