<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat




session_start();

include '../db.php';
include '../functions.php';

$chatmessage = mysql_real_escape_string($_POST['chat']);
$roomid = mysql_real_escape_string($_POST['roomid']);
$time = time();
$fromuser = $_SESSION['userid'];
$admin = 0;

$kicked = UserKicked($fromuser);

if ($kicked){

} else {


$parsed     = parse_url($chatmessage);
 $hostname  = $parsed['host']; 
 $query     = $parsed['query'];

$Arr = explode('v=',$query);
$videoIDwithString = $Arr[1];

$videoID = substr($videoIDwithString,0,11); // clean video ID


//YOUTUBE.COM
if( (isset($videoID)) && (isset($hostname)) && ($hostname=='www.youtube.com' || $hostname=='youtube.com')){

$truechat = "<iframe width=\"390\" height=\"300\" src=\"http://www.youtube.com/embed/$videoID\" frameborder=\"0\" allowfullscreen></iframe>";

} else if (preg_match('/(\.jpg|\.png|\.gif|\.bmp)$/', $chatmessage)){

$truechat = "<img src=\"$chatmessage\">";

} else {

$safechat = strip_html_tags($chatmessage);
$newchat = makeLink($safechat);

$secondnewchat = emoticons($newchat);

$truechat = $secondnewchat;
}


if ($truechat != ""){
$doquery = mysql_query("INSERT INTO chat (fromuser, chat, time, room, admin) VALUES('$fromuser', '$truechat', '$time', '$roomid', '$admin') ") or die(mysql_error()); 
} else {

}

}

?>


