<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class TvTransformer extends TransformerAbstract
{
    public function transform($tv){
        return [
          'id' => $tv['id'],
          'title' => $tv['title'],
          'thumb' => $tv['thumb'],
          'tag' => explode(',',$tv['tag']),
            'star' =>  explode(',',str_replace(" ","",str_replace("\n","",$tv['star']))),
            'director' =>  explode(',',str_replace(" ","",str_replace("\n","",$tv['director']))),
          'see' => $tv['see']
        ];
    }

}