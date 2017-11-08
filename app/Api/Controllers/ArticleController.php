<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;


use App\Api\Transformers\ArticleTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\ArticleRepository;
use Dingo\Api\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class ArticleController extends BaseController
{


    private $article;
    private $reply;

    public function __construct(ArticleRepository $article)
    {
        $this->middleware('jwt.auth')->only(['store','destroy','update']);
        $reply = new ReplyTransformer();
        $this->article = $article;
        $this->reply = $reply;
    }

    public function index(){

        $article = $this->article->findAll();
        $article->load('user');

        if(! $article){
            return $this->reply->error(1,'文章没有数据');
        }
        return $this->collection($article, new ArticleTransformer())->addMeta('errno', 0);
    }

    public function hot(Request $request) {

        $article = $this->article->findHotAll(10);
        $article->load('user');

        if(! $article){
            return $this->reply->error(1,'文章没有数据');
        }

        return $this->collection($article, new ArticleTransformer())->addMeta('errno', 0);
    }

    public function show(Request $request, $id) {

        $api_token = $request->get('api_token','false');


        $article = $this->article->findById($id);
        $article->load('user','commits','favs');


        if(! $article){
            return $this->reply->error(1,'文章没有数据');
        }

        return $this->response->item($article, new ArticleTransformer())->addMeta('errno', 0);
    }

    public function store(Request $request){
        $article =  $this->article->createArticleAndTopic($request->all());

        if (!$article) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $article  = $this->article->deleteById($id);

        if ($article){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){


        $article  = $this->article->updateArticleAndTopic($request->all());

        if (!$article) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }




}