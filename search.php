<?php
require_once ('include/header.php');
require_once('loader.php');

$user_id = $_SESSION['user_id'];
$search_value=$_POST["word"];
$it_is_hashtag = 0;


if (\strpos($search_value, '#') !== false) {
    $hashtag_value = ltrim($search_value, '#');
    $it_is_hashtag = 1;
}

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  if($it_is_hashtag == 0 ){
    $sql="SELECT * FROM users WHERE user_name LIKE '%$search_value%'";
    $res=$con->query($sql);
  }
  elseif ($it_is_hashtag == 1) {
    //echo "NICEEEEEEEEEEEEEEEEEE";
    $sql2 = "SELECT * from hashtag LEFT JOIN tweets ON hashtag.tweet_id = tweets.tweet_id LEFT JOIN users ON tweets.tweet_user_id = users.user_id  WHERE hashtag_name LIKE '%$hashtag_value%' ";
    $res2 = $con->query($sql2);

  }
}?>

  <div class="card container search-container">
    <div class="card-header search-result-title">search result for "<?php echo "<span class='user-name'>".$search_value."</span>"; ?>" : </div>
  </div>
    <?php if ($it_is_hashtag == 0) {?>
      <div class="container user-result">
        <div class="card-body search-container">
          <?php
          while($row=$res->fetch_assoc()){
            //echo $row["user_id"];
            echo '<a class="search-username" href="profile.php?id='. $row["user_id"] .'">  '.$row["user_name"] .'</a>';
            echo "</br>";
          }
          ?>
        </div>
  </div>
  <?php } ?>

  <?php if ($it_is_hashtag == 1){
    if(!$res2){echo "There is no result";}
    else{?>


        <div class="col-sm-6 search-result">
          <div class="card card-info">
            <div class="card-body">
              <?php
            while($row2=$res2->fetch_assoc()){
              $tweet_user_id = $row2['tweet_user_id'];


              //*************************show result of hashtag in order*********************************
              $sql3 = "SELECT * from tweets WHERE tweet_user_id IN (SELECT * FROM follow WHERE user_id1 ='$user_id' AND user_id2= '$tweet_user_id') ";
              $res3 = $con -> query($sql3);

              $sql4 = "SELECT * from tweets WHERE tweet_user_id NOT IN (SELECT user_id2 FROM follow WHERE user_id1 ='$user_id' AND user_id2= '$tweet_user_id') ";
              $res4 = $con -> query($sql4);

              $sql5 = "SELECT tweet_id, COUNT(*) as cnt FROM hashtag GROUP BY tweet_id HAVING cnt > 2 ORDER BY cnt";
              $res5 = $con -> query($sql5);

              ?>
              <div class="media">

                <a class="media-left" href="#fake">
                  <div class="user-pic"><i class="fa fa-user"></i></div>
                </a>
                <div class="media-body">
                  <h4 class="media-heading">
                    <?php echo '<a href="profile.php?id='. $row2['user_id'] .'">  '.$row2['user_name'] .'</a>';?>

                  </h4>
                  <p><?php echo $row2['tweet_content'];?></p>
                  <ul class="nav nav-pills nav-pills-custom">
                    <li><a href="comment.php?tid=<?php echo $row2['tweet_id']?>?uid=<?php echo $user_id?>?pid=<?php echo $row2['user_id']?>"><span class="glyphicon glyphicon-comment"></span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                    <li><a href=""><span><?php echo $row2['tweet_date']; ?></span></a></li>
                  </ul>
                </div>

              </div>


            </div>
          </div>
        </div>

      <?php
      }
    }
  }
  ?>


  <?php
require_once('include/footer.php');
  ?>
