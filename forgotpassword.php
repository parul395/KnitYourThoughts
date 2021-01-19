<?php
session_start();
include('connection.php');
 $missingemail = "<p><strong>Enter email</strong</p>";

$invalidemail = "<p> <strong> Please enter a valid email. </strong> </p>";

$errors="";
$resultmessage="";
if(empty($_POST["forgotemail"])){
    $errors .= $missingemail;
    
    
}
else{
    $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;
    }
}

if($errors)
{
    $resultmessage = '<div class=" alert alert-danger">' .$errors .' </div>';
    echo $resultmessage;
    exit;
}
$email = mysqli_real_escape_string($link, $email);
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}
$results = mysqli_num_rows($result);
if(!$results){
    echo '<div class="alert alert-danger">This email does not exist in database  </div>'; exit;
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_id = $row['user_id'];
    $key = "";
    $key = bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
$status = 'pending';
$sql = "INSERT INTO forgotpassword (`user_id`, `kkey`, `time`, `status`) VALUES ('$user_id', '$key', '$time', '$status')";
$result = mysqli_query($link, $sql);

if(!$result){
    echo '<div class="alert alert-danger"> error running the query </div>';
     echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}

$message = "Please click on this link to reset your password:\n\n";
$message .= "http://localhost/php/resetpassword.php?user_id=$user_id&key=$key";
if(mail($email, 'Reset your password', $message, 'From:'.'developmentisland@gmail.com')){
        //If email sent successfully
                //print success message
       echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
}




?>