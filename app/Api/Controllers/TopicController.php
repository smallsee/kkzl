<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\TopicTransformer;
use App\Repositories\Eloquent\TopicRepository;

class TopicController extends BaseController
{

    private $topic;
    private $reply;

    public function __construct(TopicRepository $topic)
    {
        $reply = new ReplyTransformer();
        $this->topic = $topic;
        $this->reply = $reply;
    }

    public function index(){

        $tag = $this->topic->findAll();

        if(! $tag){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->collection($tag, new TopicTransformer())->addMeta('errno', 0);
    }


}