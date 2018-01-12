<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\BrfloorTransformer;
use App\Repositories\Eloquent\BrfloorRepository;
use Dingo\Api\Http\Request;



class BrfloorController extends BaseController
{

    private $brfloor;
    private $reply;

    public function __construct(BrfloorRepository $brfloor)
    {

        $reply = new ReplyTransformer();
        $this->brfloor = $brfloor;
        $this->reply = $reply;
    }

    public function index(Request $request) {
        $brfloor = $this->brfloor->findAll();

        if(! $brfloor){
            return $this->reply->error(1,'小程序没有数据');
        }

        return $this->collection($brfloor, new BrfloorTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $brfloor = $this->brfloor->findById($id);
        return $brfloor;
        if(! $brfloor){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($brfloor, new BrfloorTransformer)->addMeta('errno', 0);
    }

    public function store(Request $request){

//        return $request->all();
        $brfloor = $this->brfloor->createBrfloor($request->all());

        if (!$brfloor) {
            return $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $brfloor  = $this->brfloor->deleteById($id);

        if ($brfloor){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }



}