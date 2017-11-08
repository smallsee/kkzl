<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\CommitTransformer;
use JWTAuth;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\CommitRepository;
use Dingo\Api\Http\Request;


class CommitController extends BaseController
{

    private $commit;
    private $reply;

    public function __construct(CommitRepository $commit)
    {
        $this->middleware('jwt.auth')->only(['store']);
        $reply = new ReplyTransformer();
        $this->commit = $commit;
        $this->reply = $reply;
    }

    public function index(){

        return 'commit/index';
    }

    public function store(Request $request){


        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $data = [
          'content' => $request->get('commit'),
          'commit_type' => $request->get('type'),
          'commit_id' => $request->get('id'),
          'user_id' => $user->id,
        ];

        $commit = $this->commit->createCommit($data);
        if (!$commit){
            return $this->reply->error(1,'创建失败');
        }

        return $this->response->item($commit, new CommitTransformer())->addMeta('errno', 0);
    }

    public function userCommit(Request $request){

        $commit = $this->commit->findUserCommit($request->all());
        $commit->load('user','commit');
        return $this->collection($commit, new CommitTransformer())->addMeta('errno', 0);
    }
}