<!-- ssl: secure socket layer-->
<!--start session-->
<?php 
session_start();
//connect to database
include('connection.php');
$password="";
$missingusername = "<p><strong> Please enter a username. </strong> </p>";
$missingemail = "<p> <strong> Please enter an email. </strong>  </p>";
$invalidemail = "<p> <strong> Please enter a valid email. </strong> </p>";
$missingpassword = "<p><strong> Password is missing.</strong> </p>";
$invalidpassword = "<p><strong> Invalid password! Password should have atleast 6 characters and include one capital letter and one digit.</strong></p>";
$differentpassword = "<p> <strong>Passwords don't match.</strong> </p>";
$missingpassword2 = "<p> <strong>Confirm Your Password.</strong> </p>";
$errors="";
$resultmessage="";
//get userinputs
if(empty($_POST["username"])){
    $errors .= $missingusername;
    
    
}
else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    
}
//get email
if(empty($_POST["email"])){
    $errors .= $missingemail;
    
    
}
else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;
    }
}
//get password
if(empty($_POST["password"])){
    $errors .= $missingpassword;
    
    
}
elseif(!(strlen($_POST["password"])>6 and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"]))){
    
    $errors .= $invalidpassword;
}
else{
    
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
         $errors .= $missingpassword2;
    }else{
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentpassword;
        }
    }
    
}

//check for errors
if($errors)
{
    $resultmessage = '<div class=" alert alert-danger">' .$errors .' </div>';
    echo $resultmessage;
    exit;
}

//no errors
//prepare variables for the queries by cleaning them to avoid sql injection
$username = mysqli_real_escape_string($link, $username);
$password = mysqli_real_escape_string($link, $password);
//$password= md5($password); //hashing function
$password = hash('sha256',$password);

$email = mysqli_real_escape_string($link, $email);

//check if username provided exists in database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}
$results = mysqli_num_rows($result);

if($results){
    echo '<div class="alert alert-danger">This username is already registered </div>'; exit;
}
//check fro email
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);

if(!$result){
    echo '<div class="alert alert-danger"> error running the query </div>';
     echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}
$results = mysqli_num_rows($result);

if($results){
    echo '<div class="alert alert-danger">This email is already registered </div>'; 
}

//create a unique activation code
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));

//enter details into database
$sql = " INSERT INTO users ( `username` , `email` ,`password`, `activation` ) VALUES ( '$username', '$email', '$password', '$activationkey' )";
$result = "";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger"> error running the query </div>';
     echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
    
}
//send the email to usernwith activation code
$message = " please click on this link to activate your account:\n \n";
$message .= " http://localhost/php/activate.php?email=". urlencode($email). "&key=$activationkey";
if(mail($email, 'Confirm Your Registration', $message, 'from:'.'parul.11804638@gmail.com')){
    echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.
</div>";
}

?>



