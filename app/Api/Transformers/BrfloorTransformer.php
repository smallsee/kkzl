<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class BrfloorTransformer extends TransformerAbstract
{
    public function transform($brfloor){
        return [
            'id' => $brfloor['id'],
            'name' => $brfloor['name'],
            'phone' => $brfloor['phone'],
            'desc' => $brfloor['desc'],
            'company' => $brfloor['company'],
            'reason' => $brfloor['reason'],
        ];
    }

}