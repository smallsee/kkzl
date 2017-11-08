<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class TvShowTransformer extends TransformerAbstract
{
    public function transform($tv){
        return [
          'id' => $tv['id'],
          'title' => $tv['title'],
          'thumb' => $tv['thumb'],
          'url' => $tv['url'],
          'country' => $tv['country'],
            'episodes' => $tv['episodes'],
          'tag' => explode(',',$tv['tag']),
            'introduction' => $tv['introduction'],
            'star' =>  explode(',',str_replace(" ","",str_replace("\n","",$tv['star']))),
            'director' =>  explode(',',str_replace(" ","",str_replace("\n","",$tv['director']))),
          'see' => $tv['see'],
            'commits_count' => count($tv['commits']),
            'commits' => $tv['commits'],
            'files' => $tv['files'],
            'files_count' => count($tv['files']),
        ];
    }

}