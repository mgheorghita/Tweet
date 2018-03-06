/**
 * Created by mgheorghita on 4/28/2016.
 */
$(document).ready(function () {
// more tweets
    $(document).scroll(function(){
        if($(document).height() == ($(window).scrollTop() + $(window).height())){
            var tweetId = parseInt($(".main-feed .tweet").last().attr("id"));

            if(tweetId !== undefined && tweetId !== null) {
                var formData = {'tweetId': tweetId};
                var formURL = 'tweet/moreTweets';
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: formURL, // the url where we want to POST
                    data: formData, // our data object
                    success: function (result) {
                        succesMoreTweets(result);
                    },
                    encode: true
                })
            }
        }
    });

    function succesMoreTweets(result) {
        var response = JSON.parse(result);
        if(response.success == true){
            $(".main-feed").append(response.tweetContent);
            $(".content-style.tweet.hidden").hide();
            $(".content-style.tweet").removeClass("hidden");
            $(".content-style.tweet").each(function(index, elem){
                $(elem).fadeIn(1500, 'swing');
            });
        } else {
            //$(".newTweets").addClass("hidden");
            //show some error
        }
    }
//end more tweets

//Follow-Unfollow

    function followInit(thisObj) {

            var formURL = '';
            if ($(thisObj).hasClass('follow')) {
                formURL = 'user/follow';
            } else if ($(thisObj).hasClass('unfollow')) {
                formURL = 'user/unfollow';
            }

            if (formURL !== '') {
                changeFollowStatus(thisObj, formURL);
            }
        }
    $(".userList .btn").click(function(){followInit(this)});
    $(".usersFollowingRow .btn").click(function(){followInit(this)});
        $(".userGeneric.follow").click(function(){followInit(this)});

    function changeFollowStatus(thisObj, formURL) {
        var followingUserId = $(thisObj).attr("id");

        var formData = {'followingUserId': followingUserId}
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: formURL, // the url where we want to POST
            data: formData, // our data object
            success: function (result) {
                var response = JSON.parse(result);
                if (response.success === true) {
                    succesFollow(thisObj);
                }
            },
            encode: true
        });
    }

    function succesFollow(thisObj) {
        var elem = $(thisObj);
        if (elem.hasClass('btn-success')) {
            elem.removeClass('btn-success');
            elem.removeClass('follow');
            elem.addClass('btn-danger');
            elem.addClass('unfollow');
            elem.text('Unfollow');
        } else if (elem.hasClass('btn-danger')) {
            elem.removeClass('btn-danger');
            elem.removeClass('unfollow');
            elem.addClass('btn-success');
            elem.addClass('follow');
            elem.text('Follow');
        }else if (elem.hasClass('btn-default')&& elem.hasClass('unfollow')) {
           elem.removeClass('unfollow');
           elem.addClass('follow');
            $('.userGeneric .hidden-xs').text("Follow")
         } else if (elem.hasClass('btn-default')&& elem.hasClass('follow')) {
            elem.removeClass('follow');
            elem.addClass('unfollow');
            $('.userGeneric .hidden-xs').text("Unfollow")
        }
    }
        
      // NewTweetsRequest
    var newTweetCount = 0;

    $("button.newTweets").click(function () {
       $(".tweet").removeClass("hidden");
       $(".newTweets").addClass("hidden");
        var newTweetCount = 0;
    });
    
    var handler = setInterval(getNewTweetsRequest, 10000);
    function getNewTweetsRequest() {
        var tweetId = parseInt($(".main-feed .tweet").first().attr("id"));
        if(tweetId !== undefined && tweetId !== null) {
            var formData = {'tweetId': tweetId};
            var formURL = 'tweet/newTweets';
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: formURL, // the url where we want to POST
                data: formData, // our data object
                success: function (result) {
                    succesNewTweets(result);
                },
                encode: true
            })
        }
    }
  function succesNewTweets(result) {
        var response = JSON.parse(result);
        if(response.success == true){
            $(".main-feed").prepend(response.tweetContent);
            $(".newTweets").removeClass("hidden");
            newTweetCount = newTweetCount + response.count;
            $( "span.newT" ).text(newTweetCount);
        } else {
            //$(".newTweets").addClass("hidden");
            //show some error
        }
    }
  // end NewTweetsRequest



    $(".loadMoreUser .btn").click(function(){
        var userId = parseInt($(".usersBlock .usersFollowingRow").last().attr("id"));
        userClass = '';
        if ($(this).hasClass('follower')) {
            userClass = 'follower';
        } else if ($(this).hasClass('following')) {
            userClass = 'following';
        }
        else if($(this).hasClass('allUser')){
            userClass = 'list'
        }
        if(userId !== undefined && userId !== null) {
            var formData = {'userId': userId, 'type' : userClass};
            var formURL = 'user/moreUsers';
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: formURL, // the url where we want to POST
                data: formData, // our data object
                success: function (result) {
                    succesMoreUsers(result);
                },
                encode: true
            })

    }
});

function succesMoreUsers(result) {
    var response = JSON.parse(result);
    if(response.success == true){

        $(".usersBlock").append(response.userContent);

        $(".usersFollowingRow.hidden").hide();
        $(".usersFollowingRow").removeClass("hidden");
        $(".usersFollowingRow").each(function(index, elem){
            $(elem).fadeIn(1500, 'swing');
        });
    } else {
        $(".main-feed").append("<div><h1 class='text-center'>No more users</h1></div>")
        $(".allUser").addClass("hidden");
    }
}


    //Favorite

    function favoriteInit(thisObj) {

        var formURL = '';
        if ($(thisObj).hasClass('favorite')) {
            formURL = 'tweet/favorite';
        } else if ($(thisObj).hasClass('unfavorite')) {
            formURL = 'tweet/unfavorite';
        }

        if (formURL !== '') {
            changeFavoriteStatus(thisObj, formURL);
        }
    }
    $(".icons-bar .favorite").click(function(){favoriteInit(this)});
    $(".icons-bar .unfavorite").click(function(){favoriteInit(this)});

    function changeFavoriteStatus(thisObj, formURL) {
        var favoriteTweetId = $(thisObj).attr("id");
        console.log(favoriteTweetId);
        var formData = {'favoriteTweetId': favoriteTweetId}
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: formURL, // the url where we want to POST
            data: formData, // our data object
            success: function (result) {
                var response = JSON.parse(result);
                if (response.success === true) {
                    succesFavorite(thisObj);
                }
            },
            encode: true
        });
    }

    function succesFavorite(thisObj) {
        var elem = $(thisObj);
        if (elem.hasClass('favorite')) {
            elem.removeClass('favorite');
            elem.addClass('unfavorite');
            elem.addClass('red');
        } else if (elem.hasClass('unfavorite')) {
            elem.removeClass('unfavorite');
            elem.removeClass('red');
            elem.addClass('favorite');
           }
    }

});





