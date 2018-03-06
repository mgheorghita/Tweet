$(document).ready(function(){		

    
    $("#register").click(function(){
	registerForm();	
    });
    
    function registerForm(){
        var login = $("input[name='login']").val();
        
         var formData = {
            'login'      :  $("input[name='login']").val(),
            'password'   :  $("input[name='password']").val(),            
            'email'      :  $("input[name='email']").val(),
            'first_name' :  $("input[name='first_name']").val(),
            'last_name'  :  $("input[name='last_name']").val(),
            'birthDate'  :  $("input[name='birthDate']").val(),
            'password_confirmation'   :  $("input[name='password_confirmation']").val()
        };
        
       
       var formURL = 'register/test';
        //alert('Login - '+login+'; password - '+password+'; first_name - '+first_name+'; last_name - '+last_name+'; birthDate - '+birthDate);
         $.ajax({
            type        : 'POST',
            url         : formURL,
            data        : formData,
            
            success: function(result) {
                succes(result, formData);
            },
            encode       : true
        });
    }
    function succes(result, formData) {        
        
        var response = JSON.parse(result);
        if(response.error != ''){
           
           var message = '';
           
            $.each( response.error, function( key, value ) {
                if(value != null){
                    message = message + '<br>' + value ;
                }
            });
           $("#error").html(message);
        }else{
            $("#registerForm").trigger('reset');
            $("#registrationField").hide();
            $("#registrationSuccess").show();
            message = '<h2>You are registered successfull<h2><h3>Now you will be redirected to login page. Thank You<h3>';
            $("#registrationSuccess").html(message);
             window.setTimeout(function(){window.location.href = "//twitter.local";}, 5000);
        }
    }
});