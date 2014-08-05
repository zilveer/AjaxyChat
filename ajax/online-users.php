<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat





include '../db.php';

session_start();


$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useradmin = $_SESSION['admin'];
$time = time() - 10;

$qryuser = mysql_query("SELECT * FROM users WHERE lasttime>='$time'") or die (mysql_error());
while ($usergetarray = mysql_fetch_array($qryuser)) {

$thischatchatname = $usergetarray['chatname'];
$thischatuseravatar = $usergetarray['avatar'];
$thischatusername = $usergetarray['username'];
$thischatchatuuid = $usergetarray['id'];

if ($thischatuseravatar == ""){
$trueavatar = "/images/avatar.png";
} else {
$trueavatar = $thischatuseravatar;
}

if ($thischatchatname == ""){
$trueusername = $thischatusername;
} else {
$trueusername = $thischatchatname;
}

if ($useradmin == 1){

$adminusercontrols = "<div class=\"adminusercontrols\"><a href=\"#\" data-id=\"$thischatchatuuid\" data-uname=\"$trueusername\" class=\"minirightbutton\" id=\"banuser\">BAN</a>   <a href=\"#\" class=\"minirightbutton\" data-id=\"$thischatchatuuid\" data-uname=\"$trueusername\" id=\"kickuser\">KICK</a></div>";

} 

echo "<div class=\"smalluseravatar\"><img class=\"onlineuser\" src=\"$trueavatar\" /> <span> $trueusername</span> $adminusercontrols </div>";



}

?>
