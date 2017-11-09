<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    protected $fillable = [
        'title', 'thumb','introduction',
        'tag', 'star','status','update_date','url','episodes','country'
    ];

    public function files()
    {
        return $this->hasMany('App\TvFile','tv_id');
    }

    public function commits()
    {
        return $this->morphMany('App\Commit', 'commit')->with('user')->orderBy('created_at','desc');
    }
}
