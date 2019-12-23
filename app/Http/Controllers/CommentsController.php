<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function index()
    {
        $comments = Comment::all();

        return view('welcome', ['comments' => $this->transformData($comments)]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'message' => 'required'
        ]);

        $comment = new Comment();
        $comment->message = $request->get('message');
        $comment->user_name = Auth::user()->name;
        $comment->comment_id = $request->get('comment_id');

        $comment->save();
        return $comment;
    }

    private function transformData($comments, $id = 0, $inc = 0)
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

    public function all()
    {
        $comment = Comment::all();

        return $this->transformData($comment);
    }
}
