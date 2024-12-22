<?php
class Orders_model {
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function Orders($userID, $status){
        $query = 'SELECT * FROM tbl_orders WHERE id_user = :id_user AND status = :status';
        $this->db->query($query);
        $this->db->bind('id_user', $userID);
        $this->db->bind('status', $status);
        $this->db->execute();
        return $this->db->single();
    }

    public function InputOrderItem($id_order, $produk) {
        $query = "INSERT INTO tbl_order_items (id_order, id_produk, quantity, harga) 
            VALUES (:id_order, :id_produk, :quantity, :harga)";

        // Siapkan query
        $this->db->query($query);
        
        foreach ($produk as $p) {
            $this->db->bind('id_order', $id_order);
            $this->db->bind('id_produk', $p['id_produk']);
            $this->db->bind('quantity', $p['quantity']);
            $this->db->bind('harga', $p['harga']);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }

    public function InputOrders($userID, $Total) {
        $query = 'INSERT INTO tbl_orders (id_user, total) 
            VALUES (:id_user, :total)';
        $this->db->query($query);
        $this->db->bind('id_user', $userID);
        $this->db->bind('total', $Total);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getOrderById($id_order){
        $query = 'SELECT * FROM tbl_orders WHERE id_order = :id_order';
        $this->db->query($query);
        $this->db->bind('id_order', $id_order);
        $this->db->execute();
        return $this->db->single();
    }

    public function laporan() {
        $query = 'SELECT tbl_users.username,  
	tbl_orders.*
FROM tbl_orders
INNER JOIN tbl_users ON tbl_orders.id_user = tbl_users.id_user';
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}