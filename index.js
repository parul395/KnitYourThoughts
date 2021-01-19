//for ajax call to other php
//once the signup form is submitted
$("#signup").submit(function(event){
    
    //prevent the default php processing
    event.preventDefault();
    //collect user inputs
   var datatopost = $(this).serializeArray();
    console.log(datatopost);
    //send them to signup.php using AJAX calls
    $.ajax({ 
    url: "signup.php",//where you sending data
        type:"POST",
        data: datatopost,
        success: function(data){
           if(data){
               $("#signupmessage").html(data);
           } 
        },
        error: function(){
            
             $("#signupmessage").html("<div class='alert alert-danger'> There was an error with the AJAX call, try again later.</div>");
            
        }
    
    });
   // $.post({ }); need extra methods like .done and .fail if method fails
    
});



//for login
//for ajax call to other php
//once the login form is submitted
$("#loginform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
   
    //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);

    //send them to login.php using AJAX
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data == "success"){
                window.location = "mainpageloggedin.php";}
            else{
                $('#loginmessage').html(data);   
            }
        },
        error: function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});

//ajax call to forgot password module
$("#passform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "forgotpassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            
            $('#forgotmessage').html(data);
        },
        error: function(){
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});