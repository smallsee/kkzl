<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;


use App\Repositories\Eloquent\SearchRepository;
use App\Api\Transformers\ReplyTransformer;
use Dingo\Api\Http\Request;


class SearchController extends BaseController
{

    private $search;
    private $reply;

    public function __construct(SearchRepository $search)
    {
        $reply = new ReplyTransformer();
        $this->search = $search;
        $this->reply = $reply;
    }

    public function search(Request $request) {
        $data = $this->search->findLikeTitle($request->all());

        if(! $data){
            return $this->reply->error(1,'没有数据');
        }

        return $this->reply->data(0,$data);
    }


}