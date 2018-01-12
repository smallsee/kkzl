<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\TvShowTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\TvTransformer;
use App\Repositories\Eloquent\TvRepository;
use Dingo\Api\Http\Request;



class TvController extends BaseController
{

    private $tv;
    private $reply;

    public function __construct(TvRepository $tv)
    {
        $this->middleware('jwt.auth')->except(['index','show','homeIndex','homeRecommend','search','hot']);

        $reply = new ReplyTransformer();

        $this->tv = $tv;
        $this->reply = $reply;
    }



    public function hot(Request $request) {
        $tv = $this->tv->findHotAll(10);
        $tv->load('files','commits');
        if(! $tv){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($tv, new TvShowTransformer())->addMeta('errno', 0);
    }
    

    public function index(Request $request) {
        $skip = $request->get('skip' , 0);
        $tv = $this->tv->findSkipOrderTime($skip);

        if(! $tv){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($tv, new TvTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $tv = $this->tv->findById($id);
        $tv->load('files','commits');
        if(! $tv){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($tv, new TvShowTransformer)->addMeta('errno', 0);
    }

    public function store(Request $request){

        $tv = $this->tv->createTvWithOther($request->all());

        if (!$tv) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $tv  = $this->tv->deleteById($id);

        if ($tv){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){
        $tv  = $this->tv->updateTvWithOther($request->all());

        if (!$tv) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }


}