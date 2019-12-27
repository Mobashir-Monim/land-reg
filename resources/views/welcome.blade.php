{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->

        <!-- Styles -->
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
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
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}


@extends('layouts.app')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>
        html, body {
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
            font-size: 3em;
        }

        .links > a {
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

        #target {
            height: 91vh;
        }
    </style>
@endsection

@section('content')
    <div class="row" id="target">
        <div class="col-md-12 my-auto">
            <h3 class="text-center title">Land Registration using Blockchain</h3>
            <div class="row">
                <div class="col-md-6 my-3">
                    <a href="{{ route('blocks') }}" class="btn btn-primary w-100">Test PHP Chain</a>
                </div>
                <div class="col-md-6 my-3">
                    <a href="{{ route('js-blocks') }}" class="btn btn-success w-100">Test JS Chain</a>
                </div>

                @auth
                    <div class="col-md-6 my-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary w-100">Dashboard</a>
                    </div>
                    <div class="col-md-6 my-3">
                        <a href="{{ route('transactions.create') }}" class="btn btn-warning w-100">Add Transaction</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- <iframe src="https://www.taff2.com/iframe/useful-links" style="border:0px #ffffff none;" name="myiFrame" scrolling="yes" frameborder="0" marginheight="0px" marginwidth="0px" height="100%" width="100%" allowfullscreen></iframe> --}}
    <iframe src="https://www.taff2.com/iframe/useful-links" width="100%" height="600px"></iframe>
@endsection