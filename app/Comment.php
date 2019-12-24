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
        $parent = collect([]);
            foreach ($comments as $comment){
                if ($comment -> comment_id == $id  and $inc <= 2){
                    $comment -> parent = $inc;
                    $comment -> answers = self::transformData( $comments, $comment -> id, $inc + 1);
                    $parent->push($comment);
                }
            }

            return $parent;
    }

//    public function newCollection(array $models = [])
//    {
//        return parent::newCollection(self::transformData($models)); // TODO: Change the autogenerated stub
//    }
}
