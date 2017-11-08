<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkiraType extends Model
{
    protected $fillable = [
        'akira_type','akira_id','user_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function akira()
    {
        return $this->morphTo();
    }
}
