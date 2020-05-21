<<<<<<< HEAD
<?php
session_start();
require_once('loader.php');
require_once ('include/header.php');

if(!is_login() ){
    header('location: index.php');
}

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  $res = $con->query("SELECT DISTINCT * FROM follow as F1 INNER JOIN follow as F2 ON F1.user_id1 = F2.user_id2 AND F1.user_id2 = F2.user_id1 ");
  while($row=$res->fetch_assoc()){
     $user_id1 = $row['user_id1'];
     $res2 = $con->query("SELECT * FROM follow WHERE user_id1 = '$user_id1'"); //get following of user1
     $res3 = $con->query("SELECT * FROM follow WHERE user_id2 = '$user_id1'"); //get follower of user1
     while($row2=$res2->fetch_assoc()){
       while($row3=$res3->fetch_assoc()){
        if($row2['user_id2'] == $row3['user_id1']) {
          //echo "user_id" .$row2['user_id2'] ."followed user_id" .$row3['user_id1'] ;
        }
       }
     }
   }

      // while($row2=$res2->fetch_assoc()){
      //   echo "intersect of following and follower : " .$row2['user_id1'];
      // }
      // $res3 = $con->query("SELECT F1.user_id2 FROM follow F1 WHERE NOT EXISTS (SELECT F2.user_id1 FROM follow F2 WHERE F2.user_id1 = F1.user_id2)");
      // while($row3=$res3->fetch_assoc()){
      //   echo "intersect of following and follower : " .$row3['user_id2'];
      // }

  // $sql = "SELECT DISTINCT * FROM follow as F1 INNER JOIN follow as F2 ON F1.user_id1 = F2.user_id2 AND F1.user_id2 = F2.user_id1 ";
  //
  // $intersect = array();
  // while($row=$res->fetch_assoc()){
  //   $user_id1 = $row['user_id1'];
  //   $user_id2 = $row['user_id2'];
  //
  // }
  //   // $sql2 = " SELECT * FROM follow as fa WHERE fa.user_id1='$user_id1' INTERSECT (SELECT * FROM follow as f2 WHERE f2.user_id2 ='$user_id1') ";
  //   // $fres = con($sql2);
  //   // foreach($item2 as $fres){
  //   //    echo "**********************user_id is:" .$user_id1;
  //   //    echo "USER_ID2 IS : " .$item2['useR_id2'];
  //   // }
  //   $sql2="SELECT * FROM follow WHERE user_id1='$user_id1'"; //get following of user1
  //   $fsql2 = $con ->query($sql2);
  //   $fresult2 =$fsql2->fetch_assoc();
  //   //print_r($fresult2);
  //   //$following_result = $fres ->fetch_assoc();
  //   echo "**********************user_id is:" .$user_id1;
  //   echo "<br>";
  //   echo "<br>";
  //
  //   while($item=$fsql2->fetch_assoc()){
  //     //echo "---following: " .$item['user_id2'];
  //     //echo "<br>";
  //   }
  //   $fsql3="SELECT * FROM follow WHERE user_id2 ='$user_id1'"; //get follower of user_id1
  //   $follower_result=$con ->query($fsql3);
  //   while($item=$follower_result->fetch_assoc()){
  //     //echo "---follower: " .$item['user_id1'];
  //     //echo "<br>";
  //   }
  //
  //   $fresult3 = $follower_result->fetch_assoc();
  //   echo "<br>";
  //   $containsAllValues = !array_diff($fresult3, $fresult2);
  //   //$containsSearch = count(array_intersect($fresult3, $fresult2)) ;
  //   echo "difeerent :" .$containsAllValues;
  //
  //     echo "<br>";
  //
  // }



  $sql3 = "SELECT count(*) as count FROM tweets INNER join comments ON tweets.tweet_id = comments.comment_tweet_id order by count" ;
  //$sql3 = "SELECT * FROM comments WHERE comment_tweet_id IN (SELECT tweet_id FROM tweets ORDER BY tweet_likes )";
  $res3 = $con->query($sql3);
  while($row3 = $res3 -> fetch_assoc()){
    // echo "********************Tweet_id: ".$row3['tweet_id'];
    // echo "                               Total LIKES:". $row3['total'];
    // echo "<br>";
    // echo "Tweet_liked: ".$row3['tweet_liked'];
    // echo "<br>";
    // echo "comment_likes: ".$row3['comment_likes'];
    // echo "<br>";
  }
  $sql5 = "SELECT *,tweet_liked FROM tweets LEFT JOIN users ON tweets.tweet_user_id = users.user_id GROUP BY tweet_liked having tweet_liked > 3 ";
  $res5 = $con -> query($sql5);
  //$like_count =0;


  // echo "*********************tweet ID : " .$row5['tweet_id'];
  // echo "<br>";
  // $comment_Like = $row5['comment_likes'];
  // $like_count += $comment_Like;
  //   echo "<br>";
  //   echo "tweet_Like : " .$row5['tweet_liked'];
  //   echo "<br>";
  //   echo "LIKE COUNT : " .$like_count;
    //echo "          comment_likes :" . $comment_likes;

  // $sql4 = "SELECT * FROM tweets";
  // $res4 = $con -> query($sql4);
  // foreach($res4 as $row4){
  //   $tweet_id = $row4['tweet_id'];
  //   // echo "*************** Tweet_id: " .$tweet_id;
  //   // echo "                tweet_liked: " .$row4['tweet_liked'];
  //   // echo "<br>";
  //
  //   echo "<br>";
  //
  // }
  // $sql2 = "SELECT * FROM users LEFT JOIN tweets ON users.user_id = tweets.tweet_user_id";
  // $res2 = $con->query($sql2);
  // $user_array = [];
  // while($row2 = $res2 -> fetch_assoc()){
  //   $tweet_user_id = $row2['user_id'];
  //   $begin = $row2['reg_date'];
  //   $end = date('Y-m-d h:i:s');
  //   $during = $end - $begin;
  //   $interval = DateInterval::createFromDateString('1 day');
  //   $period = new DatePeriod($begin, $interval, $end);
  //
  //   foreach ($period as $dt) {
  //       echo $dt->format("l Y-m-d H:i:s\n");
  //       $res3 = con("SELECT * FROM tweets WHERE tweet_user_id='$tweet_user_id' AND tweet_date = '$dt' ");
  //       if(!$res3) echo "this user is not answer";
  //   }
  //   array_push($user_array,$row2['user_id']);
  //
  // }
  // $sql = "SELECT * FROM users ";
  // $res=$con->query($sql);
  // while($row=$res->fetch_assoc()){
  //   $oneperson = $row['user_id'];
  //   echo "oneperson:" .$oneperson;
  //   $sql2 = "SELECT * FROM follow WHERE user_id1 = '$oneperson'";
  //   $res2 = $con->query($sql2); //list of follower
  //   while($row2=$res2->fetch_assoc()){
  //     $user_id2 = $row2['user_id2'];
  //     echo "following user one person is:" .$user_id2 . "  *********  ";
  //     $sql3 = "SELECT * FROM follow WHERE user_id1 = '$user_id2' AND user_id2 = '$oneperson'";
  //     $res3=$con->query($sql3);
  //     while($row3=$res3->fetch_assoc()){
  //       $user_id2 = $row3['user_id2'];
  //       echo "user_id2:" .$user_id2 . "#################";
  //     }
  //   }
  //   echo "<br>";
  //
  // }
}




?>
<div class="col-sm-6 search-result">
  <div class="card card-info">
    <div class="card-body">
      <?php
    while($row5 = $res5 -> fetch_assoc()){
      $tweet_user_id = $row5['tweet_user_id'];?>

      <div class="media">

        <a class="media-left" href="#fake">
          <div class="user-pic"><i class="fa fa-user"></i></div>
        </a>
        <div class="media-body">  
          <h4 class="media-heading">
            <?php echo '<a href="profile.php?id='. $row5['user_id'] .'">  '.$row5['user_name'] .'</a>';?>

          </h4>
          <p><?php echo $row5['tweet_content'];?></p>
          <ul class="nav nav-pills nav-pills-custom">
            <li><a href="comment.php?tid=<?php echo $row5['tweet_id']?>?uid=<?php echo $user_id?>?pid=<?php echo $row5['user_id']?>"><span class="glyphicon glyphicon-comment"></span></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
            <li><a href=""><span><?php echo $row5['tweet_date']; ?></span></a></li>
            <li><a href="#">liked by <?php echo $row5['tweet_liked'];?> person. </a></li>
          </ul>
        </div>

      </div>

    <?php }?>
    </div>
  </div>
</div>
=======
<?php
session_start();
require_once('loader.php');
require_once ('include/header.php');

if(!is_login() ){
    header('location: index.php');
}

$con=new mysqli("localhost","root","","tweetme");
if($con->connect_error){
    echo 'Connection Faild: '.$con->connect_error;
    }
else{
  $res = $con->query("SELECT DISTINCT * FROM follow as F1 INNER JOIN follow as F2 ON F1.user_id1 = F2.user_id2 AND F1.user_id2 = F2.user_id1 ");
  while($row=$res->fetch_assoc()){
     $user_id1 = $row['user_id1'];
     $res2 = $con->query("SELECT * FROM follow WHERE user_id1 = '$user_id1'"); //get following of user1
     $res3 = $con->query("SELECT * FROM follow WHERE user_id2 = '$user_id1'"); //get follower of user1
     while($row2=$res2->fetch_assoc()){
       while($row3=$res3->fetch_assoc()){
        if($row2['user_id2'] == $row3['user_id1']) {
          //echo "user_id" .$row2['user_id2'] ."followed user_id" .$row3['user_id1'] ;
        }
       }
     }
   }

      // while($row2=$res2->fetch_assoc()){
      //   echo "intersect of following and follower : " .$row2['user_id1'];
      // }
      // $res3 = $con->query("SELECT F1.user_id2 FROM follow F1 WHERE NOT EXISTS (SELECT F2.user_id1 FROM follow F2 WHERE F2.user_id1 = F1.user_id2)");
      // while($row3=$res3->fetch_assoc()){
      //   echo "intersect of following and follower : " .$row3['user_id2'];
      // }

  // $sql = "SELECT DISTINCT * FROM follow as F1 INNER JOIN follow as F2 ON F1.user_id1 = F2.user_id2 AND F1.user_id2 = F2.user_id1 ";
  //
  // $intersect = array();
  // while($row=$res->fetch_assoc()){
  //   $user_id1 = $row['user_id1'];
  //   $user_id2 = $row['user_id2'];
  //
  // }
  //   // $sql2 = " SELECT * FROM follow as fa WHERE fa.user_id1='$user_id1' INTERSECT (SELECT * FROM follow as f2 WHERE f2.user_id2 ='$user_id1') ";
  //   // $fres = con($sql2);
  //   // foreach($item2 as $fres){
  //   //    echo "**********************user_id is:" .$user_id1;
  //   //    echo "USER_ID2 IS : " .$item2['useR_id2'];
  //   // }
  //   $sql2="SELECT * FROM follow WHERE user_id1='$user_id1'"; //get following of user1
  //   $fsql2 = $con ->query($sql2);
  //   $fresult2 =$fsql2->fetch_assoc();
  //   //print_r($fresult2);
  //   //$following_result = $fres ->fetch_assoc();
  //   echo "**********************user_id is:" .$user_id1;
  //   echo "<br>";
  //   echo "<br>";
  //
  //   while($item=$fsql2->fetch_assoc()){
  //     //echo "---following: " .$item['user_id2'];
  //     //echo "<br>";
  //   }
  //   $fsql3="SELECT * FROM follow WHERE user_id2 ='$user_id1'"; //get follower of user_id1
  //   $follower_result=$con ->query($fsql3);
  //   while($item=$follower_result->fetch_assoc()){
  //     //echo "---follower: " .$item['user_id1'];
  //     //echo "<br>";
  //   }
  //
  //   $fresult3 = $follower_result->fetch_assoc();
  //   echo "<br>";
  //   $containsAllValues = !array_diff($fresult3, $fresult2);
  //   //$containsSearch = count(array_intersect($fresult3, $fresult2)) ;
  //   echo "difeerent :" .$containsAllValues;
  //
  //     echo "<br>";
  //
  // }



  $sql3 = "SELECT count(*) as count FROM tweets INNER join comments ON tweets.tweet_id = comments.comment_tweet_id order by count" ;
  //$sql3 = "SELECT * FROM comments WHERE comment_tweet_id IN (SELECT tweet_id FROM tweets ORDER BY tweet_likes )";
  $res3 = $con->query($sql3);
  while($row3 = $res3 -> fetch_assoc()){
    // echo "********************Tweet_id: ".$row3['tweet_id'];
    // echo "                               Total LIKES:". $row3['total'];
    // echo "<br>";
    // echo "Tweet_liked: ".$row3['tweet_liked'];
    // echo "<br>";
    // echo "comment_likes: ".$row3['comment_likes'];
    // echo "<br>";
  }
  $sql5 = "SELECT *,tweet_liked FROM tweets LEFT JOIN users ON tweets.tweet_user_id = users.user_id GROUP BY tweet_liked having tweet_liked > 3 ";
  $res5 = $con -> query($sql5);
  //$like_count =0;


  // echo "*********************tweet ID : " .$row5['tweet_id'];
  // echo "<br>";
  // $comment_Like = $row5['comment_likes'];
  // $like_count += $comment_Like;
  //   echo "<br>";
  //   echo "tweet_Like : " .$row5['tweet_liked'];
  //   echo "<br>";
  //   echo "LIKE COUNT : " .$like_count;
    //echo "          comment_likes :" . $comment_likes;

  // $sql4 = "SELECT * FROM tweets";
  // $res4 = $con -> query($sql4);
  // foreach($res4 as $row4){
  //   $tweet_id = $row4['tweet_id'];
  //   // echo "*************** Tweet_id: " .$tweet_id;
  //   // echo "                tweet_liked: " .$row4['tweet_liked'];
  //   // echo "<br>";
  //
  //   echo "<br>";
  //
  // }
  // $sql2 = "SELECT * FROM users LEFT JOIN tweets ON users.user_id = tweets.tweet_user_id";
  // $res2 = $con->query($sql2);
  // $user_array = [];
  // while($row2 = $res2 -> fetch_assoc()){
  //   $tweet_user_id = $row2['user_id'];
  //   $begin = $row2['reg_date'];
  //   $end = date('Y-m-d h:i:s');
  //   $during = $end - $begin;
  //   $interval = DateInterval::createFromDateString('1 day');
  //   $period = new DatePeriod($begin, $interval, $end);
  //
  //   foreach ($period as $dt) {
  //       echo $dt->format("l Y-m-d H:i:s\n");
  //       $res3 = con("SELECT * FROM tweets WHERE tweet_user_id='$tweet_user_id' AND tweet_date = '$dt' ");
  //       if(!$res3) echo "this user is not answer";
  //   }
  //   array_push($user_array,$row2['user_id']);
  //
  // }
  // $sql = "SELECT * FROM users ";
  // $res=$con->query($sql);
  // while($row=$res->fetch_assoc()){
  //   $oneperson = $row['user_id'];
  //   echo "oneperson:" .$oneperson;
  //   $sql2 = "SELECT * FROM follow WHERE user_id1 = '$oneperson'";
  //   $res2 = $con->query($sql2); //list of follower
  //   while($row2=$res2->fetch_assoc()){
  //     $user_id2 = $row2['user_id2'];
  //     echo "following user one person is:" .$user_id2 . "  *********  ";
  //     $sql3 = "SELECT * FROM follow WHERE user_id1 = '$user_id2' AND user_id2 = '$oneperson'";
  //     $res3=$con->query($sql3);
  //     while($row3=$res3->fetch_assoc()){
  //       $user_id2 = $row3['user_id2'];
  //       echo "user_id2:" .$user_id2 . "#################";
  //     }
  //   }
  //   echo "<br>";
  //
  // }
}




?>
<div class="col-sm-6 search-result">
  <div class="card card-info">
    <div class="card-body">
      <?php
    while($row5 = $res5 -> fetch_assoc()){
      $tweet_user_id = $row5['tweet_user_id'];?>

      <div class="media">

        <a class="media-left" href="#fake">
          <div class="user-pic"><i class="fa fa-user"></i></div>
        </a>
        <div class="media-body">  
          <h4 class="media-heading">
            <?php echo '<a href="profile.php?id='. $row5['user_id'] .'">  '.$row5['user_name'] .'</a>';?>

          </h4>
          <p><?php echo $row5['tweet_content'];?></p>
          <ul class="nav nav-pills nav-pills-custom">
            <li><a href="comment.php?tid=<?php echo $row5['tweet_id']?>?uid=<?php echo $user_id?>?pid=<?php echo $row5['user_id']?>"><span class="glyphicon glyphicon-comment"></span></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
            <li><a href=""><span><?php echo $row5['tweet_date']; ?></span></a></li>
            <li><a href="#">liked by <?php echo $row5['tweet_liked'];?> person. </a></li>
          </ul>
        </div>

      </div>

    <?php }?>
    </div>
  </div>
</div>
>>>>>>> 441d60d2021b25c1218bfe83eb7d0b3e48eb2a40
