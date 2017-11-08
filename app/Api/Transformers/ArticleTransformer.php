<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform($artisan){
        return [
          'id' => $artisan['id'],
          'title' => $artisan['title'],
          'content' => $artisan['content'],
          'thumb' => $artisan['thumb'],
            'topic' => json_decode($artisan['topic']),
          'status' => $artisan['status'],
          'see' => $artisan['see'],
            'user' => $artisan['user'],
            'commits_count' => count($artisan['commits']),
            'commits' => $artisan['commits'],
            'favs_count' => count($artisan['favs']),
            'favs' => $artisan['favs'],
            'created_at' => $artisan['created_at'],
        ];
    }

}