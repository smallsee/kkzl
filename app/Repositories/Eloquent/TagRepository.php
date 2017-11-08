<?php
namespace App\Repositories\Eloquent;
use App\Tag;

class TagRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Tag::class;
    }



}