<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xcx extends Model
{
    protected $fillable = [
        'name','phone','desc', 'server'
    ];
}
