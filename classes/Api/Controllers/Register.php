<?php
namespace Api\Controllers;

class Register {
    private $usersTable;

    public function __construct(\Framework\DataStore $usersTable){
        $this->usersTable = $usersTable;
    }
    public function register(){
        $valid = true;
        $errors = [];
        $success = [];
        $users = [];
        $users['regno'] = $_POST['regno'];
        $users['password'] = md5($_POST['password']);
        $users['security'] = $_POST['security'];

        if (empty($users['regno'])){
            $valid = false;
            $errors['error'] = true;
            $errors['title'] = 'Wrong password';
            $errors['message'] = 'Registration Number required.';
        } else {
            $users['regno'] = strtolower($users['regno']);
            // if (filter_var($users['reg_no'], FILTER_VALIDATE_EMAIL) == false){
            //     $valid = false;
            //     $errors['error'] = true;
            //     $errors['title'] = 'Wrong Registration Number';
            //     $errors['message'] = 'Invalid email.';
            // }
        }

        if (empty($users['password'])){
            $valid = false;
            $errors['error'] = true;
            $errors['title'] = 'No password.';
            $errors['message'] = 'Password required.';
        }
        if ($valid){
            $this->usersTable->insert($users);
            $success['message'] = 'Data saved successfully.';
            echo json_encode($success);
        } else {
            echo json_encode($errors);
        }
    }
}