<?php
namespace App\Repositories\Eloquent;

use App\Director;

class DirectorRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Director::class;
    }



}