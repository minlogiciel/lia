<?php 
$TEST_OPENHOUSE = array(
"Subject", "English & Math",
"Date", "May 29 (Fri.) 6:00pm<br>May 30 (Sat.) 1:00pm",
"Grade", "5<sup>th</sup> - 11<sup>th</sup>",
"Fee", "Free",
"Location", "Long Island Academy",
"Award", "Trophy awards<br>(1<sup>st</sup>, 2<sup>nd</sup> & 3<sup>rd</sup> place winners in each grade level.)"
);
?>

<div class="box_tit">
	<div align=center><H2><font color=red>OPEN HOUSE TEST</font></H2></div>
</div>
<div class="box_txt">
	<div class=openhouse_left>
    	<a  href="../schedule/"><img src="../images/openhouse_test.jpg" border="0" height=180 ></a>
	</div>
    <div class="openhouse_right">
       	<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">			
		<TR>
			<TD class=OPEN_HOUSE_TITLE>
				<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
				<TR>
					<TD class=OPEN_HOUSE_TITLE>
						<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
						<TR>
							<TD class=OPEN_HOUSE_TITLE height=40 colspan=2>
								May 29 or May 30, 2015
							</TD>
						</TR>
						<TR><TD colspan=2 height=15 class=OPEN_HOUSE_LINE></TD></TR>
			<?php for ($i = 0; $i < count($TEST_OPENHOUSE)-2; $i+=2) { ?>
						<TR>
							<TD class=OPEN_HOUSE_LINE height=20 width=30% valign="top">
								<div align=left> <?php echo($TEST_OPENHOUSE[$i]); ?> : </div>
							</TD>
							<TD  class=OPEN_HOUSE_LINE width=70%>
								<div align=left><?php echo($TEST_OPENHOUSE[$i+1]); ?></div>
							</TD>
						</TR>
			<?php } ?>
						<TR><TD colspan=2 height=15 class=OPEN_HOUSE_LINE></TD></TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>         
	</div>
</div>

