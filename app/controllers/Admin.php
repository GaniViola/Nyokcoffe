<?php

class Admin extends Controller {

    public function index() {

        if (isset($_COOKIE['myKey']) && isset($_COOKIE['key'])) {
            $userID = $_COOKIE['myKey'];
            $key = $_COOKIE['key'];
            $result = $this->model('User_model')->getUserById($userID);

            if($key === hash('whirlpool', $result['username'])){
                if ($_SESSION['role'] !== 'admin'){
                    header('Location: '.BASEURL);
                    exit;
                }
            }
        }else{
            header('Location: '.BASEURL);
            exit;
        }
        $data['judul'] = 'admin';
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/template/footer');
        
    }

    public function minuman() {
        $data['judul'] = 'Data Minuman';
        $data['produk'] = $this->model('Produk_model')->getAlldataMinuman();
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/produk/minuman', $data);
        $this->view('admin/template/footer');
    }

    public function inputDataMinuman(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_produk = $_POST['nama_produk'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $ukuran = $_POST['ukuran'];
            $kategori = 1;
            $location = '/admin/minuman';
            
            //cek produk pada database bynama dan ukuran
            if ($this->model('Produk_model')->cekProdukByNamaAndUkuran($nama_produk, $ukuran) > 0) {
                header('Location: '.BASEURL.'/admin/minuman');
                Flasher::setFlashProduk('Data produk sudah ada', '', 'warning');
                exit;
            } else {
                $gambar = $this->upload($location);
                if ($this->model('Produk_model')->inputDataProduk($nama_produk, $harga, $kategori,  $gambar, $stok) > 0){
                    $lastId = $this->model('Produk_model')->getLastId();
                    if ($this->model('Produk_model')->inputUkuranProduk($lastId, $ukuran) > 0) {
                        header('Location: '. BASEURL .'/admin/minuman');
                        Flasher::setFlashProduk('Data produk berhasil ditambahkan', '', 'success');
                        exit;
                    }
                }
            }
        } else {
            Admin::Header('/admin/minuman');
        }
    }

    public function hapusMinuman($id = null, $ukuran = null){
        if (empty($id) || empty($ukuran)) {
            header('Location: '. BASEURL .'/admin/minuman');
            exit;
        }
        $gambar = $this->model('Produk_model')->getGambarProduk($id);
        $idProdukUkuran = $this->model('Produk_model')->getIdProdukUkuran($id, $ukuran);
        $idUkuran = $idProdukUkuran['id_ukuran'];
        $filePath = '../public/uploads/' . $gambar['gambar'];
        if (file_exists($filePath)) {
            unlink($filePath); 
        }
        if ($this->model('Produk_model')->deleteDataMinnuman($idUkuran) > 0){
            header('Location: '. BASEURL .'/admin/minuman');
            Flasher::setFlashProduk('Data produk berhasil didelete', '', 'success');
            exit;
            
        } else {
            header('Location: '. BASEURL .'/admin/minuman');
            Flasher::setFlashProduk('Data gagal didelete', '', 'warning');
            exit;
        }
    }

    public function getUbah(){
        if (!isset($_POST['id_produk']) && !isset($_POST['nama_ukuran'])) {
            header('Location: '.BASEURL.'/admin/minuman');
            exit;
        }

        $idProduk = $_POST['id_produk'];
        $namaUkuran = $_POST['nama_ukuran'];

        echo json_encode($this->model('Produk_model')->getMinumanForEdit($idProduk, $namaUkuran));

    }

    public function EditMinuman(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_produk = $_POST['id_produk'];
            $nama_produk = $_POST['nama_produk'];
            $stok = $_POST['stok'];
            $harga = $_POST['harga'];
            $getDataLama = $this->model('Produk_model')->getProdukById($id_produk);
            $location = '/admin/minuman';
            $gambarLama = $getDataLama['gambar'];

            if ($_FILES['gambar']['error'] !== 4) {
                $gambar = $this->uploadEdit($location, $getDataLama);
                if ($this->model('Produk_model')->EditMinuman($id_produk, $nama_produk, $stok, $harga, $gambar) > 0) {
                    header('Location: '. BASEURL .'/admin/minuman');
                    Flasher::setFlashProduk('Data produk berhasil diEdit', '', 'success');
                    exit;
                }else {
                    header('Location: '. BASEURL .'/admin/minuman');
                    Flasher::setFlashProduk('Data produk gagal diEdit', '', 'warning');
                    exit;
                }
            }else {
                if ($this->model('Produk_model')->EditMinuman($id_produk, $nama_produk, $stok, $harga, $gambarLama) > 0) {
                    header('Location: '. BASEURL .'/admin/minuman');
                    Flasher::setFlashProduk('Data produk berhasil diEdit', '', 'success');
                    exit;
                }
            }
        }else {
            header('Location: '.BASEURL.'/admin/minuman');
            exit;
        }
    }

    public function EditMakanan(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_produk = $_POST['id_produk'];
            $nama_produk = $_POST['nama_produk'];
            $stok = $_POST['stok'];
            $harga = $_POST['harga'];
            $getDataLama = $this->model('Produk_model')->getProdukById($id_produk);
            $location = '/admin/makanan';
            $gambarLama = $getDataLama['gambar'];

            if ($_FILES['gambar']['error'] !== 4) {
                $gambar = $this->uploadEdit($location, $getDataLama);
                if ($this->model('Produk_model')->EditMinuman($id_produk, $nama_produk, $stok, $harga, $gambar) > 0) {
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data produk berhasil diEdit', '', 'success');
                    exit;
                }else {
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data produk gagal diEdit', '', 'warning');
                    exit;
                }
            }else {
                if ($this->model('Produk_model')->EditMinuman($id_produk, $nama_produk, $stok, $harga, $gambarLama) > 0) {
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data produk berhasil diEdit', '', 'success');
                    exit;
                }
            }
        }else {
            header('Location: '.BASEURL.'/admin/minuman');
            exit;
        }
    }

    public function makanan() {
        $data['judul'] = 'Data Makanan';
        $data['produk'] = $this->model('Produk_model')->getAlldataMakanan();
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/produk/makanan', $data);
        $this->view('admin/template/footer');
    }

    public function cariMakanan() {
        if (isset($_POST['search'])) {
            // Ambil kata kunci pencarian dari form input
            $keyword = $_POST['keyword'];
    
            // Panggil model untuk mencari produk makanan berdasarkan keyword
            $data['judul'] = 'Hasil Pencarian Makanan';
            $data['produk'] = $this->model('Produk_model')->cariMakanan($keyword);
    
            // Tampilkan hasil pencarian
            $this->view('admin/template/header', $data);
            $this->view('admin/template/sidebar');
            $this->view('admin/produk/makanan', $data);
            $this->view('admin/template/footer');
        } else {
            // Jika tidak ada pencarian, tampilkan halaman produk makanan biasa
            $this->makanan();
        }
    }

    public function cariMinuman() {
        if (isset($_POST['search'])) {
            // Ambil kata kunci pencarian dari form input
            $keyword = $_POST['keyword'];
    
            // Panggil model untuk mencari produk makanan berdasarkan keyword
            $data['judul'] = 'Hasil Pencarian Mainuman';
            $data['produk'] = $this->model('Produk_model')->cariMinuman($keyword);
    
            // Tampilkan hasil pencarian
            $this->view('admin/template/header', $data);
            $this->view('admin/template/sidebar');
            $this->view('admin/produk/minuman', $data);
            $this->view('admin/template/footer');
        } else {
            // Jika tidak ada pencarian, tampilkan halaman produk makanan biasa
            $this->minuman();
        }
    }
    
    
    public function inputDataMakanan(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_produk = $_POST['nama_produk'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $kategori = 2;
            $location = '/admin/makanan';
    
            // Cek apakah produk dengan nama yang sama sudah ada
            if ($this->model('Produk_model')->cekProdukByNama($nama_produk) > 0) {
                header('Location: '.BASEURL.'/admin/makanan');
                Flasher::setFlashProduk('Data produk sudah ada', '', 'warning');
                exit;
            } else {
                $gambar = $this->upload($location);
                if ($this->model('Produk_model')->inputDataProduk($nama_produk, $harga, $kategori,  $gambar, $stok) > 0){
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data produk berhasil ditambahkan', '', 'success');
                    exit;
                } else {
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data gagal di input', '', 'warning');
                    exit;
                }
            }
        }else {
            header('Location: '.BASEURL.'/admin');
            exit;
        }
    }

    public function hapusMakanan($id = null){
        if (empty($id)) {
            header('Location: '. BASEURL .'/admin/makanan');
            exit;
        }
        $gambar = $this->model('Produk_model')->getGambarProduk($id);
        $filePath = '../public/uploads/' . $gambar['gambar'];
        if (file_exists($filePath)) {
            unlink($filePath); 
        }
        if ($this->model('Produk_model')->deleteDataProduk($id) > 0){
            header('Location: '. BASEURL .'/admin/makanan');
            Flasher::setFlashProduk('Data produk berhasil didelete', '', 'success');
            exit;
        } else {
            header('Location: '. BASEURL .'/admin/makanan');
            Flasher::setFlashProduk('Data gagal didelete', '', 'warning');
            exit;
        }
    }

    public function getUbahMakanan (){
        if (!isset($_POST['id_produkMakanan'])) {
            header('Location: '.BASEURL.'/admin/minuman');
            exit;
        }

        $idProduk = $_POST['id_produkMakanan'];

        echo json_encode($this->model('Produk_model')->getProdukById($idProduk));
    }

    private function upload($location){
        $namafile = $_FILES["gambar"]["name"];
        $ukuranfile = $_FILES["gambar"]["size"];
        $error = $_FILES["gambar"]["error"];
        $tmpnama = $_FILES["gambar"]["tmp_name"];
    
        // Cek apakah tidak ada gambar yang di-upload
        if($error === 4){
            Admin::Header($location);
            Flasher::setFlashProduk('Tidak ada file yang diunggah', '', 'danger');
            exit;
        }
    
        // Validasi ekstensi file gambar
        $ekstensigambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namafile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensigambarValid)){
            Admin::Header($location);
            Flasher::setFlashProduk('Ekstensi file tidak sesuai. Silakan pilih file JPG, JPEG, atau PNG.', '', 'danger');
            exit;
        }
    
        // Validasi ukuran file
        if($ukuranfile > 1000000){
            Admin::Header($location);
            Flasher::setFlashProduk('Ukuran file melebihi batas maksimum 1MB.', '', 'danger');
            exit;
        }
    
        // Buat nama file unik untuk menghindari konflik
        $namafileBaru = uniqid() . '.' . $ekstensiGambar;
    
        // Path penyimpanan di server
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/Nyokcoffe/public/uploads/';
        $targetFile = $targetDir . $namafileBaru;
    
        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($tmpnama, $targetFile)) {
            return $namafileBaru;
        } else {
            Admin::Header($location);
            Flasher::setFlashProduk('Gagal meng-upload gambar. Silakan coba lagi.', '', 'danger');
            exit;
        }
    }

    private function uploadEdit($location, $getDataLama){
        $namafile = $_FILES["gambar"]["name"];
        $ukuranfile = $_FILES["gambar"]["size"];
        $tmpnama = $_FILES["gambar"]["tmp_name"];

        // Validasi ekstensi file gambar
        $ekstensigambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namafile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensigambarValid)) {
            Admin::Header($location);
            Flasher::setFlashProduk('Ekstensi file tidak sesuai. Silakan pilih file JPG, JPEG, atau PNG.', '', 'danger');
            exit;
        }

        // Validasi ukuran file
        if ($ukuranfile > 1000000) {
            Admin::Header($location);
            Flasher::setFlashProduk('Ukuran file melebihi batas maksimum 1MB.', '', 'danger');
            exit;
        }

        // Buat nama file unik untuk menghindari konflik
        $namafileBaru = uniqid() . '.' . $ekstensiGambar; 

        // Path penyimpanan di server
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/Nyokcoffe/public/uploads/';
        $targetFile = $targetDir . $namafileBaru;
        $gambarLama = $getDataLama['gambar'];

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($tmpnama, $targetFile)) {
            // Hapus gambar lama jika ada
            if ($gambarLama && file_exists($targetDir . $gambarLama)) {
                unlink($targetDir . $gambarLama);
            }
            return $namafileBaru;
        } else {
            Admin::Header($location);
            Flasher::setFlashProduk('Gagal meng-upload gambar. Silakan coba lagi.', '', 'danger');
            exit;
        }
    }

    public static function Header($location){
        header('Location: '. BASEURL.$location);
    }

    public function Profil() {
        $data['judul'] = 'Profil';
        $this->view('admin/dropdownmenu/index', $data);
       
    }
}

