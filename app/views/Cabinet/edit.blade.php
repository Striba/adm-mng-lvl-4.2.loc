@extends('cabinet.default')

@section('content')
    <div class="container">
        <a href="{{URL::route('admin',[$id_admin])}}" class="label label-primary">Вернуться</a>
    <!-- Открывающий тэг формы со всеми данными -->
    {{ Form::open(['url' => URL::route('update', [$id_admin]),
    'class' => 'form-horizontal ',
    'method' => 'POST',
    'enctype' => 'multipart/form-data']) }}


    <div class="form-group">
        <!--Создаем лейбл label -->
        {{ Form::label('email','email',['class' => 'col-xs-2 control-label']) }}
        <div class="col-xs-8">
            {{Form::token()}}
            {{Form::hidden('id', $data->id)}}
            {{ Form::text('email',$data->email,['class' => 'form-control',
            'placeholder' => 'Введите email пользователя']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Имя пользователя', ['class' => 'col-xs-2 control-label']) }}
        <div class="col-xs-8">
            {{ Form::text('name',$data->name,['class' => 'form-control',
            'placeholder' => 'Введите имя пользователя']) }}
        </div>
    </div>
        <div class="form-group">
            {{ Form::label('role', 'Должность', ['class' => 'col-xs-2 control-label']) }}
            <div class="col-xs-8">
                {{ Form::select( 'role', [
                '1' => 'Администратор',
                '0' => 'Менеджер'], $data->role, [
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

    <!-- Создаем форму конец -->
    </div>

@stop