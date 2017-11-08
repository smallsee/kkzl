<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\AkiraTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\AkiraRepository;


class AkiraController extends BaseController
{

    private $akira;
    private $reply;

    public function __construct(AkiraRepository $akira)
    {
        $reply = new ReplyTransformer();

        $this->akira = $akira;
        $this->reply = $reply;
    }

    public function index(){

        $akira = $this->akira->findAll();


        if(! $akira){
            return $this->reply->error(1,'声优没有数据');
        }
        return $this->collection($akira, new AkiraTransformer())->addMeta('errno', 0);
    }


}