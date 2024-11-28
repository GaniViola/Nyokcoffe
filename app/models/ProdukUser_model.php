<?php 

class ProdukUser_model{

    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function GetAllProduk(){
        $query = "SELECT produk.*, 
            kategori.nama_kategori,
            GROUP_CONCAT(ukuran_produk.nama_ukuran SEPARATOR ', ') AS ukuran
        FROM produk
        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
        LEFT JOIN ukuran_produk ON ukuran_produk.id_produk = produk.id_produk
        GROUP BY produk.id_produk, kategori.nama_kategori";

        $this->db->query($query);
        return $this->db->resultSet();
    }

}