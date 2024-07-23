<?php
require_once '../inc/connection.php';


if(isset($_SESSION['user_id'])){
    //$_SESSION['cart'] = [];
$quantity = (! empty($_POST['quantity']))? $_POST['quantity'] : 1;
foreach($_SESSION['products'] as $product){
    if($product['product_number'] == $_GET['id']){
        
        $product = array_merge($product,["quantity"=>$quantity,"user_id" => $_SESSION['user_id']]);
        //var_dump($product);
        $_SESSION['cart'][] = $product;
    }
}

header("location:{$_SERVER['HTTP_REFERER']}");

}else{
    header("location:../login.php");
}

