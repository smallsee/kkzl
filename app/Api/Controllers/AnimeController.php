<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\AnimeShowTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\AnimeTransformer;
use App\Repositories\Eloquent\AnimeRepository;
use Dingo\Api\Http\Request;



class AnimeController extends BaseController
{

    private $anime;
    private $reply;

    public function __construct(AnimeRepository $anime)
    {
        $this->middleware('jwt.auth')->except(['index','show','homeIndex','homeRecommend','search','hot']);

        $reply = new ReplyTransformer();

        $this->anime = $anime;
        $this->reply = $reply;
    }



    public function hot(Request $request) {
        $anime = $this->anime->findHotAll(10);
        $anime->load('commits');
        if(! $anime){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($anime, new AnimeTransformer())->addMeta('errno', 0);
    }


    public function index(Request $request) {
        $skip = $request->get('skip' , 0);
        $anime = $this->anime->findSkipOrderTime($skip);
        if(! $anime){
            return $this->reply->error(1,'视频没有数据');
        }
        return $this->collection($anime, new AnimeTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $anime = $this->anime->findById($id);
        $anime->load('files','commits');
        if(! $anime){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($anime, new AnimeShowTransformer())->addMeta('errno', 0);
    }

    public function store(Request $request){

        $anime = $this->anime->createAnimeWithOther($request->all());

        if (!$anime) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $anime  = $this->anime->deleteById($id);

        if ($anime){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){
        $anime  = $this->anime->updateAnimeWithOther($request->all());

        if (!$anime) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }


}