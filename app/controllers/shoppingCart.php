<?php
class shoppingCart extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduk = $_POST['id_produk'];
            if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
                $userID = $_COOKIE['myKey'];
                $key = $_COOKIE['key'];
                $result = $this->model('User_model')->getUserById($userID);
                if ($key === hash('whirlpool', $result['username'])) {
                    // Ambil data produk
                    $produk = $this->model('ProdukUser_model')->getProdukById($idProduk);
                    if ($produk) {
                        $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                        if (!$id_cart) {
                            $this->model('ProdukUser_model')->AddCart($userID);
                            $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                        }

                        $cartId = $id_cart['id_cart'];
                        $result = $this->model('ProdukUser_model')->cekDataItemsByIdProduk($cartId, $idProduk);

                        if ($result) {
                            $itemsId = $result['id_cart_item'];
                            $quantityDB = $result['quantity'];
                            $quantity = 1 + $quantityDB;
                            
                            $this->model('ProdukUser_model')->UpdateDtaItems($itemsId, $quantity);
                            $data = $this->model('ProdukUser_model')->cekDataItemsByIdProduk($cartId, $idProduk);
                            if ($data) {
                                echo json_encode([
                                    'success' => true,
                                    'produk' => [
                                        'id_produk' => $data['id_produk'],
                                        'nama_produk' => $data['nama_produk'],
                                        'quantity' => $data['quantity'],
                                        'harga' => $data['harga'],
                                        'gambar' => BASEURL . '/uploads/' . $data['gambar']
                                    ]
                                ]);
                                exit;
                            }
                        } else {
                            $this->model('ProdukUser_model')->AddCartItems($cartId, $produk['id_produk'], $produk['harga']);
                            $data = $this->model('ProdukUser_model')->cekDataItemsByIdProduk($cartId, $idProduk);
                            echo json_encode([
                                'success' => true,
                                'produk' => [
                                    'id_produk' => $data['id_produk'],
                                    'nama_produk' => $data['nama_produk'],
                                    'quantity' => $data['quantity'],
                                    'harga' => $data['harga'],
                                    'gambar' => BASEURL . '/uploads/' . $data['gambar']
                                ]
                            ]);
                            exit;
                        }
                    }
                }
            }

            echo json_encode(['success' => false, 'message' => 'Gagal menambahkan ke keranjang']);
            exit;
        } else {
            header('Location: ' . BASEURL . '/AllProduk');
            exit;
        }
    }

    public function updateCartQuantity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduk = $_POST['id_produk'];
            $quantity = $_POST['quantity'];
            if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
                $userID = $_COOKIE['myKey'];
                $key = $_COOKIE['key'];
                $result = $this->model('User_model')->getUserById($userID);
                if ($key === hash('whirlpool', $result['username'])) {
                    $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                    $cartId = $id_cart['id_cart'];
                    $id_cart_item = $this->model('ProdukUser_model')->getIdItem($cartId, $idProduk);
                    if ($id_cart_item) {
                        $updateResult = $this->model('ProdukUser_model')->updateCartItemQuantity($id_cart_item['id_cart_item'], $quantity);
                        if ($updateResult) {
                            echo json_encode(['success' => true]);
                            exit;
                        }
                    }
                }
            }
        }
    }

    public function deleteCartItem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduk = $_POST['id_produk'];
            if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
                $userID = $_COOKIE['myKey'];
                $key = $_COOKIE['key'];
                $result = $this->model('User_model')->getUserById($userID);
                if ($key === hash('whirlpool', $result['username'])) {
                    $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                    $cartId = $id_cart['id_cart'];
                    $id_cart_item = $this->model('ProdukUser_model')->getIdItem($cartId, $idProduk);
                    if ($id_cart_item) {
                        $updateResult = $this->model('ProdukUser_model')->deletItemById($id_cart_item['id_cart_item']);
                        if ($updateResult) {
                            echo json_encode(['success' => true]);
                            exit;
                        }
                    }
                }
            }
        }
    }

    public function getCartItems() {
        if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
            $userID = $_COOKIE['myKey'];
            $key = $_COOKIE['key'];
            $result = $this->model('User_model')->getUserById($userID);
            
            if ($key === hash('whirlpool', $result['username'])) {
                $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                if ($id_cart) {
                    $cartItems = $this->model('ProdukUser_model')->getCartItems($id_cart['id_cart']);
                    if ($cartItems) {
                        echo json_encode(['success' => true, 'cartItems' => $cartItems]);
                        exit;
                    }
                }
            }
        }
    
        echo json_encode(['success' => false, 'message' => 'Keranjang kosong']);
        exit;
    }
    
}
