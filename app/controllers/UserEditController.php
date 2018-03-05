<?php

class UserEditController extends BaseController
{

    /**
     * Метод формирвания формы редактирования
     *
     * @param  $id_admin айди текущего админа
     * @param $id - редактируемого пользователя
     * @return \Illuminate\Contracts\View\View
     */
    public function execute($id, $id_admin)
    {
        $data = User::where('id', $id)->first();
        $title = "Редактировать пользователей";

        return View::make('cabinet.edit', [
            'id_admin' => $id_admin,
            'data' => $data,
            'title' => $title
        ]);
    }

    /**
     * Метод актуализации введенной инфомации по заданному юзеру
     *
     * @param $id_admin айди админа для возвращения на страницу
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id_admin)
    {
        $update = Input::all();
        $data = array(
            'email' => $update['email'],
            //'password' => $update['password'],
            'name' => $update['name'],
            'role' => $update['role']
        );

        //создаем новую сущность модели User
        $user = new User();

        $user->where('id', $update['id'])->update($data);

        //Users::where('id', $update['id'])->update($data);

        return Redirect::route('admin', [$id_admin]);

    }

    /**
     * Метод удаления выбранного пользователя
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        User::where('id',$id)->delete();
        return Redirect::back();

    }

}