<?php 

$APSATLIST = array(
"9th / 11th<br>(Pre-calculus students)",	"SAT II MATH IIC",	"June 1", "Friday : Mar. - May  4:30-5:30/6:30pm", "$350",
"9th / 10th<br>(Bio. honors students)",	"SAT II BIOLOY",	"June 1", "Weekday Session : Feb. - May 5:00-7:00pm<br>Saturday Session : Feb. - May 1:00-3:00pm", "$750",
"10th / 11th<br>(Chem. honors students)",	"SAT II CHEMISTRY",	"June 1", "Weekday Session : Feb. - May 5:00-7:00pm<br>Stauryday Session : Feb. - May 1:00-3:00pm", "$750",
"10th<br>(AP European His. students)",	"AP EUROPEAN HISTORY<br>SAT II WORLD HISTORY",	"May 15<br>June 1", "Thursday : Feb. - May 6:30-8:30pm", "$750",
"9th / 10th<br>(AP World His. students)",	"AP WORLD HISTORY<br>SAT II WORLD HISTORY",	"May 16<br>June 1", "Thursday : Feb. - May 5:00-7:00pm", "$750",
"11th / 12th<br>(AP U.S. His. students)",	"AP U.S. HISTORY<br>SAT II U.S. HISTORY",	"May 15<br>June 1", "Spring Recess : 5 days 10:00am - 12:00pm<br>Saturday : Apr. - May 1:00pm-3:00pm", "$750",

"11th / 12th<br>(AP Physics students)",	"AP PHYSICS<br>SAT II PHYSICS",	"May 13<br>June 1", "Wednesday : Feb. - May, 5:00-7:00pm", "$750",
"11th / 12th<br>(AP Chem. students)",	"AP CHEMISTRY <br>SAT II CHEMISTRY",	"May 6<br>June 1", "Spring Recess : 3-4 days <br>Wednesday : Apr. - May 7:00-9:00pm", "$650",
"11th / 12th<br>(AP Bio. students)",	"AP BIOLOY <br>SAT II BIOLOY",	"May 13<br>June 1", "Spring Recess : 2 days<br>Saturday: Apr. - May 10:00am-12:30pm", "$650",
);

$APSATUSLIST = array(
"11th / 12th<br>(AP students)",	
"AP English<br>SAT II U.S. HISTORY",	
"May 11<br>May 5/ June 2", 
"For May<br>SAT II", "Spring Recess : 4/9-4/13, 1-3/4:30pm<br>Saturday : 4/14-5/5, 10-12am/1:30pm", 
"For June<br>SAT II", "Spring Recess : 4/9-4/13, 1-3pm<br>Saturday : 4/14-5/26, 10-12am", 
"$690");

$APSATPRIVATELIST = array(
"10th / 12th<br>(AP students)",	
"AP ENGLISH (Comp./Lit.)",	"May 10/9", 
"AP ECONOMICS (Micro/Macro)",	"May 16", 
"AP CALCULUS (AB/BC)",	"May 8", 
"Flexible hours for private lesson", "$80/hr");

?>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=5>
										<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a  href='../files/2013AP_SATIIsum.doc'>
										<font color=red size=3>Spring 2013 AP & SAT II Prep. Courses Schedule</font></a>
										<br> <font color=black>(Tentative)</font>
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=TABLE_TITLE height=30 width=22%>
										Grade
									</TD>
									<TD class=TABLE_TITLE height=30 width=22%>
										Subject
									</TD>
									<TD class=TABLE_TITLE height=30 width=8%>
										Test Date
									</TD>
									<TD class=TABLE_TITLE height=30 width=38%>
										Class Schedule
									</TD>
									<TD class=TABLE_TITLE height=30 width=8%>
										Tuition
									</TD>
								</TR>
								<?php
								$n = count($APSATLIST) / 5;
								for ($i = 0; $i < count($APSATLIST); $i+=5) {
									$col1 = $APSATLIST[$i];
									$col2 = $APSATLIST[$i+1];
									$col3 = $APSATLIST[$i+2];
									$col4 = $APSATLIST[$i+3];
									$col5 = $APSATLIST[$i+4];
								?>
								<TR>
									<TD class=TABLE_COL10>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL10>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<TD  class=TABLE_COL20>
										<div align=center><?php echo($col3); ?></div>
									</TD>
									<TD  class=TABLE_COL20>
										<div align=left><?php echo($col4); ?></div>
									</TD>
									<TD  class=TABLE_COL20>
										<div align=center><?php echo($col5); ?></div>
									</TD>
								</TR>
								<?php } 
								$n = count($APSATPRIVATELIST)-3;
								$cn = $n / 2;
								for ($i = 1; $i < $n; $i+=2) {
									$col1 = $APSATPRIVATELIST[$i];
									$col2 = $APSATPRIVATELIST[$i+1];
								?>
								<TR>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL10 rowspan='<?php echo($cn); ?>'>
										<?php echo($APSATPRIVATELIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL10>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL20>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL20 rowspan='<?php echo($cn); ?>'>
										<div align=left><?php echo($APSATPRIVATELIST[$n+1]); ?></div>
									</TD>
									<TD class=TABLE_COL20 rowspan='<?php echo($cn); ?>'>
										<div align=center><?php echo($APSATPRIVATELIST[$n+2]); ?></div>
									</TD>
									<?php } ?>
								</TR>
								<?php }  ?>
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
