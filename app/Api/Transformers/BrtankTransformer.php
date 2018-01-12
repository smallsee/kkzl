<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class BrtankTransformer extends TransformerAbstract
{
    public function transform($brtank){
        return [
          'id' => $brtank['id'],
          'name' => $brtank['name'],
          'phone' => $brtank['phone'],
          'desc' => $brtank['desc'],
          'company' => $brtank['company'],
          'reason' => $brtank['reason'],
        ];
    }

}