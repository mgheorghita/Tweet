/**
 * Created by mgheorghita on 5/6/2016.
 */
$(document).ready(function () {
    //add new tweet

    $(".cleanOnClose").click(function (){
        $("textarea#tweetContent").val('');
    });

    $('#tweetSubmit').click(function(event) {
        $('.error').hide();
        var tweetContent = $("textarea#tweetContent").val();
        if (tweetContent == "") {
            $("label#tweetContent_error").show();
            $("textarea#tweetContent").focus();
            return false;
        }
        //alert (dataString);return false;
        var formData = {
            'tweetContent'      : $('textarea[name=tweetContent]').val(),
            'image'             : $('input[name=email]').val(),
        };
        //var data = $form.serialize();
        var formURL = 'tweet/add';
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : formURL, // the url where we want to POST
            data        : formData, // our data object
            success: function(result) {
                succes(result);
            },
            encode       : true
        })
        event.preventDefault();
    });

    function succes(result) {
        var response = JSON.parse(result);
        if (response.success == true) {
            $(".main-feed").prepend(response.tweetContent);
            if (typeof initDeleteTweet === 'function') {
                initDeleteTweet();
            } else {
                $("label#tweetContent_error").show();
                $("label#tweetContent_error").text(response.error);
                $("textarea#tweetContent").focus();
            }
            $("textarea#tweetContent").val('');

        }
    }
    //end new tweet

    if (typeof initDeleteTweet === 'function'){
        initDeleteTweet();
    }

    function initDeleteTweet() {
        $("button.deleteTweet").click(function () {
            var formURL = 'tweet/delete';
            deleteTweet(this, formURL)
        });
    }
    function deleteTweet(thisObj, formURL) {
        var tweetId = $(thisObj).attr("id");

        var formData = {'tweetId': tweetId}
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: formURL, // the url where we want to POST
            data: formData, // our data object
            success: function (result) {
                var response = JSON.parse(result);
                if (response.success === true) {
                    succesDelete(thisObj);
                }
            },
            encode: true
        });
    }

    function succesDelete(thisObj) {
        $(thisObj).parent().parent().fadeOut(400, 'swing');
        /*var tweetId= $(thisObj).attr("id");
        var elem = $('.tweet');
        $('.tweet[id='+tweetId+']').addClass('hidden');*/
    }

});