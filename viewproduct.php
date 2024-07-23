<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product page</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/index_style.css">
</head>

<body>

    <!-- Start header -->
    <?php require_once 'inc/connection.php' ?>
    <?php require_once 'inc/header.php' ?>
    <?php require_once 'inc/navbar.php' ?>

    <!-- End header -->

    <?php 
    if(isset($_GET['id'])){
        $query = "select products.* , categories.name from products join categories 
        on categories.id = products.category_id  where product_number = {$_GET['id']}" ;
        $runQuery = mysqli_query($conn,$query);
        $product = mysqli_fetch_assoc($runQuery);

    }else{
        header("location:{$_SERVER['HTTP_REFERER']}");
    }
    ?>
    <section id="prodeteails" class="section-p1">

        <div class="single-pro-img">
            <img src="admin/upload/<?php echo $product['image'] ?>" width="100%" id="mainImg" alt="">
            

        </div>
        <div class="single-pro-details">
            <h6><?php echo $product['name'] ?></h6>
            <h4><?php echo $product['title'] ?></h4>
            <h2><?php echo $product['price'] ?></h2>
            <select>
                <option value="">Select Size</option>
                <option value="">X-Small</option>
                <option value="">Small</option>
                <option value="">larg</option>
                <option value="">X-larg</option>
            </select>
            <form action="handle/addcart.php?id=<?php  echo $product['product_number'] ?>" method="post">
            <input type="number"name="quantity"  id="" value="1">
            <button class="normal" type="submit" name="submit">Add To Cart</button>
            </form>
            <h4>Product Details</h4>
            <span><?php echo $product['description'] ?></span>
        </div>
    </section>

    

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newletters</h4>
            <p>Get E-mail Updates about our latest shop and <span class="text-warning">Special Offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Enter Your E-mail...">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php require_once 'inc/footer.php' ?>
</body>



</html>