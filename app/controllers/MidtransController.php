<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Midtrans\Snap;
use Midtrans\Config;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = "SB-Mid-server-VMFXvRm35_3H9uHqEQn3JO86"; // Ganti dengan Server Key Anda
        Config::$isProduction = false; // Ubah ke true jika sudah dalam produksi
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index($id_order)
    {
        // Ambil data pesanan dari database
        $order = $this->model('Orders_model')->getOrderById($id_order);

        if (!$order) {
            die("Order not found.");
        }

        // Data untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORD' . $order['id_order'], // ID unik pesanan
                'gross_amount' => $order['total'],       // Total harga pesanan
            ],
        ];

        try {
            // Generate Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Kirim token ke view untuk memunculkan Midtrans Snap
            $this->view('orders/pay', ['snapToken' => $snapToken]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function success()
    {
        // Update status pesanan menjadi 'completed'
        $order_id = $_GET['order_id'] ?? null; // Pastikan order_id dikirimkan
        if (!$order_id) {
            die("Order ID not provided.");
        }

        $id_order = str_replace('ORD', '', $order_id);

        $this->model('Orders_model')->updateOrderStatus($id_order, 'completed');
        header('Location: ' . BASEURL . '/orders');
        exit;
    }
}
