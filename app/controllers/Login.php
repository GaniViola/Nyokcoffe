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
                    setcookie('myKey', $result['id_user'], time() + 3600);
                    setcookie('key', hash('whirlpool', $result['username']), time() + 3600);

                    if ($_SESSION['role'] === 'admin'){
                        echo "<script>
                                alert('Berhasil login');
                                document.location.href = 'http://localhost/Nyokcoffe/public/admin';  
                           </script>";
                        // header('Location: '.BASEURL.'/admin');
                        // exit;
                    } else {
                        echo "<script>
                                alert('Berhasil login');
                                document.location.href = 'http://localhost/Nyokcoffe/public';  
                           </script>";
                        // header('Location: '.BASEURL);  
                    }
                    exit();  
                } else {
                    echo "<script>
                    alert('Password tidak sesuai');
                    document.location.href = 'http://localhost/Nyokcoffe/public';  
                    </script>";
                }
            }else {
                echo "<script>
                    alert('Username tidak di temukan');
                    document.location.href = 'http://localhost/Nyokcoffe/public';  
                    </script>";
            }
        } else {
            header('Location: '.BASEURL);
        }
    }
}
