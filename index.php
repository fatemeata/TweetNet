<?php
require_once('loader.php');
require_once ('include/header.php');

if (!is_login()):
?>
<!-- Form Module -->
<div class="form-container wow zoomIn" data-wow-duration="1s">
    <span class="toggle"><i class="fa fa-user"></i></span>
    <div class="form">
        <h2>Login to your account</h2>
        <form action="check.php" method="post">
            <?php
            if (isset($error)){
                echo "<span class='error'>".$error."</span>";
            } ?>
            <input type="hidden" name="login"/>
            <input type="email" name="email" placeholder="Username"/>
            <input type="password" name="pass" placeholder="Password"/>
            <input type="submit" class="button" value="LOGIN">
        </form>
        <p><span class="join">Not a member?</span><a href="register.php" class="join">Register Here</a></p>
        <a href="reset-pass.php" class="join">Forget Password?</a></p>
    </div>
</div>
<?php else:
    $error= "You already login! Please <a href='logout.php'>logout</a> ";
    require_once ('include/top-bar.php');

endif;
require_once ('include/footer.php');
