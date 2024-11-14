<?php

class Produk_model {
    private $table = 'produk';
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAlldataMinuman(){
        $this->db->query('SELECT produk.id_produk,
            produk.nama_produk, 
            kategori.nama_kategori, 
            ukuran.nama_ukuran, 
            produk.harga, 
            produk.stok, 
            produk.gambar, 
            produk.created_at 
            FROM produk 
            INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori 
            INNER JOIN produk_ukuran ON produk.id_produk = produk_ukuran.id_produk 
            INNER JOIN ukuran ON produk_ukuran.id_ukuran = ukuran.id_ukuran');
        return $this->db->resultSet();
    }

    public function getAlldataMakanan(){
        $this->db->query("SELECT produk.id_produk, 
                                produk.nama_produk, 
                                kategori.nama_kategori, 
                                produk.harga, 
                                produk.stok, 
                                produk.gambar, 
                                produk.created_at 
                            FROM produk 
                            INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori 
                            WHERE kategori.nama_kategori = 'Makanan'"
                        );
        return $this->db->resultSet();
    }

    public function cekProdukByNama($nama_produk) {
        $query = 'SELECT * FROM produk WHERE nama_produk = :nama_produk';

        $this->db->query($query);
        $this->db->bind('nama_produk', $nama_produk);
        return $this->db->single();
    }

    public function inputDataProduk($nama_produk, $harga, $id_kategori, $gambar, $stok) {
        $query = "INSERT INTO produk (nama_produk, harga, id_kategori, gambar, stok)
            VALUES (:nama_produk, :harga, :id_kategori, :gambar, :stok)";
        
        $this->db->query($query);
        $this->db->bind('nama_produk', $nama_produk);
        $this->db->bind('harga', $harga);
        $this->db->bind('id_kategori', $id_kategori);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('stok', $stok);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteDataProduk($id) {
        $query = 'DELETE FROM produk WHERE id_produk = :id_produk';

        $this->db->query($query);
        $this->db->bind('id_produk', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }
}