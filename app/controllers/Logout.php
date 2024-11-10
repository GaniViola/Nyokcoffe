<?php
session_destroy();
setcookie('myKey', '', time() - 3600);
setcookie('key', '', time() - 3600);
header('Location: '.BASEURL);