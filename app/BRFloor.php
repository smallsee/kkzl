<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BRFloor extends Model
{
    protected $fillable = [
        'name','phone','company', 'desc', 'reason'
    ];
}
