<?
session_start();
if(!isset($_SESSION['myusername'])){
header("location:../index.php");
}else{

?>
			<div class="clear"></div>
		</div><!-- end grids_of_2 -->	
		</div><!-- end grid1_of_1 -->
		<div class="grid1_of_2"><!-- start grid1_of_2 -->
			<div class="grid1_of_list1"><!-- start grid1_of_list1 -->
				<div class="grid_img">
					<img src="images/pic1.jpg"  alt=""/>
				</div>
				<div class="grid_text">
					<div class="grid_text1">
					<?
					
					$validUser = $_SESSION[myusername];
					$query_id = mysql_query("SELECT * FROM users WHERE username = '$validUser' ORDER BY id") or die(mysql_error());
					$show_tender = mysql_fetch_array($query_id);
?>
						<h4><? echo $show_tender[firstname]; ?></h4>
						<h5><? echo $show_tender[lastname]; ?></h5>
					</div>
					<ul class="list1">
						<li class="active"><a href="pipeline.php">Tender next time? <span>
						<?
						$sort_date = date("Y").date("m").date("d");
$query_id = mysql_query("SELECT * FROM events WHERE dato >= $sort_date ORDER BY dato LIMIT 0, 1") or die(mysql_error());
$show_event= mysql_fetch_array($query_id);
						?>
						
						<?
						$validEvent = $show_event[id];
						$validTenderID = $show_tender[id];
					$query_id = mysql_query("SELECT * FROM shift WHERE tender = '$validTenderID' AND event = '$validEvent' ORDER BY id DESC") or die(mysql_error());
					$show_tender = mysql_num_rows($query_id);
						if($show_tender > 0){
						?>
						Yes
						
						<?
						}else{
						?>
						
						No
						<?
						}
						?></span> </a></li>
												<?
						$sort_date = date("Y").date("m").date("d");
						
						
						$query_id_taken = mysql_query("SELECT * FROM shift WHERE tender = '$validTenderID' AND tender_end < '$sort_date' ORDER BY id DESC") or die(mysql_error());
					$show_tender_taken = mysql_num_rows($query_id_taken);
					?>
						<li><a href="#">Shifts taken<span><? echo $show_tender_taken; ?></span> </a></li>
						<?
						$sort_date = date("Y").date("m").date("d");
						
						
						$query_id_left = mysql_query("SELECT * FROM shift WHERE tender = '$validTenderID' AND tender_end > '$sort_date' ORDER BY id DESC") or die(mysql_error());
					$show_tender_left = mysql_num_rows($query_id_left);
					?>
						<li class="active"><a href="#">Shifts left<span><? echo $show_tender_left; ?></span> </a></li>
						<li><a href="#">Kudos <span>(on its way...)</span> </a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
			<div class="grid1_of_list2"><!-- start grid1_of_list2 -->
				<div class="grid1_of_list">
					<img src="images/pic2.jpg" alt="" />
					<h4>Help your fellow tender: take a shift</h4>
				</div>
				<ul class="list2">
					<li><p>Total</p><span>
					
					
					
										<?
					$sort_date = date("Y").date("m").date("d");

					
					
					
					//$tender_id = mysql_query("SELECT * FROM shift AS b JOIN events AS t on t.id = b.event WHERE t.dato > $sort_date ORDER BY b.id") or die(mysql_error());
					
					$tender_id = mysql_query("SELECT * FROM shift AS b JOIN events AS t on t.id = b.event WHERE t.dato >= $sort_date AND b.trade = 1 ORDER BY b.id") or die(mysql_error());
$num1 = mysql_num_rows($tender_id); 
					
					
					
					if($num1 != 0) {
					echo "<a href='shift.php?action=next&show=all'>";
echo $num1;
echo "</a>";
}else{
echo $num1;
}
?>
					
					
					</span></li>
					<li><p>This friday</p> <span>
					
					<?
					$sort_date = date("Y").date("m").date("d");
$query_id = mysql_query("SELECT * FROM events WHERE dato >= $sort_date ORDER BY dato LIMIT 0, 1") or die(mysql_error());
$show_shift = mysql_fetch_array($query_id);
if(mysql_num_rows($query_id) != 0)
{


					$query_n = mysql_query("SELECT * FROM shift WHERE event = $show_shift[id] AND trade = 1 ORDER BY id DESC") or die(mysql_error());
					$num = mysql_num_rows($query_n); 
					

					if($num != 0) {
					echo "<a href='shift.php?action=next'>";
echo $num;
echo "</a>";
}else{
echo $num;
}
}else{
echo "0";
}
?>
					
					
					</span></li>
					<div class="clear"></div>
				</ul>
			</div><!-- end grid1_of_list2 -->
		</div><!-- end grid1_of_2 -->
		<div class="clear"></div>
		<div class="copy"><!-- start copy -->
			<p class="link"><span></span></p>
		</div>
	</div><!-- end main -->
</div>
</body>
</html>
<?
}
?>