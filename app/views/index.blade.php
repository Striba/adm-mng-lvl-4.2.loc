@extends('layouts.default')

@section('content')

    <div class="container">
        <h2 class="text-center">Выберите действие: </h2>
        {{--<a href="{{URL::route('manager')}}">Менеджер</a><br>--}}
        {{--<a href="{{URL::route('admin')}}">Администратор</a><br>--}}
        <a href="{{URL::route('register')}}">Зарегистрироваться</a><br>
        <a href="{{URL::route('login')}}">Авторизироваться</a>
    </div>

@stop