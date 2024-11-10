<?php
class Login extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $EmailorUser = $_POST['EmailorUser'];
            $password = $_POST['password'];

            $result = $this->model('User_model')->cekEmailorUser($EmailorUser);
            if ($result > 0) {
                if (password_verify($password, $result['password'])) {

                    $_SESSION['login'] = true;
                    $_SESSION['EmailorUser'] = $EmailorUser;
                    $_SESSION['role'] = $result['role'];
                    setcookie('myKey', $result['id_user'], time() + 60);
                    setcookie('key', hash('whirlpool', $result['username']), time() + 60);
                    if ($_SESSION['role'] === 'admin'){
                        header('Location: '.BASEURL.'/admin');
                        exit;
                    } else {
                        header('Location: '.BASEURL);  // Redirect ke home untuk user biasa
                    }
                    exit();  // Pastikan exit setelah redirect
                } else {
                    echo "Password tidak sesuai";
                }
            }
        } else {
            header('Location: '.BASEURL);
        }
    }
}
