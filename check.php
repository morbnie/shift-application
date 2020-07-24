<?
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{
ob_start();

include "../Utilities/conectdb.php";
dbconnect2();

$validUser = $_SESSION[myusername];
$query_user = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id DESC") or die(mysql_error());
$user = mysql_fetch_array($query_user);

$sql="INSERT INTO user_log (`id`, `user`, `dato`) VALUES ('', '$user[id]', CURRENT_TIMESTAMP)";
$result=mysql_query($sql);

if($user[phone] != "") {
echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}else{

?>
<!DOCTYPE HTML>
<html>
<head>
<title>****** - Tender Area</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start slider -->
<link rel="stylesheet" type="text/css" href="css/slider.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="js/jquery.cslider.js"></script>
	<script type="text/javascript">
			$(function() {

				$('#da-slider').cslider({
					autoplay : true,
					bgincrement : 450
				});

			});
		</script>
		

	
		
</head>





<?
if($_GET[action] == "submit") {
if($_GET[post] == "true") {
$validUser = $_SESSION[myusername];
$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
$show_tender = mysql_fetch_array($query_id);

$phone = $_POST[phone];

mysql_query("UPDATE users SET phone = '$phone' WHERE id = '$show_tender[id]'");
echo '<meta http-equiv="refresh" content="0; url=index.php" />';

}
}
?>



<body>
<div class="wrap">
	<div class="main"><!-- start main -->
	
<div class="grids_of_2"><!-- start grids_of_2 -->
		

			<div class="hovedboks" style="background: #ffffff;">
						
						
						<div id="hovedtekst" class="hovedtekst">
						
						<div class="overskrift">
							We need your phone number!</div>
							<div id="hovedtekst" class="hovedtekst">
<?
echo "<br>";
echo "Hi ";
echo $user[name];
echo "!";
echo "<br>";
echo "In order for us to have a complete contact list we would like your phone number!";
echo "<br>";
echo "<br>";

?>
<form name="change_settings" id="change_sessings" action="?action=submit&post=true" method="post">
<label for="email">Phone:</label> <input type="text" name="phone"></p>
<label for="email">&nbsp;</label><input type="submit" value="Submit">
</form>

<br>
<a href="index.php">Continue to the tender site without giving us your phone number -></a>

							
							
							<br><br>		

					
					

				</div><!-- end slider -->
			</div><!-- end slider -->
            
            			<div class="clear"></div>
		</div>
</div>		
</div>		
	</div>	
		
		
		</body>
		</html>



<?
}
}
?>