<?php
session_start();
include("connection.php");
//logout
include('logout.php');
//rememberme
include('remember.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Knit Your Thoughts</title>  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="styling.css" type="text/css">
    <style>
       
    
    </style>
</head>
<body >
    <!-- navigation bar-->
    
        <nav class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
        
        <div class="navbar-header">
            
            <a class="navbar-brand">
                <span style="font-family:cursive"><img src="favicon.jpg"> K.Y.T
                </span></a>
            <button type="button" class="navbar-toggle" data-target="#navcol" data-toggle="collapse">
            
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>    
            
            </button>
            
            
            
            
            
            
            
            </div>
            <div class="navbar-collapse collapse" id="navcol">
                <ul class="nav navbar-nav">
                
                <li class="active"><a href="#">Home</a></li>
                     <li><a href="#">Help</a></li>
                     <li><a href="#">Contact</a></li>
                
                
                
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                
                
                     <li><a href="#loginmodal" data-toggle="modal">Login</a></li>
                    
                
                
                
                </ul>
            
            
            
            </div>
        
          </div>
        </nav>
    <div class="jumbotron">
        <div class="container">
        <h1>Knit Your Thoughts</h1>
        <h2>Process Your thoughts and be more emotionally aware of yourself/</h2>
        <h2>Hassle Free To Use, Full Protection Of Your Journals.</h2>
            
            <button class="btnn btn-lg sign" data-target="#signupmodal" data-toggle="modal">Free-Sign-up</button>
        </div>
    
    
    </div>
    
    <div class="footer">
        <div class="container">
        
        <p>Knit Your Thoughts Copyright &copy; 2015-<?php   $today = date("Y") ;echo $today?>.</p>
        </div>
    
    
    
    </div>
    <!--login-->
    <form method="post" id="loginform">
        <div class="modal" id="loginmodal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss= "modal"> &times;</button>
                
                <h4>Login</h4>
                
                
                
                </div>
                 <div class="modal-body">
              <div id="loginmessage"></div>
              <div class="form-group">
              
                          <input class="form-control" type="email"name="loginemail"placeholder="Email"   maxlength="30" id="loginemail">
              </div>
                     <div class="form-group">
              
                          <input type="password" placeholder="Password" class="form-control" name="password1" maxlength="20" id="password1">
              </div>
                     <div class="checkbox">
                         <label>
                              <input type="checkbox" name="rememberme" id="rememberme">
                         Remember Me
                         </label>
                     <a href="#passmodal" data-toggle="modal" class="pull-right" style="cursor:pointer">
                     
                     Forgot Password?
                     </a>
                     
                     </div>
                     
                </div>
            
            <div class="modal-footer">
              <input class="btn btnn" name="loginn" type="submit" value="Login">
              
            <button type="button" class=" cancel btn " data-dismiss="modal">
              Cancel
            </button>
                <button type="button" class="btn btnn  pull-left" data-target="#signupmodal" data-toggle="modal">
              Register
            </button>
            
          </div>
            
            
            </div>
            
            
            
            </div>
        
        
        
        </div>
    
    
    
    
    </form>
    <form method="post" id="passform">
    <div class="modal" id="passmodal">
        <div class="model-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
            <button class="close" data-dismiss="modal"> &times;</button>
                <h4>Forgot Password? Enter Your Email Address: </h4>
            
            
            
            </div>
            <div class="modal-body">
            <div id="forgotmessage"></div>
            <div class="form-group">
                
                <input type="email" placeholder="Email" id="forgotemail" name="forgotemail" class="form-control" >
                
                </div>
            
            </div>
            
             <div class="modal-footer">
              <input class="btn btnn" name="forgotpass" type="submit" value="Submit">
              
            <button type="button" class=" cancel btn " data-dismiss="modal">
              Cancel
            </button>
                <button type="button" class="btn btnn  pull-left" data-target="#signupmodal" data-toggle="modal">
              Register
            </button>
            
          </div>
            
            </div>
        
        
        
        
        </div>
        
        
        
        
        
        
        </div>
    
    
    
    </form>
    
    
    
    
    <!-- sign up form-->
    <form method="post" id="signup">
       <div class="modal" id="signupmodal" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 id="myModalLabel">
                Sign Up Today And Start Using Our Journal Entry App!
              </h4>
          </div>
          <div class="modal-body">
              <div id="signupmessage"></div>
              <div class="form-group">
              
                          <input type="text" placeholder="Username" class="form-control" name="username" maxlength="30" id="username">
              </div>
              <div class="form-group">
              
                          <input type="email" placeholder="Email Address" class="form-control"name="email" maxlength="50" id="email" >
              </div>
              <div class="form-group">
              
                          <input type="password" placeholder="Choose A Password" class="form-control" id="password" name="password" maxlength="30">
              </div>
              <div class="form-group">
              
                          <input type="password" placeholder="Confirm Password" class="form-control" id="password2"name="password2" maxlength="30">
              </div>

          </div>
          <div class="modal-footer">
              <input class="btn btnn" name="signup" type="submit" value="signup">
              
            <button type="button" class=" cancel btn " data-dismiss="modal">
              Cancel
            </button>
            
          </div>
      </div>
  </div>
  </div>
 </form>
    
    
    
    
    
    
    
    
  
     
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
    <script src="index.js"></script>
  
    </body>



</html>