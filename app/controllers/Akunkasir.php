<?php

class Akunkasir extends Controller {
    public function index() {
        // Memuat model User_model
        $userModel = $this->model('User_model');
        
        // Ambil data pengguna dengan role 'kasir'
        $data['users'] = $userModel->getUsersByKasir('kasir');
        
        // Set judul halaman
        $data['judul'] = 'Kasir Akun';

        // Memuat view
        $this->view('admin/template/header', $data);  // Header di atas
        $this->view('admin/template/sidebar');        // Sidebar di samping
        $this->view('admin/akunkasir/index', $data);  // Konten utama
        $this->view('admin/template/footer');         // Footer di bawah
    }
}
