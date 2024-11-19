<?php

class Produk_model {
    private $table = 'produk';
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAlldataMinuman(){
        $query = 'SELECT produk.id_produk,
            produk.nama_produk,
            kategori.nama_kategori,
            ukuran_produk.nama_ukuran,
            produk.stok,
            produk.harga,
            produk.gambar,
            produk.created_at
        FROM ukuran_produk
        INNER JOIN produk ON ukuran_produk.id_produk = produk.id_produk
        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori';
        
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function cariMakanan($nama_produk) {
        $query = 'SELECT produk.id_produk, produk.nama_produk, kategori.nama_kategori, produk.harga, produk.stok, produk.gambar, produk.created_at
                  FROM produk
                  INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                  WHERE produk.nama_produk LIKE :nama_produk';
        $this->db->query($query);
        $this->db->bind('nama_produk', "%$nama_produk%"); // LIKE dengan wildcards
        return $this->db->resultSet();
    }

    public function cariMinuman($nama_produk) {
        $query = 'SELECT produk.id_produk, produk.nama_produk, kategori.nama_kategori, produk.harga, produk.stok, produk.gambar, produk.created_at, ukuran_produk.nama_ukuran
                  FROM produk
                  INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                  LEFT JOIN ukuran_produk ON produk.id_ukuran = ukuran_produk.id_ukuran
                  WHERE produk.nama_produk LIKE :nama_produk';
        
        $this->db->query($query);
        $this->db->bind('nama_produk', "%$nama_produk%"); // LIKE dengan wildcards
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

    public function inputDataProduk($nama_produk, $harga, $kategori, $gambar, $stok) {
        $query = "INSERT INTO produk (nama_produk, harga, id_kategori, gambar, stok)
            VALUES (:nama_produk, :harga, :id_kategori, :gambar, :stok)";
        
        $this->db->query($query);
        $this->db->bind('nama_produk', $nama_produk);
        $this->db->bind('harga', $harga);
        $this->db->bind('id_kategori', $kategori);
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

    public function cekProdukByNamaAndUkuran ($nama_produk, $ukuran) {
        $query = 'SELECT produk.nama_produk, ukuran_produk.nama_ukuran
        FROM ukuran_produk
        INNER JOIN produk ON ukuran_produk.id_produk = produk.id_produk
        WHERE produk.nama_produk = :nama_produk AND ukuran_produk.nama_ukuran = :ukuran';

        $this->db->query($query);

        $this->db->bind('nama_produk', $nama_produk);
        $this->db->bind('ukuran', $ukuran);
        $this->db->execute();
        return $this->db->single();
    }

    public function getLastId(){
        return $this->db->lastInsertId();
    }

    public function inputUkuranProduk($lastId, $ukuran){
        $query = 'INSERT INTO ukuran_produk (id_produk, nama_ukuran)
                    VALUES (:id_produk, :nama_ukuran)';

        $this->db->query($query);
        $this->db->bind('id_produk', $lastId);
        $this->db->bind('nama_ukuran', $ukuran);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getIdProdukUkuran($id, $ukuran){
        $query = 'SELECT id_ukuran FROM ukuran_produk WHERE id_produk = :id_produk AND nama_ukuran = :nama_ukuran';

        $this->db->query($query);
        $this->db->bind('id_produk', $id);
        $this->db->bind('nama_ukuran', $ukuran);

        $this->db->execute();
        return $this->db->single();
    }

    public function deleteDataMinnuman($idUkuran){
        $query = 'DELETE FROM ukuran_produk WHERE id_ukuran = :id_ukuran';
        
        $this->db->query($query);
        $this->db->bind('id_ukuran', $idUkuran);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getGambarProduk($id) {
        $query = 'SELECT gambar FROM produk WHERE id_produk = :id_produk';
        
        $this->db->query($query);
        $this->db->bind('id_produk', $id);
        return $this->db->single();
    }

    public function getMinumanForEdit($idProduk, $namaUkuran){
        $query = 'SELECT produk.id_produk,
            produk.nama_produk,
	        produk.harga,
            produk.gambar,
            produk.stok,
            ukuran_produk.nama_ukuran
        FROM ukuran_produk
        INNER JOIN produk ON ukuran_produk.id_produk = produk.id_produk
        WHERE ukuran_produk.id_produk = :id_produk
        AND
        ukuran_produk.nama_ukuran = :nama_ukuran';

        $this->db->query($query);
        $this->db->bind('id_produk', $idProduk);
        $this->db->bind('nama_ukuran', $namaUkuran);

        $this->db->execute();
        return $this->db->single();
    }

    public function getProdukById($id_produk){
        $query = 'SELECT * FROM produk WHERE id_produk = :id_produk';
        
        $this->db->query($query);
        $this->db->bind('id_produk', $id_produk);

        $this->db->execute();
        return $this->db->single();
    }

    public function getIdUkuranByIdAndUkuran($id_produk, $ukuran) {
        $query = 'SELECT id_ukuran FROM ukuran_produk WHERE id_produk = :id_produk AND nama_ukuran = :nama_ukuran';
        
        $this->db->query($query);
        $this->db->bind('id_produk', $id_produk);
        $this->db->bind('nama_ukuran', $ukuran);
        $this->db->execute();
        return $this->db->single();
    }

    public function EditMinuman($id_produk, $nama_produk, $stok, $harga, $newGambar) {
        $query = 'UPDATE produk
            SET 
                nama_produk = :nama_produk,
                stok = :stok,
                harga = :harga,
                gambar = :gambar,
                created_at = NOW()
            WHERE id_produk = :id_produk';

        $this->db->query($query);
        $this->db->bind('nama_produk', $nama_produk);
        $this->db->bind('stok', $stok);
        $this->db->bind('harga', $harga);
        $this->db->bind('gambar', $newGambar);
        $this->db->bind('id_produk', $id_produk);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function EditTanpaGmbar($id_produk, $nama_produk, $stok, $harga) {
        $query = 'UPDATE produk
            SET nama_produk = :nama_produk,
                stok = :stok,
                harga = :harga,
                created_at = NOW()
            WHERE id_produk = :id_produk';

        $this->db->query($query);
        $this->db->bind('nama_produk', $nama_produk);
        $this->db->bind('stok', $stok);
        $this->db->bind('harga', $harga);
        $this->db->bind('id_produk', $id_produk);

        $this->db->execute();
        return $this->db->rowCount();
    } 
}