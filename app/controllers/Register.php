<?php 
class Register extends Controller{

    public function index(){
        $data['judul'] = 'Register';
        $data['pesan'] = '';
        $this->view('register/index', $data);
    }

    public function createAkun(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Ambil data dan masukkan ke dalam Variabel
            $username = $_POST['username'];
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $pwd = $_POST['password'];
            $kpwd = $_POST['kpwd'];
            $notelp = $_POST['no_tlp'];
            $alamat = $_POST['alamat'];

            // Validasi
            if (!preg_match('/^[a-zA-Z0-9_\s]{3,20}$/', $username)){
                $data['pesan'] =  "Username tidak valid";
                $this->view('register/index', $data);
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['pesan'] = "Validasi email gagal!";
                $this->view('register/index', $data);
                exit;
            }

            if ($pwd != $kpwd) {
                $data['pesan'] = "Konfirmasi password tidak sesuai";
                $this->view('register/index', $data);
                exit;
            }

            if (!preg_match('/^\+?[0-9]{10,15}$/', $notelp)){
                $data['pesan'] =  "Nomor telpon tidak valid";
                $this->view('register/index', $data);
                exit;
            }

            if (!preg_match('/^[a-zA-Z0-9\s,.\-\/]+$/', $alamat)) {
                $data['pesan'] = "Alamat tidak valid!";
                $this->view('register/index', $data);
                die;
            }

            // Cek Username apakah sudah ada atau tidak
            if ($this->model('User_model')->cekDataByUsername($username) > 0) {
                $data['pesan'] = "Username sudah tersedia!";
                $this->view('register/index', $data);
                exit;
            }
            
            // Enkripsi kpwd
            $password = password_hash($pwd, PASSWORD_DEFAULT);

            // Creat akun
            if ($this->model('User_model')->createAkun($username, $email, $password, $notelp, $alamat) > 0){
                Flasher::setFlash('berhasil', 'melakukan registrasi', 'success');
                header('Location: '.BASEURL.'/register');
                exit;
            } else {
                Flasher::setFlash('gagal', 'melakukan registrasi', 'danger');
                header('Location: '.BASEURL.'/register');
                exit;
            }

        }else {
            header('Location: '.BASEURL.'/register');
            die;
        }


    }
}