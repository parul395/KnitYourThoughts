<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: file.php");
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Entries</title>  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="styling.css" type="text/css">
    <style>
       
        #container{
            margin-top: 120px;
        }
        .noteheader{
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor:pointer;
            color:white;
            padding: 0 10px;
            background: linear-gradient(rgba( 124, 94, 17, 0.713 ),rgba( 197, 157, 57, 0.713 ));
            box-shadow: 4px 4px rgba( 87, 74, 39, 0.713 );
            
        }
        .notes{
            margin-bottom: 100px;
        }
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .timetext{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
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
                
                <li ><a href="profile.php">My Profile</a></li>
                     <li><a href="#">Help</a></li>
                     <li><a href="#">Contact</a></li>
                    <li class="active"><a  href="#">My Entries</a></li>
                
                
                
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                <li><a href="#" >Logged In As <b><?php echo $_SESSION['username']?></b></a></li>
                
                     <li><a href="file.php?logout=1" >Logout</a></li>
                    
                
                
                
                </ul>
            
            
            
            </div>
        
          </div>
        </nav>
   
    
    
    <div class="container" id="container">
        <div id="alert" class="alert alert-danger collapse">
        <a class="close" data-dismiss = "alert">
            
            &times;
            </a>
            <p id="alertContent"></p>
        
        </div>
        
     
    <div class="row">
        <div class="col-md-offset-3 col-md-6 ">
        <div class="buttons">
        
        
        <button class="btn btnn btn-lg" id="addNote" type="button">Add Entries</button>
        <button class="btn cancel btn-lg pull-right" id="edit" type="button">Edit</button>
            <button class="btn btnn btn-lg pull-right"id="done" type="button">Done</button>
            <button class="btn cancel btn-lg "id="allNotes" type="button">All Entries</button>
        
        
        </div>
            
            <div id="notePad">
            
           
            <textarea rows="10"> </textarea>
            
            
            </div>
            
            <div id="notes" class="notes">
            <!-- ajax call to php file-->
            
            </div>
            
            
            </div>
        
        
        </div>
    
    </div>
    
    
   
    
    
    
    
    
    
    
    <div class="footer">
        <div class="container">
        
        <p>Knit Your Thoughts Copyright &copy; 2015-<?php   $today = date("Y") ;echo $today?>.</p>
        </div>
    
    
    
    </div>
    
    
    
    
    
    
    
    
  
     
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
    <script src="mynotes.js"></script>
    
           

    </body>

</html>