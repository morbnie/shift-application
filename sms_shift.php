<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{

?>

    <script src="http://code.jquery.com/jquery-1.5.js"></script>
    <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 460) {
          val.value = val.value.substring(0, 460);
        } else {
          $('#charNum').text(len);
        }
      };
    </script>


<?
include 'top.php';
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id_shift_tender = mysql_query("SELECT * FROM shift WHERE event = '$_GET[event]' AND tender = '$show_tender[id]' AND anchor = '1' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);


if ($user[board] != 0 OR $show_shift_tender[anchor] == 1) {

$query_id_news = mysql_query("SELECT * FROM events WHERE id = '$_GET[event]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);

if($show_news[id] == true) {

if($_GET[type] == "open" OR $_GET[type] == "close" OR $_GET[type] == "both") {

?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Send SMS:</div>
							<div id="hovedtekst" class="hovedtekst">
							<?



if($_GET[post] == "true") {
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$text = $_POST[text];
$sendto = $_GET[type];

// The neccesary variables are set.
$url = "https://www.cpsms.dk/sms/";
$url .= "?message=" . urlencode($text);


if($sendto == "open") {

$query_phone = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone <> '' AND b.event = '$_GET[event]' AND b.opening = '1' ORDER BY b.id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$query_show_phone2 = mysql_query("SELECT * FROM users WHERE id = '$show_phone[tender]' ORDER BY id DESC") or die(mysql_error());
$show_phone2 = mysql_fetch_array($query_show_phone2);


$url .= "&recipient[]=".$show_phone2[phone_prefix]."".$show_phone2[phone].""; // Recipient

}

}elseif($sendto == "close"){

$query_phone = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone <> '' AND b.event = '$_GET[event]' AND b.closing = '1' ORDER BY b.id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$query_show_phone2 = mysql_query("SELECT * FROM users WHERE id = '$show_phone[tender]' ORDER BY id DESC") or die(mysql_error());
$show_phone2 = mysql_fetch_array($query_show_phone2);


$url .= "&recipient[]=".$show_phone2[phone_prefix]."".$show_phone2[phone].""; // Recipient

}

}elseif($sendto == "both"){
	
$query_phone = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone <> '' AND b.event = '$_GET[event]' AND (b.opening = '1' OR b.closing = '1') ORDER BY b.id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$query_show_phone2 = mysql_query("SELECT * FROM users WHERE id = '$show_phone[tender]' ORDER BY id DESC") or die(mysql_error());
$show_phone2 = mysql_fetch_array($query_show_phone2);


$url .= "&recipient[]=".$show_phone2[phone_prefix]."".$show_phone2[phone].""; // Recipient

}
	
}


$url .= "&username=****"; // Username
$url .= "&password=*****"; // Password
$url .= "&from=" . urlencode("*****"); // Sendername


// The url is opened
$reply = file_get_contents($url);
if(strstr($reply, "<succes>")) {
// If the reply contains the tag <succes> the SMS has been sent.
echo "The message has been sent. Server response: ".$reply;
} else {
// If not, there has been an error.
echo "The message has NOT been sent. Server response: ".$reply;
}


//$sql="INSERT INTO tender_update (`id`, `title`, `text`, `by`, `date`) VALUES ('', '$title', '$text', '$show_tender[id]', CURRENT_TIMESTAMP)";


//$result=mysql_query($sql);
//echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

//echo '<meta http-equiv="refresh" content="0; url=index.php" />';
?>
<?
$text = addslashes($text);

}else{
?>

You are about to send out an SMS to 
<?
if($_GET[type] == "open") {
echo "the opening team";
}elseif($_GET[type] == "open") {
echo "the closing team";
}elseif($_GET[type] == "open") {
echo "both team";
}
?>
<br>Event: <? echo $show_news[titel]; ?> (	<?
	$timestamp = strtotime($show_news[dato]);
	print date("d M. y", $timestamp);
	?>)
	<br><br>

<b>This SMS will be sent to:</b><br>

<?
if($_GET[type] == "open") {

$query_id_news4 = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone <> '' AND b.event = '$_GET[event]' AND b.opening = '1' ORDER BY b.id") or die(mysql_error());
$num = mysql_num_rows($query_id_news4);
while ($show_news4= mysql_fetch_array($query_id_news4)) {


$query_id_news5 = mysql_query("SELECT * FROM users WHERE id = '$show_news4[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news5 = mysql_fetch_array($query_id_news5);

echo $show_news5[name];
echo "<br>";

}
}elseif($_GET[type] == "close") {

$query_id_news4 = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone <> '' AND b.event = '$_GET[event]' AND b.closing = '1' ORDER BY b.id") or die(mysql_error());
$num = mysql_num_rows($query_id_news4);
while ($show_news4= mysql_fetch_array($query_id_news4)) {



$query_id_news5 = mysql_query("SELECT * FROM users WHERE id = '$show_news4[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news5 = mysql_fetch_array($query_id_news5);

echo $show_news5[name];
echo "<br>";

}
}elseif($_GET[type] == "both") {

$query_id_news4 = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone <> '' AND b.event = '$_GET[event]' AND (b.closing = '1' OR b.opening = '1') ORDER BY b.id") or die(mysql_error());
$num = mysql_num_rows($query_id_news4);
while ($show_news4= mysql_fetch_array($query_id_news4)) {



$query_id_news5 = mysql_query("SELECT * FROM users WHERE id = '$show_news4[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news5 = mysql_fetch_array($query_id_news5);

echo $show_news5[name];
echo "<br>";

}
}
?>

<br>
<b>This SMS will <u>NOT</u> be sent to (because we don't have their number):</b><br>

<?
if($_GET[type] == "open") {

$query_id_news6 = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone = '' AND b.event = '$_GET[event]' AND b.opening = '1' ORDER BY b.id") or die(mysql_error());
while ($show_news6= mysql_fetch_array($query_id_news6)) {


$query_id_news7 = mysql_query("SELECT * FROM users WHERE id = '$show_news6[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news7 = mysql_fetch_array($query_id_news7);

echo $show_news7[name];
echo "<br>";

}
}elseif($_GET[type] == "close") {

$query_id_news6 = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone = '' AND b.event = '$_GET[event]' AND b.closing = '1' ORDER BY b.id") or die(mysql_error());
while ($show_news6= mysql_fetch_array($query_id_news6)) {



$query_id_news7 = mysql_query("SELECT * FROM users WHERE id = '$show_news6[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news7 = mysql_fetch_array($query_id_news7);

echo $show_news7[name];
echo "<br>";

}
}elseif($_GET[type] == "both") {

$query_id_news6 = mysql_query("SELECT * FROM users AS t JOIN shift AS b on t.id = b.tender WHERE t.phone = '' AND b.event = '$_GET[event]' AND (b.closing = '1' OR b.opening = '1') ORDER BY b.id") or die(mysql_error());
while ($show_news6= mysql_fetch_array($query_id_news6)) {



$query_id_news7 = mysql_query("SELECT * FROM users WHERE id = '$show_news6[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news7 = mysql_fetch_array($query_id_news7);

echo $show_news7[name];
echo "<br>";

}
}
?>




<br>
							
                        <form action="?event=<? echo $_GET[event]; ?>&type=<? echo $_GET[type]; ?>&post=true" method="post">
<p>
<label for="email">Text:</label><textarea rows="20" cols="60" name="text" onkeyup="countChar(this)"></textarea>
<br><i>Pr. 160 characters pr. person the price for sending out is 0,3kr</i>
<br>Characters (max. 459 characters pr. SMS!): <div id="charNum" style="font-weight: bold;"></div>


<br><br>
This SMS will be send out to 
<?
echo $num;
?> people
<br>
<label for="email">&nbsp;</label><input type="submit" value="Submit">					</form>		
							


<?
}
?>							</div>
			</div>
            <?
			}
			}
			}
			include 'bottom.php';
			?>
			
			
<?
}
?>