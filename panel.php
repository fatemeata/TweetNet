<?php
require_once('loader.php');
require_once ('include/header.php');
if(!is_login()){
    header('location: index.php');
}
$user_id = $_SESSION['user_id'];

//echo $user_id;
$user_name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
$_SESSION['profile_uid'] = $user_id;



$tweet_count = getTweetCount($user_id);
$following_count = getFollowingCount($user_id);
$follower_count = getFollowerCount($user_id);

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  /****************** GET 100 top following's tweets based on date **********************/
  $sql="SELECT * FROM tweets LEFT JOIN users ON users.user_id = tweets.tweet_user_id WHERE tweet_user_id IN
   (SELECT user_id2 FROM follow WHERE user_id1='$user_id' ) ORDER BY tweet_date DESC LIMIT 100";
  $res=$con->query($sql);


  $adminres = "SELECT * FROM users WHERE user_id = '$user_id' ";
  $res2=$con->query($adminres);
  while($row2 = $res2 -> fetch_assoc()){
    $mode = $row2['user_mode'];
    //echo $mode;
    if($mode == 1 ){
      $admin = 1;
    }
    elseif($mode == 2){
      $analyzor = 1;
    }
  }

  }

?>

<div class="container">
  <div class="container panel-topheader">
		<div class="navbar-collapse navbar-collapse-1 collapse" aria-expanded="true">
			<div class="navbar-form navbar-left">
        <h1 style="margin:10px;">TweetNet</h1>
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

        <a href="logout.php" class="btn btn-danger" style="margin-top:23px;"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</div>
	</div>
</div>

<div class="container panel-container">
    	<div class="row">
    		<div class="col-sm-3">
    			<div class="card">
    				<div class="card-body">
                <?php echo '<a class="h2" href="profile.php?id='. $user_id .'">  '.$user_name .'</a>';?>

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
    			<div class="card card-info">
    				<div class="card-body">
              <?php
              while($row=$res->fetch_assoc()){
                $_SESSION['profile_uid'] = $row['user_id'];
                $tweet_id = $row['tweet_id'];

                $res2 = con("SELECT * FROM likes WHERE likes_user_id = '$user_id' AND likes_tweet_id = '$tweet_id' ");
                if($res2) { $user_liked_this_post = 1;}
                else {$user_liked_this_post = 0;}

              ?>
    					<div class="media">

    						<a class="media-left" href="#fake">
    							<div class="user-pic"><i class="fa fa-user"></i></div>
    						</a>
    						<div class="media-body">
    							<h4 class="media-heading">
                    <?php echo '<a href="profile.php?id='. $row['user_id'] .'">  '.$row['user_name'] .'</a>';?>

                  </h4>
    							<p><?php echo $row['tweet_content'];?></p>
    							<ul class="nav nav-pills nav-pills-custom">
    								<li><a href="comment.php?tid=<?php echo $row['tweet_id']?>?uid=<?php echo $user_id?>?pid=<?php echo $row['user_id']?>"><span class="glyphicon glyphicon-comment"></span></a></li>
    								<li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                    <li><a href=""><span><?php echo $row['tweet_date']; ?></span></a></li>
                    <li><a href="#">liked by <?php echo $row['tweet_liked'];?> person. </a></li>
    							</ul>
    						</div>
                <!-- <div class="media-right">
                  <form action="check.php" method="post" class="float-right follow-button">
                    <input type="hidden" name="like-tweet" />
                    <input type="hidden" name="id_tweet_id" value="<?php echo $row['tweet_id']?>">
                    <?php if ($user_liked_this_post == 0) {?>
                      <button class="btn btn-danger" data-tid="<?php echo $row['tweet_id']?>"  type="submit" >
                      <span class="like" aria-hidden="true">like </span>
                      </button>
                    <?php } ?>
                    <?php if ($user_liked_this_post == 1 ) {?>
                      <button class="btn btn-success" data-tid="<?php echo $row['tweet_id']?>" type="submit">
                      <span class="like" aria-hidden="true">liked</span>
                      </button>
                    <?php } ?>
                  </form>
                </div> -->
    					</div>
              <hr>
              <?php }?>
            </div>
    			</div>
    		</div>
        <?php if ($admin == 1) {?>
          <div class="col-sm-3">
      			<div class="card ">
      				<div class="card-header">
      					<h3 class="card-title">
      						ADMIN
      					</h3>
      				</div>

      				<div class="card-body">
      					<ul class="list-unstyled">
      						<li><a href="admin.php">hot posts</a></li>
      						<li><a href="admin.php">user follow back their followers</a></li>
      						<li><a href="admin.php">fake users</a></li>
      						<li><a href="admin.php">users have 10 or more posts in more than 3 post </a></li>
      						<li><a href="admin.php">active users </a></li>
      					</ul>
      				</div>
      			</div>
      		</div>
        <?php }?>
    	</div>
    </div>

<?php require_once ('include/footer.php'); ?>
