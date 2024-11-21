<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Produk_model.php';

class ProdukApi
{
    private $produkModel;

    public function __construct()
    {
        $this->produkModel = new Produk_model();
    }

    // Mendapatkan semua data produk
    public function getAllProduk($kategori = null) {
        header('Content-Type: application/json');
        
        // Validasi metode HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
            return;
        }
    
        // Ambil data produk berdasarkan kategori
        if ($kategori) {
            $produk = $this->produkModel->getAllProduk($kategori); // Mengambil produk berdasarkan kategori
        } else {
            $produk = $this->produkModel->getAllProduk(); // Ambil semua produk jika kategori tidak diberikan
        }
    
        // Kirimkan respons
        if ($produk) {
            http_response_code(200); // OK
            echo json_encode([
                "status" => "success",
                "data" => array_map(function ($item) {
                    return [
                        "ProdukId" => $item["id_produk"],
                        "NamaProduk" => htmlspecialchars($item["nama_produk"]),
                        "Kategori" => htmlspecialchars($item["nama_kategori"]),
                        "Ukuran" => isset($item["nama_ukuran"]) ? htmlspecialchars($item["nama_ukuran"]) : null,
                        "Harga" => $item["harga"],
                        "Stok" => $item["stok"],
                        "GambarUrl" => BASEURL . '/uploads/' . $item["gambar"],
                        "DibuatPada" => $item["created_at"],
                    ];
                }, $produk)
            ]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["status" => "error", "message" => "Data produk tidak ditemukan"]);
        }
    }
    
    
    

    // Mendapatkan data produk berdasarkan ID
    // public function getProdukById($id)
    // {
    //     header('Content-Type: application/json');

    //     if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    //         http_response_code(405); // Method Not Allowed
    //         echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
    //         return;
    //     }

    //     $produk = $this->produkModel->getProdukById($id);

    //     if ($produk) {
    //         http_response_code(200); // OK
    //         echo json_encode([
    //             "status" => "success",
    //             "data" => [
    //                 "ProdukId" => $produk["id_produk"],
    //                 "NamaProduk" => $produk["nama_produk"],
    //                 "Harga" => $produk["harga"],
    //                 "Stok" => $produk["stok"],
    //                 "GambarUrl" => BASEURL . '/uploads/' . $produk["gambar"],
    //                 "Kategori" => $produk["id_kategori"],
    //                 "DibuatPada" => $produk["created_at"],
    //             ]
    //         ]);
    //     } else {
    //         http_response_code(404); // Not Found
    //         echo json_encode(["status" => "error", "message" => "Produk tidak ditemukan"]);
    //     }
    // }

    // // Menambahkan data produk baru
    // public function addProduk($data)
    // {
    //     header('Content-Type: application/json');

    //     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //         http_response_code(405); // Method Not Allowed
    //         echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
    //         return;
    //     }

    //     // Validasi input
    //     if (empty($data['NamaProduk']) || empty($data['Harga']) || empty($data['Kategori']) || empty($data['Stok'])) {
    //         http_response_code(400); // Bad Request
    //         echo json_encode(["status" => "error", "message" => "Data produk tidak lengkap"]);
    //         return;
    //     }

    //     $result = $this->produkModel->inputDataProduk(
    //         $data['NamaProduk'],
    //         $data['Harga'],
    //         $data['Kategori'],
    //         $data['GambarUrl'] ?? null, // Gambar opsional
    //         $data['Stok']
    //     );

    //     if ($result) {
    //         http_response_code(201); // Created
    //         echo json_encode(["status" => "success", "message" => "Produk berhasil ditambahkan"]);
    //     } else {
    //         http_response_code(500); // Internal Server Error
    //         echo json_encode(["status" => "error", "message" => "Gagal menambahkan produk"]);
    //     }
    // }

    // // Mengedit data produk berdasarkan ID
    // public function updateProduk($id, $data)
    // {
    //     header('Content-Type: application/json');

    //     if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    //         http_response_code(405); // Method Not Allowed
    //         echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
    //         return;
    //     }

    //     // Validasi input
    //     if (empty($data['NamaProduk']) || empty($data['Harga']) || empty($data['Stok'])) {
    //         http_response_code(400); // Bad Request
    //         echo json_encode(["status" => "error", "message" => "Data produk tidak lengkap"]);
    //         return;
    //     }

    //     $result = $this->produkModel->EditMinuman(
    //         $id,
    //         $data['NamaProduk'],
    //         $data['Stok'],
    //         $data['Harga'],
    //         $data['GambarUrl'] ?? null // Gambar opsional
    //     );

    //     if ($result) {
    //         http_response_code(200); // OK
    //         echo json_encode(["status" => "success", "message" => "Produk berhasil diperbarui"]);
    //     } else {
    //         http_response_code(500); // Internal Server Error
    //         echo json_encode(["status" => "error", "message" => "Gagal memperbarui produk"]);
    //     }
    // }

    // // Menghapus data produk berdasarkan ID
    // public function deleteProduk($id)
    // {
    //     header('Content-Type: application/json');

    //     if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    //         http_response_code(405); // Method Not Allowed
    //         echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
    //         return;
    //     }

    //     if (empty($id) || !is_numeric($id)) {
    //         http_response_code(400); // Bad Request
    //         echo json_encode(["status" => "error", "message" => "ID produk tidak valid"]);
    //         return;
    //     }

    //     $result = $this->produkModel->deleteDataProduk($id);

    //     if ($result) {
    //         http_response_code(200); // OK
    //         echo json_encode(["status" => "success", "message" => "Produk berhasil dihapus"]);
    //     } else {
    //         http_response_code(500); // Internal Server Error
    //         echo json_encode(["status" => "error", "message" => "Gagal menghapus produk"]);
    //     }
    // }
}
