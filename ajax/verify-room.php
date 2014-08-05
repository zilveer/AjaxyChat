<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat





include '../db.php';
include '../functions.php';

session_start();

$roomid = $_POST['roomid'];
$roompass = $_POST['roompass'];

$myuserid = $_SESSION['userid'];
$time=time();


$qry = mysql_query("SELECT * FROM rooms WHERE id='$roomid' AND password='$roompass'") or die (mysql_error());
$amountchats = mysql_num_rows($qry);


echo $amountchats;



?>
