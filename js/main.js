


$(window).on("blur focus", function(e) {
    var prevType = $(this).data("prevType");

    if (prevType != e.type) {   //  reduce double fire issues
        switch (e.type) {
            case "blur":
                // do work

                break;
            case "focus":
                // do work

                break;
        }
    }

    $(this).data("prevType", e.type);
})






$(document).ready(function(){



var lastTime = (new Date()).getTime();

setInterval(function(){
var roomid = $("#roomid").attr("value");
var dataString = 'roomid='+roomid;
    $.ajax({
       type: "POST",
       url: "/ajax/check-new-chat.php",
       data: dataString,
       success: function(html){
if (html){
$(".chatter_convo").append(html);
$(".chatter_convo").animate({ scrollTop: $('.chatter_convo')[0].scrollHeight}, 1000);
$('ul li:first').remove();

//$(".chatter_convo span:first-child").remove();

}
       }
});

}, 700);





setInterval(function(){
    $.ajax({
       type: "POST",
       url: "/ajax/online-users.php",
       success: function(html){
$("#onlineusers").html(html);
       }
});

}, 100000);


$(".chatter_convo").animate({ scrollTop: $('.chatter_convo')[0].scrollHeight}, 1000);




$("#chatinput").keypress(function(e){
  if(e.keyCode == 13 && !e.shiftKey) {
   e.preventDefault();
   
var roomid = $("#roomid").attr("value");

var chatmessage = $(this).attr("value");

var dataString = 'chat=' +chatmessage+'&roomid='+roomid;

    $.ajax({
       type: "POST",
       url: "/ajax/insert-chat.php",
       data: dataString,
       success: function(html){
       }
});

$("#chatinput").val('');

  }
});




 $("#sendchatbutton").live("click", function () {
   
var roomid = $("#roomid").attr("value");

var chatmessage = $("#chatinput").attr("value");

var dataString = 'chat=' +chatmessage+'&roomid='+roomid;

    $.ajax({
       type: "POST",
       url: "/ajax/insert-chat.php",
       data: dataString,
       success: function(html){
       }
});

$("#chatinput").val('');

});




$(".chatter_avatar IMG").live("click", function () {

var username = $(this).attr("data-id");

$("#chatinput").val('@'+username+' ');

$("#chatinput").focus();

});






$("#usernamechatinput").keypress(function(e){
  if(e.keyCode == 13 && !e.shiftKey) {
   e.preventDefault();
   
var name= $(this).attr("value");

var dataString = 'name=' +name;

    $.ajax({
       type: "POST",
       url: "/ajax/new-user.php",
       data: dataString,
       success: function(html){
if (html=="0"){
location.reload();
} else {
$("#loginpassinput").fadeIn('fast');
}
       }
});


  }
});





$("#loginpassinput").keypress(function(e){
  if(e.keyCode == 13 && !e.shiftKey) {
   e.preventDefault();
   
var name= $("#usernamechatinput").attr("value");
var pass= $(this).attr("value");

var dataString = 'username=' +name+ '&password='+pass;

    $.ajax({
       type: "POST",
       url: "/ajax/login.php",
       data: dataString,
       success: function(html){
if (html=="1"){
location.reload();
} else {
$("#loginpassinput").fadeIn('fast');
alert('Incorrect Login Information, Try Again');
}
       }
});


  }
});




onlineopen = 1;
 $("#openonlineusers").live("click", function () {
if (onlineopen==1){
$(this).closest(".wheelbox").css("height", "35px");
$("#openonlineusers I").attr('class', 'fa fa-plus fa-2');
onlineopen=0;
} else {
$(this).closest(".wheelbox").css("height", "300px");
$("#openonlineusers I").attr('class', 'fa fa-minus fa-2');
onlineopen=1;
}
return false;  
   });




accountopen = 0;
 $("#openaccount").live("click", function () {
if (accountopen ==1){
$(this).closest(".wheelbox").css("height", "35px");
$("#openaccount I").attr('class', 'fa fa-plus fa-2');
accountopen=0;
} else {
$(this).closest(".wheelbox").css("height", "350px");
$("#openaccount I").attr('class', 'fa fa-minus fa-2');
accountopen=1;
}
return false;  
   });


















 $("#gotoroom").live("click", function () {
var dataid = $(this).attr("data-id");
var datapass = $(this).attr("data-pass");
auth = 1;

$("#roomid").val(dataid);


if (datapass == 1){
    var passconfirm = prompt("Please enter password for this room:", "");
    
    if (passconfirm != null) {

var dataString = 'roomid='+dataid+'&roompass='+passconfirm;
    $.ajax({
       type: "POST",
       url: "/ajax/verify-room.php",
       data: dataString,
       success: function(html){
if (html == 1){
var dataStringnn = 'roomid=' +dataid;

    $.ajax({
       type: "POST",
       url: "/ajax/goto-room.php",
       data: dataStringnn,
       success: function(htmlnn){
$(".chatter_convo").html(htmlnn);
       }
});
} else {
alert("Incorrect Password");
}
       }
});

    }

} else {

var dataString = 'roomid=' +dataid;

    $.ajax({
       type: "POST",
       url: "/ajax/goto-room.php",
       data: dataString,
       success: function(html){
$(".chatter_convo").html(html);
       }
});

}

return false;  
   });




 $("#banuser").live("click", function () {
var username = $(this).attr("data-uname");
var userid = $(this).attr("data-id");
var r = prompt("How many DAYS to BAN : "+username);
if (r != null) {
var dataString = "userid="+userid+"&t="+r;
    $.ajax({
       type: "POST",
       url: "/ajax/ban-user.php",
       data: dataString,
       success: function(html){
alert("This user will be BANNED for: "+r+" Days");
       }
});
} else {
}
return false;  
   });



 $("#kickuser").live("click", function () {
var username = $(this).attr("data-uname");
var userid = $(this).attr("data-id");
var r = prompt("How many MINUTES to KICK user: "+username);
if (r != null) {
var dataString = "userid="+userid+"&t="+r;
    $.ajax({
       type: "POST",
       url: "/ajax/kick-user.php",
       data: dataString,
       success: function(html){
alert("This user will be BANNED for: "+r+" Days");
       }
	});

} else {
    x = "You pressed Cancel!";
}
return false;  
   });













});