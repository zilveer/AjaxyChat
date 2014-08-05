<?php

include 'db.php';

session_start();

$myuserid = $_SESSION['userid'];

$result = mysql_query("UPDATE users SET lasttime='0' WHERE id='$myuserid'") or die(mysql_error());

session_destroy();


Header('Location: '.$webdomain);

?>
