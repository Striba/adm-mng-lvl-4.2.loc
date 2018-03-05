<?php

//Путь на главную страницу
Route::get('/', [
    'as'   => 'index',
    'uses' => 'SiteController@index'
]);

//Регистрация пользователя
Route::any('/register', [
    'as' => 'register',
    'uses' => 'SiteController@registration',
]);

//Авторизация пользователя
Route::any('/login', [
    'as' => 'login',
    'uses' => 'SiteController@login',
]);

//Создаем группу роутов в которые возможен достут лишь после аутентификации:
Route::group(['before' => 'auth'], function()
{


//Загрузка файлов с заданиями для менеджеров
    Route::post('/upload/{manager_id}', [
        'as' => 'uptasks',
        'uses' => 'AdminController@uploadtasks'
    ]);



//Путь в кабинет зарегистрированного пользователя 'id' == 'id_user':
    Route::get('/cabinet/{id_user}', [
        'as' => 'cabinet',
        'uses' => 'SiteController@cabinet'
    ]);

//Выход из кабинета
    Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('/')->with('message', 'Сейчас вы будете перенаправленны на главную страницу');
    });

//Сохранение добавленного пользователя с айди текущего админа для возврата
    Route::post('/save/{id}', [
        'as' => 'save',
        'uses' => 'UserAddController@save'

    ]);

//Обновление информации пользователя
    Route::post('/update/{id_admin}', [
        'as' => 'update',
        'uses' => 'UserEditController@update'
    ]);

//Редактирования данных пльзователя
    Route::get('/edituser/{id}/{id_admin}', [
        'as' => 'edituser',
        'uses' => 'UserEditController@execute'
    ]);

//Удаление пльзователя
    Route::get('/delete/{id}',[
        'as' => 'deleteuser',
        'uses' => 'UserEditController@delete'
    ]);

//Добавление задачи менеджеру с айди manager_id
    Route::get('/addtask/{manager_id}', [
        'as' => 'addtask',
        'uses' => 'AdminController@addtask'
    ]);

//Переход в кабинет администратора с определеннйм айди
    Route::get('/admin/{id}', [
        'as' => 'admin',
        'uses' => 'AdminController@index'
    ]);

//Перенаправление на ЛК текущего менеджера
    Route::get('/manager/{id}', [
        'as' => 'manager',
        'uses' => 'ManagerController@index'
    ]);

//Добавить пользователя(передаем айди текущего админа для возврата назад)
    Route::get('/adduser/{id}', [
        'as' => 'adduser',
        'uses' => 'UserAddController@execute'
    ]);

});



