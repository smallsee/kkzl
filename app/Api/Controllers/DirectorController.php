<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\DirectorTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\DirectorRepository;


class DirectorController extends BaseController
{

    private $director;
    private $reply;

    public function __construct(DirectorRepository $director)
    {
        $reply = new ReplyTransformer();

        $this->director = $director;
        $this->reply = $reply;
    }

    public function index(){

        $director = $this->director->findAll();


        if(! $director){
            return $this->reply->error(1,'声优没有数据');
        }
        return $this->collection($director, new DirectorTransformer())->addMeta('errno', 0);
    }


}