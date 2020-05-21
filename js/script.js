$(document).ready(function () {
    //set user profile id
    $('.set-user').on('click', function (e) {
      e.preventDefault();
      $this = $(this);
      var $id = $(this).data('id');

      $.ajax({
        url : 'profile.php',
        type : 'POST',
        data : {
          //type : 'set-profile-user-id',
          id : $id
        },
        success : function (response) {
          alert($id);
          alert('successful!');
          location.href="profile.php";
        },
        error : function () {
          alert('failed!');
        }
      });
    });
    // $('.tweetliked').on('click', function (event) {
    //     event.preventDefault();
    //     var $this = $(this);
    //     var $tweet_id = $this.data('tid');
    //     alert ($tweet_id);
    //     //var $tweet_userliked = $this.data('tuid');
    //     //alert($tweet_id);
    //     // if ($this.data('liked')) {
    //     //     alert("You liked already!");
    //     //     return false;
    //     // }
    //     $.ajax({
    //         url : 'check.php',
    //         type : 'post',
    //         data : {
    //             id_of_tweet : $tweet_id,
    //             //tweet_userliked : $tweet_userliked
    //         },
    //         dataType : 'json',
    //         success : function (response) {
    //             if (response.status) {
    //                 //$this.find('i').text(response.count);
    //                 //$this.find('i').removeClass('far fa-heart').addClass('fas fa-heart');
    //                 //$this.find('i').css('color','red');
    //
    //                 //$this.data('liked', 1);
    //             }
    //         },
    //         error : function () {
    //
    //         }
    //     });
    // });
    //Like Tweet

    $('.follow-btn').on('click', function (event) {
        //event.preventDefault();
        var $this = $(this);
        $this.text('following');
        $this.removeClass("btn-danger follow-btn").addClass("btn-success follow-btn");
        $.ajax({
            url : 'ajax.php',
            type : 'post',
            data : {
                type : 'follow-users',
                current_uid : $curr_uid,
                profile_uid : $profile_uid
            },

            dataType : 'json',
            success : function (response) {
                alert("success!");
                console.log(response);
            },
            error : function (response) {
                alert("failed!");
                console.log(response);
            }
        });
    });

    //comment-submit!
    $('.comment-submit').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);
        var $login_uid = $this.data('loginuser');
        var $tid = $this.data('tid').split("?");
        var $tweet_id = $tid[0];
        $.ajax({
            url : 'comment.php',
            type : 'post',
            data : {
              //type : 'add-comment',
              login_uid : $login_uid,
              //profile_uid : $profile_uid,
              tweet_id : $tweet_id,
            },

            dataType : 'json',
            success : function (response) {
              alert($login_uid);
              alert("succeess!");
            },
            error : function () {
                alert("failed!")
            }
        });
    });


    // add tweet
    // $('#add_tweet_form').on('submit',function(event){
    //   alert("you've Enterd submit!")
    //   event.preventDefault();
    //   if ($('#tweet_content').val == ""){
    //     alert("Enter SomeThing!");
    //   }
    //   else{
    //     $.ajax({
    //       url:"add-tweet.php",
    //       method:"POST",
    //       data:$('#add_tweet_form').serialize(),
    //       success:function(data){
    //         $('#add-tweet-form')[0].reset();
    //         $('#myModal').modal('hide');
    //
    //       }
    //     });
    //   }
    //
    // });


});
