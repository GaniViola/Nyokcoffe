<?php
require_once __DIR__ . '/../../fpdf/fpdf.php';  // Menyertakan file fpdf.php

class Laporan extends Controller {
    public function index() {
        $data['Order'] = $this->model('Orders_model')->laporan();
        $data['judul'] = 'Laporan Penjualan';
        $this->view('admin/template/header', $data);  // Header di atas
        $this->view('admin/template/sidebar');        // Sidebar di samping
        $this->view('admin/laporan/index', $data);  // Konten utama
        $this->view('admin/template/footer');         // Footer di bawah
    }

    public function print() {
        // Ambil data laporan
        $data['Order'] = $this->model('Orders_model')->laporan();
        $data['judul'] = 'Laporan Penjualan';

        // Membuat instance FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font untuk judul
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Penjualan', 0, 1, 'C');
        $pdf->Ln(10);  // Menambahkan line break

        // Set font untuk isi tabel
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(10, 10, 'No', 1);
        $pdf->Cell(40, 10, 'Username', 1);
        $pdf->Cell(60, 10, 'Total', 1);
        $pdf->Cell(40, 10, 'Status', 1);
        $pdf->Cell(40, 10, 'Tanggal Order', 1);
        $pdf->Ln();

        // Menambahkan data laporan
        $no = 1;
        foreach ($data['Order'] as $order) {
            $pdf->Cell(10, 10, $no++, 1);
            $pdf->Cell(40, 10, $order['username'], 1);
            $pdf->Cell(60, 10, $order['total'], 1);
            $pdf->Cell(40, 10, $order['status'], 1);
            $pdf->Cell(40, 10, $order['created_at'], 1);
            $pdf->Ln();
        }

        // Output PDF ke browser
        $pdf->Output();
    }
}
