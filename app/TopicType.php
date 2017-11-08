<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicType extends Model
{
    protected $fillable = [
        'topic_type','topic_id','user_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function topic()
    {
        return $this->morphTo();
    }
}
