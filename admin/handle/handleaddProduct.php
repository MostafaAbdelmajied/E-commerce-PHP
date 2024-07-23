<?php 
require_once '../inc/connection.php';

if(isset($_POST['addProduct'])){
    //catch and validation
    
    $errors = [];

    $cat = trim(htmlspecialchars($_POST['cat']));
    $query = "select  name from categories where name = '$cat'";
    $runQuery = mysqli_query($conn,$query);
    //var_dump($categories);
    if(is_numeric($cat)){
        $errors[] = "category name wrong";
    }elseif(mysqli_num_rows($runQuery) != 1){
        $errors[] = "not found category";
    }
    $title = trim(htmlspecialchars($_POST['title']));
    if(is_numeric($title)){
        $errors[] = "title must be string";
    }elseif(strlen($title) > 50){
        $errors[] = "very long title";
    }   
    $desc = trim(htmlspecialchars($_POST['desc']));
    if(is_numeric($desc)){
        $errors[] = "description must be string";
    }   
    $price = $_POST['price'];
    if(! is_numeric($price)){
        $errors[] = "price must be number";
    }   
    $quantity = $_POST['quantity']; 
    if(! is_numeric($quantity)){
        $errors[] = "quantity must be number";
    }     
    $img = $_FILES['img'];
    $imgName = $img['name'];
    $imgTmpname = $img['tmp_name'];
    $imgSize = $img['size'] / (1024 * 1024);
    $imgerror = $img['error'];
    $ext = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
    $validextentions = ['png','jpg','jpeg','gif'];
    $imgNewname = uniqid(). ".$ext";
    if ($imgerror != 0){
        $errors[] = "failed to upload image";
    }elseif ($imgSize > 1){
        $errors[] = "image large size";
    }elseif (! in_array($ext,$validextentions)){
        $errors[] = "not valid extention";
    }

    if(empty($errors)){
        $query = "select id from categories where name = '$cat'";
        $runQuery = mysqli_query($conn,$query);
        $cat_id = mysqli_fetch_assoc($runQuery)['id'];
        //var_dump($imgNewname);
        $query = "insert into products(`category_id`,`title`,`description`,`price`,`quantity_avilable`,`image`) values ($cat_id,'$title','$desc',$price,$quantity,'$imgNewname')";
        $runQuery = mysqli_query($conn,$query);
        if($runQuery){
            move_uploaded_file($imgTmpname,"../upload/$imgNewname");
            $_SESSION['success'] = "product added successfully";
            header("location:../view/addProduct.php");
        }

    }else{
        $_SESSION['cat'] = $cat;
        $_SESSION['title'] = $title;
        $_SESSION['desc'] = $desc;
        $_SESSION['price'] = $price;
        $_SESSION['quantity'] = $quantity;
        $_SESSION['errors'] = $errors;
        header("location:../view/addProduct.php");
    }
}else{
    
    header("location:../../login.php");
}