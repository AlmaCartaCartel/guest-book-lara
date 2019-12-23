<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use Illuminate\Support\Facades\DB;

class CommentsControler extends Controller
{
    protected $fillable = [
        'message',
        'comment_id',
        'user_id'
    ];

    public function index()
    {
        return view('comments');
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = new Comments();
        $comment -> message = $request->get('message');
        $comment -> user_id = 1;
        $comment -> comment_id = 1;
        $comment -> save();
        DB::table('comments')->insert(['massage' => $request->get('message')]);
        return redirect()->back()->with('status', 'Ваш комментарий будет скоро добавлен');
    }
}
