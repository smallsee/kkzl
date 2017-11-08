<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{

    protected $fillable = [
        'fav_type','fav_id','user_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function fav()
    {
        return $this->morphTo();
    }


}
