<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\FanStarTransformer;
use App\Api\Transformers\FanTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\FanRepository;
use Dingo\Api\Http\Request;


class FanController extends BaseController
{

    private $fan;
    private $reply;

    public function __construct(FanRepository $fan)
    {
        $reply = new ReplyTransformer();

        $this->fan = $fan;
        $this->reply = $reply;
    }

    public function fan(Request $request){


        $fan = $this->fan->createFan($request->all());
        if (!$fan){
            return $this->reply->data(1001,'删除成功');
        }


        return $this->reply->data(1002,'添加成功');
    }

    public function hasFan(Request $request){

        $fan = $this->fan->hasFan($request->all());

        if (!$fan){
            return $this->reply->data(1001,'关注');
        }


        return $this->reply->data(1002,'未关注');
    }

    public function userFan(Request $request){
        $type = $request->get('type') === 'fan_id' ? 'star' : 'fan';
        $fan = $this->fan->findUserFind($request->all());

        $fan->load($type);

        if ($type === 'fan'){
            return $this->collection($fan, new FanTransformer())->addMeta('errno', 0);
        }else{
            return $this->collection($fan, new FanStarTransformer())->addMeta('errno', 0);
        }

    }


}