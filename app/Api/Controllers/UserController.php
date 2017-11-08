<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;


use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\UserTransformer;
use App\Repositories\Eloquent\UserRepository;
use App\User;
use Dingo\Api\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends BaseController
{
    private $user;
    private $reply;

    public function __construct(UserRepository $user)
    {
        $reply = new ReplyTransformer();
        $this->user = $user;
        $this->reply = $reply;
    }

    public function userInfo($id){
        $user = $this->user->findById($id);
        if(! $user){
            return $this->reply->error(1,'用户没有数据');
        }

        return $this->response->item($user, new UserTransformer())->addMeta('errno', 0);
    }

    public function index() {
        $user = $this->user->findAll();
        if(! $user){
            return $this->reply->error(1,'用户没有数据');
        }

        return $this->response->collection($user, new UserTransformer())->addMeta('errno', 0);
    }

    public function show($id){
        $user = $this->user->findById($id);
        if(! $user){
            return $this->reply->error(1,'用户没有数据');
        }

        return $this->response->item($user, new UserTransformer())->addMeta('errno', 0);
    }

    public function update(Request $request){
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $user = $this->user->update($user,$request->all());


        if(! $user){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->response->item($user, new UserTransformer())->addMeta('errno', 0);
    }

    public function thumb(Request $request){
        return 'ssss';
    }

}