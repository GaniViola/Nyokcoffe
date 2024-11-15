<?php
class Login extends Controller {
    public function index() {
        // Pastikan hanya menerima request POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data input dari POST
            $EmailorUser = $_POST['EmailorUser'];
            $password = $_POST['password'];

            // Cek email atau username pada model User_model
            $result = $this->model('User_model')->cekEmailorUser($EmailorUser);

            // Jika username/email ditemukan
            if ($result > 0) {
                // Verifikasi password
                if (password_verify($password, $result['password'])) {
                    // Set sesi login dan cookie
                    $_SESSION['login'] = true;
                    $_SESSION['EmailorUser'] = $EmailorUser;
                    $_SESSION['role'] = $result['role'];
                    setcookie('myKey', $result['id_user'], time() + 3600);
                    setcookie('key', hash('whirlpool', $result['username']), time() + 3600);

                    // Kirim respons JSON berhasil login
                    $response = [
                        'status' => 'success',
                        'message' => 'Berhasil login',
                        'role' => $_SESSION['role'],
                        'redirect_url' => $_SESSION['role'] === 'admin' ? BASEURL . '/admin' : BASEURL
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                } else {
                    // Respons jika password tidak sesuai
                    $response = [
                        'status' => 'error',
                        'message' => 'Password tidak sesuai'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } else {
                // Respons jika username/email tidak ditemukan
                $response = [
                    'status' => 'error',
                    'message' => 'Username tidak ditemukan'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            // Respons jika request bukan POST
            $response = [
                'status' => 'error',
                'message' => 'Method not allowed'
            ];
            header('Content-Type: application/json');
            http_response_code(405); // Metode tidak diizinkan
            echo json_encode($response);
        }
    }
}
