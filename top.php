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
<body>

<div class="wrap">
	<div class="main"><!-- start main -->
		<div class="grid1_of_1"><!-- start grid1_of_1 -->
		<div class="menu"><!-- start menu -->
			<ul class="mcd-menu">
				<li>
					<a href="index.php"
                    <?
					$uri = $_SERVER['REQUEST_URI'];
if ( strpos($uri,'index.php') !== false ) {
					echo ' class="active"';
					}
					?>
                 
                    >
						<i class="icon1"></i>
						<strong>
                        
                        
						
						Front-page</strong>
					</a>
				</li>
				<li>
					<a href="pipeline.php"
                                        <?
					$uri = $_SERVER['REQUEST_URI'];
if ( strpos($uri,'pipeline.php') !== false ) {
					echo ' class="active"';
					}
					?>
                    
                    >
						<i class="icon2"></i>
						<strong>Pipeline</strong>
					</a>
				</li>
				<li>
					<a href="settings.php"
                                        <?
					$uri = $_SERVER['REQUEST_URI'];
if ( strpos($uri,'settings.php') !== false ) {
					echo ' class="active"';
					}
					?>>
						<i class="icon3"></i>
						<strong>Settings</strong>
					</a>
				</li>
				<li>
					<a href="http://wiki.*****.dk">
						<i class="icon4"></i>
						<strong>Wiki</strong>
					</a>
				</li>
				<li>
					<a href="../Utilities/logout.php">
						<i class="icon5"></i>
						<strong>Log out</strong>
					</a>
				</li>
			</ul>
		</div><!-- end menu -->	
		<div class="grids_of_2"><!-- start grids_of_2 -->
		
		
<?
}
?>