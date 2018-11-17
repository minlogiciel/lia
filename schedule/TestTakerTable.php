<?php  
/*
$TESTTAKERLIST = array(
array("08/18/2014", "6pm-10pm", "", 	"Orientation",  "" , "Take Diagnostic SAT #1"),
array("08/20/2014", "", 		"M : ", "TestTaking Techniques", "R/W : ", "Sentence Completions"), 

array("08/25/2014", "", 		"M : ", "Arithmetic/Algebra", "R/W : ", "Error ID") ,
array("08/27/2014", "", 		"M : ", "TT Techniques Review", "R/W : ", "Reading Passages #1"), 

array("09/03/2014", "", 		"M : ", "Arith/Algebra Review", "R/W : ", "Sentence Improvement") ,
array("09/04/2014", "6pm-10pm",	"", "Take Diagnostic SAT #2", "", ""), 

array("09/08/2014", "", 		"M : ", "Geometry", "R/W : ", "Reading Passages #2") ,
array("09/10/2014", "", 		"M : ", "Review Diagnostic SAT #2", "R/W : ", "Review Diagnostic SAT #2"), 

array("09/15/2014", "", 		"M : ", "Functions and Graphs", "R/W : ", "Essay/Paragraph Improve") ,
array("09/17/2014", "6pm-10pm", 		"", "Take Diagnostic SAT #3", "", ""), 

array("09/22/2014", "", 		"M : ", "Geometry Review", "R/W : ", "Reading Comp Review") ,
array("09/24/2014", "", 		"M : ", "Review Diagnostic SAT #3", "R/W : ", "Review Diagnostic SAT #3"), 

array("09/29/2014", "", 		"M : ", "TTT Review #2", "R/W : ", "Complete Writing Review") ,
array("10/01/2014", "6pm-8:30pm", "", "Take Diagnostic SAT #4", "", ""), 

array("10/06/2014", "", 		"M : ", "Review Diagnostic SAT #4", "R/W : ", "Review Diagnostic SAT #4"),
array("10/08/2014", "", 		"M : ", "Complete Math Review", "R/W : ", "Complete Reading Review"), 

array("10/13/2014", "", 		"M : ", "Practice PSAT & Review", "R/W : ", "Practice PSAT & Review"), 
array("10/15/2014", "", 		" ", " NO CLASS!", " ", " ") ,

);

$TTAKERLINK = "../files/LIA_Fall_2014_Schedule.pdf";

$TastTakerSession = "Fall 2014 SAT Course Schedule";
$TestTakerTime ="Sessions: 6:30pm - 9:30pm (except where indicated)";
*/
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
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=2>
										<div align=center>
										<a  href='../files/<?php echo($TESTTAKERNOTE[4]) ?>' target=_blank><font color=red size=4>TESTTAKERS</font></a>
										<br><font color=black>
										<br><font size=3>Long Island Academy</font><br>
										<br><?php echo($TESTTAKERNOTE[0]); ?> 
										<br><?php echo($TESTTAKERNOTE[1]); ?>
										</font>
										</div>
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($TESTTAKER); $i+=2) {
								?>
								<TR>
									<TD class=COL_LABEL_UPPER width=50% valign=top>
									<?php 
										$elem = $TESTTAKER[$i];
										$dates = $elem[0];
										$times = $elem[1];
										$dates = getWeekdayFromYear($dates).  " " .getUSADate($dates). " " .$times;
										
										$title1 = $elem[2];
										$subject1 = $elem[3];
										$title2 = $elem[4];
										$subject2 = $elem[5];
									?>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<TD class=TABLE_COL1 colspan=2>									
												<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<font color=Navy><?php echo($dates); ?></font>
												</div>
											</TD>
										</TR>
										<TR>
											<TD class=TABLE_COL1 width=20%>									
												<div align=right><font color=black><?php echo($title1); ?></font></div>
											</TD>
											<TD class=TABLE_COL2 width=80%>									
												<div align=left><?php echo($subject1); ?></div>
											</TD>
										</TR>
										<TR>
											<TD class=TABLE_COL1 width=20%>									
												<div align=right><font color=black><?php echo($title2); ?></font></div>
											</TD>
											<TD class=TABLE_COL2 width=80%>									
												<div align=left><?php echo($subject2); ?></div>
											</TD>
										</TR>
										</TABLE>
									</TD>
									<TD class=COL_LABEL_UPPER width=50% valign=top>
									<?php 
										$elem = $TESTTAKER[$i+1];
										$dates = $elem[0];
										$times = $elem[1];
										$dates = getWeekdayFromYear($dates).  " " .getUSADate($dates). " " .$times;
										
										$title1 = $elem[2];
										$subject1 = $elem[3];
										$title2 = $elem[4];
										$subject2 = $elem[5];
									?>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<TD class=TABLE_COL1 colspan=2>	
												<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;								
												<font color=Navy><?php echo($dates); ?></font>
												</div>
											</TD>
										</TR>
										<TR>
											<TD class=TABLE_COL1 width=20%>									
												<div align=right><font color=black><?php echo($title1); ?></font></div>
											</TD>
											<TD class=TABLE_COL2 width=80%>									
												<div align=left><?php echo($subject1); ?></div>
											</TD>
										</TR>
										<TR>
											<TD class=TABLE_COL1 width=20%>									
												<div align=right><font color=black><?php echo($title2); ?></font></div>
											</TD>
											<TD class=TABLE_COL2 width=80%>									
												<div align=left><?php echo($subject2); ?></div>
											</TD>
										</TR>
										</TABLE>
									</TD>
								</TR>
								<?php } ?>
							
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=10> </TD></TR>

			<?php 
					for ($i = 0; $i < count($TESTTAKERNOTE[2]); $i++) { 
						if (trim($TESTTAKERNOTE[2][$i])) { ?>
						<TR>
							<TD class=TABLE_COL1 height=20>									
								<div align=center>
									<font color=black><?php echo($TESTTAKERNOTE[2][$i])?></font>
								</div>
							</TD>
						</TR>
			<?php 		} 
					}
			?>
						<?php if (0) { ?>
						<TR>
							<TD class=TABLE_COL1 height=30>									
								<div align=left>
								<p>
								<font color=black>**NOTE : </font><font color=Navy>
								If a session is canceled because of snow, it will be rescheduled for
								<br>
								Thursday, January 3 (6:00-10:00pm); Thursday, January 23 (6:00-10:00pm);
								<br>
								Thursday, February 6 (6:00-10:00pm); Thursday, February 27 (6:00-10:00pm); or
								<br>
								Thursday, March 6 (6:30-9:30pm). Check our website (<a  href='www.ttprep.com'>www.ttprep.com</a>) for updates.
								</font>
								</p>
								</div>
							</TD>
						</TR>
						<?php } ?>
			
				<TR>
					<TD height=40>
						<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
						<a  href='../files/<?php echo($TESTTAKERNOTE[4]) ?>' target=_blank><font color=red><b>Download TESTTAKERS Program (pdf)</b></font></a>
						</div>
					</TD>
				</TR>		
				<TR><TD  height=20> </TD></TR>
	
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
