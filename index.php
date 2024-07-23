<?php require_once 'inc/connection.php' ?>
<?php include 'inc/header.php' ?>
<?php require_once 'inc/lang.php' ?>
<?php include 'inc/navbar.php' ?>

<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
if($lang == "ar"){
    require_once 'inc/arabic.php';
}else require_once 'inc/english.php';
?>




<?php require_once 'inc/errors.php'?>
    <section id="product1" class="section-p1">
        <h2><?php echo $titles['Featured Products'] ?></h2>
        <p>Summer Collection New Modren Desgin</p>

        <?php  
            $limit = 4;
            $query = "select count(product_number) as total from products";
            $runQuery = mysqli_query($conn,$query);
            if(mysqli_num_rows($runQuery) == 1){
                $total = mysqli_fetch_assoc($runQuery)['total'];
                $noOfpages = ceil($total/$limit);
            }
        ?>


        <div class="pro-container">
        
            <?php 
                $page = isset($_GET['page'])? $_GET['page'] : 1;
                if($page > $noOfpages){
                    header("location:{$_SERVER['HTTP_SELF']}?page=$noOfpages");
                }elseif ($page < 1){
                    header("location:{$_SERVER['HTTP_SELF']}?page=1");
                }
                $offset = ($page-1)*$limit;
                $query = "select products.* , categories.name from products join categories 
                on categories.id = products.category_id order by products.product_number ASC limit $limit offset $offset";
                $runQuery = mysqli_query($conn,$query);
                $products = mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
                $_SESSION['products'] = $products;
            ?>

            <?php foreach($products as $product): ?>
            <div class="pro">
            <form method="post" action="handle/addcart.php?id=<?php echo $product['product_number'] ?>">
            <a href="viewproduct.php?id=<?php echo $product['product_number'] ?>"><img src="admin/upload/<?php echo $product['image'] ?>" alt="p1" /></a>
                <div class="des">
                <h6><?php echo $product['name'] ?></h6>
                <h4><?php echo $product['title'] ?></h4>
                    <h5><?php echo substr($product['description'],0,50) . "..."?></h5>
                    <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div>
                    <h4><?php echo $product['price']?></h4>
                    <input type="number" name="quantity" value="1">
                    <button type="submit" class="cart "><i class="fas fa-shopping-cart "></i></button>
                </div>

            </form>
                </div>
                <?php endforeach; ?>
            
            </div>
    </section>
    


    <section id="pagenation" class="section-p1">
    <nav aria-label="Page navigation example" >
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="shop.php?page=<?php echo $page-1 ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#"><?php echo "$page of $noOfpages" ?></a></li>
 
    <li class="page-item">
      <a class="page-link" href="shop.php?page=<?php echo $page+1 ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext ">
            <h4>Sign Up For Newletters</h4>
            <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
        </div>
        <div class="form " >
            <?php if(isset($_SESSION['user_id'])) : ?>
            <form action="signup.php" method="post">
            <input type="text " placeholder="Enter Your E-mail... ">
            <button type="submit" >Sign Up</button>
        </form>
        <?php endif; ?>
        </div>
    </section>


    <?php include 'inc/footer.php' ?>