<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\XcxTransformer;
use App\Repositories\Eloquent\XcxRepository;
use Dingo\Api\Http\Request;



class XcxController extends BaseController
{

    private $xcx;
    private $reply;

    public function __construct(XcxRepository $xcx)
    {

        $reply = new ReplyTransformer();
        $this->xcx = $xcx;
        $this->reply = $reply;
    }

    public function index(Request $request) {
        $xcx = $this->xcx->findAll();

        if(! $xcx){
            return $this->reply->error(1,'小程序没有数据');
        }

        return $this->collection($xcx, new XcxTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $xcx = $this->xcx->findById($id);
        return $xcx;
        if(! $xcx){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($xcx, new XcxTransformer)->addMeta('errno', 0);
    }

    public function store(Request $request){

//        return $request->all();
        $xcx = $this->xcx->createXcx($request->all());

        if (!$xcx) {
            return $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $xcx  = $this->xcx->deleteById($id);

        if ($xcx){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }



}