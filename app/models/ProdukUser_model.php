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

    public function getProdukById($id) {
        $query = "SELECT produk.*, 
            kategori.nama_kategori,
            GROUP_CONCAT(ukuran_produk.nama_ukuran SEPARATOR ', ') AS ukuran
        FROM produk
        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
        LEFT JOIN ukuran_produk ON ukuran_produk.id_produk = produk.id_produk 
        WHERE produk.id_produk = :id_produk
        GROUP BY produk.id_produk, kategori.nama_kategori";

        $this->db->query($query);
        $this->db->bind('id_produk', $id);
        return $this->db->single();
    }

    public function AddCart($id_cookie) {
        $query = 'INSERT INTO tbl_cart (id_user, session_id)
            VALUES (:id_user, :session_id)';

        $this->db->query($query);
        $this->db->bind('id_user', $id_cookie);
        $this->db->bind('session_id', $id_cookie);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getIdCartById($userID) {
        $query = 'SELECT * FROM tbl_cart 
            WHERE id_user = :id_user AND session_id = :session_id';
        
        $this->db->query($query);
        $this->db->bind('id_user', $userID);
        $this->db->bind('session_id', $userID);

        $this->db->execute();
        return $this->db->single();
    }

    public function AddCartItems($id, $id_produk, $price) {
        $query = 'INSERT INTO tbl_cart_items 
            ( id_cart, id_produk, quantity, price) 
            VALUES (:id_cart, :id_produk, 1, :price)';

        $this->db->query($query);
        $this->db->bind('id_cart', $id);
        $this->db->bind('id_produk', $id_produk);
        $this->db->bind('price', $price);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cekDataItemsByIdProduk($cartId, $id_produk) {
        $query = 'SELECT produk.*,
            tbl_cart.*,
            tbl_cart_items.*
        FROM tbl_cart_items
        INNER JOIN produk ON tbl_cart_items.id_produk = produk.id_produk
        INNER JOIN tbl_cart ON tbl_cart_items.id_cart = tbl_cart.id_cart
        WHERE tbl_cart_items.id_cart = :id_cart AND tbl_cart_items.id_produk = :id_produk';
        $this->db->query($query);

        $this->db->bind('id_cart', $cartId);
        $this->db->bind('id_produk', $id_produk);
        $this->db->execute();
        return $this->db->single();
    }

    public function allDataCartItems() {
        $query = 'SELECT produk.*,
            tbl_cart.*,
            tbl_cart_items.*
        FROM tbl_cart_items
        INNER JOIN produk ON tbl_cart_items.id_produk = produk.id_produk
        INNER JOIN tbl_cart ON tbl_cart_items.id_cart = tbl_cart.id_cart
        ORDER BY tbl_cart_items.id_cart_item DESC
        LIMIT 1';

        $this->db->query($query);
        
        $this->db->execute();
        return $this->db->single();
    }

    public function allDataCartItemsUpdate() {
        $query = 'SELECT produk.*,
            tbl_cart.*,
            tbl_cart_items.*
        FROM tbl_cart_items
        INNER JOIN produk ON tbl_cart_items.id_produk = produk.id_produk
        INNER JOIN tbl_cart ON tbl_cart_items.id_cart = tbl_cart.id_cart
        ORDER BY tbl_cart_items.id_cart_item';

        $this->db->query($query);
        
        $this->db->execute();
        return $this->db->single();
    }

    public function getIdItem($id_cart, $idProduk) {
        $query = 'SELECT id_cart_item 
            FROM tbl_cart_items 
            WHERE id_cart = :id_cart AND id_produk = :id_produk';

        $this->db->query($query);
        $this->db->bind('id_cart', $id_cart);
        $this->db->bind('id_produk', $idProduk);
        $this->db->execute();
        return $this->db->single();
    }

    public function UpdateDtaItems($itemsId, $quantity){
        $query = 'UPDATE tbl_cart_items SET 
            quantity = :quantity WHERE id_cart_item = :id_cart_item';
        $this->db->query($query);
        $this->db->bind('quantity', $quantity);
        $this->db->bind('id_cart_item', $itemsId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateCartItemQuantity($id_cart_item, $quantity) {
        $this->db->query('UPDATE tbl_cart_items 
            SET quantity = :quantity 
            WHERE id_cart_item = :id_cart_item');
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':id_cart_item', $id_cart_item);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletItemById($id_cart_item){
        $query = 'DELETE FROM tbl_cart_items 
            WHERE id_cart_item = :id_cart_item';
        $this->db->query($query);
        $this->db->bind('id_cart_item', $id_cart_item);
        $this->db->execute();
        return $this->db->rowCount();
    }
    

}