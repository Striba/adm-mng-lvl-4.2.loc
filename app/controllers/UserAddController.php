<?php


class UserAddController extends BaseController
{
    /**
     * Метод создания вида добавления пользователя
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function execute ($id)
    {
        $title = "Добавить пользователя";

    return View::make('cabinet.adduser', [
        'title' => $title,
        'id' => $id,
        'errors' => isset($errors) ? $errors : null,
        'success' => isset($success) ? $success : null
        ]);

    }

    /**
     * Сохрянить данные нового пользователя
     *
     * @param int $id - айди текущего админа
     * @return view
     */
    public function save ($id)
    {
        $insert = Input::all();

        //Проверка на существование глобальной переменной $_POST['email']:
        if (Input::has('email'))
        {
            //Присваиваем полученнst значения из формы в переменные:
            $email = $insert['email'];
            $password = $insert['password'];
            $name = $insert['name'];
            $role = $insert['role'];


            //Дополнительная валидация - проверка на корректность:
            $validators = Validator::make(
            //Указываем поля которые будем валидировать:
                array(
                    'email' => $email,
                    'password' => $password,
                    'name' => $name,
                    'role' => $role
                ),
                //Указываем правила валидации:
                array(
                    'email' => 'required|unique:users,email|email|min:3|max:55',
                    'password' => 'required|min:6',
                    'name' => 'required'
                ),
                //Указываем сообщения в случае ошибок:
                array(
                    'required' => 'Вы не ввели поле :attribute ',
                    'unique' => 'Такой :attribute уже исспльзуется',
                    'min' => 'Поле :attribute должно содержать минимум :min символов',
                    'max' => 'Поле :attribute не должно превышать :max сиволов'
                )

            );

            //Проверяем поступили ли ошибки:
            if($validators->fails())
            {
                //Сообшения ошибок:
                $errorMessage = $validators->messages();
                $errors = "";
                foreach ($errorMessage->all() as $messages)
                {
                    $errors .= $messages . "\n" . nl2br("\n");
                }

                return View::make('cabinet.adduser', [
                    'id' => $id,
                    'success' => isset($success) ? $success : null,
                    'success' => isset($success) ? $success : null,
                    'title' => 'Добавить пользователя']);

                //return Redirect::intended('manager', ['errorss' => isset($errors) ? $errors : null]);
            }    else {

                //создаем новую сущность модели User
                $user = new User();

                //Регистрация пользователя
                $user->fill(Input::all());
                if($user->signup()){
                    $success = 'Пользователь '.$name.' успешно добавлен';
                }

                return View::make('cabinet.adduser', array(
                    'id' => $id,
                    'title' => 'Добавить пользователя',
                    'success' => isset($success) ? $success : null,
                    'errors' => isset($errors) ? $errors : null
                ));

            }

            }

    }

}
