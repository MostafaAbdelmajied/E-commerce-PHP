<?php
require_once '../inc/connection.php';
if(isset($_POST['submit'])){
    //var_dump($_POST);
    
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['newpassword']));
    $confirmpass = trim(htmlspecialchars($_POST['confirm']));
    $query = "select email from users where email = '$email'";
    $runQuery = mysqli_query($conn,$query);
    if(mysqli_num_rows($runQuery) == 1){
        if(($password == $confirmpass)){ 
            
        
        // validation
        $errors = [];
        if(empty($password)){
            $errors[] = "password is required";
        }elseif(strlen($password) < 6){
            $errors[] = "password shoul be more than 6 charachters";
        }

        if(empty($errors)){
            $pass_hash = password_hash($password,PASSWORD_DEFAULT);
            $query = "update users set password = '$pass_hash' where email = '$email'";
            $runQuery = mysqli_query($conn,$query);
            if($runQuery){
                header("location:../login.php");
            }else{
                $_SESSION['errors'] = ['error occurred'];
                header("location:{$_SERVER['HTTP_REFERER']}");
            }
        }else{
            $_SESSION['errors'] = $errors;
            header("location:{$_SERVER['HTTP_REFERER']}");
        }
    }else{
        $_SESSION['errors'] = ['confirm password not equal password'];
            
            header("location:../forgetPassword.php");
    }
}else{
    $_SESSION['errors'] = ['not found email'];
        $_SESSION['email'] = $email;
        header("location:{$_SERVER['HTTP_REFERER']}");
}
}else{
    header("location:../login.php");
}