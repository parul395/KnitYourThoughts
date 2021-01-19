<?php 
//if user is not logged in and cookie exist
if(!isset($_SESSION['user_id']) && !empty($_COOKIE['rememberme'])){
    
    //array_key_exists('user_id',$_SESSION);
    // f1COOKIE:$a . "," .bin2hex($b)
    //f2 :hash('sha256',$a)
    //extract cookies
    list($authenticator1, $authenticator2)=explode(',', $_COOKIE['rememberme']);
    $authenticator2 = hex2bin(authenticator2);
    
    $f2authenticator2 = hash('sha256',$authenticator2);
    //look fro auth1 in remember table
    $sql = "SELECT * FROM rememberme WHERE authenticator = '$authenticator1'";
    $result = mysqli_query($link, $sql);
        if(!$result){
            echo '<div style ="margin-top:50px" class="alert alert-danger">Error running the query'.mysqli_error($link). '</div>';
            exit;
        }
    $count = mysqli_num_rows($result);
   
    if($count !== 1){
        
         echo '<div style ="margin-top:50px" class="alert alert-danger">Remember me process failed!!</div>' .$count; exit;
    }
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    
    if(!hash_equals($row['f2authenticator2'], $f2authenticator2)){
   
    echo '<div style ="margin-top:50px" class="alert alert-danger">hash equals failed</div>' ;
    
    }else{
        
        //store new value in cookies
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
            echo 'div style ="margin-top:50px" class="alert alert-danger">Error storing the data!'.mysqli_error($link). '</div>';
        }
        
        
        
        
        
        $_SESSION['user_id'] = $row['user_id'];
        header("location: mainpageloggedin.php");
    }
    
    
    
}



?>