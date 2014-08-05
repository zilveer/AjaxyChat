<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat





include '../db.php';
include '../functions.php';

session_start();

$roomid = $_POST['roomid'];

$myuserid = $_SESSION['userid'];
$time=time();

$thischatarray = array();

$qry = mysql_query("SELECT * FROM chat WHERE room='$roomid' ORDER BY time DESC LIMIT 25") or die (mysql_error());
$amountchats = mysql_num_rows($qry);
   while ($userget = mysql_fetch_array($qry)) {
$thischat = $userget['chat'];
$thislasttime = $userget['time'];
$thischatfrom = $userget['fromuser'];
$thischatid = $userget['id'];

$isotime = date('g:ia', $thislasttime);


$qryuser = mysql_query("SELECT * FROM users WHERE id='$thischatfrom'") or die (mysql_error());
$usergetarray = mysql_fetch_array($qryuser);
$thischatusername = $usergetarray['username'];
$thischatuseravatar = $usergetarray['avatar'];
$thischatuseradmin = $usergetarray['admin'];
$thischatname = $usergetarray['chatname'];


if ($thischatname == ""){
$currentchattruename = $thischatusername;
} else {
$currentchattruename = $thischatname;
}

$texttime = date('Y-m-d h:m:s', $timestamp);

if ($thischatuseravatar==""){
$thischatuseravatar = "/images/avatar.png";
} else {
$thischatuseravatar = $thischatuseravatar;
}

if ($thischatuseradmin == 0){
$cssside = "chatter_msg_item_admin";
} else {
$cssside = "chatter_msg_item_user";
} 

$correctedtime = date('h:m:s',$time);

if ($amountchats==0){ } else {


$ischatPM = mb_substr($thischat, 0, 1);
if ($ischatPM == "@"){

} else {

$thischatarray[] = "<span class=\"chatter_msg_item $cssside\">
       <a href=\"\" class=\"chatter_avatar\"><img src=\"$thischatuseravatar\" /></a>
       <strong class=\"chatter_name\">$currentchattruename</strong>$thischat<br>
<div class=\"settimearea\">$isotime</div></span>";

}

$_SESSION['lastid'] = $thischatid;

}


}


$reversedchat = array_reverse($thischatarray);

$normalchat = implode(" ",$reversedchat);

echo $normalchat;


$result = mysql_query("UPDATE users SET lasttime='$time' WHERE id='$myuserid'") or die(mysql_error()); 

?>
