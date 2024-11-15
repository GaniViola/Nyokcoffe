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

    public function produk(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori = $_POST['kategori'];
            if ($kategori == 'Makanan'){
                $data['judul'] = 'Data Produk';
                $data['produk'] = $this->model('Produk_model')->getAlldataMakanan();
                $this->view('admin/template/header', $data);
                $this->view('admin/template/sidebar');
                $this->view('admin/produk/index');
                $this->view('admin/produk/makanan', $data);
                $this->view('admin/template/footer');
                exit;
            }
        }

        $data['judul'] = 'Data Produk';
        $data['produk'] = $this->model('Produk_model')->getAlldata();
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/produk/index');
        $this->view('admin/template/footer');
    }

    public function makanan() {
        $data['judul'] = 'Data Makanan';
        $data['produk'] = $this->model('Produk_model')->getAlldataMakanan();
        $this->view('admin/template/header', $data);
        $this->view('admin/template/sidebar');
        $this->view('admin/produk/makanan', $data);
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

    public function inputDataMakanan(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_produk = $_POST['nama_produk'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
    
            // Cek apakah produk dengan nama yang sama sudah ada
            if ($this->model('Produk_model')->cekProdukByNama($nama_produk) > 0) {
                header('Location: '.BASEURL.'/admin/makanan');
                Flasher::setFlashProduk('Data produk sudah ada', '', 'warning');
                exit;
            } else {
                // Upload gambar
                $gambar = $this->upload();
                if (!$gambar) {
                    header('Location: '.BASEURL.'/admin/makanan');
                    Flasher::setFlashProduk('Gagal menambahkan data', '', 'warning');
                    exit;
                }
    
                // Jika upload berhasil, lakukan proses simpan data produk ke database
                $id_kategori = 2;
                if ($this->model('Produk_model')->inputDataProduk($nama_produk, $harga, $id_kategori,  $gambar, $stok) > 0){
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data produk berhasil ditambahkan', '', 'success');
                    exit;
                } else {
                    header('Location: '. BASEURL .'/admin/makanan');
                    Flasher::setFlashProduk('Data gagal di input', '', 'warning');
                    exit;
                }
            }
        }
    }

    public function hapusMakanan($id){
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
    
    private function upload(){
        $namafile = $_FILES["gambar"]["name"];
        $ukuranfile = $_FILES["gambar"]["size"];
        $error = $_FILES["gambar"]["error"];
        $tmpnama = $_FILES["gambar"]["tmp_name"];
    
        // Cek apakah tidak ada gambar yang di-upload
        if($error === 4){
            Flasher::setFlashProduk('Tidak ada file yang diunggah', '', 'danger');
            return false;
        }
    
        // Validasi ekstensi file gambar
        $ekstensigambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namafile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensigambarValid)){
            header('Location: '.BASEURL.'/admin/makanan');
            Flasher::setFlashProduk('Ekstensi file tidak sesuai. Silakan pilih file JPG, JPEG, atau PNG.', '', 'danger');
            exit;
        }
    
        // Validasi ukuran file
        if($ukuranfile > 1000000){
            header('Location: '.BASEURL.'/admin/makanan');
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
            header('Location: '.BASEURL.'/admin/makanan');
            Flasher::setFlashProduk('Gagal meng-upload gambar. Silakan coba lagi.', '', 'danger');
            exit;
        }
    }
}