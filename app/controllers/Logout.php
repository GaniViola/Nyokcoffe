<?php
unset($_SESSION['login']);
unset($_SESSION['EmailorUser']);
unset($_SESSION['role']);
session_destroy(); 
setcookie('myKey', '', time() - 3600, '/'); 
setcookie('key', '', time() - 3600, '/');  
header('Location: '.BASEURL); 
exit; 