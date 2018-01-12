<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;


use App\Api\Transformers\PictureTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\PictureRepository;
use Dingo\Api\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class PictureController extends BaseController
{


    private $picture;
    private $reply;

    public function __construct(PictureRepository $picture)
    {
        $this->middleware('jwt.auth')->only(['store','destroy','update']);
        $reply = new ReplyTransformer();
        $this->picture = $picture;
        $this->reply = $reply;
    }

    public function index(Request $request){

        $skip = $request->get('skip' , 0);
        $picture = $this->picture->findSkipOrderTime($skip);
        $picture->load('user');

        if(! $picture){
            return $this->reply->error(1,'文章没有数据');
        }
        return $this->collection($picture, new PictureTransformer())->addMeta('errno', 0);
    }

    public function hot(Request $request) {

        $picture = $this->picture->findHotAll(10);
        $picture->load('user');

        if(! $picture){
            return $this->reply->error(1,'文章没有数据');
        }
        return $this->collection($picture, new PictureTransformer())->addMeta('errno', 0);
    }

    public function show(Request $request, $id) {

        $api_token = $request->get('api_token','false');


        $picture = $this->picture->findById($id);
        $picture->load('user','commits','favs');


        if(! $picture){
            return $this->reply->error(1,'文章没有数据');
        }

        return $this->response->item($picture, new PictureTransformer())->addMeta('errno', 0);
    }

    public function store(Request $request){
        $picture =  $this->picture->createPictureAndTopic($request->all());

        if (!$picture) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $picture  = $this->picture->deleteById($id);

        if ($picture){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){


        $picture  = $this->picture->updatePictureAndTopic($request->all());

        if (!$picture) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }




}