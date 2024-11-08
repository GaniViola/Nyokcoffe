<?php 
class Home extends Controller{
    public function index(){
        
        if (isset($_SESSION['user'])){
            Flasher::Login();
        }

        $data['judul'] = 'Home';
        $this->view('template/header', $data);
        $this->view('template/navbar');
        $this->view('home/index');
        $this->view('template/footer');
    }
}