<?php require_once 'inc/connection.php' ?>
<?php include 'inc/header.php' ?>
<?php include 'inc/navbar.php' ?>


<?php
if (!isset($_SESSION['user_id'])) {
    
    header("Location: errorpage.php");
    exit(); 
}
?>


<section id="page-header" class="about-header"> 
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <td>Edit</td>
                </tr>
            </thead>

            <tbody>
                <?php 
                if(! isset($_SESSION['cart'])){
                    $_SESSION['errors'] = ['cart empty !'];
                    header("location:shop.php");
                }
                ?>
                <?php foreach($_SESSION['cart'] as $key=>$product) : ?>
                    <?php if($product['user_id'] == $_SESSION['user_id']): ?>
                <tr>
                    <td><img src="admin/upload/<?php echo$product['image'] ?>" alt="product1"></td>
                    <td><h6><?php echo$product['title'] ?></h6></td>
                    <td><h6><?php echo substr($product['description'],0,15) ?></h6></td>
                    <td><h6><?php echo $product['quantity'] ?></h6></td>
                    <td><h6><?php echo $product['price'] ?></h6></td>
                    <td><h6><?php $subtotal = $product['quantity'] * $product['price'] ; echo $subtotal ?></h6></td>
                
                    
                    <td><a href="handle/removefromcart.php?key=<?php echo $key ?>"><button type="submit"  class="btn btn-danger" >Remove</button></a></td>
                    
                    <!-- Remove any cart item  -->
                    <td></td>
                    
                    
                
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
            <!-- confirm order  -->
            <!-- <td><button type="submit" name="" class="btn btn-success">Confirm</button></td> -->
            
        </table>
    </section>

<?php
    $total = 0;
    foreach($_SESSION['cart'] as $key=>$product){
        if($product['user_id'] == $_SESSION['user_id']){
            $total += ($product['quantity'] * $product['price']);
        }
        
        
    }
?>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <form action="handle/coupon.php?subtotal=<?php echo $total ?>" method="post">
            <input type="text" name="coupon" placeholder="Enter coupon code">
            <button type="submit" >Apply</button>
            </form>
            
        <?php require_once 'inc/errors.php' ?>
        <?php require_once 'inc/success.php' ?>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td><?php if(isset($_GET['newsubtotal'])) echo $_GET['newsubtotal']; else echo $total ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong><?php if(isset($_GET['newsubtotal'])) echo $_GET['newsubtotal']; else echo $total ?></strong></td>
                </tr>
            </table>
            <?php 
            $_SESSION['order_total'] = $total ;
            if(isset($_GET['newsubtotal'])){
                $_SESSION['order_after_copun'] = $_GET['newsubtotal'];
            } else{ 
                $_SESSION['order_after_copun'] = $total;
            }
            ?>

            <a href="confirmOrder.php"><button class="normal">proceed to checkout</button></a>
        </div>
    </section>

    <?php include "inc/footer.php" ?>

