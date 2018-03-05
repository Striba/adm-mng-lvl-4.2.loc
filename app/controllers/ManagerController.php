<?php
class ManagerController extends BaseController
{
    /**
     * Метод формирования страницы manager
     *
     * @param int $id_user айди пользователя
     * @return View
     */
    public function index($id_user)
    {
        //Получаем данные текущего пользователя
        $userData = DB::table('users')->where('id', $id_user)->first();

        //Получаем данные по теущим загруженным заданиям для выбранного менеджера
        $tasks = DB::table('tasks')->where('manager_id', $id_user)->get();

        $title = "Менеджер ".$userData->name;

        return View::make('manager', [
            'title' => $title,
            'userData' => $userData,
            'tasks' => isset($tasks) ? $tasks : null
        ]);
    }

}