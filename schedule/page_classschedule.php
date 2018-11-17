<?php include "../public/home.php"; ?>
<table  width=100% cellspacing=0 cellpadding=0 align=center border=0>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=2 width=100% border=0>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=1 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=6>
										<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a  href="<?php echo($SEMESTERLINK); ?>"><font color=red size=3><?php echo($TSEMESTER[0]); ?></font></a>
										<font color=black><?php echo($TSEMESTER[1]); ?> </font>
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=TABLE_TITLE height=30 colspan=2 width=20%>
										Course
									</TD>
									<TD class=TABLE_TITLE height=30 width=12%>
										Grade
									</TD>
									<TD class=TABLE_TITLE height=30 width=30%>
										Description
									</TD>
									<TD class=TABLE_TITLE height=30 width=23%>
										Schedule
									</TD>
									<TD class=TABLE_TITLE height=30 width=15%>
										Tuition
									</TD>
								</TR>
								<?php
								$n = count($PREPLIST) / 5;
								for ($i = 1; $i < count($PREPLIST); $i+=5) {
									$col1 = $PREPLIST[$i];
									$col2 = $PREPLIST[$i+1];
									$col3 = $PREPLIST[$i+2];
									$col4 = $PREPLIST[$i+3];
									$col5 = $PREPLIST[$i+4];
								?>
								<TR>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL_V width=6% rowspan='<?php echo($n); ?>'>
										<?php echo($PREPLIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL1 width=14%>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<TD  class=TABLE_COL2>
										<div align=left><?php echo($col3); ?></div>
									</TD>
									<TD  class=TABLE_COL2>
										<div align=left><?php echo($col4); ?></div>
									</TD>
									<TD  class=TABLE_COL2>
										<div align=center><?php echo($col5); ?></div>
									</TD>
								</TR>
								<?php } 
								$n = count($HSLIST)-3;
								$cn = $n / 3;
								for ($i = 1; $i < $n; $i+=3) {
									$col1 = $HSLIST[$i];
									$col2 = $HSLIST[$i+1];
									$col3 = $HSLIST[$i+2];
								?>
								<TR>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL_V width=6% rowspan='<?php echo($cn); ?>'>
										<?php echo($HSLIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL1>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<TD  class=TABLE_COL2>
										<div align=left><?php echo($col3); ?></div>
									</TD>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'>
										<div align=left><?php echo($HSLIST[$n+1]); ?></div>
									</TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'>
										<div align=center><?php echo($HSLIST[$n+2]); ?></div>
									</TD>
									<?php } ?>
								</TR>
								<?php } 
								
								$n = count($JHSLIST)-3;
								$cn = $n / 2;
								for ($i = 1; $i < $n; $i+=2) {
									$col1 = $JHSLIST[$i];
									$col2 = $JHSLIST[$i+1];
								?>
								<TR>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL_V rowspan='<?php echo($cn); ?>'><?php echo($JHSLIST[0]); ?></TD>
									<TD class=TABLE_COL1><div align=center><?php echo($col1); ?></div></TD>
									<TD  class=TABLE_COL1><div align=center><?php echo($col2); ?></div></TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'><div align=left><?php echo($JHSLIST[$n]); ?></div></TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'><div align=left><?php echo($JHSLIST[$n+1]); ?></div></TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'><div align=center><?php echo($JHSLIST[$n+2]); ?></div></TD>
									<?php } else { ?>
									<TD class=TABLE_COL1><div align=center><?php echo($col1); ?></div></TD>
									<TD class=TABLE_COL1><div align=center><?php echo($col2); ?></div></TD>
									<?php } ?>
								</TR>
								<?php }
								
								$n = count($PSLIST)-3;
								$cn = $n / 2;
								for ($i = 1; $i < $n; $i+=2) {
									$col1 = $PSLIST[$i];
									$col2 = $PSLIST[$i+1];
								?>
								<TR>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL_V rowspan='<?php echo($cn); ?>'><?php echo($PSLIST[0]); ?></TD>
									<TD class=TABLE_COL1><div align=center><?php echo($col1); ?></div></TD>
									<TD  class=TABLE_COL1><div align=center><?php echo($col2); ?></div></TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'><div align=left><?php echo($PSLIST[$n]); ?></div></TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'><div align=left><?php echo($PSLIST[$n+1]); ?></div></TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($cn); ?>'><div align=center><?php echo($PSLIST[$n+2]); ?></div></TD>
									<?php } else { ?>
									<TD class=TABLE_COL1><div align=center><?php echo($col1); ?></div></TD>
									<TD class=TABLE_COL1><div align=center><?php echo($col2); ?></div></TD>
									<?php } ?>
								</TR>
								<?php } ?>
								<TR>
									<TD class=TABLE_COL1 height=30 colspan=2><div align=center>Private Tutoring</div></TD>
									<TD class=TABLE_COL1><div align=center>All grades</div></TD>
									<TD class=TABLE_COL2><div align=left>All subjects &amp; tests</div></TD>
									<TD class=TABLE_COL2><div align=center>Flexile hours</div></TD>
									<TD class=TABLE_COL2><div align=center>$60-85/hr</div></TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR><TD  height=10> </TD></TR>



				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
