<?php 

$ELALink ="../files/NYS_ELA_Prep.doc";

$ELALIST = array(
array("3/28/2014", 	"Day 1 	ELA", 	"Extended-Response Questions"), 
array("Friday	", 		"4:00-6:00", 		"4:00-6:00", "5:00-7:00"), 
array("3/29/2014", 	"Day 2 	ELA", 	"Short-Response Questions"), 
array("Saturday", 	"1:00-3:00", 		"2:00-4:00", "2:00-4:00"), 
array("3/31/2014 ", 	"Day 3 	ELA", 	"Multiple-Choice Questions"), 
array("Monday", 		"4:00-6:00", 		"4:00-6:00", "5:00-7:00"), 
);

$MATHELALIST = array(
array("4/21/2014 ", 	"Day 1 	Math ", 	"Extended-Response Questions"), 
array("Monday", 		"9:30-11:30", 		"10:30-12:30", "11:30-1:30"), 
array("4/22/2014 ", 	"Day 2 	Math ", 	"Short-Response Questions"), 
array("Tuesday", 	"9:30-11:30", 		"10:30-12:30", "11:30-1:30"), 
array("4/26/2014 ", 	"Day 3 	Math ", 	"Multiple-Choice Questions"), 
array("Saturday", 		"1:00-3:00", 		"2:00-4:00", "5:00-7:00"), 
);



$NYSText1 = array(
"Speaking and Listening will no longer be assessed;",
"All text passages will be authentic and worthwhile to read;",
"Some text passages may express opinions with which the reader may disagree;",
"Text passages may be longer and more rigorous than on the past tests.",
"ELA tests will be split into 4 books and administered across 3 days;",
"New CCLS (Common Core Learning Standards) rubrics will be used for scoring short and extended response questions."
);

$NYSText2 = array(
"Tests will emphasize the major work of the grade. The major work of the grade is a set of key concepts 
     that helps teachers prioritize where to spend most of their instructional time;",
"Assessments will include more questions that require students to take multiple steps in order to
     solve them;",
"Questions that in the past have focused on testing mathematical vocabulary will instead require
     students to apply skills based on their understanding of that vocabulary;",
"Questions using tools like rulers or protractors will include prompts that require students to 
     both choose the appropriate tool and apply mathematical concepts in using the tool."
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
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD>
								<TABLE cellSpacing=2 cellPadding=0 width=90% border=0 align=center>
								<TR>
									<TD class=TUITION_TITLE height=25 colspan=4>
										<div align=center>
										<font color=black size=3>New York State Common Core</font>
										</div>
									</TD>
								</TR>
								<TR><TD height=25 colspan=4></TD></TR>
								<TR>
									<TD class=TUITION_TITLE width=100% height=25 colspan=4>
										<div align=center>
										<font color=Navy size=4>ELA Test Prep. Course</font>
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=MEET_AUTOR width=100% height=25 colspan=4>
										<font color=black size=3>ELA Test Dates
										<br>April 1, 2, and 3, 2014<br>
										</font>
									</TD>
								</TR>
								<TR><TD height=2 colspan=4 class=PAGE_TITLE>&nbsp; </TD></TR>
								
								<TR>
									<TD class=TABLE_COL2 width=30% height=40>
										<div align=center> </div>
									</TD>
									<TD class=TABLE_COL2 width=22%>
										<div align=center> Grade 3 </div>
									</TD>
									<TD  class=TABLE_COL2 width=22%>
										<div align=center> Grade 4 </div>
									</TD>
									<TD  class=TABLE_COL2 width=22%>
										<div align=center> Grade 5 </div>
									</TD>
								</TR>

								<TR><TD height=2 class=PAGE_TITLE colspan=4> </TD></TR>						
								<?php 
								for ($i = 0; $i < count($ELALIST); $i++) {
									$item = $ELALIST[$i];
								?>
								<TR>
									<TD class=TABLE_COL1 >
										<div align=center><?php echo($item[0]); ?></div>
									</TD>
									<TD class=TABLE_COL1 >
										<div align=center><?php echo($item[1]); ?></div>
									</TD>
									<?php  if (count($item) == 3) { ?>
										<TD  class=TABLE_COL1 colspan=2>
											<div align=left><?php echo($item[2]); ?> </div>
										</TD>
									<?php  } else { ?>
										<TD  class=TABLE_COL1 >
											<div align=center><?php echo($item[2]); ?></div>
										</TD>
										<TD  class=TABLE_COL1 >
											<div align=center><?php echo($item[3]); ?> </div>
										</TD>
									<?php } ?>
								</TR>
								<?php if ($i%2)  { ?>
								<TR><TD height=20 colspan=4></TD></TR>
								<?php } } ?>
								<TR><TD height=2 class=PAGE_TITLE colspan=4> </TD></TR>	
								<TR>
									<TD  class=TABLE_COL1 colspan=4 >
										<div align=right><font color=black>Tuition: $140</font></div>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>

						<TR>
							<TD>
								<TABLE cellSpacing=2 cellPadding=0 width=90% border=0 align=center>

								<TR><TD height=25 colspan=4></TD></TR>
								<TR>
									<TD class=TUITION_TITLE width=100% height=25 colspan=4>
										<div align=center>
										<font color=Navy size=4>Math Test Prep. Course</font>
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=MEET_AUTOR width=100% height=25 colspan=4>
										<font color=black size=3>Math Test Dates
										<br>April 30, May 1, and May 2, 2014<br>
										</font>
									</TD>
								</TR>
								<TR><TD height=2 colspan=4 class=PAGE_TITLE>&nbsp; </TD></TR>
								
								<TR>
									<TD class=TABLE_COL2 width=30% height=40>
										<div align=center> </div>
									</TD>
									<TD class=TABLE_COL2 width=22%>
										<div align=center> Grade 3 </div>
									</TD>
									<TD  class=TABLE_COL2 width=22%>
										<div align=center> Grade 4 </div>
									</TD>
									<TD  class=TABLE_COL2 width=22%>
										<div align=center> Grade 5 </div>
									</TD>
								</TR>

								<TR><TD height=2 class=PAGE_TITLE colspan=4> </TD></TR>						
								<?php 
								for ($i = 0; $i < count($MATHELALIST); $i++) {
									$item = $MATHELALIST[$i];
								?>
								<TR>
									<TD class=TABLE_COL1 >
										<div align=center><?php echo($item[0]); ?></div>
									</TD>
									<TD class=TABLE_COL1 >
										<div align=center><?php echo($item[1]); ?></div>
									</TD>
									<?php  if (count($item) == 3) { ?>
										<TD  class=TABLE_COL1 colspan=2>
											<div align=left><?php echo($item[2]); ?> </div>
										</TD>
									<?php  } else { ?>
										<TD  class=TABLE_COL1 >
											<div align=center><?php echo($item[2]); ?></div>
										</TD>
										<TD  class=TABLE_COL1 >
											<div align=center><?php echo($item[3]); ?> </div>
										</TD>
									<?php } ?>
								</TR>
								<?php if ($i%2)  { ?>
								<TR><TD height=20 colspan=4></TD></TR>
								<?php } } ?>
								<TR><TD height=2 class=PAGE_TITLE colspan=4> </TD></TR>	
								<TR>
									<TD  class=TABLE_COL1 colspan=4 >
										<div align=right><font color=black>Tuition: $140</font></div>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>

						<TR><TD height=30> </TD></TR>
						
						<TR><TD height=30 > </TD></TR>

						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TUITION_TITLE width=100% height=25 colspan=3>
										<div class=NYCtitle>
										ELA Test Dates
										<br>April 1, 2, and 3, 2014
										<br>ELA Important Test Changes
										</div>
									</TD>
								</TR>
								<TR>
									<TD  class=TABLE_COL1 height=15>
										
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						<TR>
							<TD class=TABLE_COL1>
								<TABLE cellSpacing=0 cellPadding=0 width=95% border=0>
								<TR>
									<TD  class=TABLE_COL1 valign=top><div class=NYCitem><ol>
										<?php for ($i = 0; $i < count($NYSText1); $i++) { ?>
										<li><?php echo($NYSText1[$i]); ?></li>
										<?php } ?>
										</ol></div>
									</TD>
								</TR>
								
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=20></TD></TR>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TUITION_TITLE width=100% height=25 colspan=3>
										<div class=NYCtitle>
										Math Test Dates
										<br>April 30, May 1, and May 2, 2014
										<br>Math Important Test Changes
										</div>
									</TD>
								</TR>
								<TR>
									<TD  class=TABLE_COL1 height=15>
										
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						<TR>
							<TD class=TABLE_COL1>
								<TABLE cellSpacing=0 cellPadding=0 width=95% border=0>
								<TR>
									<TD  class=TABLE_COL1 valign=top>
										<div class=NYCitem>
										<ol>
										<?php for ($i = 0; $i < count($NYSText2); $i++) { ?>
										<li><?php echo($NYSText2[$i]); ?></li>
										<?php } ?>
										</ol>
										</div>
									</TD>
								</TR>
								
								</TABLE>
							</TD>
						</TR>
						<TR>
							<TD class=TABLE_COL1>
								<TABLE cellSpacing=0 cellPadding=0 width=90% border=0>
								<TR>
									<TD  class=TABLE_COL1 height=40>
										<div align=right><font color=black>Tuition: $195</font></div>
									</TD>
								</TR>
								
								</TABLE>
								
							</TD>
						</TR>
<?php 
$TESTLIST = array(
	array("9:00am-9:30am E-Test",		"9:30am-10:15am E-Test",		"12:00-1:00pm E&M-Tests"),
	array("9:30am-10:15am E-Class",		"10:15am-11:00am E-Class",		"Break"),
	array("Break",		"Break",		"1:00-1:45pm E-Class"),
	array("10:30am-1l:00am M-Test",		"11:15am-11:45am M-Test",		"Break"),
	array("11:00am-11:45am M-Class",		"11:45am-12:30pm M-Class",		"2:00-2:45pm M-Class")
);
?>
	
	
						<TR>
							<TD>
								<TABLE cellSpacing=2 cellPadding=0 width=90% border=0 align=center>
								<TR>
									<TD class=TABLE_COL2 width=33%>
										<div align=center> Grade 4 </div>
									</TD>
									<TD  class=TABLE_COL2 width=33%>
										<div align=center> Grade 5 </div>
									</TD>
									<TD  class=TABLE_COL2 width=33%>
										<div align=center> Grade 3 </div>
									</TD>
								</TR>

								<TR><TD height=2 class=PAGE_TITLE colspan=3> </TD></TR>						
								<?php 
								for ($i = 0; $i < count($TESTLIST); $i++) {
									$item = $TESTLIST[$i];
								?>
								<TR>
									<TD class=TABLE_COL1 >
										<div align=center><?php echo($item[0]); ?></div>
									</TD>
									<TD class=TABLE_COL1 >
										<div align=center><?php echo($item[1]); ?></div>
									</TD>
									<TD  class=TABLE_COL1 colspan=2>
										<div align=left><?php echo($item[2]); ?> </div>
									</TD>
								</TR>
								<?php } ?>
								<TR><TD height=2 class=PAGE_TITLE colspan=4> </TD></TR>	
								</TABLE>
							</TD>
						</TR>
	
						
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
