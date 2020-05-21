<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

require_once ('loader.php');

// Connect to database
global $con;
$con = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);

/*global $date;
$date = Date::getInstance();*/

global $con_db;
$con_db = Database::getInstance();

// Time zone
date_default_timezone_set("Asia/Tehran");

function dump($var) {
    if (is_array($var)) {
        echo "<pre>";
        print_r($var);
        echo "<pre>";
    }
    else if (is_object($var)) {
        var_export($var);
    }
    else {
        echo $var;
    }
}

function con ($sql) {
    global $con;
    $result = mysqli_query ($con, $sql);
    $row = mysqli_fetch_row($result);
    return $row;
}

function insert ($sql) {
    global $con;
    $result = mysqli_query ($con, $sql);
    return $result;
}

function is_login() {
    if(isset($_SESSION['login'])){
        return true;
    }
    return false;
}

function contact($sql){
    global $con;
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_all($result);
    return $row;
}

function dic($sql) {
    global $con;
    mysqli_set_charset($con, "utf8");
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_all($result);
    return $row;
}

function update($sql) {
    global $con;
    $result = mysqli_query ($con, $sql);
    return $result;
}

function get_like($tweet_id) {
    if (intval($tweet_id)) {
        $like = con("SELECT tweet_liked FROM tweets WHERE tweet_id = '$tweet_id'");
        return $like['0'];
    }
    else {
        return 0;
    }
}
function get_comment_like($comment_id) {
    if (intval($comment_id)) {
        $like = con("SELECT comment_likes FROM comments WHERE comment_id = '$comment_id'");
        return $like['0'];
    }
    else {
        return 0;
    }
}


function set_like($tweet_id,$tweet_userliked) {
    if (intval($tweet_id)) {
      if(intval($tweet_userliked)){
        $like_tweet = get_like($tweet_id);
        $like_tweet++;
        update("UPDATE tweets SET tweet_liked = $like_tweet WHERE tweet_id = '$tweet_id'");
        $result = con("INSERT INTO likes (likes_tweet_id, likes_user_id) VALUES ('$tweet_id', '$tweet_userliked')");
        return intval($like_tweet);
      }

    }
    else {
        return 0;
    }
}

function set_comment_like($comment_id,$comment_userliked) {
    if(intval($comment_id)) {
      if(intval($comemnt_userliked)){
        $like_comment = get_comment_like($comment_id);
        $like_comment++;
        update("UPDATE comments SET comment_likes = $like_comment WHERE comment_id = '$comment_id'");
        $result = con("INSERT INTO commentlike (comment_id, user_liked_id) VALUES ('$comment_id', '$comment_userliked')");
        return intval($like_comment);
      }

    }
    else {
        return 0;
    }
}
function getTweetCount($user_id){
  $sql3 = "SELECT count(*) as count FROM tweets WHERE tweet_user_id = '$user_id'";
  $res3 = con($sql3);
  if(!$res3){
    $tweet_count = 0;
  }
  else{
    foreach($res3 as $item){
      $tweet_count = $item['count'];
    }
  }
  return $tweet_count;
}
function getFollowingCount($user_id){
    $fcount = "SELECT count(*) as count FROM follow WHERE action_user_id = '$user_id'";
    $fresult = con($fcount);
    if(!$fresult){
      $following_count = 0;
    }
    else{
      foreach($fresult as $item){
        $following_count= $item['count'];
      }
    }
    return $following_count;
  }
function getFollowerCount($user_id){
  $fcount2 = "SELECT count(*) as count FROM follow WHERE follow.user_id2 = '$user_id'";
  $fresult2 = con($fcount2);
  if(!$fresult2){
    $follower_count = 0;
  }
  else{
    foreach($fresult2 as $item){
      $follower_count= $item['count'];
    }
  }
  return $follower_count;
}
function getFollowingUser($user_id){
  //$sql = "SELECT FROM follow WHERE user_id1 = '$user_id'";
  $sql="SELECT * FROM follow LEFT JOIN users ON users.user_id = follow.user_id2 WHERE user_id2 IN
  (SELECT user_id2 FROM follow WHERE user_id1='$user_id' )";
  $res=$con ->query($sql);
  return $res;
}

// Function to create read more link of a content with link to full page
function readMore($content, $limit, $note_id) {
    $content = substr($content,0,$limit);
    $content = substr($content,0,strrpos($content,' '));
    $content = $content." <a href='' class='read-more' data-nid='$note_id'>Read More...</a>";
    return $content;
}

// Base Url
function base_url() {
    global $config;
    return $config['base_url'];
}

//get hashtag
function gethashtags($text)
{
  //Match the hashtags
  preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
  $hashtag = '';
  // For each hashtag, strip all characters but alpha numeric
  if(!empty($matchedHashtags[0])) {
      foreach($matchedHashtags[0] as $match) {
          $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
      }
  }
    //to remove last comma in a string
    return trim($hashtag, ',');
}

//convert hashtags into clickable links.
function convert_clickable_links($message)
{
    $parsedMessage = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="">@$2</a>', '$1<a href="index.php?hashtag=$2">#$2</a>'), $message);
    return $parsedMessage;
}
function follow(){
  $profile_uid = $_SESSION['profile_uid'];
  $current_uid = $_SESSION['user_id'];
  $result = con ("INSERT INTO follow (user_id1,user_id2,action_user_id) VALUES ('$current_uid','$profile_uid','$current_uid')");
  $success= "You followed published successfully!";
  require_once ('msg-success.php');
  header('refresh:2; url= profile.php');
}
function set_hashtag($tweet_content, $last_id){
  $data = gethashtags($tweet_content);
  $data_arr = explode (",", $data);
  foreach ($data_arr as $item) {
      $result = insert ("INSERT INTO hashtag (hashtag_name, tweet_id) VALUES ('$item', '$last_id')");
    }
}
