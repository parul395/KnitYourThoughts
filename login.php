<?php
session_start();
include("connection.php");
//check for user inputs
$missingemail = '<p><strong> please enter your email. <strong></p>';
$missingpassword = '<p><strong> please enter your password. <strong></p>';
//get inputs
$errors="";
$resultmessage="";
if(empty($_POST["loginemail"])){
    $errors .= $missingemail;
   
}
else{
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
    
    }
if(empty($_POST["password1"])){
    $errors .= $missingpassword;
    
    
}else{
    
    $password = filter_var($_POST["password1"], FILTER_SANITIZE_STRING);}
if($errors)
{
    $resultmessage = '<div class=" alert alert-danger">' . $errors .' </div>';
    echo $resultmessage;
    exit;
}
else{
    //prepare variables
    $password = mysqli_real_escape_string($link, $password);
//$password= md5($password); //hashing function

$password = hash('sha256',$password);
$email = mysqli_real_escape_string($link, $email);
    //run query
    $sql = "SELECT * FROM users  WHERE email = '$email' AND password = '$password'  ";
    $result = mysqli_query($link,$sql);
   
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}
    $count = mysqli_num_rows($result);
   
    if($count !== 1){
        
         echo '<div class="alert alert-danger">Wrong Username or Password!</div>';
    }
    
    
    
    
else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
    
    if(empty($_POST['rememberme'])){
        
        echo "success";
    }
    else{
        //create two variables
        $authenticator1 = bin2hex(openssl_random_pseudo_bytes(10));
        $authenticator2 = openssl_random_pseudo_bytes(20);
        //store these variables inside a cookie
        function f1($a, $b){
          $c =  $a . "," .bin2hex($b);
            return $c;
        }
        $cookievalue = f1($authenticator1 , $authenticator2 );
        //set the expiration date and time for the cookie
        setcookie(
        "rememberme", $cookievalue, time() + 1296000
        );
        //set the expiration date and time for the cookie
       //store query in table
        function f2($a) {
            $b = hash('sha256', $a);
            return $b;
        }
        
        $f2authenticator2 = f2($authenticator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('Y-m-d H:i:s', time() + 1296000);
        $sql = "INSERT INTO rememberme
        (`authenticator`, `f2authenticator2`, `user_id`, `expires`)
        VALUES
        ('$authenticator1', '$f2authenticator2', '$user_id', '$expiration')";
        $result = mysqli_query($link, $sql);
        if(!$result){
            echo '<div class="alert alert-danger">Error storing the data!'.mysqli_error($link). '</div>';
        }
        else{
            
            echo "success";
        }
        
    }
    
}
}



?>