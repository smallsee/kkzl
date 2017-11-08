<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'title', 'thumb','episodes','introduction','issue_date',
        'tag', 'akira','status','update_date'
    ];

    public function files()
    {
        return $this->hasMany('App\AnimeFile','anime_id');
    }


    public function commits()
    {
        return $this->morphMany('App\Commit', 'commit')->with('user')->orderBy('created_at','desc');
    }

}
