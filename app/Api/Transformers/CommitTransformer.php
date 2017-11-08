<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class CommitTransformer extends TransformerAbstract
{
    public function transform($commit){
        return [
          'content' => $commit['content'],
          'user' => $commit['user'],
          'created_at' => $commit['created_at'],
          'commit_title' => $commit['commit']['title'],
          'commit_id' => $commit['commit']['id'],
        ];
    }

}