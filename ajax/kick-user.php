<?php

session_start();

include '../db.php';
include '../functions.php';


$admin = $_SESSION['admin'];

if ($admin == 1){

$userid = mysql_real_escape_string($_POST['userid']);
$tttime = mysql_real_escape_string($_POST['t']);

$fromuser = $_SESSION['userid'];

$time = time();
$newtime = $time + ($t * 60);

$hashedpass = sha1($password);

$result = mysql_query("UPDATE users SET kick='$newtime' WHERE id='$userid'") or die(mysql_error());  

} else {

}


?>