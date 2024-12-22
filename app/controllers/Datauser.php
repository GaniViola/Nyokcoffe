<?php

class Datauser extends Controller {
    public function index() {
        // Memuat model dengan menggunakan method model()
        $userModel = $this->model('User_model');
        
        // Ambil data pengguna dengan role 'user'
        $data['users'] = $userModel->getUsersByRole('user');
        
        // Set judul halaman
        $data['judul'] = 'Data User';
        
        // Kirim data ke view
        $this->view('admin/template/header', $data);  // Header di atas
        $this->view('admin/template/sidebar');        // Sidebar di samping
        $this->view('admin/datauser/index', $data);   // Konten utama
        $this->view('admin/template/footer');         // Footer di bawah
    }

    // Method untuk menghapus data pengguna berdasarkan ID
    public function delete($id) {
        // Memuat model
        $userModel = $this->model('User_model');
        
        // Panggil fungsi di model untuk menghapus pengguna berdasarkan ID
        if ($userModel->deleteUser($id)) {
            // Menyimpan flash message untuk redirect
            $_SESSION['flash_message'] = 'Pengguna berhasil dihapus.';
        } else {
            // Jika penghapusan gagal, menyimpan pesan error
            $_SESSION['flash_message'] = 'Gagal menghapus pengguna.';
        }
    
        // Redirect ke halaman utama setelah penghapusan
        header('Location: ' . BASEURL . '/datauser');
        exit;
    }
    
    
    
}


