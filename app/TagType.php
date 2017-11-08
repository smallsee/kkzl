<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    protected $fillable = [
        'tag_type','tag_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tag()
    {
        return $this->morphTo();
    }
}
