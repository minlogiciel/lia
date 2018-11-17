<?php  
$CTYSATTITLE = "CTY SAT 2013-2014 Winter Schedule";
$CTYSATCLASS = "For 7th & 8th Graders";
$CTYSATFEE = "$690";
$CTYSATLIST = array(
array("Winter Break Class", "12/26/2013", "12/27/2013", "12/28/2013", "12/30/2013", "12/31/2012", "9:30am - 1:30pm"),
array("Practice Test #1", "01/31/2013", "1:309m - 4:30pm"),
array("January Class", "01/04/2014", "01/11/2014", "01/18/2014", "9:30am - 1:30pm"),
array("Practice Test #2", "01/20/2014", "9:30am - 12:30pm"),
);

$CTYSCATTITLE = "CTY SCAT 2013-2014 Winter Schedule";
$CTYSCATCLASS = "For 5th & 6th Graders";
$CTYSCATFEE = "$690";
$CTYSCATLIST = array(
array("Winter Break Class", "12/26/2013", "12/27/2013", "12/28/2013", "12/30/2013", "12/31/2013", "9:30am - 12:30am"),
array("Practice Test #1", "12/31/2013", "12:30pm - 2:00pm"),
array("January Class", "01/04/2014", "01/11/2014", "01/18/2014", "01/25/2014", "9:30am - 12:30am"),
array("Practice Test #2", "01/21/2014", "9:30am - 11:00pm"),
);


$CTYLINK2 = "../files/CTY_2013-2014.doc";
?>

<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0 align="center">
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=3>
										<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a  href='<?php echo($CTYLINK2); ?>'><font color=red size=3><?php echo($CTYSATTITLE); ?></font></a>
										<br><font color=black>( <?php echo($CTYSATCLASS); ?>, Tuition : <?php echo($CTYSATFEE); ?> )</font>
										</div>
									</TD>
								</TR>
								<?php $list_nb = count($CTYSATLIST);
								for ($i = 0; $i < $list_nb; $i++) {
									$cty = $CTYSATLIST[$i];
									$title = $cty[0];
									
								?>
								<TR>
									<TD class=TABLE_COL2 width=30%>
										<div align=center><?php echo($title); ?></div>
									</TD>
									<TD  class=TABLE_COL1 width=40%>
										<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center height=25>
								<?php 
									$n_elem = count($cty) - 1;
									for ($j = 1; $j < $n_elem; $j++) {
										$dates =  $cty[$j];
										$dates = getUSADate( $cty[$j]). " (" .getWeekdayFromYear($cty[$j]).  ")";
								?>
										<TR>
											<TD class=TABLE_COL1 width=100%><div align=left>
												<?php echo($dates); ?> 
											</div>
											</TD>
										</TR>
								<?php } ?>
										</TABLE>
									</TD>
									<TD  class=TABLE_COL1 width=30%>
										<div align=left><?php echo($cty[$n_elem]); ?></div>
									</TD>
								</TR>
								<?php } ?>
								<TR>
									<TD colspan=3 class=TABLE_COL2>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
										<TR>
											<TD class=TABLE_COL2 width=50% valign=top>
												<div align=left>&nbsp;
												* Deadline for SAT on Jan. 25, 2014 
												</div>
											</TD>
											<TD class=TABLE_COL1 width=50%>
												<div align=left>
												CTY Application Due Nov. 25, 2013<br>
												SAT Registration Due Dec. 27, 2013
												</div>
											</TD>
										</TR>
										</TABLE>
									</TD>
								</TR>							
								</TABLE>
							</TD>
						</TR>

						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=3>
										<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a  href='<?php echo($CTYLINK2); ?>'><font color=red size=3><?php echo($CTYSCATTITLE); ?></font></a>
										<br><font color=black>( <?php echo($CTYSCATCLASS); ?>, Tuition : <?php echo($CTYSCATFEE); ?> )</font>
										</div>
									</TD>
								</TR>
								<?php $list_nb = count($CTYSCATLIST);
								for ($i = 0; $i < $list_nb; $i++) {
									$cty = $CTYSCATLIST[$i];
									$title = $cty[0];
									
								?>
								<TR>
									<TD class=TABLE_COL2 width=30%>
										<div align=center><?php echo($title); ?></div>
									</TD>
									<TD  class=TABLE_COL1 width=40%>
										<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center height=25>
								<?php 
									$n_elem = count($cty) - 1;
									for ($j = 1; $j < $n_elem; $j++) {
										$dates =  $cty[$j];
										$dates = getUSADate( $cty[$j]). " (" .getWeekdayFromYear($cty[$j]).  ")";
								?>
										<TR>
											<TD class=TABLE_COL1 width=100%><div align=left>
												<?php echo($dates); ?> 
											</div>
											</TD>
										</TR>
								<?php } ?>
										</TABLE>
									</TD>
									<TD  class=TABLE_COL1 width=30%>
										<div align=left><?php echo($cty[$n_elem]); ?></div>
									</TD>
								</TR>
								<?php } ?>
								<TR>
									<TD colspan=3 class=TABLE_COL2>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
										<TR>
											<TD class=TABLE_COL2 width=30% valign=top>
												<div align=left>&nbsp;
												* Deadlines
												</div>
											</TD>
											<TD class=TABLE_COL1 width=70%>
												<div align=left>
												CTY Application due a month before desired test date<br>
												SCAT Test before Jan. 31, 2014
												</div>
											</TD>
										</TR>
										</TABLE>
									</TD>
								</TR>							
								
								</TABLE>
							</TD>
						</TR>

						<TR><TD height=10> </TD></TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
