<?php

class User_model {
    private $table = 'tbl_users';
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    // Mengecek data berdasarkan username (untuk validasi)
    public function cekDataByUsername($username){
        $this->db->query('SELECT * FROM '.$this->table.' WHERE username=:username');
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Menambahkan akun baru ke dalam database
    public function createAkun($username, $email, $password, $notelp, $alamat){
        $query = "INSERT INTO tbl_users (username, email, no_tlp, alamat, password, role)
                VALUES 
            (:username, :email, :no_tlp, :alamat, :password, 'user')";

        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->bind('email', $email);
        $this->db->bind('no_tlp', $notelp);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('password', $password);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Mengecek apakah username atau email sudah ada
    public function cekEmailorUser($EmailorUser){
        $query = "SELECT * FROM tbl_users WHERE username = :username OR email = :email";
        $this->db->query($query);
        $this->db->bind('username', $EmailorUser);
        $this->db->bind('email', $EmailorUser);

        return $this->db->single();
    }

    // Mengambil data user berdasarkan ID
    public function getUserById($userID) {
        $this->db->query('SELECT * FROM tbl_users WHERE id_user = :id');
        $this->db->bind(':id', $userID);
        return $this->db->single();
    }

    // Memperbarui data profil user
    public function updateUser($userID, $username, $email, $notelp, $alamat) {
        $query = "UPDATE tbl_users 
                  SET username = :username, email = :email, no_tlp = :no_tlp, alamat = :alamat 
                  WHERE id_user = :id";

        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->bind('email', $email);
        $this->db->bind('no_tlp', $notelp);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('id', $userID);

        $this->db->execute();
        return $this->db->rowCount(); // Mengembalikan jumlah baris yang diubah
    }
}
