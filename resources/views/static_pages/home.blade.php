@extends('layouts.default')
@section('content')
{{--    <h1>主页</h1>--}}
    <div class="jumbotron">
        <h1>Hello laravel</h1>
        <p class="lead">
            你现在所看到的是 <a href="https://learnku.com/courses/laravel-essential-training">Laravel 入门</a> 的示例项目主页。
        </p>
        <p>
            every one , begin hear!
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="botton"> 现在注册 </a>
        </p>
    </div>
@stop
