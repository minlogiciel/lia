<?php 
if ($student) {
	$firstname =  $student->getFirstname();
	$studentname = $firstname[0]. ". " .$student->getLastname();
	$studentid = $student->getID();
	$stclass = $student->getClasses();
?>
		<div class="right_box right_box3">
			<div class=item_tit>Welcome <?php echo($studentname); ?></div>
 			<div class=item_schdule>  
	    		<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    			<a href="../member/login.php?action=changeprofile">Change My Profile</a>
	    		</div>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    			<a href="../member/?action=reportcard&studentid=<?php echo($studentid); ?>">My Report Card</a>
	    		</div>
	    		<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    			<a href="../member/?action=tuitionbill&studentid=<?php echo($studentid); ?>">My Tuition Bill</a>
	    		</div>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    			<a href="../member/?action=allscores&studentid=<?php echo($studentid); ?>">All Scores</a>
	    		</div>
    		<?php if (0) { ?>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    			<a href="../private/?action=privatesession&studentid=<?php echo($studentid); ?>">Private Session</a>
	    		</div>
			<?php } ?>
 			</div>
		</div>
		<div><img src="../images/box_bg2.gif"></div>
<?php } ?>
