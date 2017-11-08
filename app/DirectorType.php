<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectorType extends Model
{
    protected $fillable = [
        'director_type','director_id','user_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function director()
    {
        return $this->morphTo();
    }
}
