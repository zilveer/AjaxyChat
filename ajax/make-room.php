<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat





include '../db.php';

session_start();

$myuuid = $_SESSION['userid'];

$roomname = $_POST['name'];
$password = $_POST['password'];
$time = time();

$doquery = mysql_query("INSERT INTO rooms (fromuser, title, password, maketime) VALUES('$myuuid', '$roomname', '$password', '$time') ") or die(mysql_error()); 
$newid = mysql_insert_id();


Header('Location: '.$webdomain);


?>
