<?php
require_once '../inc/connection.php';
//var_dump($_POST);
if(! isset($_POST['submit'])){
    header("location:../login.php");
}

$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));

$query = "select id, name ,email , password ,role from users where email = '$email'";
$runQuery = mysqli_query($conn,$query);
if(mysqli_num_rows($runQuery) == 1){
    $user = mysqli_fetch_assoc($runQuery);
    $verify = password_verify($password,$user['password']);
    //var_dump($verify);
    if($verify){
        
        if(isset($_POST['remember'])){
            
            setcookie("email",$email,time()+86400*15,'/');
            setcookie("password",$password,time()+86400*15,'/');
            
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        if($user['role'] == 'admin'){
            header("location:../admin/index.html");
        }else{
        header("location:../shop.php");
        }
    }else{
        $_SESSION['errors'] = ['not correct password'];
        $_SESSION['email'] = $email;
        header("location:../login.php");
    }
}else{
    $_SESSION['errors'] = ['not correct email or password'];
    $_SESSION['email'] = $email;
    //var_dump($_SESSION['errors']);
    header("location:../login.php");
}