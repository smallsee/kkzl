<?php
namespace App\Repositories\Eloquent;

use App\Commit;

class CommitRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Commit::class;
    }

    function findUserCommit(array $attributes){

        $user_id = $attributes['user_id'];
        $commit_type = $attributes['commit_type'];

        return $this->model->where([
            ['user_id',$user_id],
            ['commit_type',$commit_type],
        ])->get();


    }



}