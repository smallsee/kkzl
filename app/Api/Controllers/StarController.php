<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\StarTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\StarRepository;


class StarController extends BaseController
{

    private $star;
    private $reply;

    public function __construct(StarRepository $star)
    {
        $reply = new ReplyTransformer();

        $this->star = $star;
        $this->reply = $reply;
    }

    public function index(){

        $star = $this->star->findAll();


        if(! $star){
            return $this->reply->error(1,'声优没有数据');
        }
        return $this->collection($star, new StarTransformer())->addMeta('errno', 0);
    }


}