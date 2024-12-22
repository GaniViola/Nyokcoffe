<?php

class Dashboard extends Controller {
    public function index() {
        $data['judul'] = 'Dashboard';
        $this->view('admin/template/header', $data);  // Header di atas
        $this->view('admin/template/sidebar');        // Sidebar di samping
        $this->view('admin/dashboard/index', $data);  // Konten utama
        $this->view('admin/template/footer');         // Footer di bawah
    }
}

