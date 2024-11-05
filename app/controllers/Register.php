<?php 
class Register extends Controller{
    public function index(){
        $data['judul'] = 'Register';
        $data['pesan'] = '';
        $this->view('register/index', $data);
    }

    public function createAkun(){
        $username = $_POST['username'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pwd = $_POST['password'];
        $kpwd = $_POST['confirm_password'];
        $notelp = $_POST['no_tlp'];
        $alamat = $_POST['alamat'];
        
        // validasi
        if (!preg_match('/^[a-zA-Z0-9_\s]{3,20}$/', $username)){
            $data['pesan'] =  "Username tidak valid";
            $this->view('register/index', $data);
            die;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['pesan'] = "Validasi email gagal!";
            $this->view('register/index', $data);
            die;
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $pwd)) {
            $data['pesan'] = "Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan karakter khusus!";
            $this->view('register/index', $data);
            die;
        }

        if (!preg_match('/^\+?[0-9]{10,15}$/', $notelp)){
            $data['pesan'] =  "Nomor telpon tidak valid";
            $this->view('register/index', $data);
            die;
        }

        if (!preg_match('/^[a-zA-Z0-9\s,.\-\/]+$/', $alamat)) {
            $data['pesan'] = "Alamat tidak valid!";
            $this->view('register/index', $data);
            die;
        }

        // cek username apakah sudah ada di database
        if ($this->model('Register_model')->cekDataByUsername($username) > 0) {
            $data['pesan'] = "Username sudah tersedia!";
            $this->view('register/index', $data);
            exit;
        }

        // konfirmasi password
        if ($pwd !== $kpwd) {
            $data['eer'] = "Konfirmasi password tidak cocok!";
            $this->view('register/index', $data);
            return;
        }

        
        if ($this->model('Register_model')->createAkun($_POST) > 0){
            header('Location: '.BASEURL);
            exit;
        }
        
    }
}