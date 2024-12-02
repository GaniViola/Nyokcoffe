<?php
class shoppingCart extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduk = $_POST['id_produk'];
            // Cek apakah pengguna sudah login dengan cookie
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
                            // Buat cart baru jika belum ada
                            $this->model('ProdukUser_model')->AddCart($userID);
                            $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                        }

                        // Tambahkan produk ke cart_items
                        $this->model('ProdukUser_model')->AddCartItems($id_cart['id_cart'], $produk['id_produk'], $produk['harga']);
                        $data = $this->model('ProdukUser_model')->allDataCartItems();

                        // Kembalikan respons produk
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

            // Jika gagal
            echo json_encode(['success' => false, 'message' => 'Gagal menambahkan ke keranjang']);
            exit;
        } else {
            header('Location: ' . BASEURL . '/AllProduk');
            exit;
        }
    }
}
