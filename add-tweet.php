<?php
require_once('loader.php');
require_once ('include/header.php');
if(!is_login()){
    header('location: index.php');
}


$user_id = $_SESSION['user_id'];

?>


<div class="container add-tweet-container">
  <div class="card">
    <div class="card-header">
      <h3>Compose New Tweet<h3>
    </div>
    <div class="card-body">
      <form id="add_tweet_form" method="post" action="check.php">
          <?php
          if (isset($error)){
              echo "<span class='error'>".$error."</span>";
          } ?>
          <input type="hidden" name="add-tweet"  />
          <textarea type="text" id="tweet-msg" class="panel-tweet-content" name="tweet-content" placeholder="what's up?" required></textarea>
          <!-- <input type="text" name="tweet-hashtag" placeholder="insert at least 2 hashtag" class="hashtag-input" style=""/> -->
          <input type="submit" id="tweet-sub"  class="btn btn-primary" data-dismiss="modal" value="tweet" style="margin-top:10px; float:right;" />
      </form>
    </div>
  </div>
</div>

<?php require_once ('include/footer.php'); ?>
