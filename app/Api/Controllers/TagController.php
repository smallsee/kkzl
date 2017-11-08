<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\TagTransformer;
use App\Repositories\Eloquent\TagRepository;

class TagController extends BaseController
{

    private $tag;
    private $reply;

    public function __construct(TagRepository $tag)
    {
        $reply = new ReplyTransformer();
        $this->tag = $tag;
        $this->reply = $reply;
    }

    public function index(){

        $tag = $this->tag->findAll();

        if(! $tag){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->collection($tag, new TagTransformer())->addMeta('errno', 0);
    }




}