<?php 

$PSATLink ="../files/fa12PSAT.doc";

$ELALIST = array(
 "PSAT Test Date", "Wednesday, Oct 17, 2012 or <br>Saturday, Oct 20, 2012", 
 "Qualification", "9th, 10th or 11th graders who will take PSAT in 2012",
 "Practice test", "9/05, 9/12, 9/19, 9/26, 10/03 & 10/10 - (Wednesday 6:30pm - 9:00pm)",
 "Review Class", "9/15, 9/22, 9/29, 10/06 & 10/13 - <br>(Saturday 9:30am - 12:30pm) ",
 "Tuition", "Test only - $150 (6 tests) <br>Review class only - $430 <br>Tests & Review class - $495 ",
);


?>

<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0>
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=70% border=0>
						<TR>
							<TD >
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR><TD height=30 colspan=2> </TD></TR>
								<TR>
									<TD class=TUITION_TITLE width=100% colspan=2>
										<div align=center>
										<font color=Navy size=4>PSAT Practice Test and Review</font>
										</div>
									</TD>
								</TR>
								<TR><TD height=2 colspan=2 class=PAGE_TITLE>&nbsp; </TD></TR>

								<TR><TD colspan=2 height=30></TD></TR>
								<?php 
								for ($i = 0; $i < count($ELALIST); $i+=2) {
									$col1 = $ELALIST[$i];
									$col2 = $ELALIST[$i+1];
								?>
								<TR>
									<TD class=TABLE_COL1 width=40% valign=top>
										<div align=left><?php echo($col1); ?>  : </div>
									</TD>
									<TD  class=TABLE_COL2 width=60%>
										<div align=left><?php echo($col2); ?></div>
									</TD>
								</TR>
								<TR><TD colspan=2 height=10></TD></TR>
								<?php } ?>
								<TR><TD colspan=2 height=20></TD></TR>
								<TR>
									<TD class=TUITION_TITLE width=100% colspan=2>
										<div align=center>
										<font color=red size=3><em>
										Please call for registration and more information!<br>
										Please, bring your calculator and pencils!<br>
										</em>
										</font>
										</div>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=10 class=PAGE_TITLE> </TD></TR>						
						

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
