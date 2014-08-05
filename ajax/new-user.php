<?php

include '../db.php';

session_start();

$username = mysql_real_escape_string($_POST['name']);
$userid = $_SESSION['userid'];
$userip = $_SERVER['REMOTE_ADDR'];


$qry = mysql_query("SELECT * FROM users WHERE username='$username' OR chatname='$username' ") or die (mysql_error());
$userget = mysql_fetch_array($qry);
$amountchats = mysql_num_rows($qry);

if ($amountchats >= 1) {

echo 1;

} else {

$doquery = mysql_query("INSERT INTO users (username, ip) VALUES('$username', '$userip') ") or die(mysql_error()); 
$newid = mysql_insert_id();

$_SESSION['userid'] = $newid;
$_SESSION['username'] = $username;

echo 0;

}


?>