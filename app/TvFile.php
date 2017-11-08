<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvFile extends Model
{
    protected $fillable = [
        'file_name', 'file_url', 'tv_id'
    ];
}
