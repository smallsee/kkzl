<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StarType extends Model
{
    protected $fillable = [
        'star_type','star_id','user_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function star()
    {
        return $this->morphTo();
    }
}
