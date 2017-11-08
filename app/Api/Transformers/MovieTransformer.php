<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class MovieTransformer extends TransformerAbstract
{
    public function transform($movie){
        return [
          'id' => $movie['id'],
          'title' => $movie['title'],
          'thumb' => $movie['thumb'],
          'url' => $movie['url'],
          'tag' => explode(',',$movie['tag']),
            'introduction' => $movie['introduction'],
            'star' =>  explode(',',str_replace(" ","",str_replace("\n","",$movie['star']))),
            'director' =>  explode(',',str_replace(" ","",str_replace("\n","",$movie['director']))),
          'see' => $movie['see'],
            'commits_count' => count($movie['commits']),
            'commits' => $movie['commits'],
        ];
    }

}