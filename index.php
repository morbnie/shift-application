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
if($_GET[action] == "delete") {
if ($user[board] != 0) {
if($_GET[id] != "") {
if($_GET[post] == "true") {



mysql_query("DELETE FROM tender_update WHERE id = '$_GET[id]'") or die(mysql_error());
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

echo '<meta http-equiv="refresh" content="0; url=index.php" />';


}else{


?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Delete update:</div>
							<div id="hovedtekst" class="hovedtekst">
							
							<font color="red">* Are you sure you want to delete?</font>
<form action="?action=delete&id=<? echo $_GET[id]; ?>&post=true" method="post">
<label for="email">&nbsp;</label><input type="submit" value="Delete">
</form>
							

							
							</div>
			</div>

<?
}
}
}
}else{





if($_GET[action] == "create") {
if ($user[board] != 0) {
if($_GET[post] == "true") {

$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$title1 = addslashes($_POST[title]);
$text1 = addslashes($_POST[text]);

$title = nl2br($title1);
$text = nl2br($text1);



$sql="INSERT INTO tender_update (`id`, `title`, `text`, `by`, `date`) VALUES ('', '$title', '$text', '$show_tender[id]', CURRENT_TIMESTAMP)";


$result=mysql_query($sql);
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';

echo '<meta http-equiv="refresh" content="0; url=index.php" />';
?>
<?


}else{
?>

			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Create update:</div>
							<div id="hovedtekst" class="hovedtekst">
							
                        <form action="?action=create&post=true" method="post">
<p><label for="email">Title:</label> <input type="text" name="title"><br>
<label for="email">Text:</label><textarea rows="20" cols="60" name="text"></textarea>

<br>
<label for="email">&nbsp;</label><input type="submit" value="Submit">					</form>		
							
							</div>
			</div>

<?
}
}
}else{
?>

<?

if($_GET[action] == "edit") {
if ($user[board] != 0) {
if($_GET[id] != "") {
if($_GET[post] == "true") {


$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$title = $_POST[title];
$text = $_POST[text];

mysql_query("UPDATE tender_update SET title = '$title', text = '$text' WHERE id = '$_GET[id]'");
echo '<p style="text-align:center">Wait...<br><br><img src="../Images/Icons/loading.gif"/></p>';
echo '<meta http-equiv="refresh" content="0; url=index.php" />';

}else{

$query_id_news = mysql_query("SELECT * FROM tender_update WHERE id = '$_GET[id]' ORDER BY id DESC") or die(mysql_error());
$show_news = mysql_fetch_array($query_id_news);
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Edit update:</div>
							<div id="hovedtekst" class="hovedtekst">
							
                        <form action="?action=edit&id=<? echo $_GET[id]; ?>&post=true" method="post">
<p><label for="email">Title:</label> <input type="text" name="title" value="<? echo $show_news[title]; ?>"><br>
<label for="email">Text:</label><textarea rows="20" cols="60" name="text">
<? echo $show_news[text]; ?>

</textarea>
<br>
<label for="email">&nbsp;</label><input type="submit" value="Submit">					</form>		
							
							</div>
			</div>

<?
}
}
}
}else{
?>

					<?
if($_GET[p] == "") {
$p = 10;
$p_d = 0;
}else{
$p = $_GET[p]+10;
$p_b = $_GET[p]-10;
$p_d = $_GET[p];
}
?>



			<div class="hovedboks">
						
						
						<div id="hovedtekst" class="hovedtekst">
                        <br>
						
						<div style="text-align: center;">
                        <div class="contactlist" style="margin: 10px; display: inline-block;">
                        <a href="contacts.php"><img src="images/smartphone11.png"><br>Contact list</a></div>
						
						<?
						if ($user[board] != 0) {
						?>
						<div class="contactlist" style="margin: 10px; display: inline-block;">
                        <a href="sms.php"><img src="images/sms.png"><br>SMS</a></div>
                        
						<?
						}
					?>
						</div></div>
						
						<div class="overskrift">
							Updates from the board</div>
							<div id="hovedtekst" class="hovedtekst">
							<?
							if ($user[board] != 0) {
							echo "[<a href='?action=create'>Create update</a>]";
							
							}
							
							$query_id_news = mysql_query("SELECT * FROM tender_update ORDER BY date DESC LIMIT $p_d, 10") or die(mysql_error());
while ($show_news = mysql_fetch_array($query_id_news)) {
						?>
							<p>
							<h3><? echo $show_news[title]; ?>
							<?
							if ($user[board] != 0) {
							?>
							 - [<a href="?action=edit&id=<? echo $show_news[id]; ?>">Edit</a> / <a href="?action=delete&id=<? echo $show_news[id]; ?>">Delete</a>]
							<?
							}
							?>
							
							</h3>
							<? echo $show_news[text]; ?>
							<?
							$timestamp = strtotime($show_news[date]);
							$validUserName = $show_news[by];
					$query_id = mysql_query("SELECT * FROM users WHERE id = '$validUserName' ORDER BY id") or die(mysql_error());
					$show_tender_name = mysql_fetch_array($query_id);
							?>
							<br><span style='font-style: italic;'>by <? echo $show_tender_name[firstname]; ?> <? echo $show_tender_name[lastname]; ?>
							 (<?
							if($show_tender_name[board] == "1") {
							echo "Chairman";
							}elseif($show_tender_name[board] == "2") {
							echo "Vice-chairman";
							}elseif($show_tender_name[board] == "3") {
							echo "Maintenance";
							}elseif($show_tender_name[board] == "4") {
							echo "Purchaser";
							}elseif($show_tender_name[board] == "5") {
							echo "Music";
							}elseif($show_tender_name[board] == "6") {
							echo "IT";
							}elseif($show_tender_name[board] == "7") {
							echo "PR";
							}elseif($show_tender_name[board] == "8") {
							echo "Treasurer";
							}
							?>) - 
							<? print date("d M. y", $timestamp);
							?></span><br><br>
							</p>
							
							<?
							
					}
					?>


					<div name='page_number' style='text-align:center;'>
					<?
					$query_n = mysql_query("SELECT * FROM tender_update ORDER BY date DESC") or die(mysql_error());
					$num = mysql_num_rows($query_n); 
					
					if($_GET[p] != 0) {
					echo "<a href='?p=";
					echo $p_b;
					echo "'><span style='font-size: 18pt;'>Newer Posts</span></a>";
					}
					
					if($_GET[p] != 0 && $num > 10 && $num > $p) {
					echo " || ";
					}
					
					if($num > 10 && $num > $p) {
					echo "<a href='?p=";
					echo $p;
					echo "'><span style='font-size: 18pt;'>Older Posts</span></a>";
					}
					?>
					</div>
					
					

				</div><!-- end slider -->
			</div><!-- end slider -->
            
            <?
			}
			}
			}
			include 'bottom.php';
			?>
			
			
<?
}
?>