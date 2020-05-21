<?php
require_once('loader.php');
require_once ('include/header.php');
?>
    <!-- Form Module -->
    <div class="form-container wow fadeIn" data-wow-delay="0.2s">
    <span class="toggle"><i class="fa fa-exchange" style="font-size:unset !important;"></i></span>
        <div class="form form-register">
            <h2>Change your password</h2>
            <form action="check.php" method="post">
                <?php
                if (isset($error)){
                    echo "<span class='error'>".$error."</span>";
                } ?>
                <input type="hidden" name="change"/>
                <input type="email" name="email" placeholder="Email Address" required/>
                <input type="password" name="psw" placeholder="Old Password" required/>
                <input type="password" name="pass" placeholder="New Password" required/>
                <input type="password" name="conf_pass" placeholder="Confirm New Password" required/>
                <input type="submit" class="button" value="Change Password">
            </form>
        </div>
    </div>
<?php
require_once ('include/footer.php');
