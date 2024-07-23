<?php
require_once 'inc/connection.php';
include "inc/header.php";
include "inc/navbar.php";
?>

<?php
if (!isset($_SESSION['user_id'])) {
    
    header("Location: errorpage.php");
    exit(); 
}
?>

<?php 
if(! isset($_SESSION['user_id'])){
    header("location:login.php");
}
?>

<?php 
$query = "select * from users where id = {$_SESSION['user_id']}";
$runQuery = mysqli_query($conn,$query);
$user = mysqli_fetch_assoc($runQuery);
?>

<section id="cart-add" class="section-p1">
        <div id="subTotal">
            <h3>Cart totals</h3>
            <form class=" col-4" action="handle/handleconfirm.php" method="post">
                name<input type="text" name="name" value="<?php if(! empty($user['name'])) echo $user['name'] ?>" >
                email <input type="email"  name="email" value="<?php if(! empty($user['email'])) echo $user['email'] ?>">
                address<input type="text" name="address" value="<?php if(! empty($user['address'])) echo $user['address'] ?>" >
                city<input type="text" name="city" value="<?php if(! empty($user['city'])) echo $user['city'] ?>" >
                postalCode<input type="number" name="postal_code" value="<?php if(! empty($user['postal_code'])) echo $user['postal_code'] ?>" >
                phone<input type="text" name="phone" value="<?php if(! empty($user['phone'])) echo $user['phone'] ?>">
                paymentType<select  name="pyment_type">
                <option value="Cash_on_Delivery">Cash on Delivery</option>
                    <option value="Credit_Card">Credit Card</option>
                    <option value="Fawry">Fawry</option>
                </select>
                <button class="normal" type="submit" name="submit">proceed to checkout</button>
            </form>
        
        </div>
    </section>


    <?php include "inc/footer.php" ?>