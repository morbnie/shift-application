<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{

?>


<?
include 'top.php';

?>




			<div class="hovedboks">
						
						
						
						
						<div class="overskrift">
							Contact list</div>
							<div id="hovedtekst" class="hovedtekst">
                            
                            						<ul class="listC">
                            <li class="active">
							<a href="#"><label for="telefon"><h3>Phone</h3></label><h3>Name</h3></a></li>
							</ul>
                            <?
							$i = 0;
							$query_id_news = mysql_query("SELECT * FROM users WHERE status = '2' or status = '3' ORDER BY name") or die(mysql_error());
while ($show_news = mysql_fetch_array($query_id_news)) {
						?>
                        <?
						
						if($i == 0) {
							?>
							<ul class="listC">
                            <li>
							<a href="#"><label for="telefon">&nbsp;<? echo $show_news[phone]; ?></label><? echo $show_news[name]; ?></a></li>
							</ul>
							
							<?
							$i = 1;
							}else{
								?>
                                
                                						<ul class="listC">
                            <li class="active">
							<a href="#"><label for="telefon">&nbsp;<? echo $show_news[phone]; ?></label><? echo $show_news[name]; ?></a></li>
							</ul>
                                <?
					
					$i = 0;
					}		
					}
					?>


					
					

				</div><!-- end slider -->
			</div><!-- end slider -->
            
            <?
			include 'bottom.php';
			?>
			
			
<?
}
?>