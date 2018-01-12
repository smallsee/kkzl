<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BRTank extends Model
{
    protected $fillable = [
        'name','phone','company', 'desc', 'reason'
    ];
}
