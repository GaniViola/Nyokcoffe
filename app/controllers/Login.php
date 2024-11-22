<?php

class Login extends Controller {
    public function index() {
        // Pastikan hanya menerima request POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data input dari POST
            $EmailorUser = $_POST['EmailorUser'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validasi input kosong
            if (empty($EmailorUser) || empty($password)) {
                $this->jsonResponse('error', 'Email/Username dan password tidak boleh kosong', [], 400);
            }

            // Cek email atau username pada model User_model
            $result = $this->model('User_model')->cekEmailorUser($EmailorUser);

            // Jika username/email ditemukan
            if ($result) {
                // Verifikasi password
                if (password_verify($password, $result['password'])) {
                    // Set sesi login dan cookie
                    $_SESSION['login'] = true;
                    $_SESSION['EmailorUser'] = $EmailorUser;
                    $_SESSION['role'] = $result['role'];
                    setcookie('myKey', $result['id_user'], time() + 3600, '/', '', true, true); // HttpOnly & Secure
                    setcookie('key', hash('whirlpool', $result['username']), time() + 3600, '/', '', true, true);

                    // Cek apakah permintaan dari API atau web
                    if (isset($_POST['is_api']) && $_POST['is_api'] == 'true') {
                        // Kirim respons JSON untuk API
                        $this->jsonResponse('success', 'Berhasil login', [
                            'role' => $_SESSION['role'],
                            'username' => $result['username'],
                            'redirect_url' => $_SESSION['role'] === 'admin' ? BASEURL . '/admin' : BASEURL
                        ]);
                    } else {
                        // Redirect langsung untuk web
                        $redirectUrl = $_SESSION['role'] === 'admin' ? BASEURL . '/admin' : BASEURL;
                        header("Location: $redirectUrl");
                        exit;
                    }
                } else {
                    // Password salah
                    header("Location: ".BASEURL);
                    // $this->jsonResponse('error', 'Login gagal, silakan cek kembali data Anda', [], 401);
                }
            } else {
                // Username/email tidak ditemukan
                $this->jsonResponse('error', 'Login gagal, silakan cek kembali data Anda', [], 404);
            }
        } else {
            // Respons jika request bukan POST
            $this->jsonResponse('error', 'Method not allowed', [], 405);
        }
    }

    /**
     * Helper untuk mengirimkan respons JSON
     * 
     * @param string $status Status respons ('success' atau 'error')
     * @param string $message Pesan untuk client
     * @param array $data Data tambahan yang dikirimkan
     * @param int $httpCode HTTP status code
     */
    private function jsonResponse($status, $message, $data = [], $httpCode = 200) {
        $response = array_merge(['status' => $status, 'message' => $message], $data);
        header('Content-Type: application/json');
        http_response_code($httpCode);
        echo json_encode($response);
        exit;
    }
}
