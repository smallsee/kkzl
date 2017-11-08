<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    public function transform($topic){
        return [
          'id' => $topic['id'],
          'name' => $topic['name'],
          'use_count' => $topic['use_count'],
          'user_id' => $topic['user'],
        ];
    }

}