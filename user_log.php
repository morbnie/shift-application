<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{

?>


<?
include 'top.php';


if ($user[board] != 0) {
?>
			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Log: Log-in (last 100 log-in)</div>
							<div id="hovedtekst" class="hovedtekst">
							
<table width="100%">



<tr>
<td><b>Tender</b></td>
<td><b>Time</b></td>
</tr>
<?
$query_id2 = mysql_query("SELECT * FROM user_log ORDER BY dato DESC LIMIT 100") or die(mysql_error());
while($show_shift_2 = mysql_fetch_array($query_id2)) {
?>
<tr>
<td><? echo $show_shift_2[user]; ?>
 - 
<?
$query_id3 = mysql_query("SELECT * FROM users WHERE id = $show_shift_2[user] ORDER BY id") or die(mysql_error());
while($show_shift_3 = mysql_fetch_array($query_id3)) {
echo $show_shift_3[name];
}
?>

</td>
<td><? echo $show_shift_2[dato]; ?></td>
</tr>
<?
}
?>

</table>
<br>

							

							
							</div>
			</div>

<?
}
			include 'bottom.php';
			?>
			
			
<?
}
?>