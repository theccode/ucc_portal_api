<?php
namespace Api;
class ApiRoutes implements \Framework\Routes{
    private $usersTable;
    private $userDetailsTable;
    private $students_db;
    private $auth;

    public function __construct(){
        include __DIR__ . '/../../helpers/connect.php';
        $this->usersTable = new \Framework\DataStore($pdo, 'useraccount', 'id');
        $this->userDetailsTable = new \Framework\DataStore($pdo, 'students_db', 'id');
        $this->students_db = new \Framework\DataStore($pdo, 'students_db', 'id');
        $this->auth = new \Framework\Auth($this->usersTable, $this->userDetailsTable, 'regno', 'password');
    }
    public function getRoutes():array{
        $registerController = new \Api\Controllers\Register($this->usersTable);
        $loginController = new \Api\Controllers\Login($this->auth);
        $routes = [
            'register' => [
                'POST' => [
                    'controller' => $registerController,
                    'action' => 'register'
                ]
            ],
            'login' => [
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'login'
                ],
            ],
            'user' => [
               'POST' => [
                'controller' => $loginController,
                'action' => 'getUser'
               ]
            ],
            'logout' => [
                'GET' => [
                    'controller' => 'controller',
                    'action' => 'logout'
                ]
            ]
        ];
        return $routes;
    }
    public function getAuth(){
        return $this->auth;
    }
}