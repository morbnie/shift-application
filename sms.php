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


?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Send SMS:</div>
							<div id="hovedtekst" class="hovedtekst">
							<?


if ($user[board] != 0) {
if($_GET[post] == "true") {

$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$text = $_POST[text];
$sendto = $_POST[sendto];


// The neccesary variables are set.
$url = "https://www.cpsms.dk/sms/";
$url .= "?message=" . urlencode($text);


if($sendto == "all") {

$query_phone = mysql_query("SELECT * FROM users WHERE phone <> '' AND (status = '2' OR status = '3') ORDER BY id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$url .= "&recipient[]=".$show_phone[phone_prefix]."".$show_phone[phone].""; // Recipient

}

}elseif($sendto == "active"){

$query_phone = mysql_query("SELECT * FROM users WHERE phone <> '' AND status = '2' ORDER BY id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$url .= "&recipient[]=".$show_phone[phone_prefix]."".$show_phone[phone].""; // Recipient

}

}elseif($sendto == "passive"){
	
$query_phone = mysql_query("SELECT * FROM users WHERE phone <> '' AND status = '3' ORDER BY id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$url .= "&recipient[]=".$show_phone[phone_prefix]."".$show_phone[phone].""; // Recipient

}
	
}elseif($sendto == "anchors"){
	
$query_phone = mysql_query("SELECT * FROM users WHERE phone <> '' AND anchor = '1' ORDER BY id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$url .= "&recipient[]=".$show_phone[phone_prefix]."".$show_phone[phone].""; // Recipient

}
	
}elseif($sendto == "board"){
	
$query_phone = mysql_query("SELECT * FROM users WHERE phone <> '' AND board <> '' ORDER BY id") or die(mysql_error());
while($show_phone = mysql_fetch_array($query_phone)) {

$url .= "&recipient[]=".$show_phone[phone_prefix]."".$show_phone[phone].""; // Recipient

}

}


$url .= "&username=******"; // Username
$url .= "&password=*****"; // Password
$url .= "&from=" . urlencode("******"); // Sendername

// The url is opened
$reply = file_get_contents($url);
if(strstr($reply, "<succes>")) {
// If the reply contains the tag <succes> the SMS has been sent.
echo "The message has been sent. Server response: ".$reply;
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

echo '<meta http-equiv="refresh" content="2; url=index.php" />';

} else {
// If not, there has been an error.
echo "The message has NOT been sent. Server response: ".$reply;
}


//$sql="INSERT INTO tender_update (`id`, `title`, `text`, `by`, `date`) VALUES ('', '$title', '$text', '$show_tender[id]', CURRENT_TIMESTAMP)";


//$result=mysql_query($sql);

?>
<?
$text = addslashes($text);

}else{
?>


							
                        <form action="?post=true" method="post">
<p>
<label for="email">Text:</label><textarea rows="20" cols="60" name="text" onkeyup="countChar(this)"></textarea>
<br><i>Pr. 160 characters pr. person the price for sending out is 0,3kr</i>
<br>Characters (max. 459 characters pr. SMS!): <div id="charNum" style="font-weight: bold;"></div>
<br>
Send to: <select name="sendto">
<option value="all">All</option>
<option value="active">Active Members</option>
<option value="passive">Passive Members</option>
<option value="anchors">Anchors</option>
<option value="board">Board</option>
</select>
<br><br>
<label for="email">&nbsp;</label><input type="submit" value="Submit">					</form>		
							


<?
}
}
?>							</div>
			</div>
            <?
			include 'bottom.php';
			?>
			
			
<?
}
?>