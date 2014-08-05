<?php

session_start();

include '../db.php';
include '../functions.php';

$email = mysql_real_escape_string($_POST['upemail']);
$screenname = mysql_real_escape_string($_POST['upchatname']);

$time = time();
$fromuser = $_SESSION['userid'];

$hashedpass = sha1($password);

$result = mysql_query("UPDATE users SET email='$email', chatname='$screenname' WHERE id='$fromuser'") or die(mysql_error());  

Header("Location: http://www.teensupportchat.com/new.php");


?>