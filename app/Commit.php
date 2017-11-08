<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commit extends Model
{
    //
    protected $fillable = [
        'commit_type','commit_id','user_id','content'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function commit()
    {
        return $this->morphTo();
    }
}
