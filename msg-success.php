<?php
require_once('loader.php');
require_once ('include/header.php');
?>

<div class="topbar"><img src="image/icon-success.png">
    <div class="massage">
        <?php if (isset($success)){
            echo "<span class='success'>".$success."</span>";
        } ?>
    </div>
</div>

<?php
require_once ('include/footer.php');