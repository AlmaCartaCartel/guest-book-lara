<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\Coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CommentsController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function store(Coment $request)
    {
        $request->validated();

        $comment = new Comment();
        $comment-> message = $request->get('message');
        $comment-> user_name = Auth::user() -> name;
        $comment-> comment_id = $request->get('comment_id');

        $comment->save();
        return $comment;
    }

    public function all()
    {
        $comment = DB::table('comments')->where('comment_id', 0)->paginate();
        return Comment::transformData($comment);
    }
}
