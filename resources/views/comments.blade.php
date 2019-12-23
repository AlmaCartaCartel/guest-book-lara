@extends('layout')

@section('content')
    <div>
        <h1>Home page</h1>
        <div>
            <div class="alert alert-dark" role="alert">

            </div>

            <h3>Comments</h3>
            <div>
                <ul id="comments" style="list-style: none" data-auth="" data-nesting="">

                </ul>
            </div>
            {{ Form::open(['route' => 'comment.add', 'method' => 'post']) }}
                <h4> Message </h4>

                <input type="hidden" name="comment_id" value='1' class="comment_id" >
                <textarea name="message" id="textarea" class="form-control" cols="30" rows="3" placeholder="Введите комментарий"></textarea><br>

                <button id="submit"  class="btn btn-success submit"> Submit</button>
            {{ Form::close() }}

            <div class="alert alert-dark" role="alert">
                <a href="/auth">Авторизируйтесь</a>! или <a href="/register">зарагестрируйтесь</a>!
            </div>
        </div>
    </div>
@endsection
