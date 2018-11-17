<?php 
include "../php/allinclude.php"; 
session_start();

include ("../php/title1.php");
?>

<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9OpdlEHy1-u9hSYsh4MOqAHN-FYl2mvI&sensor=true"></script>    
<script type="text/javascript" src="../scripts/gmap.js"></script>

<BODY onload="initializemaps()">
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
      	<div class="box_txt">
			<div id="map_canvas" style="width:640px; height:380px;"></div> 
		</div>
	</div>
 	<div><img src="../images/box_bg.gif"></div>
 	
 	<div class="left_box">
      	<div class="box_txt">
      		<div class=tit_img>
				<div class=DIR_TITLE> L. I. A.</div>
				<div class=DIR_TITLE>
				<P>303 Sunnyside Blvd.<br>
					Suite #10,<br>
					Plainview, NY 11803<br><br><br>
					<span class="LABEL60">TEL.</span> :&nbsp;&nbsp;(516) 364-2121<br>
					<span class="LABEL60">Email</span> :&nbsp;&nbsp;<?php email(); ?> <br>
					<span class="LABEL60">WEB</span> :&nbsp;&nbsp;<?php site(); ?> <br><br>
				</P>
				</div>
			</div>
			
			<div class=text2>

				<div class=DIRECTION> Direction to LIA </div>
				<div class=DIR_TITLE>From western Long Island via Long Island Expressway:</div>
				<div class=DIR_TEXT>
					Take exit #46 - Sunnyside Blvd. Stay in right lane and make a left at
					traffic light. Turn right on to Fairchild Ave. Holliday Inn is on your right and
					we are on your left.
				</div>
				<br>
				<div class=DIR_TITLE>From western Long Island via Northern Parkway:</div>
				<div class=DIR_TEXT>
					Take exit #38 and make left at stop sign - Sunnyside Blvd. Turn left on to
					Fairchild Ave. Holliday Inn is on your right and we are on your left.
				</div>
				<br>
				<div class=DIR_TITLE>From eastern Long Island via Long Island Expressway:</div>
				<div class=DIR_TEXT>
					Take exit #46 - Sunnyside Blvd. Turn right at traffic light. Make right on to
					Fairchild Ave. Holliday Inn is on your right and we are on your left.
				</div>
				<br>
				<div class=DIR_TITLE>From eastern Long Island via Northern Parkway:</div>
				<div class=DIR_TEXT>
					Take exit #38 - Make right at stop sign - Sunnyside Blvd. Follow the road
					as it curves to the right. Turn left on to Fairchild Ave. Holliday Inn is on
					your right and we are on your left.
				</div>
			</div>
		</div>
	</div>
</div>
<div class="right">
	<?php include "../php/right.php" ?>
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>

