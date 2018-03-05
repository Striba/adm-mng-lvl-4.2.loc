@extends('layouts.default')


@section('content')


    <div class="container" style="margin: 5%">
        @if($authError)
            <div class="bg-warning text-center">{{$authError}}</div>
        @endif

        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Для входа в личный кабинет - авторизируйтесь.</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{URL::route('login', [null])}}"  >

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="hidden" value="{{csrf_token()}}" name="_token" >
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" placeholder=" Ваш email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Ваш пароль">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" > Запомнить меня
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Войти в кабинет
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/') }}">Вернуться на главную</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
