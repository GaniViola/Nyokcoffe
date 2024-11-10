<?php

class User_model {
    private $table = 'tbl_users';
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function cekDataByUsername($username){
        $this->db->query('SELECT * FROM '.$this->table.' WHERE username=:username');
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }

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

    public function cekEmailorUser($EmailorUser){
        $query = "SELECT * FROM tbl_users WHERE username = :username OR email = :email";
        $this->db->query($query);
        $this->db->bind('username', $EmailorUser);
        $this->db->bind('email', $EmailorUser);

        return $this->db->single();
    }

    public function getUserById($userID) {
        $this->db->query('SELECT * FROM tbl_users WHERE id_user = :id');
        $this->db->bind(':id', $userID);
        return $this->db->single();
    }
}