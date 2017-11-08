<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'title','user_id','big_thumb','topic','status','thumb'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function commits()
    {
        return $this->morphMany('App\Commit', 'commit')->with('user')->orderBy('created_at','desc');
    }

    public function favs()
    {
        return $this->morphMany('App\Fav', 'fav')->orderBy('created_at','desc');
    }

    public function hasfav($user_id = 0)
    {

        return !! $this->morphMany('App\Fav', 'fav')->where('user_id', $user_id)->count();
    }
}
