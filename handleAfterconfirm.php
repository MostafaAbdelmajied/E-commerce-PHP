<?php require_once 'inc/header.php' ?>
<?php require_once 'inc/navbar.php' ?>
<?php require_once 'inc/success.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
    
    header("Location: errorpage.php");
    exit(); 
}
?>
<a href="handle/receiptpdf.php" target="_blank"><button class="normal" type="submit" name="submit">Receipt </button></a>
<a href="shop.php"><button class="normal" type="submit" name="submit">back to home</button></a>