<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat





include 'db.php';

session_start();


$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useradmin = $_SESSION['admin'];

echo "<div class=\"wheelbox\">
<div class=\"wheeltitle\" id=\"openaccount\">Rooms<i class=\"fa fa-plus fa-2\"></i></div>";

echo "<div class=\"roomobject\" id=\"gotoroom\" data-id=\"0\" data-pass=\"0\">Main Room</div>";

$qry = mysql_query("SELECT * FROM rooms ORDER BY id DESC") or die (mysql_error());
$amountrooms = mysql_num_rows($qry);
while ($roomget = mysql_fetch_array($qry)) {

$roomid = $roomget['id'];
$roomtitle = $roomget['title'];
$roompassword = $roomget['password'];

if ($roompassword == ""){
$passaccpt = 0;
} else {
$passaccpt = 1;
}

echo "<div class=\"roomobject\" id=\"gotoroom\" data-id=\"$roomid\" data-pass=\"$passaccpt\">$roomtitle</div>";

}




echo "</div><input type=\"hidden\" id=\"roomid\" value=\"0\">";




?>
