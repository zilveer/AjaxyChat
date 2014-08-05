<?php

include '../db.php';

session_start();

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$userid = $_SESSION['userid'];
$userip = $_SERVER['REMOTE_ADDR'];
$time=time();

$correctpass = sha1($password);

$qry = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$correctpass' ") or die (mysql_error());
$userget = mysql_fetch_array($qry);
$amountchats = mysql_num_rows($qry);
$myuserid = $userget['id'];
$mychatname = $userget['chatname'];
$admin = $userget['admin'];

if ($amountchats == 1) {

$_SESSION['userid'] = $myuserid;
$_SESSION['username'] = $mychatname;
$_SESSION['trueusername'] = $username;
$_SESSION['admin'] = $admin;
$result = mysql_query("UPDATE users SET lasttime='$time' WHERE id='$myuserid'") or die(mysql_error());
echo 1;

} else {

echo 0;
}




?>