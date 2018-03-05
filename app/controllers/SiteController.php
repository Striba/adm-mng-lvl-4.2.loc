<?php

class SiteController extends BaseController{

    /**
     * Метод формирования стартовой страницы сайта
     *
     */
    public function index()
    {
        $users = Users::get();
        //Название страницы:
        $title = 'Главная страница';

        return View::make('index', array(
            'users' => $users,
            'title' => $title
        ));
    }

    /**
     * Метод формирования стартовой страницы сайта
     *
     * @param int $id_user - айди текущего пользователя
     * @return View
     */
    public function login($id_user = null)
    {
        $users = Users::get();
        //Название страницы:
        $title = 'Авторизация';
        //Проверяем авторизован ли пользователь:
        if(Auth::check()){
            //Берем из сессии айди текущего пользователя:
            $id_user = Session::get('id_user');

            //Перенаправляем на страницу пользователя(передаем айди пользователя):
            return Redirect::to('cabinet/'.$id_user);
        }

        //Проверка на существование глобальной переменной $_POST['email']:
        if (Input::has('email')){
            //Присваиваем полученнst значения из формы в переменные:
            $email = Input::get('email') ? Input::get('email') : null;
            $password = Input::get('password') ? Input::get('password') : null;
            $remember = Input::has('remember') ? true : false;

            //Получаем данные текущего пользователя:
            $currUser = DB::table('users')->where('email', $email)->first();
            //Получаем айди текущего пльзователя:
            $id_user = $currUser->id;

            //Дополнительная валидация - проверка на корректность:
            $validators = Validator::make(
                //Указываем поля которые будем валидировать:
                array(
                    'email' => $email,
                    'password' => $password,
                ),
                //Указываем правила валидации:
                array(
                    'email' => 'required|min:3|max:55',
                    'password' => 'required|min:6',
                ),
                //Указываем сообщения в случае ошибок(русифицируем те, что по умолчанию):
                array(
                    'required' => 'Вы не ввели поле :attribute ',
                    'min' => 'Поле :attribute должно содержать минимум :min символов',
                    'max' => 'Поле :attribute не должно превышать :max сиволов'
                )
            );

            //Проверяем поступили ли ошибки:
            if($validators->fails()) {
                //Сообшения ошибок:
                    return Redirect::to('login')->withErrors($validators);
                }
                else {

                    if (Auth::attempt(array('email' => $email, 'password' => $password), $remember)) {
                        //Заносив в сессию айди текущего пользователя
                        Session::put('id_user', $id_user);
                        //Перенаправляем в ЛК текущего пользователя, с соотв. айди.
                        return Redirect::to('cabinet/'.$id_user);
                    } else {
                        $authError = 'Пароль либо email не верны!';
                    }
                }
            }


        return View::make('login', array(
                                          'users' => $users,
                                          'title' => $title,
                                          'authError' => isset($authError) ? $authError : null
        ));
    }

    /**
     * Метод регистрации нового пользователя
     *
     * @param int $id_user - айди текущего пользователя
     * @return View
     */
    public function registration($id_user = null)
    {
        //Создаем новую сущность модели User
        $user = new User();

        $users = Users::get();
        //Название страницы:
        $title = 'Регистрация';

        //Проверяем авторизован ли пользователь:
        if(Auth::check()){
            //Берем из сессии айди текущего пользователя:
            $id_user = Session::get('id_user');

            //Перенаправляем на страницу пользователя:
            return Redirect::to('cabinet/'.$id_user);
        }

        //Проверка на существование глобальной переменной $_POST['email']:
        if (Input::has('email')){
            //Присваиваем полученнst значения из формы в переменные:
            $name = Input::get('name');
            $email = Input::get('email');
            $password = Input::get('password');
            $password_confirmation = Input::get('password_confirmation');


            //Дополнительная валидация - проверка на корректность:
            $validators = Validator::make(
            //Указываем поля которые будем валидировать:
                array(
                    'email' => $email,
                    'password' => $password,
                    'password_confirmation' => $password_confirmation,
                ),
                //Указываем правила валидации:
                array(
                    'email' => 'required|unique:users,email|email|min:3|max:55',
                    'password' => 'required|confirmed|min:6',
                    'password_confirmation' => 'same:password'
                ),
                //Указываем сообщения в случае ошибок:
                array(
                    'required' => 'Вы не ввели поле :attribute ',
                    'email' => 'E-MAIL должен быть корректен',
                    'unique' => 'Такой :attribute уже исспользуется',
                    'min' => 'Поле :attribute должно содержать минимум :min символов',
                    'max' => 'Поле :attribute не должно превышать :max сиволов',
                    'confirmed' => 'Пароли не совпадают',
                    'same' => 'поля пароля и подтверждения пароля не совпадают'
                )

            );

            //Проверяем поступили ли ошибки:
            if($validators->fails()) {
                //Сообшения ошибок:
                return Redirect::to('register')->withErrors($validators);

            }    else {

                //Регистрация пользователя
                $user->fill(Input::all());
                if($user->signup()){
                    $success = 'Пользователь '.$name.' успешно зарегистриован';
                }
            }
        }


        return View::make('reg', array(
            'users' => $users,
            'title' => $title,
            'success' => isset($success) ? $success : null
        ));
    }

    /**
     * Метод ведет в зарегистрированный ЛК пользователя
     *
     * @param int id_user - пользователя
     * @return View
     */
    public function cabinet($id_user = null){

        $userData = DB::table('users')->where('id', $id_user)->first();

        //Распределяем переадресацию на ЛК Менеджер-Администратор
        if ($userData->role == 0) {
        return Redirect::to('manager/'.$id_user);
        }
        else{
        return Redirect::to('admin/'.$id_user);
        }

    }



}