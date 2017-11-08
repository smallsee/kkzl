<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = [
        'fan_id','star_id'
    ];

    //粉丝用户
    public function fan(){

        return $this->hasOne(\App\User::class,'id','fan_id');
    }

    //被关注用户
    public function star(){

        return $this->hasOne(\App\User::class,'id','star_id');
    }
}
