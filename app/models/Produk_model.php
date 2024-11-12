<?php

class Produk_model {
    private $table = 'produk';
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAlldata(){
        $this->db->query('SELECT produk.id_produk, produk.nama_produk, kategori.nama_kategori, ukuran.nama_ukuran, produk.harga, produk.stok, produk.gambar, produk.created_at FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori INNER JOIN produk_ukuran ON produk.id_produk = produk_ukuran.id_produk INNER JOIN ukuran ON produk_ukuran.id_ukuran = ukuran.id_ukuran;');
        return $this->db->resultSet();
    }
}