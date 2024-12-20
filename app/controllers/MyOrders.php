<?php 
class MyOrders extends Controller{
    public function index()
    {
        if ($_COOKIE['myKey'] && $_COOKIE['key']) {
            $userID = $_COOKIE['myKey'];
            $key = $_COOKIE['key'];

            $result = $this->model('User_model')->getUserById($userID);
            if ($result && $key === hash('whirlpool', $result['username'])) {
                $data['judul'] = 'My Orders';
                $data['orders'] = $this->model('ProdukUser_model')->selectAllOrders($userID);
                $this->view('orders/index', $data);
                
            }
            
        }else {
            header('Location: '.BASEURL);
            exit;
        }
    }

    public function addToOrders() {
        // Pastikan request menggunakan metode POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }
    
        // Cek keberadaan COOKIE
        if (isset($_COOKIE['myKey'], $_COOKIE['key'])) {
            $userID = $_COOKIE['myKey'];
            $key = $_COOKIE['key'];
    
            // Validasi input POST
            $Total = isset($_POST['Total']) ? (int)$_POST['Total'] : 0;
            $Produk = isset($_POST['produk']) ? $_POST['produk'] : [];
    
            // Cek user berdasarkan ID
            $result = $this->model('User_model')->getUserById($userID);
    
            if ($result && $key === hash('whirlpool', $result['username'])) {
                $status = 'pending';
                $tblOrder = $this->model('Orders_model')->Orders($userID, $status);
    
                // Jika tidak ada pesanan 'pending', buat pesanan baru
                if (!$tblOrder) {
                    $this->model('Orders_model')->InputOrders($userID, $Total);
    
                    // Ambil ID order yang baru saja dibuat
                    $order = $this->model('Orders_model')->Orders($userID, $status);
                    $id_order = $order['id_order'];
    
                    // Input order items
                    $this->model('Orders_model')->InputOrderItem($id_order, $Produk);
    
                    // Hapus item keranjang pengguna
                    $id_cart = $this->model('ProdukUser_model')->getIdCartById($userID);
                    if ($id_cart) {
                        $this->model('ProdukUser_model')->deleteCartItems($id_cart['id_cart']);
                    }
    
                    // Respons sukses
                    echo json_encode(['success' => true, 'message' => 'Order berhasil dibuat', 'redirect_url' => BASEURL . '/MyOrders']);
                    exit;
                } else {
                    echo json_encode(['success' => false, 'message' => 'Anda memiliki pesanan pending. Selesaikan terlebih dahulu.']);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'User tidak valid']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Sesi Anda berakhir. Silakan login ulang.']);
            exit;
        }
    }    
}