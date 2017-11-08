<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class PictureTransformer extends TransformerAbstract
{
    public function transform($picture){
        return [
          'id' => $picture['id'],
          'title' => $picture['title'],
          'thumb' => $picture['thumb'],
          'big_thumb' => $picture['big_thumb'],
            'topic' => json_decode($picture['topic']),
          'status' => $picture['status'],
          'see' => $picture['see'],
            'user' => $picture['user'],
            'commits_count' => count($picture['commits']),
            'commits' => $picture['commits'],
            'favs_count' => count($picture['favs']),
            'favs' => $picture['favs'],
            'created_at' => $picture['created_at'],
        ];
    }

}