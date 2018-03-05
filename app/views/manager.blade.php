@extends('cabinet.default')

@section('content')


    <div class="container">
        <section class="panel panel-primary">
            <div class="panel-heading">

               Добро пожаловать, менеджер {{$userData->name}}! Ваши текущие задания:
            </div>
            <div class="panel-body">
                @if(isset($tasks))
                <table class="table table-bordered">
                    <thead>
                    <th>Название</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                    </thead>

                    <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->filename}}</td>
                        <td>{{$task->created_at}}</td>
                        <td><a href="{{public_path('tasks/'.$task->filename)}}" download="{{$task->filename}}"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-download"> Скачать</i></button></a> </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                    @else
                    <p class="text-center"> На данный момент задач нет </p>
                    @endif

                <button class="btn btn-primary">
                    <a href="{{url('/logout')}}" style="color: #bcd42a">Выход из кабинета
                    </a>

                </button>

            </div>

        </section>
    </div>


@stop