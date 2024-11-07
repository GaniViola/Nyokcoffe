<?php

class Login extends Controller{
    public function index(){

        if (isset($_SESSION['user'])){
            Flasher::Login();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $EmailorUser = $_POST['EmailorUser'];
            $password = $_POST['password'];

            $result = $this->model('User_model')->cekEmailorUser($EmailorUser);
            if ($result > 0) {
                if (password_verify($password, $result['password'])){
                    if ($result['role'] === 'admin'){
                        Flasher::setLogin();
                        echo "halaman admin";
                    }else{
                        Flasher::setLogin();
                        $data['judul'] = 'Home';
                        $this->view('template/header', $data);
                        $this->view('template/navbar');
                        $this->view('home/index');
                        $this->view('template/footer');
                    }
                }else{
                    echo"password tidak sesuai";
                }
                
            }
        }else {
            header('Location: '.BASEURL);
        }

    }
}