@extends('layouts.default')

@section('content')


    {{--Регистрация начало формы--}}


    <div class="container" style="margin: 5%">
        @if($success)
            <div class="bg-success text-center">{{$success}}</div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Если у Вас нет учетной записи, регистрируйтесь пожалуйста.</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('register')}}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="">
                                    <input type="hidden" name="_token" value="{{csrf_token();}}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role" class="col-md-4 control-label">Должность</label>

                                <div class="col-md-6">
                                    <select  class="form-control" name="role" value="">
                                        <option value="1">Администратор</option>
                                        <option value="0">Менеджер</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                {{--<div class="btn-group">--}}
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Зарегистрироваться
                                        </button>

                                        <a class="btn btn-link" href="{{ url('/') }}">Вернуться на главную</a>
                                    </div>
                                {{--</div>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Регистрация концец формы--}}

@stop
