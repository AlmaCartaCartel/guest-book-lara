<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        div.comment {
            width: 500px;
            border: 1.3px solid gray;
            border-radius: 5px;
            padding: 20px 10px 0 0;
            background-color: #F8F8FF;
        }

        textarea {
            width: 500px;
            height: 180px;
        }

        div.answer {
            margin-left: 30px;
            border: 1px solid black;
            padding: 20px 10px 0 5px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref ">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div>
                <h1>Home page</h1>

                <div>
                    <h3>Comments</h3>
                    <div>
                        <ul id="comments" style="list-style: none" data-auth="{!! Auth::check() ? true : false !!}" data-nesting="{!! Config::get('constants.nesting') !!}">

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="/scripts/index.js">
    </script>
    <script src="/js/app.js"></script>
</body>

</html>
