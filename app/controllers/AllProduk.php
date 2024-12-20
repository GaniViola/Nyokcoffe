<?php 

class allProduk extends Controller{
    public function index(){
        $data['judul'] = 'Home';
        $data['allProduk'] = $this->model('ProdukUser_model')->GetAllProduk();
        $this->view('template/header', $data);
        $this->view('template/navbar');
        $this->view('produk/index', $data);
        $this->view('template/footer');
    }

    public function Cekout()
{
    // Pastikan request menggunakan metode POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        exit;
    }

    // Cek keberadaan COOKIE
    if (isset($_COOKIE['myKey'], $_COOKIE['key'])) {
        $userID = htmlspecialchars($_COOKIE['myKey']); // Sanitasi input
        $key = $_COOKIE['key'];

        // Validasi input POST
        $Total = isset($_POST['Total']) ? (int)$_POST['Total'] : 0;
        $Produk = isset($_POST['produk']) ? $_POST['produk'] : [];

        if ($Total <= 0 || empty($Produk)) {
            echo json_encode(['success' => false, 'message' => 'Data pesanan tidak valid.']);
            exit;
        }

        // Cek user berdasarkan ID
        $result = $this->model('User_model')->getUserById($userID);

        if ($result && $key === hash('whirlpool', $result['username'])) {
            $status = 'pending';
            $tblOrder = $this->model('Orders_model')->Orders($userID, $status);

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

                // Generate Snap Token dari Midtrans
                require_once __DIR__ . "/../../vendor/autoload.php";
                \Midtrans\Config::$serverKey = 'SB-Mid-server-VMFXvRm35_3H9uHqEQn3JO86'; 
                \Midtrans\Config::$isProduction = false;
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $id_order,
                        'gross_amount' => $Total,
                    ],
                ];

                try {
                    $snapToken = \Midtrans\Snap::getSnapToken($params);
                    echo json_encode(['success' => true, 'snap_token' => $snapToken]);
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Gagal membuat token pembayaran: ' . $e->getMessage()]);
                }
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