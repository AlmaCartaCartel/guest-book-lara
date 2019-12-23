<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = [
        'message', 'user_name', 'comment_id',
    ];

    protected $table = 'comments';
}
