<?php
$PSATLIST = array(
"PSAT Test Date", "10/16/2013 (Wednesday) or 10/19/2013 (Saturday)", 
"Qualification", "for 9th, 10th or 11th graders who will take PSAT in October, 2013", 
"Practice test", "9/11, 9/18, 9/25, 10/02, 10/09 - (Wednesday 6:30pm - 9:00pm) <br> 10/14 (Columbus Day) - (Monday 9:00am - 11:30am)", 
"Review Class", "9/14, 9/21, 9/28, 10/05, 10/12 - (Saturday 9:30am -12:30pm) <br> 10/14 (Columbus Day) - (Monday 11:30am - 2:30pm)", 
"Tuition", "Test only - $150 (6 tests) <br> Review class only - $375 <br> Tests & Review class - $450" 
);

$TITLEPSAT="PSAT Practice Test and Review";
$PSATFILE = "../files/2013PSAT.doc";

?>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=1 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=2>
										<div align=center>
										<a  href='<?php echo($PSATFILE); ?>'>
											<font color=red size=4><?php echo($TITLEPSAT); ?></font></a>
										</div>
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($PSATLIST); $i+=2) {
									$col1 = $PSATLIST[$i];
									$col2 = $PSATLIST[$i+1];
								?>
								<TR>
									<TD class=TABLE_COL1 width=35%>
										<div align=left><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL2 width=65%>
										<div align=left><?php echo($col2); ?></div>
									</TD>
								</TR>
								<?php } ?>
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=30> </TD></TR>
						</TABLE>
					</TD>
				</TR>
				<TR><TD height=20>
					<b><font color=black>** Please call for registration and more information!</font></b>
				</TD></TR>
				<TR><TD height=20>
					<b><font color=black>** Please, bring your calculator and pencils!</font></b>
				</TD></TR>
				<TR><TD height=30> </TD></TR>
				</TABLE>
	</TD>
</TR>		
</table>
