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

$item = $TOPPHOTOS[0]; 
?>

<BODY>

<?php include "../php/maintitle.php"; ?>
<div class="content">
<div class="left">
<?php if (0) { ?>
<!----------- images  ------------->
	<div class="left_pic">		
		<ul id="YSlide">
<?php 
		for ($i = 0; $i < count($TOPPHOTOS); $i++) { 
			$item = $TOPPHOTOS[$i]; 
     		if ($i == 0) {
     ?>
      		<li style="display: block;" class="YSample">
<?php  		} else { ?>
      		<li style="display: none;" class="YSample">
<?php  		} ?>
				<a href='<?php echo($item[2]); ?>' target="_target"><IMG style="opacity: 1;" SRC="../photos/<?php echo($item[0]); ?>" border=0 width="640" height="350" ></a>
				<div class=title1>
					<h2><?php echo($item[1]); ?></h2>
				</div>
			</li>
			<?php } ?>
		</ul>
		<div id="YSIndex">
	        <ul>
		        <li class="li_01  current"><a>&nbsp;1&nbsp;</a></li>
		        <li class="li_02 "><a>&nbsp;2&nbsp;</a></li>
		        <li class="li_03 "><a>&nbsp;3&nbsp;</a></li>
		        <li class="li_04 "><a>&nbsp;4&nbsp;</a></li>
		        <li class="li_05 "><a>&nbsp;5&nbsp;</a></li>
	        </ul>
		</div>
	</div>
	<div><img src="../images/box_bg.gif"></div>
	<!-- div class="left_box">
		<?php  /* include "SummerTest.php"; */ ?>
	</div -->
<?php  }
for ($n = 0; $n < count($CONGRATOPPHOTOS); $n++) {
	$elem = $CONGRATOPPHOTOS[$n];
	$item = $elem[2];
	$other = $elem[4];
	if ($elem[1] == 1) {
?>
	<div class="left_box">
<?php 
	switch ($other[3]) { 
// APSAT II	
		case 600:  
?>      	
     	<div class="box_tit">
        	<h2><a href="../schedule/?scheduletype=<?php echo($M_APSAATII); ?>"><font color=red><?php echo($item[0][0]); ?></font></a></h2>
      	</div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="../photos/<?php echo($other[1]); ?>" border="0" height="140" width="290">
        	</div>
        	<div class="text2">
<?php 
		for ($i = 1; $i < count($item); $i++) {
			$sitem = $item[$i];
			echo("<div class=course2>".$sitem[0]."</div>");
			echo("<div class=coursenote>".$sitem[1]."</div>");
		} 
		for ($i = 1; $i < count($item[0]); $i++) {
			$note = $item[0][$i];
			if (trim($note)) {
				echo("<div align=center><font color=#FC0000><b>* ".$note. "</b></font></div>");
			}
		} 
?>
          	</div>
        </div>
<?php 	
			break ;
// open house test
		case 400 :		
			include ("../home/SummerOpenhouse.php");
			break;
		case 500 :		
			include ("../home/openhouse.php");
			break;
// Saturday Class Information			
		case 300 :
		$scheduletype = $M_FALL;
		for ($i = 0; $i < count($S_INDEX_MENU); $i++) {
			if ($S_INDEX_MENU[$i][1] == 1 &&  ($S_INDEX_MENU[$i][2] == $M_SPRING || $S_INDEX_MENU[$i][2] == $M_FALL)) {
				$scheduletype = $S_INDEX_MENU[$i][2];
				break;
			}
		}
		
?>      	
     	<div class="box_tit">
        	<h2><a href="../schedule/?scheduletype=<?php echo($scheduletype); ?>"><font color=red><?php echo($item[0][0]); ?></font></a></h2>
      	</div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="../photos/<?php echo($other[1]); ?>" border="0" height="140" width="290">
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
?>
		<div align=center><font color=#FC0000><b>* <?php echo($note); ?></b></font></div>
<?php 
		} 
	}
?>
         	</div>
        </div>
<?php 	
			break ;
// class schedule			
		case 200 : 		
		?>
 		<div class="box_tit">
			<h2><a href="../schedule/"><font color=red><?php echo($elem[0]); ?></font></a></h2>
		</div>
		<div class="box_txt">
			<div class="tit_img">
				<img src="../photos/<?php echo($other[1]); ?>" border="0" height="140" width="290">
	        </div>
        	<div class="text2">
        	<ul>
<?php
			for ($i = 0; $i < count($item); $i++) {
				$sitem = $item[$i];
				if ($sitem[1]) {
					echo("<div class=schedule2><font size=4>&#9997;&nbsp;&nbsp;</font>");
					echo("<A href='../schedule/?scheduletype=".$sitem[2]."'>".$sitem[0]."</a></div>");
				}
			}
?>
  			</ul>
  			</div>
      	</div>

<?php 
			break;
 // congratulation 
		default :
?>
    	<div class="box_tit">
        	<h2><font color=red><?php echo($item[1]); ?></font></h2>
      	</div>
      	<div class="box_txt">
<?php if (trim($other[1])) { ?>
        	<div class="tit_img">
          		<img src="../photos/<?php echo($other[1]); ?>" border="0" height="140" width="290">
        	</div>
        	<div class="text2">
<?php } else { ?>
       		<div class="schedule_left">
<?php } ?>
          		<ul> 
      			<?php 
					for ($i= 2; $i < count($item); $i+=2) {
						echo("<li>");
						if ($item[$i]) {
							echo($item[$i]. " : &nbsp;&nbsp; ");
						}
						echo($item[$i+1]."</li>");
					} 
 				?>
           		</ul>
        	</div>
      	</div>
<?php 
		break; 
	}
?>
    </div>
<?php  } 

} ?>
<!--  end congratulation -->

	
</div>

<script language="javascript" type="text/javascript" src="../scripts/yao.js"></script>
<script language="javascript" type="text/javascript">
        <!--
        YAO.YTabs({
                tabs: YAO.getEl('YSIndex').getElementsByTagName('li'),
                contents: YAO.getElByClassName('YSample', 'li', 'YSlide'),
                defaultIndex: 0,
                auto: true,
                fadeUp: true
        });
        //-->
</script>

<div class="right">
	<?php include "../php/right.php" ?>
</div>
</div>
<?php include "../php/foot1.php"; ?>

</BODY>
</html>
