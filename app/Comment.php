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

    public static function transformData($parent_comments, $comments, $id = 0, $inc = 0)
    {
        if($parent_comments !== null){
            $comments = $comments->concat($parent_comments);
        }

        $parent = collect([]);
            foreach ($comments as $comment){
                if ($comment -> comment_id == $id  and $inc <= Config::get('constants.nesting')){
                    $comment -> parent = $inc;
                    $comment -> answers = self::transformData( null , $comments, $comment -> id, $inc + 1);
                    $parent->push($comment);
                }
            }

        return $parent;
    }

}
