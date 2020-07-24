<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{

?>


<?
include 'top.php';
?>

<?
if($_GET[action] == "delete_event") {
if ($user[board] != 0) {
if($_GET[id] != "") {
if($_GET[post] == "true") {



mysql_query("DELETE FROM events WHERE id = '$_GET[id]'") or die(mysql_error());
mysql_query("DELETE FROM shift WHERE event = '$_GET[id]'") or die(mysql_error());

echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';


}else{


?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Delete event:</div>
							<div id="hovedtekst" class="hovedtekst">
							
							<font color="red">* Are you sure you want to delete?<br>All shifts for this event will also be deleted</font>
<form action="?action=delete_event&id=<? echo $_GET[id]; ?>&post=true" method="post">
<label for="email">&nbsp;</label><input type="submit" value="Delete">
</form>
							

							
							</div>
			</div>

<?
}
}
}
}else{


////////////////////////////

if($_GET[log] == "change_tender") {
if ($user[board] != 0) {
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Log: Change of tenders (last 100 changes)</div>
							<div id="hovedtekst" class="hovedtekst">
							
<table width="100%">



<tr>
<td><b>Old tender</b></td>
<td><b>New tender</b></td>
<td><b>Changed (YY-MM-DD)</b></td>
<td><b>Event</b></td>
<td><b>Changed by</b></td>
<td><b>Comment</b></td>
</tr>
<?
$query_id2 = mysql_query("SELECT * FROM trade_log ORDER BY dato DESC LIMIT 100") or die(mysql_error());
while($show_shift_2 = mysql_fetch_array($query_id2)) {
?>
<tr>
<td><? echo $show_shift_2[old_v]; ?></td>
<td><? echo $show_shift_2[new_v]; ?></td>
<td><? echo $show_shift_2[dato]; ?></td>
<td><? echo $show_shift_2[event]; ?></td>
<td><? echo $show_shift_2[changed_by]; ?></td>
<td><? echo $show_shift_2[comment]; ?></td>
</tr>
<?
}
?>

</table>
<br>
<table width="100%">
<tr>
<td>
<h3>User ID's</h3>
</td>
<td>
<h3>Event ID's</h3>
</td>
</tr><tr>
<td>
<?
$query_id3 = mysql_query("SELECT * FROM users WHERE status = 2 OR status = 3 ORDER BY id") or die(mysql_error());
while($show_shift_3 = mysql_fetch_array($query_id3)) {
?>
<? echo $show_shift_3[id]; ?> - <? echo $show_shift_3[name]; ?><br>
<?
}
?>
</td>
<td>
<?
$query_id4 = mysql_query("SELECT * FROM events ORDER BY id DESC LIMIT 50") or die(mysql_error());
while($show_shift_4 = mysql_fetch_array($query_id4)) {
?>
<? echo $show_shift_4[id]; ?> - <? echo $show_shift_4[titel]; ?><br>
<?
}
?>


</td>
</tr>
</table>

							

							
							</div>
			</div>

<?
}
}else{


//////////////////////////







if($_GET[action] == "edit_event") {
if ($user[board] != 0) {
if($_GET[id] != "") {
if($_GET[post] == "true") {


$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$titel = $_POST[title];
$facebook = $_POST[facebook];
$dato = date($_POST[year].'-'.$_POST[month].'-'.$_POST[day]);

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
$from = $hour.':'.$minut.':00';
$to = $ehour.':'.$eminut.':00';

mysql_query("UPDATE events SET dato = '$dato', from_time = '$from', to_time = '$to', titel = '$titel', facebook = '$facebook' WHERE id = '$_GET[id]'");

echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';

}else{

$query_id_news = mysql_query("SELECT * FROM events WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Edit event:</div>
							<div id="hovedtekst" class="hovedtekst">
							
                        <form action="?action=edit_event&id=<? echo $_GET[id]; ?>&post=true" method="post">
<p><label for="email">Title:</label> <input type="text" name="title" value="<? echo $show_news[titel]; ?>"><br>
<p><label for="email">Facebook:</label> http://<input type="text" name="facebook" value="<? echo $show_news[facebook]; ?>"><br>




<p><label for="email">Date of event:</label> 
 


<?php

$timestamp = strtotime($show_news[dato]);

$dag = date("d", $timestamp);
$maned = date("m", $timestamp);
$aar = date("Y", $timestamp);

    // current year
    $now = date('Y');
	
    // lowest year wanted
    $cutoff = $now+1;
	
    // build days menu
    echo '<select name="day">' . PHP_EOL;
    for ($d=1; $d<=31; $d++) {
        echo '  <option value="' . $d . '"';
		if($dag == $d) {
echo ' selected';
}
echo '>' . $d . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build months menu
    echo '<select name="month">' . PHP_EOL;
    for ($m=1; $m<=12; $m++) {
        echo '  <option value="' . $m . '"';
		if($maned == $m) {
echo ' selected';
}
//echo '>' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;


                $mon = date("F", mktime(0, 0, 0, $m+1, 0, 0, 0));

echo '>' . $mon . '</option>' . PHP_EOL;




    }
    echo '</select>' . PHP_EOL;

    // build years menu
    echo '<select name="year">' . PHP_EOL;
    for ($y=$now; $y<=$cutoff; $y++) {
        echo '  <option value="' . $y . '"';
		if($aar == $y) {
echo ' selected';
}
echo '>' . $y . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

?>

<br>
<p><label for="email">From:</label> 
<?
$timefrom = strtotime($show_news[from_time]);

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
$timeto = strtotime($show_news[to_time]);

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
















if($_GET[action] == "create_event") {
if ($user[board] != 0) {
if($_GET[post] == "true") {












$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$titel = $_POST[title];
$facebook = $_POST[facebook];
$dato = date($_POST[year].'-'.$_POST[month].'-'.$_POST[day]);

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
$from = $hour.':'.$minut.':00';
$to = $ehour.':'.$eminut.':00';


$sql="INSERT INTO events (id, dato, from_time, to_time, titel, facebook, pictures) VALUES ('', '$dato', '$from', '$to', '$titel', '$facebook', '0')";
$result=mysql_query($sql);

$id = mysql_insert_id();


$tender_s_t = $dato.' 14:00:00';
$tender_e_t = $dato.' 21:00:00';

if($_POST[opening_tenders] != "") {
$openingsql = '';
foreach ($_POST['opening_tenders'] as $opening_tenders) {

//     no idea where to get EmpNo from, let's assume it is in $empno.
    $openingsql .= "('','$id','$opening_tenders','0','1','0','0','$tender_s_t','$tender_e_t'),";

}

$openingsql = "INSERT INTO shift (id, event, tender, anchor, opening, closing, trade, tender_start, tender_end) VALUES " . trim($openingsql,',');
$result2=mysql_query($openingsql);
}

$tender_s_t2 = $dato.' 20:45:00';
$tender_e_t2 = $dato.' 02:00:00';

if($_POST[closing_tenders] != "") {
$closingsql = '';
foreach ($_POST['closing_tenders'] as $closing_tenders) {

//     no idea where to get EmpNo from, let's assume it is in $empno.
    $closingsql .= "('','$id','$closing_tenders','0','0','1','0','$tender_s_t2','$tender_e_t2'),";

}

$closingsql = "INSERT INTO shift (id, event, tender, anchor, opening, closing, trade, tender_start, tender_end) VALUES " . trim($closingsql,',');
$result3=mysql_query($closingsql);
}
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';



//echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
//echo '<meta http-equiv="refresh" content="0; url=pipeline.php" />';
}else{

?>

			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Create Event</div>
							<div id="hovedtekst" class="hovedtekst">
							<?
							//////////////////////////////////////
							?>
							
							
<form action="?action=create_event&post=true" method="post">							
<p><label for="email">Name of event:</label><input type="text" name="title"> (*)<br>
<p><label for="email">Date of event:</label>


<?php
$brug_dag = date("Y-m-d");
$timestamp = strtotime($brug_dag);

$dag = date("d", $timestamp);
$maned = date("m", $timestamp);
$aar = date("Y", $timestamp);

    // current year
    $now = date('Y');
	
    // lowest year wanted
    $cutoff = $now+1;
	
    // build days menu
    echo '<select name="day">' . PHP_EOL;
    for ($d=1; $d<=31; $d++) {
        echo '  <option value="' . $d . '"';
		if($dag == $d) {
echo ' selected';
}
echo '>' . $d . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build months menu
    echo '<select name="month">' . PHP_EOL;
    for ($m=1; $m<=12; $m++) {
        echo '  <option value="' . $m . '"';
		if($maned == $m) {
echo ' selected';
}
//echo '>' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;


                $mon = date("F", mktime(0, 0, 0, $m+1, 0, 0, 0));

echo '>' . $mon . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build years menu
    echo '<select name="year">' . PHP_EOL;
    for ($y=$now; $y<=$cutoff; $y++) {
        echo '  <option value="' . $y . '"';
		if($aar == $y) {
echo ' selected';
}
echo '>' . $y . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

?>

<br>
<p><label for="email">From:</label>
<?
    // build hour menu
    echo '<select name="hour">' . PHP_EOL;
    for ($h=0; $h<=23; $h++) {
        echo '  <option value="' . $h . '" ';
if($h == "15")	{
	echo 'selected="selected"';
	}	
echo	'>' . $h . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
	echo ':';
    // build minut menu
    echo '<select name="minut">' . PHP_EOL;
    for ($mi=0; $mi<=59; $mi++) {
        echo '  <option value="' . $mi . '">' . $mi . '</option>' . PHP_EOL;
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
		
if($th1 == "2")	{
	echo 'selected="selected"';
	}	
echo	'>' . $th1 . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
	echo ':';
    // build minut menu
    echo '<select name="eminut">' . PHP_EOL;
    for ($tmi=0; $tmi<=59; $tmi++) {
        echo '  <option value="' . $tmi . '">' . $tmi . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>

<br>

<p><label for="email">Facebook:</label> http://<input type="text" name="facebook">
<br>
<br>

<p><label for="email">Select opening tenders:<br>(14:00 - 21:00)</label><select size="9" name="opening_tenders[]" multiple="multiple">

<?
$query_id = mysql_query("SELECT * FROM users WHERE status = 2 OR status = 3 ORDER BY username") or die(mysql_error());
while ($show_tender= mysql_fetch_array($query_id)) {
?>

<option value="<? echo $show_tender[id]; ?>"><? echo $show_tender[name]; ?></option>

<?
}
?>

</select><br><label for="email">&nbsp;</label><font size="1">Use Control/Command to select multiple tender!</font>
<br><br>
<p><label for="email">Select closing tenders:<br>(20:45 - 02:00)</label>
<select size="9" name="closing_tenders[]" multiple="multiple">
<?
$query_id_c = mysql_query("SELECT * FROM users WHERE status = 2 OR status = 3 ORDER BY username") or die(mysql_error());
while ($show_tender_c = mysql_fetch_array($query_id_c)) {
?>

<option value="<? echo $show_tender_c[id]; ?>"><? echo $show_tender_c[name]; ?></option>

<?
}
?>

</select><br><label for="email">&nbsp;</label><font size="1">Use Control/Command to select multiple tender!</font>
<br>
<label for="email">&nbsp;</label><input type="submit" name="create_submit" value="Submit">
					</form>		
							
							<?
							//////////////////////////////////////////
							?>

				</div>
			</div>

<?


}
}
}else{
?>


<?
if($_GET[action] == "single") {
if($_GET[id] != "") {

$query_id_news = mysql_query("SELECT * FROM events WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);

?>
<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Pipeline</div>
							<div id="hovedtekst" class="hovedtekst">

                            <div class="thisfriday" style="
    text-transform: uppercase;
    font-weight: bold;
    font-size: 20px;
">

<? echo $show_news[titel]; ?>
<?
echo " - (";
$timestamp = strtotime($show_news[dato]);

print date("d M. y", $timestamp);
echo ")";
?>

</div>

<?
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id_shift_tender = mysql_query("SELECT * FROM shift WHERE event = '$_GET[id]' AND tender = '$show_tender[id]' AND anchor = '1' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);


if ($user[board] != 0 OR $show_shift_tender[anchor] == 1) {

echo "[<a href='shift.php?action=assign_tender&id=";

echo $show_news[id];
echo "'>Assign tender</a>]";
echo " - ";
echo "[Send sms to: ";
echo "<a href='sms_shift.php?event=";
echo $show_news[id];
echo "&type=open";
echo "'>opening</a>";
echo " / ";
echo "<a href='sms_shift.php?event=";
echo $show_news[id];
echo "&type=close";
echo "'>closing</a>";
echo " / ";
echo "<a href='sms_shift.php?event=";
echo $show_news[id];
echo "&type=both";
echo "'>both</a>";
echo "]";
echo "<br><br>";

}
?>

<b>Opening</b><br>
<?

$query_id_vis = mysql_query("SELECT * FROM shift WHERE event ='$_GET[id]' AND opening = 1 ORDER BY id DESC") or die(mysql_error());
while ($show_event = mysql_fetch_array($query_id_vis)) {
$query_id_shift_tender = mysql_query("SELECT * FROM users WHERE id = '$show_event[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);
?>

<div class="shift_name" style="
    float: left;
	clear:both;
">
<? echo $show_shift_tender[firstname]; ?> <? echo $show_shift_tender[lastname]; ?><?
if($show_event[anchor] == 1) {
echo " <b>(anchor)</b>";
}
?>

 (<a href="shift.php?action=edit_tender&id=<? echo $show_event[id]; ?>">Change tender</a>) 

<?
if($show_shift_tender[username] == $_SESSION[myusername]) {
if($show_event[trade] == "1") {

echo "- (<a href='shift.php?action=take_back&id=";
echo $show_event[id];
echo "'>Take back</a>)";


}else{
echo "- (<a href='shift.php?action=free&id=";
echo $show_event[id];
echo "'>Up for grabs</a>)";
}
}
?>


<?
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id1 = mysql_query("SELECT * FROM shift WHERE event = '$_GET[id]' AND tender = '$show_tender[id]' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);

if ($user[board] != 0 OR $show_tender1[anchor] == 1) {

echo " - [<a href='shift.php?action=edit_shift&id=";
echo $show_event[id];
echo "'>Edit</a> / <a href='shift.php?action=delete_shift&id=";
echo $show_event[id];
echo "'>Delete</a>]";
}
?>



</div>

<div class="time" style="
    overflow: hidden;
    float: right;
    margin-right: 5%;
"> <i>(<?
$timestamp = strtotime($show_event[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_event[tender_end]);
echo date("H:i", $timestamp);
?>)</i></div>

<?
}
?>





<p><div class="closing"  style="
    float: left;
	clear:both;
	margin-top: 20px;
"><b>Closing</b></div><br>
<?

$query_id_vis = mysql_query("SELECT * FROM shift WHERE event ='$_GET[id]' AND closing = 1 ORDER BY id DESC") or die(mysql_error());
while ($show_event = mysql_fetch_array($query_id_vis)) {
$query_id_shift_tender = mysql_query("SELECT * FROM users WHERE id = '$show_event[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);
?>

<div class="shift_name" style="
    float: left;
	clear:both;
">
<? echo $show_shift_tender[firstname]; ?> <? echo $show_shift_tender[lastname]; ?><?
if($show_event[anchor] == 1) {
echo " <b>(anchor)</b>";
}
?>
 (<a href="shift.php?action=edit_tender&id=<? echo $show_event[id]; ?>">Change tender</a>) 
<?
if($show_shift_tender[username] == $_SESSION[myusername]) {
if($show_event[trade] == "1") {

echo "- (<a href='shift.php?action=take_back&id=";
echo $show_event[id];
echo "'>Take back</a>)";


}else{
echo "- (<a href='shift.php?action=free&id=";
echo $show_event[id];
echo "'>Up for grabs</a>)";
}
}
?>
<?
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id1 = mysql_query("SELECT * FROM shift WHERE event = '$_GET[id]' AND tender = '$show_tender[id]' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);

if ($user[board] != 0 OR $show_tender1[anchor] == 1) {

echo " - [<a href='shift.php?action=edit_shift&id=";
echo $show_event[id];
echo "'>Edit</a> / <a href='shift.php?action=delete_shift&id=";
echo $show_event[id];
echo "'>Delete</a>]";
}
?>



</div>

<div class="time" style="
    overflow: hidden;
    float: right;
    margin-right: 5%;
"> <i>(<?
$timestamp = strtotime($show_event[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_event[tender_end]);
echo date("H:i", $timestamp);
?>)</i></div>




<?
}
?>

<?
$query_id_vis_b = mysql_query("SELECT * FROM shift WHERE event ='$_GET[id]' AND opening = 0 AND closing = 0 ORDER BY id DESC") or die(mysql_error());
$show_event_b = mysql_fetch_array($query_id_vis_b);
if($show_event_b == true) {
?>

<p><div class="closing"  style="
    float: left;
	clear:both;
	margin-top: 20px;
"><b>In between</b></div><br>
<?

$query_id_vis = mysql_query("SELECT * FROM shift WHERE event ='$_GET[id]' AND opening = 0 AND closing = 0 ORDER BY id DESC") or die(mysql_error());
while ($show_event = mysql_fetch_array($query_id_vis)) {
$query_id_shift_tender = mysql_query("SELECT * FROM users WHERE id = '$show_event[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);
?>

<div class="shift_name" style="
    float: left;
	clear:both;
">
<? echo $show_shift_tender[firstname]; ?> <? echo $show_shift_tender[lastname]; ?><?
if($show_event[anchor] == 1) {
echo " <b>(anchor)</b>";
}
?>
 (<a href="shift.php?action=edit_tender&id=<? echo $show_event[id]; ?>">Change tender</a>) 
<?
if($show_shift_tender[username] == $_SESSION[myusername]) {
if($show_event[trade] == "1") {

echo "- (<a href='shift.php?action=take_back&id=";
echo $show_event[id];
echo "'>Take back</a>)";


}else{
echo "- (<a href='shift.php?action=free&id=";
echo $show_event[id];
echo "'>Up for grabs</a>)";
}
}
?>
<?
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$query_id1 = mysql_query("SELECT * FROM shift WHERE event = '$_GET[id]' AND tender = '$show_tender[id]' ORDER BY id") or die(mysql_error());
$show_tender1 = mysql_fetch_array($query_id1);

if ($user[board] != 0 OR $show_tender1[anchor] == 1) {

echo " - [<a href='shift.php?action=edit_shift&id=";
echo $show_event[id];
echo "'>Edit</a> / <a href='shift.php?action=delete_shift&id=";
echo $show_event[id];
echo "'>Delete</a>]";
}
?>



</div>

<div class="time" style="
    overflow: hidden;
    float: right;
    margin-right: 5%;
"> <i>(<?
$timestamp = strtotime($show_event[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_event[tender_end]);
echo date("H:i", $timestamp);
?>)</i></div>




<?
}
}
?>







				</div><!-- end slider -->
			</div><!-- end slider -->
            



<?

}
}else{
?>







			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Pipeline</div>
							<div id="hovedtekst" class="hovedtekst">
							<?

if ($user[board] != 0) {
echo "[<a href='?action=create_event'>Create new event</a>]";
echo " - ";
echo "[<a href='?log=change_tender'>Log: Change of tenders</a>]";
echo " - ";
echo "[<a href='user_log.php'>Log: Login</a>]";
}
?>
                            <div class="thisfriday" style="
    text-transform: uppercase;
    font-weight: bold;
    font-size: 20px;
">


<?
$sort_date = date("Y").date("m").date("d");
$query_id = mysql_query("SELECT * FROM events WHERE dato >= $sort_date ORDER BY dato LIMIT 0, 1") or die(mysql_error());
$show_shift = mysql_fetch_array($query_id);
?>
Pipeline for the next event - <? echo $show_shift[titel]; ?></div>
<div class="next" style="overflow: hidden;">
<div class="opening" style="
    width: 50%;
    float: left;
"><b>Opening</b><br>
<?

$query_id_vis = mysql_query("SELECT * FROM shift WHERE event ='$show_shift[id]' AND opening = 1 ORDER BY id DESC") or die(mysql_error());
while ($show_event = mysql_fetch_array($query_id_vis)) {
$query_id_shift_tender = mysql_query("SELECT * FROM users WHERE id = '$show_event[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);
?>

<div class="shift_name"  style="
    float: left;
clear:both;
">
<? echo $show_shift_tender[firstname]; ?> <? echo $show_shift_tender[lastname]; ?><?
if($show_event[anchor] == 1) {
echo " <b>(anchor)</b>";
}
?></div>

<div class="time" style="
    overflow: hidden;
    float: right;
    margin-right: 5%;
"> <i>(<?
$timestamp = strtotime($show_event[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_event[tender_end]);
echo date("H:i", $timestamp);
?>)</i></div>

<?
}
?>
						</div>
                        
<div class="closing" style="
    width: 50%;
    overflow: hidden;
"><b>Closing</b><br>
<?
$query_id_vis = mysql_query("SELECT * FROM shift WHERE event ='$show_shift[id]' AND closing = 1 ORDER BY id DESC") or die(mysql_error());
while ($show_event = mysql_fetch_array($query_id_vis)) {
$query_id_shift_tender = mysql_query("SELECT * FROM users WHERE id = '$show_event[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);
?>


<div class="shift_name"  style="
    float: left;
clear:both;
"><? echo $show_shift_tender[firstname]; ?> <? echo $show_shift_tender[lastname]; ?>
<?
if($show_event[anchor] == 1) {
echo " <b>(anchor)</b>";
}
?></div>

<div class="time" style="
    overflow: hidden;
    float: right;
    margin-right: 5%;
"> <i>(<?
$timestamp = strtotime($show_event[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_event[tender_end]);
echo date("H:i", $timestamp);
?>)</i></div>
<br>
<?
}
?>


</div>


<?
$query_id_vis_b = mysql_query("SELECT * FROM shift WHERE event ='$show_shift[id]' AND opening = 0 AND closing = 0 ORDER BY id DESC") or die(mysql_error());
$show_event_b = mysql_fetch_array($query_id_vis_b);
if($show_event_b == true) {
?>

<p><div class="closing"  style="
    float: left;
	clear:both;
	margin-top: 20px;
	width: 50%;
"><b>In between</b><br>
<?

$query_id_vis = mysql_query("SELECT * FROM shift WHERE event ='$show_shift[id]' AND opening = 0 AND closing = 0 ORDER BY id DESC") or die(mysql_error());
while ($show_event = mysql_fetch_array($query_id_vis)) {
$query_id_shift_tender = mysql_query("SELECT * FROM users WHERE id = '$show_event[tender]' ORDER BY id DESC") or die(mysql_error());
$show_shift_tender = mysql_fetch_array($query_id_shift_tender);
?>

<div class="shift_name" style="
    float: left;
	clear:both;
">
<? echo $show_shift_tender[firstname]; ?> <? echo $show_shift_tender[lastname]; ?><?
if($show_event[anchor] == 1) {
echo " <b>(anchor)</b>";
}
?>






</div>

<div class="time" style="
    overflow: hidden;
    float: right;
    margin-right: 5%;
"> <i>(<?
$timestamp = strtotime($show_event[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_event[tender_end]);
echo date("H:i", $timestamp);
?>)</i></div>
</div>



<?
}
}
?>
</div>
						
<hr>

<br>
<div id="b_events">
<div id="all_events"  style="
    width: 50%;
    float: left;
">
<b>All events</b><br>
<?
$sort_date = date("Y").date("m").date("d");
$query_id2 = mysql_query("SELECT * FROM events WHERE dato >= $sort_date ORDER BY dato") or die(mysql_error());
while($show_shift_2 = mysql_fetch_array($query_id2)) {
?>
<div class="end_events">
<?
echo "<a href='?action=single&id=$show_shift_2[id]'>";
echo $show_shift_2[titel];
echo "</a>";

if ($user[board] != 0) {
echo " ";
echo "[<a href='?action=edit_event&id=";
echo $show_shift_2[id];
echo "'>";
echo "Edit</a>";
echo " / ";
echo "<a href='?action=delete_event&id=";
echo $show_shift_2[id];
echo "'>Delete</a>]";
}


echo " - (";
$timestamp = strtotime($show_shift_2[dato]);

print date("d M. y", $timestamp);
echo ")";
?>
</div>
<?

}

?>
</div>



<div id="my_events"  style="
    width: 50%;
    float: right;
">
<b>My events</b>

<?
$validUser = $_SESSION[myusername];
$my_query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$my_show_tender = mysql_fetch_array($my_query_id);




$sort_date = date("Y").date("m").date("d");
$query_id3 = mysql_query("SELECT * FROM shift AS b JOIN events AS t on t.id = b.event WHERE t.dato >= $sort_date AND b.tender = $my_show_tender[id] ORDER BY t.dato") or die(mysql_error());



while($show_shift_3 = mysql_fetch_array($query_id3)) {
?>
<div class="end_events">
<?
echo "<a href='?action=single&id=$show_shift_3[id]'>";
echo $show_shift_3[titel];
echo "</a>";


echo " - (";
$timestamp = strtotime($show_shift_3[dato]);

print date("d M. y", $timestamp);


echo " - ";

$timestamp = strtotime($show_shift_3[tender_start]);
echo date("H:i", $timestamp);
?>
 -> 
<?
$timestamp = strtotime($show_shift_3[tender_end]);
echo date("H:i", $timestamp);



echo ")";
?>
</div>
<?

}

?>

</div>
	</div>			



				</div><!-- end slider -->
			</div><!-- end slider -->
            
            <?
			}
			}
			}
			}
			}
			?>
			<?
			
			include 'bottom.php';
			?>
			
			
<?
}
?>