<?php 

class Flasher {

    public static function setFlash($pesan, $aksi, $tipe){
        $_SESSION['flash'] = ['pesan' => $pesan, 'aksi' => $aksi, 'tipe' => $tipe];
    }

    public static function flash(){
        if (isset($_SESSION['flash'])){
            echo '<div class="alert alert-'.$_SESSION['flash']['tipe'].' alert-dismissible fade show" role="alert">
                    <strong>'.$_SESSION['flash']['pesan'].'</strong>'.$_SESSION['flash']['aksi'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['flash']);
        }
    }

    public static function setLogin(){
        $_SESSION['user'] = true;
    }

    public static function Login(){
        if (isset($_SESSION['user'])){
            echo '<li class="nav_item dropdown">
                    <a href="#" class="nav_link user-name">
                        <span class="nav_icons"><i class="bx bxs-user-circle"></i></span>
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">Settings</a>
                        <a href="logout.php">Logout</a>
                    </div>';
        } else {
            echo '<a href="#" class="nav_user">
            <i class="bx bx-user"></i>
            </a>';
        }
    }

    public static function navLogin(){
        if (isset($_SESSION['user'])) {
            echo '<li class="nav_item hidden">
                    <a href="" class="nav_link">Logout</a>
                  </li>';
        }
    }
    
}