<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{

?>


<?
include 'top.php';

$query_a = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id") or die(mysql_error());
$show_anchor = mysql_fetch_array($query_a);

if($_GET[action] == "assign_tender") {
if($_GET[id] != "") {

$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id_shift_tender = mysql_query("SELECT * FROM shift WHERE event = '$_GET[id]' AND tender = '$show_tender[id]' AND anchor = '1' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);


if ($user[board] != 0 OR $show_shift_tender[anchor] == 1) {

if($_GET[post] == "true") {








$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id3 = mysql_query("SELECT * FROM events WHERE id = '$_GET[id]' ORDER BY id") or die(mysql_error());
$show_tender3 = mysql_fetch_array($query_id3);

if($_POST[anchor] == "1") {
$anchor = 1;
}else{
$anchor = 0;
}

if($_POST[opening] == "1") {
$opening = 1;
}else{
$opening = 0;
}

if($_POST[closing] == "1") {
$closing = 1;
}else{
$closing = 0;
}



if($_POST['hour'] < 10){
$hour = '0' . $_POST['hour'];
}else{
$hour = $_POST['hour'];
}
if($_POST['minut'] < 10){
$minut = '0' . $_POST['minut'];
}else{
$minut = $_POST['minut'];
}
if($_POST['ehour'] < 10){
$ehour = '0' . $_POST['ehour'];
}else{
$ehour = $_POST['ehour'];
}
if($_POST['eminut'] < 10){
$eminut = '0' . $_POST['eminut'];
}else{
$eminut = $_POST['eminut'];
}
$from = $show_tender3[dato] . ' ' . $hour.':'.$minut.':00';
$to = $show_tender3[dato] . ' ' . $ehour.':'.$eminut.':00';


$sql="INSERT INTO shift (`id`, `event`, `tender`, `anchor`, `opening`, `closing`, `trade`, `tender_start`, `tender_end`) VALUES ('', '$_GET[id]', '$_POST[tender]', '$anchor', '$opening', '$closing', '0', '$from', '$to')";


$result=mysql_query($sql);


echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';










}else{

?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Assign tender:</div>
							<div id="hovedtekst" class="hovedtekst">
							
<form action="?action=assign_tender&id=<? echo $_GET[id]; ?>&post=true" method="post">
						
						
						
						
						<p><label for="email">Tender:</label> <select name="tender">
<?
$query_id = mysql_query("SELECT * FROM users WHERE status = 2 OR status = 3 ORDER BY firstname") or die(mysql_error());
while ($show_tender= mysql_fetch_array($query_id)) {
?>
  <option value="<? echo $show_tender[id]; ?>"><? echo $show_tender[firstname]; ?> <? echo $show_tender[lastname]; ?></option>
<?
}
?>
</select>
						
						
<p><label for="email">Anchor:</label> <input type="checkbox" name="anchor" style="
    width: inherit;
" value="1"><br>
<p><label for="email">Opening:</label> <input type="checkbox" name="opening" style="
    width: inherit;
" value="1"><br>
<p><label for="email">Closing:</label> <input type="checkbox" name="closing" style="
    width: inherit;
" value="1"><br>


<p><label for="email">From:</label> 
<?

    // build hour menu
    echo '<select name="hour">' . PHP_EOL;
    for ($h=12; $h<=23; $h++) {
        echo '  <option value="' . $h . '" ';	
echo	'>' . $h . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
	echo ':';
    // build minut menu
    echo '<select name="minut">' . PHP_EOL;
    for ($mi=0; $mi<=59; $mi++) {
        echo '  <option value="' . $mi . '" ';
echo	'>' . $mi . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>
<p><label for="email">To:</label> 
<?

    // build hour menu
    echo '<select name="ehour">' . PHP_EOL;
    for ($th=14; $th<=23; $th++) {
        echo '  <option value="' . $th . '" ';
echo	'>' . $th . '</option>';
		}

		    for ($th1=0; $th1<=4; $th1++) {
        echo '  <option value="' . $th1 . '" ';
echo	'>' . $th1 . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
	echo ':';
    // build minut menu
    echo '<select name="eminut">' . PHP_EOL;
    for ($tmi=0; $tmi<=59; $tmi++) {
        echo '  <option value="' . $tmi . '" ';
echo	'>' . $tmi . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>










<br>
<label for="email">&nbsp;</label><input type="submit" value="Submit">					</form>	
						
													</div>
			</div>

<?



}
}
}
}else{




if($_GET[action] == "edit_shift") {
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id1 = mysql_query("SELECT * FROM shift WHERE event = '$show_anchor[event]' AND tender = '$show_tender[id]' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);

if ($user[board] != 0 OR $show_tender1[anchor] == 1) {
if($_GET[id] != "") {
if($_GET[post] == "true") {


$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id2 = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id") or die(mysql_error());
$show_tender2 = mysql_fetch_array($query_id2);

$query_id3 = mysql_query("SELECT * FROM events WHERE id = '$show_tender2[event]' ORDER BY id") or die(mysql_error());
$show_tender3 = mysql_fetch_array($query_id3);

if($_POST[anchor] == "1") {
$anchor = 1;
}else{
$anchor = 0;
}

if($_POST[opening] == "1") {
$opening = 1;
}else{
$opening = 0;
}

if($_POST[closing] == "1") {
$closing = 1;
}else{
$closing = 0;
}



if($_POST['hour'] < 10){
$hour = '0' . $_POST['hour'];
}else{
$hour = $_POST['hour'];
}
if($_POST['minut'] < 10){
$minut = '0' . $_POST['minut'];
}else{
$minut = $_POST['minut'];
}
if($_POST['ehour'] < 10){
$ehour = '0' . $_POST['ehour'];
}else{
$ehour = $_POST['ehour'];
}
if($_POST['eminut'] < 10){
$eminut = '0' . $_POST['eminut'];
}else{
$eminut = $_POST['eminut'];
}
$from = $show_tender3[dato] . ' ' . $hour.':'.$minut.':00';
$to = $show_tender3[dato] . ' ' . $ehour.':'.$eminut.':00';

$query_id_news = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);

$query_id_news_tender = mysql_query("SELECT * FROM users WHERE id = '$show_news[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news_tender = mysql_fetch_array($query_id_news_tender);


$validUser1 = $_SESSION[myusername];
$query_id1 = mysql_query("SELECT * FROM users WHERE username = '$validUser1' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);


$sql="INSERT INTO trade_log (id, old_v, new_v, dato, event, changed_by, comment) VALUES ('', '$show_news_tender[id]', '$_POST[tender]', now(), '$show_news[event]', '$show_tender1[id]', '[admin] changed by edit shift.')";
$result=mysql_query($sql);


mysql_query("UPDATE shift SET tender = '$_POST[tender]', anchor = '$anchor', opening = '$opening', closing = '$closing', tender_start = '$from', tender_end = '$to' WHERE id = '$_GET[id]'");



echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';

}else{

$query_id_news = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Edit shift:</div>
							<div id="hovedtekst" class="hovedtekst">
							
                        <form action="?action=edit_shift&id=<? echo $_GET[id]; ?>&post=true" method="post">
						
						
						
						
						<p><label for="email">Tender:</label> <select name="tender">
<?
$query_id = mysql_query("SELECT * FROM users WHERE status = 2 OR status = 3 ORDER BY firstname") or die(mysql_error());
while ($show_tender= mysql_fetch_array($query_id)) {
?>
  <option value="<? echo $show_tender[id]; ?>" <? if($show_news[tender] == $show_tender[id]) {
  echo " selected";
  }
  ?>><? echo $show_tender[firstname]; ?> <? echo $show_tender[lastname]; ?></option>
<?
}
?>
</select>
						
						
<p><label for="email">Anchor:</label> <input type="checkbox" name="anchor" style="
    width: inherit;
" value="1"
<?
if($show_news[anchor] == "1") {
echo " checked";
}
?>
><br>
<p><label for="email">Opening:</label> <input type="checkbox" name="opening" style="
    width: inherit;
" value="1"
<?
if($show_news[opening] == "1") {
echo " checked";
}
?>
><br>
<p><label for="email">Closing:</label> <input type="checkbox" name="closing" style="
    width: inherit;
" value="1"
<?
if($show_news[closing] == "1") {
echo " checked";
}
?>
><br>


<p><label for="email">From:</label> 
<?
$timefrom = strtotime($show_news[tender_start]);

$hour_from = date("H", $timefrom);
$minut_from = date("i", $timefrom);

    // build hour menu
    echo '<select name="hour">' . PHP_EOL;
    for ($h=0; $h<=23; $h++) {
        echo '  <option value="' . $h . '" ';
		if($hour_from == $h) {
echo ' selected';
}	
echo	'>' . $h . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
	echo ':';
    // build minut menu
    echo '<select name="minut">' . PHP_EOL;
    for ($mi=0; $mi<=59; $mi++) {
        echo '  <option value="' . $mi . '" ';
		if($minut_from == $mi) {
echo ' selected';
}	
echo	'>' . $mi . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>
<p><label for="email">To:</label> 
<?
$timeto = strtotime($show_news[tender_end]);

$hour_to = date("H", $timeto);
$minut_to = date("i", $timeto);
    // build hour menu
    echo '<select name="ehour">' . PHP_EOL;
    for ($th=14; $th<=23; $th++) {
        echo '  <option value="' . $th . '" ';
		if($hour_to == $th) {
echo ' selected';
}	
echo	'>' . $th . '</option>';
		}

		    for ($th1=0; $th1<=4; $th1++) {
        echo '  <option value="' . $th1 . '" ';
		if($hour_to == $th1) {
echo ' selected';
}	
echo	'>' . $th1 . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
	echo ':';
    // build minut menu
    echo '<select name="eminut">' . PHP_EOL;
    for ($tmi=0; $tmi<=59; $tmi++) {
        echo '  <option value="' . $tmi . '" ';
		if($minut_to == $tmi) {
echo ' selected';
}	
echo	'>' . $tmi . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>










<br>
<label for="email">&nbsp;</label><input type="submit" value="Submit">					</form>		
							
							</div>
			</div>

<?
}
}
}
}else{


















if($_GET[action] == "delete_shift") {
if($_GET[id] != "") {
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id1 = mysql_query("SELECT * FROM shift WHERE event = '$show_anchor[event]' AND tender = '$show_tender[id]' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);

if ($user[board] != 0 OR $show_tender1[anchor] == 1) {
if($_GET[post] == "true") {

$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id1 = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);

$sql="INSERT INTO trade_log (id, old_v, new_v, dato, event, changed_by, comment) VALUES ('', '$show_tender1[tender]', '', now(), '$show_tender1[event]', '$show_tender[id]', '[admin] deleted shift.')";
$result=mysql_query($sql);

mysql_query("DELETE FROM shift WHERE id = '$_GET[id]'") or die(mysql_error());
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';

?>


<?
}else{
?>



			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Do you want to delete this shift?:</div>
							<div id="hovedtekst" class="hovedtekst">
							<?
							$query_id_shift_tender = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);

							$query_id_shift_tender2 = mysql_query("SELECT * FROM users WHERE id = '$show_shift_tender[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender2 = mysql_fetch_array($query_id_shift_tender2);

							$query_id_shift_tender3 = mysql_query("SELECT * FROM events WHERE id = '$show_shift_tender[event]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender3 = mysql_fetch_array($query_id_shift_tender3);
?>
							
							You are about to delete the following shift:
							<br>Tender: <? echo $show_shift_tender2[firstname]; ?> <? echo $show_shift_tender2[lastname]; ?>
							<br>Event: <? echo $show_shift_tender3[titel]; ?>
							<br>
							From: <?
$timestamp = strtotime($show_shift_tender[tender_start]);
echo date("H:i", $timestamp);
?>
<br>To: 
<?
$timestamp = strtotime($show_shift_tender[tender_end]);
echo date("H:i", $timestamp);
?>
							
							
<br><br>
Do you want to delete?<br>							
							
                        <form action="?action=delete_shift&id=<? echo $_GET[id]; ?>&post=true" method="post">

<label for="email">&nbsp;</label><input type="submit" value="Yes">					</form>		
							
							</div>
			</div>



<?
}
}
}
}else{


if($_GET[action] == "edit_tender") {
if($_GET[id] != "") {
if($_GET[post] == "true") {
$query_id_news = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);

$query_id_news_tender = mysql_query("SELECT * FROM users WHERE id = '$show_news[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news_tender = mysql_fetch_array($query_id_news_tender);


$validUser1 = $_SESSION[myusername];
$query_id1 = mysql_query("SELECT * FROM users WHERE username = '$validUser1' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);


$sql="INSERT INTO trade_log (id, old_v, new_v, dato, event, changed_by, comment) VALUES ('', '$show_news_tender[id]', '$_POST[tender]', now(), '$show_news[event]', '$show_tender1[id]', 'Change tender function')";
$result=mysql_query($sql);

mysql_query("UPDATE shift SET tender = '$_POST[tender]' WHERE id = '$_GET[id]'");



echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';



}else{
$query_id_news = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);

$query_id_news_tender = mysql_query("SELECT * FROM users WHERE id = '$show_news[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news_tender = mysql_fetch_array($query_id_news_tender);
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Edit shift:</div>
							<div id="hovedtekst" class="hovedtekst">
							
                        <form action="?action=edit_tender&id=<? echo $_GET[id]; ?>&post=true" method="post">
						
						
						<p><label for="email">Old tender:</label> <? echo $show_news_tender[name]; ?>
						
						<br>
						
						<p><label for="email">New tender:</label> <select name="tender">
<?
$query_id = mysql_query("SELECT * FROM users WHERE status = 2 OR status = 3 ORDER BY firstname") or die(mysql_error());
while ($show_tender= mysql_fetch_array($query_id)) {
$validUser1 = $_SESSION[myusername];
$query_id1 = mysql_query("SELECT * FROM users WHERE username = '$validUser1' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);
?>
  <option value="<? echo $show_tender[id]; ?>" <? if($show_tender[id] == $show_tender1[id]) {
  echo " selected";
  }
  ?>><? echo $show_tender[firstname]; ?> <? echo $show_tender[lastname]; ?></option>
<?
}
?>
</select><br>

<label for="email">&nbsp;</label><input type="submit" value="Yes">					</form>		
							
							</div>
			</div>


<?
}
}
}else{

if($_GET[action] == "free") {
if($_GET[id] != "") {

$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id_shift_tender = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);

if($show_shift_tender[tender] == $show_tender[id]) {
if($_GET[post] == "true") {

mysql_query("UPDATE shift SET trade = '1' WHERE id = '$_GET[id]'");
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';




?>


<?
}else{
?>





			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Don't want this shift?:</div>
							<div id="hovedtekst" class="hovedtekst">
							
							
							This function will set your shift free for trade. It doesn't guarantee that you will get rid of your shift, but it shows the other tenders that you want to get rid of it.<br>
							If another tender chooses to take your shift you will be unassigned from it. In case of another tenders takes your shift you will be notified by e-mail.
<br><br>
Do you wish to set your shift free for trade?<br>							
							
                        <form action="?action=free&id=<? echo $_GET[id]; ?>&post=true" method="post">

<label for="email">&nbsp;</label><input type="submit" value="Yes">					</form>		
							
							</div>
			</div>



<?
}
}
}
}else{
?>
<?
if($_GET[action] == "take_back") {
if($_GET[id] != "") {

$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id_shift_tender = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);

if($show_shift_tender[tender] == $show_tender[id]) {


mysql_query("UPDATE shift SET trade = '0' WHERE id = '$_GET[id]'");
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';




?>


<?
}
}
}else{
?>


<?
if($_GET[action] == "next") {
if($_GET[post] == "true") {

$query_id_news = mysql_query("SELECT * FROM shift WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);

$query_id_event = mysql_query("SELECT * FROM events WHERE id = '$show_news[event]' ORDER BY id DESC") or die(mysql_error());
$show_event = mysql_fetch_array($query_id_event);

$query_id_news_tender = mysql_query("SELECT * FROM users WHERE id = '$show_news[tender]' ORDER BY id DESC") or die(mysql_error());
$show_news_tender = mysql_fetch_array($query_id_news_tender);


$validUser1 = $_SESSION[myusername];
$query_id1 = mysql_query("SELECT * FROM users WHERE username = '$validUser1' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);


$sort_date = date("Y").date("m").date("d");

if($show_news[trade] == "1"){
if($show_event[dato] >= '$sort_date'){




$email = $show_news_tender[email];
$name = $show_news_tender[name];

$timestamp = strtotime($show_event[dato]);
$event_date = date("d M. y", $timestamp);

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.*****.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = '';                 // SMTP username
//$mail->Password = '';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'noreply@*******.dk';
$mail->FromName = '******* - Shift Update';
$mail->addAddress($email, $name);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Your shift has been taken';
$mail->Body    = 'Hello '.$name.',<br><br>'.$show_tender1[name].' has taken your shift on '.$event_date.'.<br>You do therefore not have this shift anymore.<br><br>***** Loves You';
$mail->AltBody = 'Hello $name,\n\n'.$show_tender1[name].' has taken your shift on '.$event_date.'\n.You do therefore not have this shift anymore.\n\***** Loves You';


if(!$mail->send()) {
//    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {

$sql="INSERT INTO trade_log (id, old_v, new_v, dato, event, changed_by, comment) VALUES ('', '$show_news_tender[id]', '$show_tender1[id]', now(), '$show_news[event]', '$show_tender1[id]', 'Up for grabs function')";
$result=mysql_query($sql);

mysql_query("UPDATE shift SET tender = '$show_tender1[id]', trade = '0' WHERE id = '$_GET[id]'");


echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';
}

}
}
}else{
?>
<?
if($_GET[show] == "all") {


$sort_date = date("Y").date("m").date("d");

					//$query_n = mysql_query("SELECT * FROM shift WHERE trade = 1 ORDER BY id DESC") or die(mysql_error());
					
					$query_n = mysql_query("SELECT * FROM events AS t JOIN shift AS b on t.id = b.event WHERE t.dato >= $sort_date AND b.trade = 1 ORDER BY b.tender_start") or die(mysql_error());
					$num = mysql_num_rows($query_n); 
					?>
					
					
								<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
						
					
					<?
					
					echo "There are ";
					echo $num;
					echo " avaliable shift(s).";

					?>
					</div>
							<div id="hovedtekst" class="hovedtekst">
					<br><br>
					<table width="100%" border="0">
  <tr>
    <td><b>Tender</b></td>
    <td><b>Date & time</b></td>
    <td><b>Event</b></td>
    <td><b>Anchor</b></td>
    <td></td>
  </tr>


					
					<?
					
while($show_trade = mysql_fetch_array($query_n)) {
$query_nt = mysql_query("SELECT * FROM users WHERE id = $show_trade[tender] ORDER BY id DESC") or die(mysql_error());
$show_trade_tender = mysql_fetch_array($query_nt);
$query_ne = mysql_query("SELECT * FROM events WHERE id = $show_trade[event] ORDER BY id DESC") or die(mysql_error());
$show_trade_event = mysql_fetch_array($query_ne);
?>
  <tr>
    <td><? echo $show_trade_tender[name]; ?></td>
    <td>
	<?
	$timestamp = strtotime($show_trade_event[dato]);
	print date("d M. y", $timestamp);
	?>
 - (<?
$timestamp = strtotime($show_trade[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_trade[tender_end]);
echo date("H:i", $timestamp);
?>)
	</td>
    <td><? echo $show_trade_event[titel]; ?></td>
    <td><?
	if($show_trade[anchor] == "1") {
	echo "Yes";
	}else{
	echo "No";
	}
	?>
	</td>
    <td><a href="shift.php?action=next&post=true&id=<? echo $show_trade[id]; ?>">Take</a></td>
  </tr>

<?

}
?>
</table>
</div>
</div>







<?
////////////////////////////////////////////////////
}else{


					$sort_date = date("Y").date("m").date("d");
$query_id = mysql_query("SELECT * FROM events WHERE dato >= $sort_date ORDER BY dato LIMIT 0, 1") or die(mysql_error());
$show_shift = mysql_fetch_array($query_id);


					$query_n = mysql_query("SELECT * FROM shift WHERE event = $show_shift[id] AND trade = 1 ORDER BY id DESC") or die(mysql_error());
					$num = mysql_num_rows($query_n); 
					?>
					
					
								<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
						
					
					<?
					
					echo "There are ";
					echo $num;
					echo " avaliable shift(s) for the next event.";

					?>
					</div>
							<div id="hovedtekst" class="hovedtekst">
					<br><br>
					<table width="100%" border="0">
  <tr>
    <td><b>Tender</b></td>
    <td><b>Date & time</b></td>
    <td><b>Event</b></td>
    <td><b>Anchor</b></td>
    <td></td>
  </tr>


					
					<?
					
while($show_trade = mysql_fetch_array($query_n)) {
$query_nt = mysql_query("SELECT * FROM users WHERE id = $show_trade[tender] ORDER BY id DESC") or die(mysql_error());
$show_trade_tender = mysql_fetch_array($query_nt);
$query_ne = mysql_query("SELECT * FROM events WHERE id = $show_trade[event] ORDER BY id DESC") or die(mysql_error());
$show_trade_event = mysql_fetch_array($query_ne);
?>
  <tr>
    <td><? echo $show_trade_tender[name]; ?></td>
    <td>
	<?
	$timestamp = strtotime($show_trade_event[dato]);
	print date("d M. y", $timestamp);
	?>
 - (<?
$timestamp = strtotime($show_trade[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_trade[tender_end]);
echo date("H:i", $timestamp);
?>)
	</td>
    <td><? echo $show_trade_event[titel]; ?></td>
    <td><?
	if($show_trade[anchor] == "1") {
	echo "Yes";
	}else{
	echo "No";
	}
	?>
	</td>
    <td><a href="shift.php?action=next&post=true&id=<? echo $show_trade[id]; ?>">Take</a></td>
  </tr>

<?

}
?>
</table>
</div>
</div>

<?
}
}
}else{
?>



<?
}
}
}
}
}
}
}
include 'bottom.php';
?>
			
			
<?
}
?>