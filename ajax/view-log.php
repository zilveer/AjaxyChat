<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat






include '../db.php';
include '../functions.php';

session_start();

$lastid = $_SESSION['lastid'];

$roomid = $_POST['roomid'];

$myuserid = $_SESSION['userid'];
$myusername = $_SESSION['trueusername'];

$date = $_POST['date'];
$cordate = "$date 00:00:00";

$timestamp = strtotime($cordate);
$lasttime = $timestamp + 86400;



$qry = mysql_query("SELECT * FROM chat WHERE time>='$timestamp' OR time<='$lasttime' ORDER BY id DESC") or die (mysql_error());
$amountchats = mysql_num_rows($qry);


echo "<H1>CHAT LOG FOR: $cordate - $date - $amountchats Chats - $timestamp - $lasttime</H1>";


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

$result = mb_substr($myStr, 0, 5);


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

$ischatPM = mb_substr($thischat, 0, 1);

$correctedtime = date('h:m:s',$time);

if ($amountchats==0){ } else {

if ($ischatPM == "@"){

$explodechat = explode(" ", $thischat);
$pmusername = $explodechat[0];
$correctnewchat = implode(" ",$explodechat);
$actualpmusername = substr($pmusername, 1);


echo "<strong>$currentchattruename</strong>: $correctnewchat -- $isotime<br>";
}

}


}

?>
