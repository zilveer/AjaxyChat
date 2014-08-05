<?php



// database information goes here
$dbhost = "localhost";
$dbuser = "MYSQL_USER_HERE";
$dbpass = "MYSQL_PASS_HERE";
$dbdatabase = "MYSQL_DB_HERE";

mysql_connect("$dbhost", "$dbuser", "$dbpass") or die(mysql_error()); 
mysql_select_db("$dbdatabase") or die(mysql_error());


// AMAZON SES Username/Password
    $mailusername = "SES_USER_HERE";  // SES SMTP  username
    $mailpassword  = "SES_PASS_HERE";



?>
