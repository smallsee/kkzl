<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class SearchTransformer extends TransformerAbstract
{
    public function transform($search){
        return [
          'thumb' => $search['thumb'],
          'title' => $search['title'],
        ];
    }

}