@extends('cabinet.default')

@section('content')

    <div class="container">

        <a href="{{URL::route('admin', [$manager_id])}}" class="label label-primary">Вернуться</a>

        <h1>Добавьте файлы в выделенный сектор для менеджера {{$managerName}}</h1>
        <div class="col-md-8" style="margin: 5%;">
            {{ Form::open([
                    'url' => URL::route('uptasks', [$manager_id]),
                    'class' => 'form-horizontal dropzone',
                    'id' => 'mydropzone uploads',
                    'files' => 'true',
                    'enctype' => 'multipart/form-data'

            ]) }}
            {{Form::token()}}

            {{ Form::close() }}
        </div>


    </div>


@stop