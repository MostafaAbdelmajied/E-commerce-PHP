<?php
require_once '../inc/connection.php';

if(isset($_GET['key'])){
    unset($_SESSION['cart'][$_GET['key']]);
    header("location:{$_SERVER['HTTP_REFERER']}");  
}else{
    header("location:../cart.php");
}
