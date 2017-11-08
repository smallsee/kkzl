<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\FavTransformer;
use App\Repositories\Eloquent\FavRepository;
use JWTAuth;
use App\Api\Transformers\ReplyTransformer;
use Dingo\Api\Http\Request;


class FavController extends BaseController
{

    private $fav;
    private $reply;

    public function __construct(FavRepository $fav)
    {
        $this->middleware('jwt.auth')->only(['store']);
        $reply = new ReplyTransformer();
        $this->fav = $fav;
        $this->reply = $reply;
    }

    public function index(){

        return 'fav/index';
    }

    public function store(Request $request){


        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $data = [
          'fav_type' => $request->get('type'),
          'fav_id' => $request->get('id'),
          'user_id' => $user->id,
        ];

        $fav = $this->fav->createFav($data);

        if (!$fav){
            return $this->reply->data(1001,'删除成功');
        }


        return $this->reply->data(1002,'添加成功');



    }


    public function hasFav(Request $request){

        $fav = $this->fav->hasFav($request->all());

        if (!$fav){
            return $this->reply->data(1001,'已收藏');
        }


        return $this->reply->data(1002,'收藏');
    }

    public function userFav(Request $request){

        $fav = $this->fav->findUserFav($request->all());
        $fav->load('fav');

        return $this->collection($fav, new FavTransformer())->addMeta('errno', 0);
    }

}