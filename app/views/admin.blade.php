@extends('cabinet.default')

@section('content')

    <style type="text/css">
        table tbody tr:hover{
            background-color: #bcd42a;
        }

    </style>


    <a href="{{URL::route('adduser', [$userData->id])}}" class="label label-primary">Добавить ползователя</a>
    <div class="handler text-center"> Добро пожаловать, администратор {{$userData->name}}</div>
    @if($users->count())
        <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">email</th>
                <th scope="col">Должность</th>
                <th scope="col">Имя</th>
                <th scope="col">Создан</th>
                <th scope="col">Изменен</th>
                <th scope="col">Редактировать</th>
                <th scope="col">Удалить</th>
                <th scope="col">Добавить задачу</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        @if($user->role == true)
                            <td>Администратор</td>

                        @else
                            <td>Менеджер</td>
                        @endif
                        <td>{{$user->name}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td><a href="{{URL::route('edituser', [$user->id, $userData->id])}}">Редактировать</a></td>
                        <td><a href="{{URL::route('deleteuser', [$user->id])}}">Удалить</a></td>
                        @if($user->role == true)
                            <td></td>
                        @else
                            <td><a href="{{URL::route('addtask', [$user->id])}}">Загрузить файл(ы)</a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
            <button class="btn btn-primary">
                <a href="{{url('/logout')}}" style="color: #bcd42a">Выход из кабинета
                </a>

            </button>
        </div>
    @endif

@stop