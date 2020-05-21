<?php
session_start();
require_once('loader.php');
// Login Check
if (isset($_POST['login'])) {
    if (isset($_POST["email"]) && isset($_POST["pass"])) {
        $user = trim($_POST["email"]);
        $pass = "4e7b271b4ccdb5cbeb".md5($_POST["pass"]);
    }
    if (!empty($user) && !empty($pass)) {
        $sql = "SELECT user_id, user_name, user_email FROM users WHERE user_email='$user' AND user_password='$pass'";
        $user_array = con($sql);
        if ($user_array) {
            $_SESSION['login']= $user_array;
            $_SESSION['user_id']= $user_array['0'];
            $_SESSION['user_name']= $user_array['1'];
            $_SESSION['user_email']= $user_array['2'];


            $success= "Your user name and password is correct!";
            require_once ('msg-success.php');
            header('refresh: 3; url= panel.php');
            exit;
        } else {
            $error = "User Name Or Password is incorrect! Try Again";
            require_once ('index.php');
            exit;
        }
    } elseif (empty($user) && !empty($pass)) {
        $error= "Please Enter Your Username!";
        require_once('index.php');
        exit;
    } elseif (!empty($user) && empty($pass)) {
        $error= "Please Enter Your Password!";
        require_once('index.php');
        exit;
    }
}

// Register Check
else if (isset($_POST['register'])) {
    $username =  trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $pass1 = $_POST["pass"];
    $pass2 = $_POST["conf_pass"];
    $pquestion = trim($_POST["pquestion"]);
    $panswer = trim($_POST["panswer"]);
    $hash = "4e7b271b4ccdb5cbeb".md5($pass1);
    $reg_date = date("Y-m-d h:i:s");

    $sql = "SELECT * FROM users WHERE user_email = '$email' AND user_name = '$username'";
    $user_array = con($sql);

    if ($user_array) {
    $error= "User already registered!";
    require_once('register.php');
    exit;
    } else {
        //check pass and confirmation pass is same
        if ($pass1 != $pass2) {
            $error = "Passwords didn't matched!";
            require_once('register.php');
            exit;
        }
        //check password length and its type
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8}$/', $pass1)) {
          $error = "the password must contain at least 8 characters and combination of number and character";
          require_once('register.php');
          exit;
        }
        $result = $temp->insert('users',array('user_name'=>$username,
            'user_password'=>$hash,
            'user_email'=>$email,
            'user_pquestion' => $pquestion,
            'user_panswer' => $panswer,
            'user_regdate' => $reg_date
        ));
      //  insert("INSERT INTO users (user_name, user_password, user_email, user_regdate, user_picture, user_lastseen) VALUES ('$fullname', '$hash', '$email', '$now_status', '$file', '$now_status')");
        $success = 'registration successfully!';
        require_once('msg-success.php');
        header('refresh:2; url= index.php');
        exit;
    }
}

//Reset Password
else if (isset($_POST['resetPass'])) {
    $email= $_POST["email"];
    $new_pass= $_POST["pass"];
    $conf_pass= $_POST["conf_pass"];
    $hash = "4e7b271b4ccdb5cbeb".md5($new_pass);
    $pquestion = $_POST["pquestion"];
    $panswer = $_POST["panswer"];
    //update database
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $user_array = con($sql);

    $sql2 = "SELECT * FROM users WHERE user_email = '$email' AND user_pquestion = '$pquestion' AND user_panswer = '$panswer'  ";
    $user_array2 = con($sql2);

    //check if user has registerd and answer is true.
    if ($user_array && $user_array2) {
        $sql = ("UPDATE users SET user_password='$hash' WHERE user_email = '$email'");
        insert($sql);
        $success= "Your password change successfully!";
        require_once ('msg-success.php');
        header('refresh:2; url= index.php');
        exit;
    }
    else if ($new_pass != $conf_pass) {
        $error= "Passwords didn't matched!";
        require_once('change-pass.php');
        exit;
    }
    //check user has registered
    else if (!$user_array) {
      $error= "User not found!";
      require_once('change-pass.php');
      exit;
    }
    //check answer accuracy
    else if (!$user_array2) {
      $error= "The Answer is Wrong! Try Again.";
      require_once('change-pass.php');
      exit;
    }
}


//add-tweet
else if (isset($_POST['add-tweet'])) {
  $tweet_content = $_POST["tweet-content"];
  $tweet_date = date("Y-m-d h:i:s");
  $hashtag_content = $_POST['tweet-hashtag'];
  $sql = "SELECT * FROM tweet WHERE tweet_content= '$tweet_content'";
  $tweet_array = con($sql);

  //check if tweet_content is repeated
  if ($tweet_array) {
    $success= "Your post has already been published before!";
    require_once ('msg-success.php');
    header('refresh:2; url= panel.php');
    exit;
  }
  else {
    $tweet_userid = $_SESSION['user_id'];
    $data = gethashtags($tweet_content);
    $data_arr = explode (",", $data);
    $count =count($data_arr);
    if ($count > 1){ //check tweet has 2 hashtag
      insert("INSERT INTO tweets (tweet_content,tweet_date,tweet_user_id) VALUES ('$tweet_content','$tweet_date','$tweet_userid')");
      $last_id = mysqli_insert_id($con);
      set_hashtag($tweet_content,$last_id);
      $success= "Your tweet published successfully!";
      require_once ('msg-success.php');
      header('refresh:2; url= panel.php');
      exit;

      }

    else{
      $success= "Your tweet should have at least 2 hashtag!!!";
      require_once ('msg-success.php');
      header('refresh:2; url= panel.php');
      exit;
    }
    //insert("INSERT INTO tweets (tweet_content,tweet_date,tweet_hashtag,tweet_user_id) VALUES ('$tweet_content','$tweet_date','$data','$tweet_userid')");
  }
}
//add-comment
else if (isset($_POST['add-comment'])) {

  $comment_content = $_POST["comment-content"];
  $login_uid = $_SESSION['user_id'];
  //$profile_uid = $_POST['profile_uid'];
  $tweet_id = $_SESSION['tweet_id'];
  $comment_date = date("Y-m-d h:i:s");
    //$res = con("SELECT * FROM tweets WHERE tweet_id ='$tweet_id'");

    $profile_uid = $_SESSION['profile_uid'];
    //insert("INSERT INTO comments (comment_content,comment_date,comment_tweet_id,comment_user_id) VALUES ('$comment_content','$comment_date','$tweet_id','$login_uid')");
    $result = con ("INSERT INTO comments (comment_content,comment_date,comment_tweet_id,comment_user_id) VALUES ('$comment_content','$comment_date','$tweet_id','$login_uid')");
    $success= "Your comment published successfully!";
    require_once ('msg-success.php');
    //header('refresh:2; url= panel.php');
    header('Location: profile.php?id='.$profile_uid);
    //header('Location:panel.php?id=$profile_uid');
    exit;

}
//add-reply to a comment
else if (isset($_POST['add-reply'])) {

  $reply_content = $_POST["reply-content"];
  $login_uid = $_SESSION['user_id'];
  //$profile_uid = $_POST['profile_uid'];
  $comment_id = $_SESSION['comment_id'] ;
  $reply_date = date("Y-m-d h:i:s");
    //$res = con("SELECT * FROM tweets WHERE tweet_id ='$tweet_id'");

    $profile_uid = $_SESSION['profile_uid'];
    //insert("INSERT INTO comments (comment_content,comment_date,comment_tweet_id,comment_user_id) VALUES ('$comment_content','$comment_date','$tweet_id','$login_uid')");
    $result = con ("INSERT INTO replys (reply_content,reply_date,reply_comment_id,reply_user_id) VALUES ('$reply_content','$reply_date','$comment_id','$login_uid')");

    $success= "Your reply published successfully!";
    require_once ('msg-success.php');
    //header('refresh:2; url= panel.php');
    header('Location: profile.php?id='.$profile_uid);
    //header('Location:panel.php?id=$profile_uid');
    exit;

}
//fllow user
else if (isset($_POST['follow-user'])) {
  $profile_uid = $_SESSION['profile_uid'];
  $login_uid = $_SESSION['user_id'];
  $res = con("SELECT * FROM follow WHERE user_id1 = '$login_uid' AND user_id2='$profile_uid' ");

  if (empty($res)){
    $result = con ("INSERT INTO follow (user_id1,user_id2,action_user_id) VALUES ('$login_uid','$profile_uid','$login_uid')");
    $success= "You followed successfully!";
    require_once ('msg-success.php');
    header('Location: profile.php?id='.$profile_uid);
  }
  elseif ($profile_uid == $login_uid) {
    echo "you can't follow yourself! :)";
  }
  else{
    echo "followed before!";
  }
}
//Block user
else if (isset($_POST['block-user'])) {
  $profile_uid = $_SESSION['profile_uid'];
  $login_uid = $_SESSION['user_id'];
  $res = con("SELECT * FROM block WHERE user_id1 = '$login_uid' AND user_id2='$profile_uid' ");

  if (empty($res)){
    $result = con ("INSERT INTO block (user_id1,user_id2) VALUES ('$login_uid','$profile_uid')");
    $result2 = con("SELECT * FROM follow WHERE user_id1 = '$login_uid' AND user_id2='$profile_uid'");
      if($result2){
        $result3 = con("DELETE FROM follow WHERE  user_id1 ='$login_uid' AND user_id2='$profile_uid'");
      }
    $result4 =con("SELECT * FROM follow WHERE user_id2 = '$login_uid' AND user_id1='$profile_uid'");
    if($result4){
      $result5 = con("DELETE FROM follow WHERE  user_id2 = '$login_uid' AND user_id1='$profile_uid'");
    }
    $success= "You blocked successfully!";
    require_once ('msg-success.php');
    header('Location: profile.php?id='.$profile_uid);
  }
  elseif ($profile_uid == $login_uid) {
    echo "you can't block yourself! :)";
  }
  else{
    echo "blocked before!";
  }
}
//like tweet
else if (isset($_POST['like-tweet'])) {
  $tweet_id  = $_POST['id_tweet_id'];
  //echo $tweet_id;
  $login_uid = $_SESSION['user_id'];
  $profile_uid = $_SESSION['profile_uid'];
  $result = con("SELECT * FROM likes WHERE likes_tweet_id = '$tweet_id' AND likes_user_id = '$login_uid' ");
  if(!$result){
    $like_tweet = get_like($tweet_id);
    $like_tweet++;
    update("UPDATE tweets SET tweet_liked = $like_tweet WHERE tweet_id = '$tweet_id'");
    $result = con("INSERT INTO likes (likes_tweet_id, likes_user_id) VALUES ('$tweet_id', '$login_uid')");
    $success= "You liked tweet successfully!";
    require_once ('msg-success.php');
    header('Location: profile.php?id='.$profile_uid);
  }
  else{
    echo "you liked this tweet before!";
  }
}

//like comments
else if (isset($_POST['like-comment'])) {
  $comment_id  = $_POST['comment-id'];
  $comment_authuid = $_POST['comment-authid'];
  //echo $comment_id;
  $login_uid = $_SESSION['user_id'];
  $profile_uid = $_SESSION['profile_uid'];


  /////////////////////////////check this profile user doesnt block this user
  $res2 = con("SELECT * FROM block WHERE user_id1 ='$comment_authid' AND user_id2 = '$login_uid'");
  if($res2){
    echo "you are BLOCK by THIS USER";
  }
  else{
  $result = con("SELECT * FROM comment_likes WHERE comment_id = '$comment_id' AND user_liked_id = '$login_uid' ");
  if(!$result){
    if($login_uid == $comment_authuid){
      echo "you can't like your comment!";
    }
    else{
    $like_comment = get_comment_like($comment_id);
    //echo "like_comment:" .$like_comment;
    $like_comment++;
    update("UPDATE comments SET comment_likes = $like_comment WHERE comment_id = '$comment_id'");
    $result = insert("INSERT INTO comment_likes (comment_id, user_liked_id) VALUES ('$comment_id', '$login_uid')");
    $success= "You liked this comment successfully!";
    require_once ('msg-success.php');
    header('Location: profile.php?id='.$profile_uid);
     }
  }
  else{
    echo "you liked this comment before!";
  }
}
}
