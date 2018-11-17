<?php 
$ACTLIST = array(
array("2/18/2014", "1:00pm-4:00pm", "Science Reasoning Review  1"), 
array("2/20/2014", "1:00pm-4:00pm", "Science Reasoning Review  2"), 
array("2/22/2014", "1:00pm-4:00pm", "English & Writing Review 1"), 
array("03/01/2014", "1:00pm-4:00pm", "English & Writing Review 2"), 
array("03/08/2014", "1:00pm-4:00pm", "Reading Review 1"), 
array("03/15/2014", "1:00pm-4:00pm", "Reading Review 2"), 
array("03/22/2014", "1:00pm-4:00pm", "Math Review"), 
array("03/29/2014", "1:00pm-4:00pm", "English, Reading & Writing Review"), 
array("04/05/2014",	"1:00pm-4:00pm", "Full-Length Practice Test "), 
);

$ACTTESTLIST = array(
"April 12, 2014", 	"March 7, 2014", 		"March 8 - 21, 2014" ,
"June 14, 2014", 	"May 9, 2014", 		"May 10 - 23, 2014" 
);



$ACT_TT = "The ACT may be a better test for you if";
$ACTText = array(
"You had a PSAT or SAT score inconsistent with your academic performance in school.",
"Your vocabulary is not as strong as your reading. You read well and relatively quickly. Arguably, the ACT is a test that is three parts verbal — English, Reading and Science (the latter section requires no knowledge outside of what the test presents). ",
"You are great at writing papers but haven't had formal grammar instruction. The English portion of the ACT is more a test of punctuation and sentence and paragraph structure. Many students find the English to be common sense, much like proof-reading a paper. ",
"You are more academic than \"test savvy.\" The ACT seems to most people to be more curriculum-based and thus more straightforward. There is more advanced math content (logarithms, trigonometry, conic sections, etc.), but it seems more like a regular test you might encounter in school.",
);


$ACT_T_DESP = "Description of the ACT";
$ACT_DESP = array(
	"The ACT (No Writing) consists of four multiple-choice tests: English, Mathematics, Reading, and Science.",
	"The ACT Plus Writing includes the four multiple-choice tests and a Writing Test."
);

$ACTDesp = array(
array("English", "75 questions",  "45 minutes", "Measures standard written English and rhetorical skills."),
array("Mathematics", "60 questions", "60 minutes",  "Measures mathematical skills students have typically acquired in courses taken up to the beginning of grade 12."),
array("Reading", "40 questions", "35 minutes", "Measures reading comprehension."),
array("Science", "40 questions", "35 minutes", "Measures the interpretation, analysis, evaluation, reasoning, and problem-solving skills required in the natural sciences."),
array("Optional Writing Test", "1 prompt", "30 minutes", "Measures writing skills emphasized in high school English classes and in entry-level college composition courses.")
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
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TUITION_TITLE width=100% height=25 colspan=3>
										<div align=center><br><br>
						<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
						<a  href='../files/LIA_MTP_ACT_Class.doc'><font color=red size=4>ACT Prep. Course</font></a><br><br>
										</div>
									</TD>
								</TR>
								<!-- TR>
									<TD class=MEET_AUTOR width=100% height=25 colspan=3>
										<font color=black>
										<br> with <br>
										<b>Dr. Danielowich (Science)</b><br>
										<b>Mr. Bosley (English, Reading & Writing)</b><br>
										</font>
									</TD>
								</TR -->
								<TR>
									<TD class=MEET_AUTOR width=100% height=25 colspan=3>
										<font color=black>
										<br><b>Tuition : $695</b><br>
										</font>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_TITLE height=20 width=30%>
										Date
									</TD>
									<TD class=TABLE_TITLE height=20 width=30%>
										Time
									</TD>
									<TD class=TABLE_TITLE height=20 width=40%>
										Subject
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($ACTLIST); $i++) {
									$elem = $ACTLIST[$i];
									$dates = $elem[0];
									if (strpos($dates, "(") && strpos($dates, ")")) {
									}
									else {
										$dates .= " (" .getWeekdayFromYear($dates).  ")";
									}
									$nn = count($elem)/2;
								
									for ($j = 0; $j < $nn; $j+=2) {
									$times = $elem[$j+1];
									$title = $elem[$j+2];
								?>								
								<TR>
								<?php if ($j == 0 ) { ?>
									<TD class=TABLE_COL1 rowspan=<?php echo($nn); ?>>
										<div align=left><?php echo($dates); ?></div>
									</TD>
								<?php } ?>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($times); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($title); ?></div>
									</TD>
								</TR>
								<?php } } ?>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>

				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_TITLE height=30 width=30%>
										Test Date
									</TD>
									<TD class=TABLE_TITLE height=30  width=30%>
										Registration Deadline
									</TD>
									<TD class=TABLE_TITLE height=30  width=40%>
										Late Fee Required
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($ACTTESTLIST); $i+=3) {
									
									$col1 = $ACTTESTLIST[$i];
									$col2 = $ACTTESTLIST[$i+1];
									$col3 = $ACTTESTLIST[$i+2];
								?>
								<TR>
									<TD class=TABLE_COL1>
										<div align=left><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($col2); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($col3); ?></div>
									</TD>
								</TR>
								<?php } ?>
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=30> </TD></TR>
						<TR><TD height=2 class=PAGE_TITLE>&nbsp; </TD></TR>
						
						<TR>
							<TD class=TABLE_COL1>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD  class=TABLE_COL1 valign=top height=40>
										<div align=left><font color=black size=3>
										
										<?php echo($ACT_TT); ?> : 
										
										</font></div>
									</TD>
								</TR>
								<TR>
									<TD  class=TABLE_COL1 valign=top><div align=left><font color=black><ol>
										<?php for ($i = 0; $i < count($ACTText); $i++) { ?>
										<li><?php echo($ACTText[$i]); ?></li><br><br>
										<?php } ?>
										</ol></font></div>
									</TD>
								</TR>
								
								</TABLE>
							</TD>
						</TR>

						<TR>
							<TD class=TABLE_COL1>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD  class=TABLE_COL1 valign=top height=40>
										<div align=left><font color=black size=3>
										
										<?php echo($ACT_T_DESP); ?> : 
										
										</font></div>
									</TD>
								</TR>
								<TR>
									<TD  class=TABLE_COL1 valign=top><div align=left><font color=black><ol>
										<?php for ($i = 0; $i < count($ACT_DESP); $i++) { ?>
										<?php echo($ACT_DESP[$i]); ?><br>
										<?php } ?>
										</ol></font></div>
									</TD>
								</TR>
								
								</TABLE>
							</TD>
						</TR>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_TITLE height=30 width=20%>
										Test
									</TD>
									<TD class=TABLE_TITLE   width=20%>
										
									</TD>
									<TD class=TABLE_TITLE   width=20%>
										
									</TD>
									<TD class=TABLE_TITLE   width=40%>
										Content
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($ACTDesp); $i++) {
									
									$desp = $ACTDesp[$i];
								?>
								<TR>
									<TD class=TABLE_COL1>
										<div align=left><?php echo($desp[0]); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($desp[1]); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($desp[2]); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($desp[3]); ?></div>
									</TD>
								</TR>
								<?php } ?>
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
