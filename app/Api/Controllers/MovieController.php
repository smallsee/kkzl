<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\MovieTransformer;
use App\Repositories\Eloquent\MovieRepository;
use Dingo\Api\Http\Request;



class MovieController extends BaseController
{

    private $movie;
    private $reply;

    public function __construct(MovieRepository $movie)
    {
        $this->middleware('jwt.auth')->except(['index','show','homeIndex','homeRecommend','search','hot']);

        $reply = new ReplyTransformer();

        $this->movie = $movie;
        $this->reply = $reply;
    }



    public function hot(Request $request) {
        $movie = $this->movie->findHotAll(10);
        $movie->load('commits');
        if(! $movie){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($movie, new MovieTransformer())->addMeta('errno', 0);
    }


    public function index() {
        $movie = $this->movie->findAll();
        $movie->load('commits');


        if(! $movie){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($movie, new MovieTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $movie = $this->movie->findById($id);
        $movie->load('commits');
        if(! $movie){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($movie, new MovieTransformer)->addMeta('errno', 0);
    }

    public function store(Request $request){

        $movie = $this->movie->createMovieWithOther($request->all());

        if (!$movie) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $movie  = $this->movie->deleteById($id);

        if ($movie){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){
        $movie  = $this->movie->updateMovieWithOther($request->all());

        if (!$movie) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }


}