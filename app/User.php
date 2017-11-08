<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','thumb','status','confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function followers(){
        return $this->belongsToMany(self::class, 'followers','follower_id','followed_id')->withTimestamps();
    }

    public function followersUser(){
        return $this->belongsToMany(self::class, 'followers','followed_id','follower_id')->withTimestamps();
    }


    public function followThisUser($user){
        return $this->followers()->toggle($user);
    }
}
