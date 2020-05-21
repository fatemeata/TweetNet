<?php
require_once('loader.php');
require_once ('include/header.php');
?>
<!-- Form Module -->
<div class="form-container wow fadeIn" data-wow-delay="0.2s">
<span class="toggle"><i class="fa fa-times fa-pencil"></i></span>
    <div class="form form-register">
        <h2>Create an account</h2>
        <form action="check.php" method="post" enctype="multipart/form-data">
            <?php
            if (isset($error)){
                echo "<span class='error'>".$error."</span>";
            } ?>
            <div class="form-group">
                <input type="hidden" name="register"/>
                <input class="form-control" type="text" name="username" placeholder="username" required/>
                <input class="form-control" type="email" name="email" placeholder="Email Address" required/>
                <input class="form-control" type="password" name="pass" placeholder="Password" required/>
                <input class="form-control" type="password" name="conf_pass" placeholder="Confirm Password" required/>
                <select class="select select-sm"  name="pquestion" required>
                  <option selected>Answer one of the questions </option>
                  <option value="book">your favorite book? </option>
                  <option value="freind">name of your best freind?</option>
                  <option value="food">your favorite food?</option>
                </select>
                <input class="form-control" type="text" name="panswer" placeholder="answer question here" required/>
            </div>
            <input type="submit" class="button" value="REGISTER">
        </form>
    </div>
</div>
<?php
require_once ('include/footer.php');
