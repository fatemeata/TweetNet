<?php
require_once('loader.php');

if (isset($_POST['type'])) {
    switch ($_POST['type']) {
        case 'delete-contact':
            $contact_id = $_POST['id'];
            $result ['status'] = false;
            $result ['status'] = insert("DELETE FROM fb_contact WHERE contact_id= '$contact_id'");
            echo json_encode($result);
            break;
        case 'like-tweet':
                $tweet_id = intval($_POST['tweet_id']);
                $tweet_userliked = intval($_POST['tweet_userliked']);
                if ($tweet_id) {
                  if($tweet_userliked ){
                    $likes = set_like($tweet_id, $tweet_userliked);
                    if ($likes) {
                        $result = array(
                            'status'=>true,
                            'count'=>$likes
                        );
                        setcookie('tweet-'.$tweet_id, '1', time() + 86400, '/');
                    }
                    else {
                        $result = array(
                            'status'   =>  false,
                            'count' =>  '0'
                        );
                    }
                    echo json_encode($result);
                  }

                }
                break;
         case 'like-comment':
                    $comment_id = intval($_POST['comment_id']);
                    $comment_userliked = intval($_POST['comment_userliked'])
                    if ($comment_id) {
                      if($comment_userliked){
                        $likes = set_comment_like($comment_id, $comment_userliked);
                        if ($likes) {
                            $result = array(
                                'status'=>true,
                                'count'=>$likes
                            );
                            //setcookie('comment-'.$comment_id, '1', time() + 86400, '/');
                        }
                        else {
                            $result = array(
                                'status'   =>  false,
                                'count' =>  '0'
                            );
                        }
                        echo json_encode($result);
                      }
                    }
                    break;

        case 'read-more':
            $note_id = $_POST['fullNote'];
            $content = $_POST['content'];
//            $limit = $_POST['limit'];
//            $fullNote = readMore($content, $limit, $note_id);
            if ($content) {
                $result = array(
                    'status'=>true,
                    'fullNote'=>$content
                );
            }
            echo json_encode($result);
            break;
        default:
            $content = "Nothing to display!";
            $result ['status']= $content;
            echo json_encode($result);
            break;
    }
}
