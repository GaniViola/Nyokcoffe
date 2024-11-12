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
        $data['judul'] = 'admin';
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/template/footer');
        
    }

    public function produk(){
        $data['judul'] = 'Data Produk';
        $data['produk'] = $this->model('Produk_model')->getAlldata();
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/produk/index', $data);
        $this->view('admin/template/footer');
    }
}
