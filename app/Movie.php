<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'thumb','introduction',
        'tag', 'star','status','update_date','director','url'
    ];

    public function commits()
    {
        return $this->morphMany('App\Commit', 'commit')->with('user')->orderBy('created_at','desc');
    }
}
