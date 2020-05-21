<?php
session_start();
require_once('loader.php');
require_once ('include/header.php');
if(!is_login()){
    header('location: index.php');
}

global $my_tweet_count;
$login_uid = $_SESSION['user_id'];
//echo $login_uid;
$prof_id = $_GET['id'];
//echo $prof_id;
$_SESSION['profile_uid'] = $prof_id;

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  //get username of profile user
  $sql="SELECT * FROM users WHERE user_id = '$prof_id'";
  $res=$con->query($sql);

  while($row=$res->fetch_assoc()){
    $profile_user_name = $row['user_name'];
    echo "</br>";
  }
  // get tweets of profile user
  $sql2 = "SELECT * FROM tweets WHERE tweet_user_id = '$prof_id' ORDER BY tweet_date DESC";
  $res2 = $con->query($sql2);

// count of tweets ,following, follower count
  $tweet_count = getTweetCount($prof_id);
  $following_count = getFollowingCount($prof_id);
  $follower_count = getFollowerCount($prof_id);

// set follow or following btn
  $sql3 = "SELECT * FROM follow WHERE user_id1 ='$login_uid' AND user_id2 ='$prof_id'";
  $res3  = $con->query($sql3);
  while($row3=$res3->fetch_assoc()){
    $loginuser = $row3['user_id1'];
  }

  if($login_uid == $loginuser) { $follow = 1; }
  else{ $follow = 0; }

  $sql4 = "SELECT * FROM block WHERE user_id1 ='$login_uid' AND user_id2 ='$prof_id' UNION  SELECT * FROM block WHERE user_id1 ='$prof_id' AND user_id2 ='$login_uid'";
  $res4 = $con->query($sql4);
  while($row4=$res4->fetch_assoc()){
    $blocking_user = $row4['user_id1'];
    $blocked_user = $row4['user_id2'];
  }

  if( ($login_uid == $blocking_user) || $login_uid == $blocked_user ) { $block = 1; }
  else{ $block = 0; }

}
?>

<div class="container profile-container">
  <div class="container panel-topheader">
		<div class="navbar-collapse navbar-collapse-1 collapse" aria-expanded="true">
			<div class="navbar-form navbar-left">
        <h1 style="margin:10px;">TweetNet</h1>
        <nav class="navbar navbar-expand-sm">
            <ul class="navbar-nav">
              <li class="nav-item">
                <span class="nav-link" href="#">tweets<p><?php echo $tweet_count;?></p></span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="following.php">followings<p><?php echo $following_count;?></p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="follower.php">followers<p><?php echo $follower_count;?></p></a>
              </li>
            </ul>
        </nav>
      </div>
			<div class="navbar-form navbar-right">
				<div class="form-group has-feedback">
          <form action="search.php" method="post">
            <input type="hidden" name="search">
            <input type="text" name="word" class="form-control-nav" id="search" aria-describedby="search1" placeholder="search">
					  <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
          </form>
				</div>

        <button class="btn btn-primary tweet-btn" aria-label="Left Align">
          <a href="add-tweet.php">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Tweet
        </a>
        </button>

			</div>
		</div>
	</div>
</div>

<div class="container panel-container">
    	<div class="row">
    		<div class="col-sm-3">
    			<div class="card">
    				<div class="card-body">
    					<a ><div class="h2 panel-username float-left">
                <?php echo "<span class='user-name'>".$profile_user_name."</span>"; ?>
              </div></a>
              <div class="follow-block float-right">
              <form action="check.php" method="post" class="float-left follow-button ">
                <input type="hidden" name="block-user" />
                <?php if (($login_uid!=$prof_id) && ($block == 0 )) {?>
                  <button class="btn btn-primary"  type="submit" aria-label="Left Align">
                    <span class="block" aria-hidden="true">block </span>
                  </button>
                  <?php }?>
                  <?php if (($login_uid!=$prof_id) && ($block == 1 )) {?>
                    <button class="btn btn-danger"  type="submit" aria-label="Left Align">
                      <span class="blocked" aria-hidden="true">blocked </span>
                    </button>
                  <?php }?>

              </form>
              <form action="check.php" method="post" class="float-right follow-button">
                <input type="hidden" name = "follow-user">
                <?php if (($login_uid!=$prof_id) && ($follow == 0 )) {?>
        				  <button class="btn btn-danger"  type="submit" aria-label="Left Align">
        					<span class="following" aria-hidden="true">follow </span>
        				  </button>
                <?php } ?>
                <?php if (($login_uid!=$prof_id) && ($follow == 1)) {?>
        				  <button class="btn btn-success"  type="submit" aria-label="Left Align">
        					<span class="following" aria-hidden="true">following </span>
        				  </button>
                <?php } ?>
              </form>
            </div>
    				</div>
    			</div>

    			<div class="card ">
    				<div class="card-header">
    					<h3 class="card-title">
    						Trends
    					</h3>
    				</div>

    				<div class="card-body">
    					<ul class="list-unstyled">
    						<li><a href="#">#Cras justo odio</a></li>
    						<li><a href="#">#Dapibus ac facilisis in</a></li>
    						<li><a href="#">#Morbi leo risus</a></li>
    						<li><a href="#">#Porta ac consectetur ac</a></li>
    						<li><a href="#">#Vestibulum at eros</a></li>
    						<li><a href="#">#Vestibulum at eros</a></li>
    						<li><a href="#">#Vestibulum at eros</a></li>
    					</ul>
    				</div>
    			</div>
    		</div>

    		<div class="col-sm-6">
          <?php
          if( $block == 1){?>
            <div class="card card-info">
      				<div class="card-body">
                <h3> This user has no posts yet.</h3>
              </div>
            </div>
           <?php }
          else{
          while($row2=$res2->fetch_assoc()){

            $tweet_content = $row2['tweet_content'];
            $tweet_id = $row2['tweet_id'];

            $likes = get_like($tweet_id);

            $res = con("SELECT * FROM likes WHERE likes_user_id = '$login_uid' AND likes_tweet_id = '$tweet_id' ");
            if($res) { $user_liked_this_post = 1;}
            else {$user_liked_this_post = 0;}

          ?>
    			<div class="card card-info">
    				<div class="card-body">
    					<div class="media">
    						<a class="media-left" href="#fake">
    							<div class="user-pic"><i class="fa fa-user"></i></div>
    						</a>
    						<div class="media-body">
    							<h4 class="h4 media-heading"><?php echo "<span class='user-name'>".$profile_user_name."</span>"; ?></h4>
    							<p><?php echo "<span class='user-name'>".$tweet_content."</span>";?></p>
    							<ul class="nav nav-pills nav-pills-custom">
    								<li><a href="comment.php?tid=<?php echo $row2['tweet_id']?>?uid=<?php echo $login_uid?>?pid=<?php echo $prof_id?>"><span class="glyphicon glyphicon-comment"></span>
                    </a></li>
    								<li><a href="#"><span class="glyphicon glyphicon-retweet"></span></a></li>
    								<li><a href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a></li>
                    <li><a href=""><span><?php echo $row2['tweet_date']; ?></span></a></li>
                    <li><a href="#">liked by <?php echo $likes;?> person. </a></li>
    							</ul>
    						</div>
                <div class="media-right">
                  <form action="check.php" method="post" class="float-right follow-button">
                    <input type="hidden" name="like-tweet" />
                    <input type="hidden" name="id_tweet_id" value="<?php echo $row2['tweet_id']?>">
                    <?php if ($user_liked_this_post == 0) {?>
                      <button class="btn btn-danger" data-tid="<?php echo $row2['tweet_id']?>"  type="submit" >
                      <span class="like" aria-hidden="true">like </span>
                      </button>
                    <?php } ?>
                    <?php if ($user_liked_this_post == 1 ) {?>
                      <button class="btn btn-success" data-tid="<?php echo $row2['tweet_id']?>" type="submit">
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

         }
       }?>
    		</div>



<?php require_once ('include/footer.php'); ?>
