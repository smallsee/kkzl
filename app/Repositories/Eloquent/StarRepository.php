<?php
namespace App\Repositories\Eloquent;

use App\Star;

class StarRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Star::class;
    }



}