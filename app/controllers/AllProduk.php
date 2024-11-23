<?php 

class allProduk extends Controller{
    public function index(){
        $data['judul'] = 'Home';
        $data['minuman'] = $this->model('Produk_model')->getAlldataMinuman();
        $this->view('template/header', $data);
        $this->view('template/navbar');
        $this->view('produk/index', $data);
        $this->view('template/footer');
    }
}