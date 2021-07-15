<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name', 'detail',
    ];
    protected $table = 'posts';

    protected $guarded = [];

}
