<?php

include 'db.php';

session_start();


$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useradmin = $_SESSION['admin'];


$qryuser = mysql_query("SELECT * FROM users WHERE id='$userid'") or die (mysql_error());
$usergetarray = mysql_fetch_array($qryuser);
$myusername = $usergetarray['username'];
$thischatuseravatar = $usergetarray['avatar'];
$thischatuseremail = $usergetarray['email'];
$mychatname = $usergetarray['chatname'];


$date = date('d-m-Y', time());


?>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="/js/timeago.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<script src="/js/main.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<title>Teen Support Chat</title>

<div class="chatter">

<div id="notifi"></div>
  
  <div class="chatter_pre_signup">
  <input type="text" name="chatter_name" placeholder="Your name" class="chatter_field chatter_name" />
  <input type="text" name="chatter_email" placeholder="Your email address" class="chatter_field chatter_email" />
  <input type="submit" name="chatter_create_user" value="Start Chatting" class="chatter_btn chatter_create_user" />
  </div>
  <input type="hidden" id="roomid" value="0">
  <div class="chatter_post_signup">
    <div class="chatter_convo">
      

<?php


$qry = mysql_query("SELECT * FROM chat WHERE room='0' ORDER BY time DESC LIMIT 25") or die (mysql_error());
$amountchats = mysql_num_rows($qry);
$i=0;
$thischatarray = array();
while ($userget = mysql_fetch_array($qry)) {
$i++;

$thischat = $userget['chat'];
$thislasttime = $userget['time'];
$thischatadmin = $userget['admin'];
$thischatfrom = $userget['fromuser'];
$thischatid = $userget['id'];

$isotime = date('g:ia', $thislasttime);

if ($i == 1){
$lastseenchatid = $thischatid;
}

$qryuser = mysql_query("SELECT * FROM users WHERE id='$thischatfrom'") or die (mysql_error());
$usergetarray = mysql_fetch_array($qryuser);
$thischatusername = $usergetarray['username'];
$thischatuseravatar = $usergetarray['avatar'];
$thischatuseradmin = $usergetarray['admin'];

$texttime = date('Y-m-d h:m:s', $timestamp);

if ($thischatuseradmin == 0){
$cssside = "chatter_msg_item_admin";
} else {
$cssside = "chatter_msg_item_user";
} 


if ($thischatuseravatar==""){
$thischatuseravatar = "/images/avatar.png";
} else {
$thischatuseravatar = $thischatuseravatar;
}

$ischatPM = mb_substr($thischat, 0, 1);
if ($ischatPM == "@"){

} else {

$thischatarray[] = "<span class=\"chatter_msg_item $cssside\">
        <a href=\"#\" class=\"chatter_avatar\"><img data-id=\"$thischatusername\" src=\"$thischatuseravatar\" /></a>
        <strong class=\"chatter_name\">$thischatusername</strong>$thischat 
<div class=\"settimearea\">$isotime</div></span>";

}

}

$_SESSION['lastid'] = $lastseenchatid;

$reversedchat = array_reverse($thischatarray);

$normalchat = implode(" ",$reversedchat);

echo $normalchat;

?>

    </div>

<?php

if ($userid == ""){

echo "<b>Enter your username or create a new one:</b><br><textarea id=\"usernamechatinput\" placeholder=\"Type your UserName here!\" class=\"chatter_field chatter_message\" required pattern=\"[a-zA-Z]+\"></textarea>";

echo "<textarea id=\"loginpassinput\" placeholder=\"Type your password and hit enter!\" class=\"chatter_field chatter_message\" style=\"display: none; margin: 3px 0 0 0;\"></textarea>";

} else {

echo "<textarea id=\"chatinput\" placeholder=\"Type your message here...\" class=\"chatter_field chatter_message\"></textarea>";

echo "<div id=\"otheraccountstuff\">

<a href=\"#\" id=\"sendchatbutton\" style=\"margin: -3px 0 0 345px; width:110px;\" class=\"submitbutton green\">Send</a>

<i id=\"uploadchatphoto\" style=\"margin: -20px 0 0 315px; position: absolute;\" class=\"fa fa-camera fa-1\"></i>

<a href=\"/logout.php\" style=\" position: absolute; width:110px;\" class=\"submitbutton red\">Logout</a>

</div>";
}

  
?>

</div>



<div id="rightside">




<div class="wheelbox" style="height:175px">
<div id="openonlineusers" class="wheeltitle">News <i class="fa fa-minus fa-2"></i></div>

<?php   include 'includes/news.php'; ?>

</div>




<div class="wheelbox" style="height:300px">
<div id="openonlineusers" class="wheeltitle">Online <i class="fa fa-minus fa-2"></i></div>

<div id="onlineusers">

<?php   include 'ajax/online-users.php'; ?>

</div>

</div>



<?php




include 'includes/rooms.php';





if ($userid != "" && $thischatuseremail == ""){

echo "<div class=\"wheelbox\" style=\"height: 270px;\">
<div class=\"wheeltitle\">Register</div>
<form action=\"/ajax/update-user.php\" method=\"post\" enctype=\"multipart/form-data\">
Email: <input class=\"smallinput\" type=\"email\" name=\"newemail\" placeholder=\"Insert your email\"><br>
Username: <input class=\"smallinput\" type=\"text\" name=\"newusername\" placeholder=\"Username for login\" value=\"$username\" required pattern=\"[a-zA-Z]+\"><br>
Password: <input class=\"smallinput\" type=\"password\" name=\"newpassword\" placeholder=\"Insert a password\"><br>
Chat Name: <input class=\"smallinput\" type=\"text\" name=\"newscreenname\" value=\"$username\" placeholder=\"Name users will see\" required pattern=\"[a-zA-Z]+\"><br>
<input type=\"submit\" class=\"submitbutton green\" name=\"submit\" value=\"Register\" />
</form>
</div>";

} else {

}




if ($userid != "" && $thischatuseremail != ""){

echo "<div class=\"wheelbox\">
<div class=\"wheeltitle\" id=\"openaccount\">My Account <i class=\"fa fa-plus fa-2\"></i></div>
<form action=\"/ajax/update-user-info.php\" method=\"post\" enctype=\"multipart/form-data\">
Login: <b>$myusername</b> <br>
Chat Name: <input type=\"text\" name=\"upchatname\" class=\"smallinput\" value=\"$mychatname\" placeholder=\"Insert your new chatname\" required pattern=\"[a-zA-Z ]+\"><br>
Email: <input type=\"email\" name=\"upemail\" class=\"smallinput\" value=\"$thischatuseremail\" placeholder=\"Insert your email address\"><br>
<input type=\"submit\" class=\"submitbutton green\" name=\"submit\" value=\"Update Settings\" />
</form>


<form action=\"/ajax/upload-avatar.php\" method=\"post\" enctype=\"multipart/form-data\">
	Your Photo: <input class=\"custom-file-input\" type=\"file\" name=\"file\" size=\"25\" />
	<input type=\"submit\" class=\"submitbutton green\" name=\"submit\" value=\"Upload Photo\" />
</form>

<p>


</div>";

}





if ($useradmin == 1){

echo "<div class=\"wheelbox\">
<div class=\"wheeltitle\" id=\"openaccount\">ADMIN<i class=\"fa fa-plus fa-2\"></i></div>
<form action=\"/ajax/make-room.php\" method=\"post\" enctype=\"multipart/form-data\">
New Room: <input type=\"text\" name=\"name\" class=\"smallinput\" placeholder=\"Insert your new room name\" required><br>
Password: <input type=\"text\" name=\"password\" class=\"smallinput\" placeholder=\"Leave empty to make room public!\"><br>
<input type=\"submit\" class=\"submitbutton green\" name=\"submit\" value=\"Make Room\" />
</form>
<p>


<form action=\"/ajax/view-log.php\" method=\"post\" enctype=\"multipart/form-data\">
Date: <input type=\"text\" name=\"date\" class=\"smallinput\" placeholder=\"2014-07-30\" value=\"$date\" required><br>
<input type=\"submit\" class=\"submitbutton green\" name=\"submit\" value=\"View Logs\" />
</form>

</div>";

} else {

}




?>


</div>
  
</div>
