<?php 
require_once '../inc/connection.php';
if(isset($_GET['subtotal'])){
    //var_dump($_GET['subtotal']);

    if(! empty($_POST['coupon'])){
        $coupon = $_POST['coupon'];
    $query = "select * from coupon where name = '$coupon'";
    $runQuery = mysqli_query($conn,$query);
    if(mysqli_num_rows($runQuery) == 1){
        $coupon_data = mysqli_fetch_assoc($runQuery);
        
        $percent = $coupon_data['percent'];
        $newsubtotal =  floatval($_GET['subtotal']) - (floatval($_GET['subtotal']) * floatval(($percent/100)));
        
        $_SESSION['success'] = "coupon applied successfully";
        //echo $newsubtotal;
        header("location:{$_SERVER['HTTP_REFERER']}?newsubtotal=$newsubtotal");
    }else{
        $_SESSION['errors'] = ["not correct coupon"];
        header("location:../cart.php");
    }
    }else{
        $newsubtotal = $_GET['subtotal'];
        // echo $newsubtotal;
        header("location:{$_SERVER['HTTP_REFERER']}?newsubtotal=$newsubtotal");
    }
}else{
    header("location:../cart.php");
}