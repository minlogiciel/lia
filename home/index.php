<?php
include "../php/allinclude.php";
session_start();
include ("../public/newslists.php");
include ("../public/registerlists.php");
include ("../public/educationlists.php");
include ("homeinclude.php");
include ("summertop.php");
include ("../schedule/schedule_var.inc");
include_once ("../home/apsat_information.inc");
include_once ("../home/cours_information.inc");
include ("../php/title1.php");
?>

<BODY>

<?php include "../php/maintitle.php"; ?>

<div class="content">
<div class="left">

<?php 
$n_p = count($CONGRATOPPHOTOS);
for ($p = 0; $p < count($CONGRATOPPHOTOS); $p++) { 
	$elem = $CONGRATOPPHOTOS[$p];
	if ($elem[2] < $n_p && $elem[2] != 0) {
		$item = $elem[1];
?>
	<div class="left_box">
<?php	if ($elem[0] == "ADMISSION_VAR[0]") { ?>
		<div class="box_tit">
        	<div align=center><h2><?php echo($item[1]); ?></h2></div>
      	</div>
      	<div class="box_txt">
        	<div class="schedule_left">
         		<ul> 
      			<?php 
					for ($i= 2; $i < count($item); $i+=2) {
						echo("<li>".$item[$i]. " : &nbsp;&nbsp; ".$item[$i+1]."</li>");
					} 
 				?>
           		</ul>
        	</div>
		</div>
<?php 	} else if ($elem[0] == "S_INDEX_MENU") { ?>
	  	<div class="box_tit">
        	<a href="../schedule/?scheduletype=<?php echo($scheduletype); ?>"><h2>LIA Class Schedule</h2></a>
      	</div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="../photos/Picture_020-758x300.jpg" border="0" height="140" width="290">
        	</div>
        	<div class="text2">
<?php
			for ($i = 0; $i < count($item); $i++) {
				$sitem = $item[$i];
				if ($sitem[1]) {
					echo("<div class=schedule2><font size=4>&#9997;&nbsp;&nbsp;</font>");
					echo("<A href='../schedule/?scheduletype=".$sitem[2]."'>".$sitem[0]."</a></div>");
				}
			}
?>
         	</div>
        </div>
<?php 	} else if  ($elem[0] == "COURS_INFOS") {
	$scheduletype = $item[0][1];
?>      	
     	<div class="box_tit">
        	<h2><a href="../schedule/?scheduletype=<?php echo($scheduletype); ?>"><font color=red><?php echo($item[0][0]); ?></font></a></h2>
      	</div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="../photos/Picture_003-489x269.jpg" border="0" height="140" width="290">
        	</div>
        	<div class="text2">
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>	
<?php 
	$i_nb =  count($item);
	for ($i = 1; $i < $i_nb; $i++) {
		$sitem = $item[$i];
?>
		<TR>
			<TD class='course1' valign=top width=35%>
			<?php 
				echo($sitem[0]."<br><font size=1 color=#AAAAAA>".$sitem[1]."<sup>th</sup> grade</font>"); 
			?>
			</TD>
			<TD class='course1' width=65%>
<?php 
				for ($j = 0; $j < count($sitem[2]); $j++) {
					echo($sitem[2][$j]."<br>");
				}
?>
			</TD>
		</TR>
<?php } ?>
		</TABLE><br>
<?php
	for ($i = 1; $i < count($item[0]); $i++) {
		$note = $item[0][$i];
		if (trim($note)) {
			echo("<div align=center><font color=#FC0000><b>* ".$note. "</b></font></div>");
		} 
	}
?>
         	</div>
        </div>
<?php 	} else if ($elem[0] == "SUMMER_OPEN") {

			include ("../home/SummerOpenhouse.php"); 
		}
?>


	</div>
<?php
	}
}
?>
	<!-- congradulation  -->
	<div class="left_box">
	   	<div class="box_tit"><h2>Congratulations</h2></div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="../photos/harvard-university.jpg" border="0" height="140" width="290">
        	</div>
        	<div class="text2"> 	
<?php 
				$nb = count($ADMISSION_VAR);
				if ($nb > 8)
					$nb = 8;
				for ($i= 1; $i < $nb; $i++) {
					$admitem = $ADMISSION_VAR[$i];
					$body = "<div class=box_tit align=center><h2>".$admitem[1]."</h2></div><br>";
					for ($j= 2; $j < count($admitem); $j+=2) {
						$body .= "<div>&nbsp;&nbsp";
						if ($admitem[$j])
							$body .= "<font color=blue>".$admitem[$j]. " : </font>&nbsp;&nbsp; ";
						$body .= $admitem[$j+1]."</div>";
					} 
					
					echo("<div class=schedule2>");
					echo("<font size=4>&#9997;&nbsp;&nbsp;</font>");
					echo("<a href='#' class=tooltip>".$admitem[0]);
					echo("<span>".$body."</span></a>");
					echo("</div>");
				} 
?>
        	</div>
      	</div>
	</div>
	<!-- end congradulation  -->
</div>


<div class="right">
	<?php include "../php/right.php" ?>
</div>
</div>


</BODY>
</html>
