<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\Coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function store(Coment $request)
    {

//        $this->validate($request, [
//            'message' => 'required'
//        ]);
        $request->validated();

        $comment = new Comment();
        $comment->message = $request->get('message');
        $comment->user_name = Auth::user()->name;
        $comment->comment_id = $request->get('comment_id');

        $comment->save();
        return $comment;
    }

    public function all()
    {
        $comment = Comment::all();
        return Comment::transformData($comment);
    }
}
