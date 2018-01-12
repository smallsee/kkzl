<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\BrtankTransformer;
use App\Repositories\Eloquent\BrtankRepository;
use Dingo\Api\Http\Request;



class BrtankController extends BaseController
{

    private $brtank;
    private $reply;

    public function __construct(BrtankRepository $brtank)
    {

        $reply = new ReplyTransformer();
        $this->brtank = $brtank;
        $this->reply = $reply;
    }

    public function index(Request $request) {
        $brtank = $this->brtank->findAll();

        if(! $brtank){
            return $this->reply->error(1,'小程序没有数据');
        }

        return $this->collection($brtank, new BrtankTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $brtank = $this->brtank->findById($id);
        return $brtank;
        if(! $brtank){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($brtank, new BrtankTransformer)->addMeta('errno', 0);
    }

    public function store(Request $request){

//        return $request->all();
        $brtank = $this->brtank->createBrtank($request->all());

        if (!$brtank) {
            return $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $brtank  = $this->brtank->deleteById($id);

        if ($brtank){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }



}