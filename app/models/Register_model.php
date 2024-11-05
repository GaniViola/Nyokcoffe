<?php

class Register_model {
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

    public function createAkun($data){
        $query = "INSERT INTO tbl_users (username, email, no_tlp, alamat, password, role)
                VALUES 
            (:username, :email, :no_tlp, :alamat, :password, 'user')";

        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('no_tlp', $data['no_tlp']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('password', $data['password']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}