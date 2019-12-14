<?php

namespace app\Controllers;

class UserController extends BasicController
{
    public $apiName = 'users';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/users
     * @return string
     */
    public function index()
    {
        $db = (new Db())->getConnect();
        $users = Users::getAll($db);
        if ($users) {
            return $this->response($users, 200);
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function view()
    {
        $db = (new Db())->getConnect();
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;
        $user = Users::getById($db, $userId);

        if ($user) {
            return $this->response($user, 200);
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/users + параметры запроса name, email
     * @return string
     */
    public function create()
    {
        $firstName = $this->requestParams['firstName'] ?? '';
        $lastName = $this->requestParams['$lastName'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        $password = $this->requestParams['password'] ?? '';
        if ($firstName && $email) {
            $db = (new Db())->getConnect();
            $user = new Users($db, [
                'firstName' => $firstName,
                'email' => $email,
                'lastName' => $lastName,
                'password' => $password
            ]);
            if ($user = $user->saveNew()) {
                return $this->response('Data saved.', 200);
            }
        }
        return $this->response("Saving error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/users/1 + параметры запроса name, email
     * @return string
     */
    public function update()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $db = (new Db())->getConnect();

        if (!$userId || !Users::getById($db, $userId)) {
            return $this->response("User with id=$userId not found", 404);
        }

        $firstName = $this->requestParams['firstName'] ?? '';
        $lastName = $this->requestParams['lastName'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        $password = $this->requestParams['password'] ?? '';
        $role = $this->requestParams['role'] ?? '';

        if ($firstName && $email) {
            if ($user = Users::update($db, $userId, $firstName, $email, $lastName, $password, $role)) {
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response("Update error", 500);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function delete()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $db = (new Db())->getConnect();

        if (!$userId || !Users::getById($db, $userId)) {
            return $this->response("User with id=$userId not found", 404);
        }
        if (Users::deleteById($db, $userId)) {
            return $this->response('Data deleted.', 200);
        }
        return $this->response("Delete error", 500);
    }

}