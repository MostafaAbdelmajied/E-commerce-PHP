<?php
require_once 'connection.php';
if(isset($_SESSION['errors'])){
    foreach($_SESSION['errors'] as $error){
        ?>
        <div class="alert alert-danger"><?php echo $error . "<br>"?></div>
    <?php }
    unset($_SESSION['errors']);

}
