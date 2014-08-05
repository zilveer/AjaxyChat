<?php
// AJAXY CHAT
// PROGRAMMED BY: Hunter Long
// GPL LICENSE - Please push updates to github!
// https://github.com/Hunterlong/AjaxyChat





include '../db.php';

session_start();

$fromuser = $_SESSION['userid'];


$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if (in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";


      move_uploaded_file($_FILES["file"]["tmp_name"], "../images/uploads/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "/images/uploads/" . $_FILES["file"]["name"];

$mynewavatar = '/images/uploads/' . $_FILES["file"]["name"];


$result = mysql_query("UPDATE users SET avatar='$mynewavatar' WHERE id='$fromuser'") or die(mysql_error());  

Header("Location: http://www.teensupportchat.com/new.php");




  }
} else {
  echo "Invalid file extension: $extension. Please use jpg or png.";
}
?>
