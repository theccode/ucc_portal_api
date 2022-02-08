<?php
namespace Api\Controllers;
class Login{
    private $auth;

    public function __construct($auth){
        $this->auth = $auth;
    }

    public function login(){
        $error = false;
        if ($this->auth->login($_POST['reg_no'], $_POST['password'])){
            return [
                'variables' => [
                    'error' => $error,
                    'title' => 'Login',
                    'message' => $this->getUser()
                ]
            ];
        } else {
            $error = true;
            return [
                'variables' => [
                    'error' => $error,
                    'title' => 'Login Error',
                    'message' => 'Invalid Registration Number/password.'
                ]
            ];
        }
    }
    private function getUser(){
        return $this->auth->authUser();
    }
}