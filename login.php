<?php
require_once 'inc/connection.php';
include "inc/header.php";
include "inc/navbar.php";
?>
<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
if($lang == "ar"){
    require_once 'inc/arabic.php';
}else require_once 'inc/english.php';
?>

            
              <div class="card-body px-5 py-5" style="background-color:darkgray;">
              <?php require_once 'inc/success.php' ?>
              <?php //var_dump($_COOKIE) ?>
                <h3 class="card-title text-left mb-3"><?php echo $titles['Login'] ?></h3>
                <form action="handle/handlelogin.php" method="post">
                  <div class="form-group">
                    <label><?php echo $titles['email *'] ?></label>
                    <?php if(isset($_SESSION['email'])): ?>
                    <input type="email" name="email" class="form-control p_input" value="<?php echo ($_SESSION['email']) ; unset($_SESSION['email'] ) ?>" >
                    <?php elseif(! empty($_COOKIE['email'])): ?>
                    <input type="email" name="email" class="form-control p_input" value="<?php echo ($_COOKIE['email']) ?>" >
                    <?php else : ?>
                      <input type="email" name="email" class="form-control p_input"  >
                      <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label><?php echo $titles['Password *'] ?></label>
                    <input type="password" name="password" class="form-control p_input" value="<?php if(! empty($_COOKIE['password'])) echo $_COOKIE['password'] ?>" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="remember" class="form-check-input"> <?php echo $titles['Remember me'] ?> </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass"><?php echo $titles['Forgot password'] ?></a>
                  </div>
                  <?php require_once 'inc/errors.php' ?>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn"><?php echo $titles['Login'] ?></button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> <?php echo $titles['Sign Up'] ?></a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "inc/footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session