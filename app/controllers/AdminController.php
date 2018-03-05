<?php

class AdminController extends BaseController
{

    /**
     * Метод формирования страницы admin
     *
     * @param $id_user айди пользовалея
     * @return \Illuminate\Contracts\View\View
     */
    public function index($id_user)
    {
        $users = Users::get();

        //Получаем данные текущего пользователя
        $userData = DB::table('users')->where('id', $id_user)->first();

        $title = "Администратор ".$userData->name;
        return View::make('admin', [
            'title' => $title,
            'users' => $users,
            'userData' => $userData
        ]);

    }

    /**
     * Метод формирующий представление добавления заданий-файлов менеджеру
     *
     * @param int $manager_id айди менеджера
     * @return \Illuminate\Contracts\View\View
     */
    public function addtask($manager_id)
    {
        //Получаем имя выбранного менеджера по его айди:
        $managerName = Users::find($manager_id)->name;

        return View::make('cabinet.addtask', [
            'title' => 'Добавить задание',
            'managerName' => $managerName,
            'manager_id' => $manager_id
        ]);
    }

    /**
     * Метод загрузки задания на сервер
     *
     * @param $manager_id
     * @return string
     */
    public function uploadtasks($manager_id)
    {

        //Проверка поступил ли файл:
        if (Input::hasFile('file'))
        {
            //Получаем название файла:
            $filename = Input::file('file')->getClientOriginalName();

            //Определяем путь по которому производится сохранение файла на диске:
            $destinationPath = 'tasks/';

            //Перемещение загруженного файла
            Input::file('file')->move($destinationPath, $filename);

            //создаем новую сущность модели Task
            $task = new Task();

            //Передаем значения записываемые в таблицу tasks:
            $task->filename = $filename;
            $task->manager_id = $manager_id;

            //Сохраняем новые данные в таблицу tsks:
            $task->save();

            return "success";
        } else {
            return "wrong";
        }
    }


}