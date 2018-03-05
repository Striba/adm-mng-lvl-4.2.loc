@extends('cabinet.default')

@section('content')
    <div class="container">
        <a href="{{URL::route('admin', [$id])}}" class="label label-primary">Вернуться</a>

    @if($errors)

    <br>
            <strong style="color:red">{{$errors}}</strong>
    <br>


@endif

@if($success)

            <br>
            <strong style="color:green">{{$success}}</strong>
            <br>

@endif

        <!-- Создаем форму начало -->
<div class="center-block" style="margin: 5%;">
<!-- Открывающий тэг формы со всеми данными -->
{{ Form::open(['url' => URL::route('save', [$id]),
'class' => 'form-horizontal ',
'method' => 'POST',
'enctype' => 'multipart/form-data']) }}

<div class="form-group">
    <!--Создаем лейбл label -->
    {{ Form::label('email','email',['class' => 'col-xs-2 control-label']) }}
    <div class="col-xs-8">
        {{ Form::text('email','',['class' => 'form-control',
        'placeholder' => 'Введите email пользователя']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('password', 'Пароль', ['class' => 'col-xs-2 control-label']) }}
    <div class="col-xs-8">
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>
</div>
        <div class="form-group">
            {{ Form::label('name', 'Имя пользователя', ['class' => 'col-xs-2 control-label']) }}
            {{Form::token()}}
            <div class="col-xs-8">
                {{ Form::text('name','',['class' => 'form-control',
                'placeholder' => 'Введите имя пользователя']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('role', 'Должность', ['class' => 'col-xs-2 control-label']) }}
            <div class="col-xs-8">
                {{ Form::select( 'role', [
                '1' => 'Администратор',
                '0' => 'Менеджер'], '0', [
                'class' => 'form-control'] ) }}
            </div>
        </div>

<div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
        <!-- Кнопка отправки формы: -->
        {{ Form::button('Сохранить', ['class' => 'btn btn-primary',
        'type' => 'submit']) }}
    </div>
</div>

<!-- Закрывающий тэг формы -->
{{ Form::close() }}

</div>

<!-- Создаем форму конец -->

    </div>


@stop





