<?php
namespace App\Repositories\Eloquent;
use App\Topic;

class TopicRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Topic::class;
    }



}