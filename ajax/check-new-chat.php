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
$time=time();


$qry = mysql_query("SELECT * FROM chat WHERE id>'$lastid' AND room='$roomid' ") or die (mysql_error());
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

if ($actualpmusername == $myusername || $thischatusername == $myusername){
echo "<span class=\"chatter_msg_item $cssside\" style=\"background-color:rgba(0, 0, 0, 0.45); width:390px;\">
       <a href=\"#\" class=\"chatter_avatar\"><img data-id=\"$thischatusername\" src=\"$thischatuseravatar\" /></a>
       <strong class=\"chatter_name\">$currentchattruename</strong>$correctnewchat<br>
<div class=\"settimearea\">$isotime</div></span>";
}

} else {

echo "<span class=\"chatter_msg_item $cssside\">
       <a href=\"#\" class=\"chatter_avatar\"><img data-id=\"$thischatusername\" src=\"$thischatuseravatar\" /></a>
       <strong class=\"chatter_name\">$currentchattruename</strong>$thischat<br>
<div class=\"settimearea\">$isotime</div></span>";

}

$_SESSION['lastid'] = $thischatid;

}



}


$result = mysql_query("UPDATE users SET lasttime='$time' WHERE id='$myuserid'") or die(mysql_error()); 

?>
