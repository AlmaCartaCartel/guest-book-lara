<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Comment extends Model
{
     protected $fillable = [
        'message', 'user_name', 'comment_id',
    ];
    protected $table = 'comments';

    public static function transformData($comments, $id = 0, $inc = 0)
    {
        $parent = [];
            foreach ($comments as $comment){
                if ($comment['comment_id'] == $id  and $inc <= Config::get('constants.nesting')){
                    $comment['parent'] = $inc;
                    $comment['answers'] = Comment::transformData($comments, $comment['id'], $inc + 1);
                    array_push($parent, $comment);
                }
            }
        return $parent;
    }
}
