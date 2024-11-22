<?php
class Home extends Controller {
    public function index() {

        if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
            $userID = $_COOKIE['myKey'];
            $key = $_COOKIE['key'];
            $result = $this->model('User_model')->getUserById($userID);
            
            if($key === hash('whirlpool', $result['username'])){
                $_SESSION['login'] = true;
                $_SESSION['EmailorUser'] = $result['username'];
                $_SESSION['role'] = $result['role'];
            }
        }else{
            session_destroy();
            setcookie('EmailorUser', '', time() - 3600);
        }

        if (isset($_SESSION['login'])){
            if($_SESSION['role'] === 'admin'){
                header('Location: '.BASEURL.'/admin');
                exit;
            }
        }

        // Menyiapkan data untuk tampilan
        $data['judul'] = 'Home';
        $data['produk'] = $this->model('Produk_model')->getAlldataMinuman();
        $this->view('template/header', $data);
        $this->view('template/navbar');
        $this->view('home/index', $data);
        $this->view('template/footer');
    }


}
