<?php
require_once('loader.php');
require_once ('include/header.php');
if(!is_login()){
    header('location: index.php');
}

$data = $_GET['cid'];
$data_arr = explode ("?", $data);
$comment_id = $data_arr[0];
//echo $comment_id;
$_SESSION['comment_id'] = $comment_id; //send variable to check.php

$data_arr2 = explode("=", $data_arr[1]);
$comment_uid = $data_arr2[1];
$_SESSION['comment_uid'] = $comment_uid; //send variable to check.php

$login_uid = $_SESSION['user_id'];

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  $sql="SELECT * FROM users WHERE user_id = '$comment_uid'";
  $res=$con->query($sql);
  while($row=$res->fetch_assoc()){
    $cauthor_uname = $row['user_name'];
  }
  $sql2 = "SELECT * FROM replys LEFT JOIN users ON replys.reply_user_id = users.user_id WHERE reply_comment_id = '$comment_id' ORDER BY reply_date DESC";
  $res2= $con->query($sql2);




}

?>


<div class="container add-tweet-container">
  <div class="card">
    <div class="card-header">
      <h3>Replying to <?php echo $cauthor_uname;?><h3>
    </div>
    <div class="card-body">
      <form id="add_tweet_form" method="post" action="check.php" >
          <?php
          if (isset($error)){
              echo "<span class='error'>".$error."</span>";
          } ?>
          <input type="hidden" name="add-reply"  />
          <textarea type="text" id="tweet-msg" class="panel-tweet-content" name="reply-content" placeholder="tweet your reply..." required></textarea>
          <input type="submit" id="tweet-sub" class="btn btn-primary" data-dismiss="modal" value="reply" style="margin-top:10px; float:right;" />
      </form>
    </div>
  </div>


  <div class="col-sm-6" style="margin:20px auto;">
    <?php

    while($row2=$res2->fetch_assoc()){

      $comment_content = $row2['reply_content'];
      $comment_author = $row2['user_name'];

    ?>
    <div class="card card-info">
      <div class="card-body">
        <div class="media">
          <a class="media-left" href="#fake">
            <div class="user-pic"><i class="fa fa-user"></i></div>
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?php echo "<span class='user-name'>".$comment_author."</span>"; ?></h4>
            <p><?php echo "<span class='user-name'>".$comment_content."</span>";?></p>
            <ul class="nav nav-pills nav-pills-custom">
              <li><a href="reply.php?tid=<?php echo $row2['tweet_id']?>?uid=<?php echo $login_uid?>"><span class="glyphicon glyphicon-comment"></span>
              </a></li>
              <li><a href="#"><span class="glyphicon glyphicon-retweet"></span></a></li>
              <li><a href="#" class="tweet-like" data-tuid="<?php echo $user_id; ?>" data-tid="<?php echo $row2['tweet_id']; ?>">
                <span><i class="far fa-thumbs-up">
                    <?php
                        echo $like;
                    ?>
                </i></span>
              </a></li>
              <li><a href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a></li>
              <li><a href=""><span><?php echo $row2['reply_date']; ?></span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
</div>

<?php require_once ('include/footer.php'); ?>
