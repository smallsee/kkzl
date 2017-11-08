<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimeFile extends Model
{
    protected $fillable = [
        'file_name', 'file_url', 'anime_id'
    ];
}
