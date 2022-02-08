<?php
namespace Framework;
class Auth{
    private $users;
    private $userDetails;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct($users, $userDetails, $usernameColumn, $passwordColumn){
        session_start();
        $this->users = $users;
        $this->userDetails = $userDetails;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    public function login($username, $password){
        $username = $_POST['reg_no'];
        $password = md5($_POST['password']);

        $user = $this->users->findById($this->usernameColumn, strtolower($username));
        // echo json_encode(['password' => $this->passwordColumn]);
        if (!empty($user) && $password === $user[0][$this->passwordColumn]){
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0][$this->passwordColumn];
            return true;
        } else {
            return false;
        }
    }
    public function isLoggedIn(){
        if (empty($_SESSION['username'])){
            return false;
        }
        $user = $this->users->findById($this->usernameColumn, $_SESSION['username']);
        if (!empty($user) && $_SESSION['password'] === $user[0][$this->passwordColumn]){
            return true;
        } else {
            return false;
        }
    }
    public function authUser(){
        if ($this->login($_SESSION['username'], $_SESSION['password'])){
            $user = $this->userDetails->findById($this->usernameColumn, $_SESSION['username']);
            if (!empty($user)){
                return $user;
            }
        }
    }
}