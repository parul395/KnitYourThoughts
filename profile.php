<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: file.php");}
    include('connection.php');
define('MYSQL_BOTH',MYSQLI_BOTH);
define('MYSQL_NUM',MYSQLI_NUM);
define('MYSQL_ASSOC',MYSQLI_ASSOC);
$user_id = $_SESSION['user_id'];
//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQL_ASSOC); 
    $username = $row['username'];
    $email = $row['email']; 
}else{
    echo "There was an error retrieving the username and email from the database";   
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Profile</title>  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="styling.css" type="text/css">
    <style>
       
        #container{
            margin-top: 130px;
        }
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
                
                <li class="active"><a href="profile.php">Profile</a></li>
                     <li><a href="#">Help</a></li>
                     <li><a href="#">Contact</a></li>
                    <li ><a  href="mainpageloggedin.php">My Entries</a></li>
                
                
                
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                <li><a href="#" >Logged In As <b><?php echo $username; ?></b></a></li>
                
                     <li><a href="file.php?logout=1 ">Logout</a></li>
                    
                
                
                
                </ul>
            
            
            
            </div>
        
          </div>
        </nav>
   
    
    <div class="cont">
   
    <div class="row">
        <div class="col-md-offset-3 col-md-6 ">
       
            <h2 ><span class="glyphicon glyphicon-cog"></span>   General Account Settings:</h2>
            <div class="table-responsive">
            
            <table class="table table-hover tabel-condensed table-bordered">
                
                <tr data-target="#updateuser" data-toggle="modal">
                <td>Username:</td>
                    <td><?php echo $username; ?></td>
                
                </tr>
                
                 <tr data-target="#updatemail" data-toggle="modal">
                <td>Email:</td>
                    <td><?php echo "$email"; ?></td>
                
                </tr>
                
                 <tr data-target="#updatepass" data-toggle="modal">
                <td>Password:</td>
                    <td>hidden</td>
                
                </tr>
                
                </table>
            
            </div>
            
        </div></div>
        </div>
    
    <div class="footer">
        <div class="container">
        
        <p>Knit Your Thoughts Copyright &copy; 2015-<?php   $today = date("Y") ;echo $today?>.</p>
        </div>
    
    
    
    </div>
    <!--update username-->
    <form method="post" id="userupdate">
        <div class="modal" id="updateuser">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"> &times;</button>
                
                <h4>Edit Username:</h4>
                
                
                
                </div>
                 <div class="modal-body">
              <div id="updateusernamemessage"></div>
             
                     <div class="form-group">
              <label for id="updateusername">Username:</label>
                          <input type="text" placeholder="Username" class="form-control" name="updateus" id="updateus"
                                 maxlength="30" value="<?php echo $username ; ?>">
              </div>
                     
                     
                </div>
            
            <div class="modal-footer">
              <input class="btn btnn" name="updateusername" type="submit" value="Submit">
              
            <button type="button" class=" cancel btn " data-dismiss="modal">
              Cancel
            </button>
                
            
          </div>
            
            
            </div>
            
            
            
            </div>
        
        
        
        </div>
    
    
    
    
    </form>
    
    
    <!--update email-->
    <form method="post" id="emailupdate">
        <div class="modal" id="updatemail">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"> &times;</button>
                
                <h4>Edit Email Adress:</h4>
                
                
                
                </div>
                 <div class="modal-body">
              <div id="updateemailmessage"></div>
             
                     <div class="form-group">
               <label for id="updatemail">Email:</label>
                          <input type="text" placeholder="Email" class="form-control" name="email" id="email"
                                 maxlength=30 value="<?php echo $email; ?>">
              </div>
                     
                     
                </div>
            
            <div class="modal-footer">
              <input class="btn btnn" name="update" type="submit" value="Submit">
              
            <button type="button" class=" cancel btn " data-dismiss="modal">
              Cancel
            </button>
                
            
          </div>
            
            
            </div>
            
            
            
            </div>
        
        
        
        </div>
    
    
    
    
    </form>
    
    
    <!--update pass-->
    <form method="post" id="passupdate">
        <div class="modal" id="updatepass">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"> &times;</button>
                
                <h4>Enter Current and New Password</h4>
                
                
                
                </div>
                 <div class="modal-body">
              <div id="updatepassmsg"></div>
             
                     <div class="form-group">
               
                          <input type="password" placeholder="Your Current Password" class="form-control" name="currentpassword" id="currentpassword"
                                 maxlength= "30" >
              </div>
                     
                     <div class="form-group">
               
                          <input type="password" placeholder="Choose A Password" class="form-control" name="newpassword" id="newpassword"
                                 maxlength= "30" >
              </div>
                     
                     <div class="form-group">
               
                          <input type="password" placeholder="Confirm Your Password" class="form-control" name="confirmpassword" id="confirmpassword"
                                 maxlength= "30" >
              </div>
                     
                     
                </div>
            
            <div class="modal-footer">
              <input class="btn btnn" name="update" type="submit" value="Submit">
              
            <button type="button" class=" cancel btn " data-dismiss="modal">
              Cancel
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
            
            <div class="form-group">
                
                <input type="email" placeholder="Email" id="email2" name="email2" class="form-control" >
                
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
    <script src="profile.js"></script>
    
    </body>



</html>