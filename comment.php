<?php
require_once('loader.php');
require_once ('include/header.php');
if(!is_login()){
    header('location: index.php');
}


$data = $_GET['tid'];
$data_arr = explode ("?", $data);
$tweet_id = $data_arr[0];
$_SESSION['tweet_id'] = $tweet_id;

//print_r($data_arr);
$data_arr2 = explode("=", $data_arr[1]);
$user_id = $data_arr2[1];
//print_r($data_arr2);
$_SESSION['login_uid'] = $user_id;
$data_arr3 = explode("=", $data_arr[2]);;
//print_r($data_arr3);
$profile_uid = $data_arr3[1]; //// person that tweeted!

$login_uid = $_SESSION['user_id']; //person who login to site!

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{

  $sql="SELECT * FROM users WHERE user_id = '$profile_uid'";
  $res=$con->query($sql);

  while($row=$res->fetch_assoc()){
    $profile_uname = $row['user_name'];
  }
  $sql2 = "SELECT * FROM comments LEFT JOIN users ON comments.comment_user_id = users.user_id WHERE comment_tweet_id = '$tweet_id' ORDER BY comment_date DESC";
  $res2= $con->query($sql2);


}

?>


<div class="container add-tweet-container">
  <div class="card">
    <div class="card-header">
      <h3>Comment to <?php echo $profile_uname;?><h3>
    </div>
    <div class="card-body">
      <form id="add_tweet_form" method="post" action="check.php" >
          <?php
          if (isset($error)){
              echo "<span class='error'>".$error."</span>";
          } ?>
          <input type="hidden" name="add-comment"  />
          <textarea type="text" id="tweet-msg" class="panel-tweet-content" name="comment-content" placeholder="tweet your comment..." required></textarea>
          <input type="submit" id="tweet-sub" data-tid="<?php echo $tweet_id?>" data-loginuser="<?php echo $logged_in_user_id?>" class="btn btn-primary" data-dismiss="modal" value="reply" style="margin-top:10px; float:right;" />
      </form>
    </div>
  </div>


  <div class="col-sm-6" style="margin:20px auto;">
    <?php

    while($row2=$res2->fetch_assoc()){

      $comment_content = $row2['comment_content'];
      $comment_author = $row2['user_name'];
      $comment_authid = $row2['user_id'];
      $comment_id = $row2['comment_id'];
      //echo $comment_id;
      $likes = get_comment_like($comment_id);
      //check this person liked this comment or not!
      $res = con("SELECT * FROM comment_likes WHERE user_liked_id = '$login_uid' AND comment_id = '$comment_id' ");
      if($res) { $user_liked_this_comment = 1;}
      else {$user_liked_this_comment = 0;}




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
              <li><a href="reply.php?cid=<?php echo $row2['comment_id']?>?cuid=<?php echo $row2['comment_user_id']?>"><span class="glyphicon glyphicon-comment"></span></a></li>
              <li><a ><span><?php echo $row2['comment_date']; ?></span></a></li>
              <li><a href="#">liked by <?php echo $likes;?> person. </a></li>
            </ul>
          </div>
          <div class="media-right">
            <form action="check.php" method="post" class="float-right follow-button">
              <input type="hidden" name="like-comment" />
              <input type="hidden" name="comment-id" value="<?php echo $row2['comment_id']?>" />
              <input type="hidden" name="comment-authid" value="<?php echo $comment_authid?>">
              <?php if ($user_liked_this_comment == 0) {?>
                <button class="btn btn-danger" data-tid="<?php echo $row2['comment_id']?>"  type="submit" >
                <span class="like" aria-hidden="true">like </span>
                </button>
              <?php } ?>
              <?php if ($user_liked_this_comment == 1 ) {?>
                <button class="btn btn-success" data-tid="<?php echo $row2['comment_id']?>" type="submit">
                <span class="like" aria-hidden="true">liked</span>
                </button>
              <?php } ?>
            </form>
            <?php if(!isset($_SESSION['tweet_id'])) {
              $_SESSION['tweet_id'] = array();
            }?>
          </div>
        </div>
      </div>
    </div>
    <?php

   }?>

  </div>
</div>

<?php
require_once ('include/footer.php'); ?>
