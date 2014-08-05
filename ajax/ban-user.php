<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat




session_start();

include '../db.php';
include '../functions.php';

$admin = $_SESSION['admin'];

if ($admin == 1){

$userid = mysql_real_escape_string($_POST['userid']);
$tttime = mysql_real_escape_string($_POST['t']);

$fromuser = $_SESSION['userid'];

$time = time();
$newtime = $time + ($t * 86400);

$hashedpass = sha1($password);

$result = mysql_query("UPDATE users SET ban='$newtime' WHERE id='$userid'") or die(mysql_error());  

} else {

}

?>
