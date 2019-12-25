<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\Coment;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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

    public function all(Request $request)
    {
        $page = $request->get('page');
        $paginate = Config::get('constants.paginate');

        $comments = Comment::all();
        $comments_pag = collect(Comment::transformData($comments));
        $count = $comments_pag -> count();

        $pag = new LengthAwarePaginator($comments_pag->forPage($page, $paginate), $count, $paginate, $page);
        $pag->withPath('comments/all');

        return view('comments', ['comments' => $pag]);
    }
}
