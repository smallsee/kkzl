<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class AnimeTransformer extends TransformerAbstract
{
    public function transform($anime){
        return [
          'id' => $anime['id'],
          'title' => $anime['title'],
          'issue_date' => $anime['issue_date'],
          'thumb' => $anime['thumb'],
          'episodes' => $anime['episodes'],
          'created_at' => $anime['created_at'],
          'akira' =>  explode(',',str_replace(" ","",str_replace("\n","",$anime['akira']))),
          'tag' => explode(',',$anime['tag']),
          'see' => $anime['see'],
          'introduction' => $anime['introduction'],
            'commits_count' => count($anime['commits']),
            'commits' => $anime['commits'],
        ];
    }

}