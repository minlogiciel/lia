<?php 
	$c_year = 2018;
	$c_year1 = $c_year-1;
	$c_year2 = $c_year-2;
	include "TestWinnerStudent_".$c_year.".inc"; 
?>
	<div class="box_tit">
    	<div align=center><h2><a  href="../schedule/OpenTestResult.php?annee=<?php echo($c_year); ?>"><font color=red>Open House Test / Summer Placement Test</font></a></h2></div>
	</div>
    <div class="box_txt">
      	
	    <div class="tit_img">
	    	<p><a  href="../schedule/OpenTestResult.php?annee=<?php echo($c_year); ?>"><font color=red><?php echo($c_year); ?> Summer Placement Test Report</font></a></p>
	           <a  href="../schedule/OpenTestResult.php?annee=<?php echo($c_year); ?>"><img src="../images/trophy.jpg" border="0" height=160 ></a>
	        <p><a  href="../schedule/OpenTestResult.php?annee=<?php echo($c_year1); ?>"><font color=red><?php echo($c_year1); ?> Summer Placement Test Report</font></a></p>
	        <p><a  href="../schedule/OpenTestResult.php?annee=<?php echo($c_year2); ?>"><font color=red><?php echo($c_year2); ?> Summer Placement Test Report</font></a></p>
		</div>
		<div class="text2">
		    <TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">			
			<TR>
				<TD class=OPEN_HOUSE_TITLE>
					<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
					<TR>
						<TD class=OPEN_HOUSE_TITLE height=40>Congratulations : </TD>
					</TR>
					</TABLE>
				</TD>
			</TR>
			<TR>
				<TD class=OPEN_HOUSE_LINE>
					<MARQUEE behavior="scroll" onmouseover=this.stop() onmouseout=this.start() trueSpeed scrollAmount=1 scrollDelay=25 height=220 direction=up>
					<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
					<TR><TD colspan=2 height=5 class=OPEN_HOUSE_LINE></TD></TR>
					<?php for ($i = 0; $i < count($_SUMMERTOP); $i+=2) { ?>
					<TR>
						<TD class=OPEN_HOUSE_LINE height=20 width=70% valign="top">
							<div align=left> <?php echo($_SUMMERTOP[$i]); ?></div>
						</TD>
						<TD  class=OPEN_HOUSE_LINE width=30%>
							<div align=left><?php echo($_SUMMERTOP[$i+1]); ?></div>
						</TD>
					</TR>
					<?php } ?>
							
					<TR><TD colspan=2 height=5 class=OPEN_HOUSE_LINE></TD></TR>							
					</TABLE>
					</MARQUEE>
				</TD>
			</TR>
			</TABLE>         
	    </div>
	</div>



