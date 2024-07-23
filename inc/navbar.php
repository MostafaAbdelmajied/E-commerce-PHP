<?php 
require_once 'connection.php' ;
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
if($lang == "ar"){
    require_once 'inc/arabic.php';
}else require_once 'inc/english.php';
?>

<section id="header">
<a href="shop.php">
    <img src="img/logo.png" alt="homeLogo">
</a>



<div>
    <ul id="navbar">
        <li class="link">
            <a class="active " href="index.html"></a>
        </li>
        <li class="link">
            <a href="shop.php"></a>
        </li>
        <li class="link">
            <a href="blog.html">Blog</a>
        </li>
        <li class="link">
            <a href="about.html">About</a>
        </li>
        <li class="link">
            <a href="contact.html">Contact</a>
        </li>
        <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="link">
            <a href="logout.php"><?php  echo $titles['Logout'] ?></a>
        </li>
        <?php else : ?>
        <li class="link">
            <a href="signup.php"><?php echo $titles['Signup'] ?></a>
        </li>

        <li class="link">
            <a href="login.php"><?php echo $titles['Login'] ?></a>
        </li>
        <?php endif; ?>
        <?php if($lang == 'ar'): ?>
        <li class="link">
            <a href="inc/changelang.php?lang=en">English</a>
        </li>
        <?php else : ?>
        <li class="link">
            <a href="inc/changelang.php?lang=ar">العربية</a>
        </li>
        <?php endif; ?>

    


        <li class="link">
            <a id="lg-cart" href="cart.php">
                <i class="fas fa-shopping-cart"></i> 
            </a>
        </li>
        <li><h5><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name'] ?></h5></li>
        <a href="#" id="close"><i class="fas fa-times"></i> </a>
    </ul>

</div>

<div id="mobile">
    <a href="cart.html">
        <i class="fas fa-shopping-cart"></i>
    </a>
    <a href="#" id="bar"> <i class="fas fa-outdent"></i> </a>
</div>
</section>