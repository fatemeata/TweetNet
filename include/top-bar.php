<?php
require_once ('loader.php');
require_once ('include/header.php');
?>

    <div class="topbar"><img src="image/error-flat.png" style="width:192px; height:192px;">
        <p class="massage">
            <?php if (isset($success)){
            echo "<span class='success'>".$success."</span>";
            } else if (isset($error)) {
                echo "<span class='success'>".$error."</span>";
            }?>
        </p>
    </div>

<?php
require_once ('include/footer.php');