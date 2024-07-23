<?php
require_once '../inc/connection.php';

if(isset($_POST['submit'])){
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $address = trim(htmlspecialchars($_POST['address']));
    // validation
    $errors = [];
    if(empty($name)){
        $errors[] = "name is required";
    }elseif(is_numeric($name)){
        $errors[] = "name must be string";
    }
    if(empty($email)){
        $errors[] = "email is required";
    }elseif(! filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = "email must be in email format";
    }
    # password
    if(empty($password)){
        $errors[] = "password is required";
    }elseif(strlen($password) < 6 ){
        $errors[] = "password length must be more than 6";
    }
    $pass_hash = password_hash($password,PASSWORD_DEFAULT);
    
    # address
    if(empty($address)){
        $errors[] = "address is required";
    }elseif(is_numeric($address)){
        $errors[] = "address must be string";
    }

    if(empty($errors)){
    
        $query = "insert into users(`name`,`email`,`password`,`phone`,`address`) values('$name','$email','$pass_hash','$phone','$address')";
        $runQuery = mysqli_query($conn,$query);
        if($runQuery){
            $_SESSION['success'] = "successfull signup";
            header("location:../login.php");
        }else {
            $_SESSION['errors'] = ['error occurred while registering'];
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['address'] = $address;
            header("location:../signup.php");
        }
    }else{
        $_SESSION['errors'] = $errors;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;
        header("location:../signup.php");
    }
}else{
    header("location:../shop.php");
}