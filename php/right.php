<?php 
include_once ("right_information.inc");
include_once ("right1.php"); 

?>

<div class="right_box right_box_top">
	<div class=item_tit>Announcement</div>
	<div class="anno_red">
	<?php 
		for ($n = 0; $n < count($ANNOUNCEMENT); $n++) {
			echo("<p>&nbsp;".$ANNOUNCEMENT[$n]."</p>");
		} 
	?>
 	</div>
</div>
<div><img src="../images/box_bg2.gif"></div>

<?php 

for ($n = 0; $n < count($RIGHT_LIST); $n++) {
	$items = $RIGHT_LIST[$n];
	if ($items[1] == 1) {
		$item = $items[2];
?>
	 
<div class="right_box right_box3">
	<div class=item_tit><?php echo($item[0]); ?></div>
 	<div class=item_schdule>  
 	<?php 
		for ($i = 1; $i < count($item); $i++) {
			$elem = $item[$i];
			$dates = $elem[0];
			$dates = getFullDateSimple($dates);						
			$times = $elem[1];
		?>								
 			<div class=list_tit><?php echo($dates. "&nbsp;&nbsp;&nbsp;&nbsp;" .$times); ?></div>
			<div class=list_text>
			<?php 
				for ($j = 2; $j < count($elem); $j++) {
					echo($elem[$j]. "<br>"); 
				}
			?>
			</div>
	<?php } ?>
 
 	</div>
</div>
<div><img src="../images/box_bg2.gif"></div>
  
<?php 
	}
}

if (0) { ?>  
<div class="right_box right_box3">
	<div class=item_tit><h6>Long Island Academy</h6></div>
    <div class="img">
    	<a href="../about/"><img src="../images/Picture_003-489x269.jpg" border="0" width="240px"></a>
    </div>
</div>    
<div><img src="../images/box_bg2.gif"></div>
<?php } ?> 	
