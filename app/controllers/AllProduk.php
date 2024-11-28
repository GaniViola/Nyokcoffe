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
}