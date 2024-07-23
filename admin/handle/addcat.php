<?php 
//var_dump($_POST);

require_once '../inc/connection.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    // validation
    
    if(is_numeric($name)){
        $_SESSION['errors'] = ['not valid name of category'];
    }elseif(strlen($name) > 50){
        $_SESSION['errors'] = ['too long name'];
    }

    if(isset($_SESSION['errors'])){
        $_SESSION['name'] = $name;
        header("location:../view/addCategory.php");
    }
    //check if exist category
    $query = "select name from categories where name = '$name'";
    $runQuery = mysqli_query($conn,$query);
    if(mysqli_num_rows($runQuery) == 1){
        $_SESSION['errors'] = ['category already exist'];
        header("location:../view/addCategory.php");
    }else{
        $query = "insert into categories (`name`) values ('$name')";
        $runQuery = mysqli_query($conn,$query);
        if($runQuery){
            $_SESSION['success'] = "successfull add";
            header("location:../view/addCategory.php");
        }else{
            $_SESSION['errors'] = ['error occurred while adding new category'];
            header("location:../view/addCategory.php");
        }
    }
}else{
    header("location:../view/addCategory.php");
}