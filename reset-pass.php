<?php
require_once('loader.php');
require_once ('include/header.php');
?>
    <!-- Form Module -->
    <div class="form-container  wow fadeIn" data-wow-delay="0.2s">
    <span class="toggle"><i class="fa fa-exchange" style="font-size:unset !important;"></i></span>
        <div class="form form-register">
            <h2>Change your password</h2>
            <form action="check.php" method="post">
                <?php
                if (isset($error)){
                    echo "<span class='error'>".$error."</span>";
                } ?>
                <input type="hidden" name="resetPass"/>
                <input type="email" name="email" placeholder="Email Address" required/>
                <input type="password" name="pass" placeholder="Enter new password" required/>
                <input type="password" name="conf_pass" placeholder="Confirm New Password" required/>
                <label>Select the question you've answered when register:</label>
                <select class="select select-sm"  name="pquestion" required>
                  <option selected value="book">your favorite book? </option>
                  <option value="freind">name of your best freind?</option>
                  <option value="food">your favorite food?</option>
                </select>
                <input class="form-control" type="text" name="panswer" placeholder="answer question here" required/>
                <input type="submit" class="button" value="Reset Password">
            </form>
            <span style="margin-left:25%; font-size:15px; "><a href="index.php">Back to login page</span>
        </div>
    </div>
<?php
require_once ('include/footer.php');
