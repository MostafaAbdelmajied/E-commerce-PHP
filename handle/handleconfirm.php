<?php
require_once '../inc/connection.php';

if(! isset($_POST['submit'])){
    header("location:../cart.php");
}
// var_dump($_POST);
// echo "<hr>";
$order_products = [];
foreach($_SESSION['cart'] as $key=>$product){
    if($product['user_id'] == $_SESSION['user_id']){
        array_push($order_products,$product);
    }
}
// var_dump($order_products);
// echo "<hr>";
// var_dump(array_keys($_SESSION));
// echo "<hr>";
// echo  $_SESSION['order_total'] ."    " . $_SESSION['order_after_copun'];


$city = $_POST['city'];
$postal_code = $_POST['postal_code'];
// validation on city postal code
$errors = [];
if(empty($city)){
    $errors[] = "city is required";
}elseif(is_numeric($city)){
    $errors[] = "city name must be string";
}
if(empty($postal_code)){
    $errors[] = "postal_code is required";
}elseif(! is_numeric($postal_code)){
    $errors[] = "postal_code must be number";
}

$query = "select city, postal_code from users where id = {$_SESSION['user_id']}";
$runQuery = mysqli_query($conn,$query);
$user = mysqli_fetch_assoc($runQuery);
if($user['city'] == null || $user['postal_code'] == null){
    $query = "update users set city = '$city' , postal_code = $postal_code where id = {$_SESSION['user_id']}";
    $runQuery = mysqli_query($conn,$query);
}

// order 
$orderDateTime = date('Y-m-d H:i:s');
$query = "insert into orders(`order_date`,`first_price`,`final_price`,`user_id`) values ('$orderDateTime',{$_SESSION['order_total']},{$_SESSION['order_after_copun']},{$_SESSION['user_id']})";
$runQuery = mysqli_query($conn,$query);
if($runQuery){
    $query = "select order_number from orders where `order_date` = '$orderDateTime'";
    $runQuery = mysqli_query($conn,$query);
    $order_id = mysqli_fetch_assoc($runQuery)['order_number'];
    $_SESSION["order_id"] = $order_id;
    // order details
    foreach($order_products as $product){
        $query = "insert into order_details (`order_number`,`product_number`,`quantity`,`price_each`) values ($order_id,{$product['product_number']},{$product['quantity']},{$product['price']})";
        $runQuery = mysqli_query($conn,$query);
    }
    $_SESSION['success'] = 'order cofirmed';
    foreach($_SESSION['cart'] as $key=>$product){
        if($product['user_id'] == $_SESSION['user_id']){
            unset($_SESSION['cart'][$key]);
        }
    }
    header("location:../handleAfterconfirm.php");
}