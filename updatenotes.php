<?php 
define('MYSQL_BOTH',MYSQLI_BOTH);
define('MYSQL_NUM',MYSQLI_NUM);
define('MYSQL_ASSOC',MYSQLI_ASSOC);
session_start();
include('connection.php');

//get the id of the note sent through AJAX
$id = isset($_POST['id']) ? $_POST['id'] : '';
$note = isset($_POST['note']) ? $_POST['note'] : '';


$time = time();

$sql = "UPDATE notes SET note = '$note' , time = '$time' WHERE id = '$id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error' ;
}

?>