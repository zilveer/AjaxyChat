<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat




session_start();

include '../db.php';
include '../functions.php';

$email = mysql_real_escape_string($_POST['newemail']);
$username = mysql_real_escape_string($_POST['newusername']);
$password = mysql_real_escape_string($_POST['newpassword']);
$screenname = mysql_real_escape_string($_POST['newscreenname']);

$time = time();
$fromuser = $_SESSION['userid'];

$hashedpass = sha1($password);

$result = mysql_query("UPDATE users SET email='$email', password='$hashedpass', maketime='$time', username='$username', chatname='$screenname' WHERE id='$fromuser'") or die(mysql_error());  

Header("Location: http://www.teensupportchat.com/new.php");


?>
