<?php



function UserKicked($userid){

$qryuser = mysql_query("SELECT * FROM users WHERE id='$userid'") or die (mysql_error());
$usergetarray = mysql_fetch_array($qryuser);
$thisuserkicked = $usergetarray['kick'];
$thisuserbanned = $usergetarray['ban'];

$time = time();
$left = $time - $thisuserkicked;

if ($left < 0){
return true;
} else {
return false;
}


}






function makeLink($string){

/*** make sure there is an http:// on all URLs ***/
$string = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i", "$1http://$2",$string);
/*** make all URLs links ***/
$string = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<a target=\"_blank\" href=\"$1\">$1</A>",$string);
/*** make all emails hot links ***/
$string = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<A HREF=\"mailto:$1\">$1</A>",$string);

return $string;
}




function emoticons($text) {
    $icons = array(
        ':)'    =>  '<img src="/images/emo/bigsmile.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        'xD'    =>  '<img src="http://i.4cdn.org/wsg/1396494184624.gif" style="width:200px;height:125px;margin:0px 0 -5px 0;" />',
        'XD'    =>  '<img src="http://i.4cdn.org/wsg/1396494184624.gif" style="width:200px;height:125px;margin:0px 0 -5px 0;" />',
        ':O'   =>  '<img src="/images/emo/oh.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':/'    =>  '<img src="/images/emo/frown.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':('    =>  '<img src="/images/emo/crysad.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':D'    =>  '<img src="/images/emo/extremesmile.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':*'    =>  '<img src="/images/emo/kiss.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':Q'    =>  '<img src="/images/emo/smoke.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':s'    =>  '<img src="/images/emo/sface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':S'    =>  '<img src="/images/emo/sface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        'O.O'    =>  '<img src="/images/emo/wtfface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        'o.o'    =>  '<img src="/images/emo/wtfface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        'O.o'    =>  '<img src="/images/emo/wtfface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        'o.O'    =>  '<img src="/images/emo/wtfface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        '0.0'    =>  '<img src="/images/emo/wtfface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':c'    =>  '<img src="/images/emo/cutecface.png" style="width:30px;height:30px;margin:0px 0 -5px 0;" />',
        ':---'    =>  '<img src="/images/emo/gag.gif" style="width:90px;height:65px;margin:0px 0 -5px 0;" />',
    );

    foreach ($icons as $search => $replace)
        $text = preg_replace("#(?<=\s|^)" . preg_quote($search) . "#", $replace, $text);

    return $text;
}





function strip_html_tags( $text )
{
    $text = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
          // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $text );
    return strip_tags( $text );
}



function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] 'ago' ";
}



?>