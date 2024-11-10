<?php

class Admin extends Controller {

    public function index() {

        if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
            $userID = $_COOKIE['myKey'];
            $key = $_COOKIE['key'];
            $result = $this->model('User_model')->getUserById($userID);

            if($key === hash('whirlpool', $result['username'])){
                if ($_SESSION['role'] !== 'admin'){
                    header('Location: '.BASEURL);
                    exit;
                }
            }
        }else{
            header('Location: '.BASEURL);
            exit;
        }

        $this->view('admin/template/header');
        
    }
}
