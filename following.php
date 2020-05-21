<?php
session_start();
require_once('loader.php');
require_once ('include/header.php');
if(!is_login()){
    header('location: index.php');
}

$prfile_uid = $_SESSION['profile_uid'];
$login_uid = $_SESSION['user_id'];
//$following = getFollowingUser($prfile_uid);


$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  /****************** show profile user's followings **********************/
  $sql="SELECT * FROM follow LEFT JOIN users ON users.user_id = follow.user_id2 WHERE user_id1='$prfile_uid'";
  $res=$con->query($sql);
}

?>

<div class="follow-container">
<div class="card card-info" >
  <div class="card-body">
    <?php while($row=$res->fetch_assoc()){
      $userid2 = $row['user_id'];
      $_SESSION['profile_uid'] = $userid2;
      //check that following of this user followed by login user or not!
      $sql3 = "SELECT * FROM follow WHERE user_id1 ='$login_uid' AND user_id2 ='$userid2'";
      $res3  = $con->query($sql3);
      while($row3=$res3->fetch_assoc()){
        $loginuser = $row3['user_id1'];
      }

      if($login_uid == $loginuser) { $follow = 1; }
      else{ $follow = 0; }

      ?>
    <div class="media">
      <a class="media-left" href="#fake">
        <div class="user-pic"><i class="fa fa-user"></i></div>
      </a>
      <div class="media-body">
        <div class="h5"><?php echo '<a href="profile.php?id='. $row['user_id'] .'">  '.$row['user_name'] .'</a>';?></div>
      </div>

      <a class="media-right float-right">
        <form action="check.php" method="post" class="float-right follow-button">
          <input type="hidden" name="follow-user" />

          <?php if (($login_uid!=$userid2) && ($follow == 0) ) {?>
            <button class="btn btn-danger"  type="submit" aria-label="Left Align">
            <span class="following" aria-hidden="true">follow </span>
            </button>
          <?php } ?>
          <?php if  (($login_uid!=$userid2) && ($follow == 1  ) ) {?>
            <button class="btn btn-success"  type="submit" aria-label="Left Align">
            <span class="following" aria-hidden="true">following </span>
            </button>
          <?php } ?>
        </form>
      </a>

    </div>
<hr>
  <?php } ?>

  </div>
</div>

</div>
