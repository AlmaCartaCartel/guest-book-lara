<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
            if ($comment['comment_id'] == $id  and $inc <= 2){
                $comment['parent'] = $inc;
                $comment['answers'] = self::transformData($comments, $comment['id'], $inc + 1);
                array_push($parent, $comment);
            }
        }
        return $parent;
    }
}
