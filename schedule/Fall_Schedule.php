<?php 

$FALLSEMESTERLINK = "../files/fa12bro.doc";
$FALLSEMESTERT=array("Fall 2014 Class Schedule", " ");


$PREPLIST = array(
"College Prep.",
	"College Essay",	
	"12<sup>th</sup>",	
	"Weekday afternoon, evening or Saturdays (Appointment only)", 
	"$85 per hour<br> (one to one)",

	"<font size=1>USABO (Bio)<br>USNCO (Chem)<br>USAPhO (Physics)</font>",
	"10<sup>th</sup>-12<sup>th</sup>",	
	"Oct. 2014 - Feb. 2015<nr>Small group lesson to prepare for 2015 USA Olympiad in February ", 
	"TBA",


	"SAT II<br>(Bio, Chem, Physics, Math)", 
	"10<sup>th</sup> - 12<sup>th</sup>",	
	"Private lesson to meet October test",  
	"$80/hr",

	"SAT I / PSAT (TestTakers)", 
	"11<sup>th</sup> & 12<sup>th</sup>",
	"8/18 - 10/13/2014<br> (M.&W.) 6:00/6:30 - 9:30/10:00pm", 
	"$1,995 (new)<br>$445 (returning)",

	"ACT", 
	"11<sup>th</sup> & 12<sup>th</sup>",
	"8/5 - 8/28 for September test (T & Th)<br>9/17 - 10/11 for October test (M & W)",
	"TBA",

	"PSAT Practice Tests", 
	"9<sup>th</sup> - 11<sup>th</sup>",
	"9/10 - 10/13/2014<br>Test (Wed.)  6:30pm - 9:00pm<br>Review (Sat.) 9:30am -12:30pm", 
	"$150 (6 Tests)<br>$430 (5 Review)<br>$495 (Test & Review",
);

$HSLIST = array(
"H. S.",
	"PSAT & Trigonometry", 	"10<sup>th</sup> & 11<sup>th</sup>", 	
	"English & Geometry",	"9<sup>th</sup> & 10<sup>th</sup>",
	"English & Algebra",	"8<sup>th</sup> & 9<sup>th</sup>",
	"9/20 - 12/20/2014<br>Saturday 9:30am - 12:30pm",	"$1150 <br>($862)"
);

$JJHSLIST = array(
"J.H.S.",
	"English & Math Enrichment",	"6<sup>th</sup> - 8<sup>th</sup>", "9/20- 12/20/2014<br>Saturday 9:30am - 12:30pm", "$1150 <br>($862)",
	"CTY (SCAT)",	"7<sup>th</sup> - 8<sup>th</sup>", "9/20/2014 - 1/19/2015<br>Saturdays till 12/20/14  9:30am-2:30pm<br>Plus Winter Recess & 3 days in 2015", "$2,500<br>($1,875)",
	"CTY (SCAT)", "5<sup>th</sup> - 6<sup>th</sup>", "9/20/2014 - 1/19/2015<br>Saturdays till 12/20/14  9:30am-2:00pm<br>Plus Winter Recess & 3 days in 2015", "$1,950<br>($1,462)"
);

$PSLIST = array(
"P.S.",
	"English & Math Enrichment",	"4<sup>th</sup> - 5<sup>th</sup>", 
	"9/20- 12/20/2014<br>Saturday 9:30am - 12:30pm", "$1150 <br>($862)"
);

?>

<table  width=100% cellspacing=0 cellpadding=0 align=center border=0>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=TABLE_FTITLE width=100% height=25 colspan=5>
						<div align=center>
							<font color=red size=2><?php echo($FALLSEMESTERT[0]); ?></font>
							<font color=black><?php echo($FALLSEMESTERT[1]); ?> </font>
						</div>
					</TD>
				</TR>
				<TR>
					<TD class=TABLE_TITLE height=30 colspan=2 width=25%>Course</TD>
					<TD class=TABLE_TITLE height=30 width=13%>Grade</TD>
					<TD class=TABLE_TITLE height=30 width=42%>Schedule</TD>
					<TD class=TABLE_TITLE height=30 width=20%>Tuition</TD>
				</TR>
		<?php
			$rn = 3; //// should modify 
			$n = count($PREPLIST) / 4;
			for ($i = 1; $i < count($PREPLIST); $i+=4) {
				$col1 = $PREPLIST[$i];
				$col2 = $PREPLIST[$i+1];
				$col3 = $PREPLIST[$i+2];
				$col4 = $PREPLIST[$i+3];
		?>
				<TR>
			<?php if ($i==1) { ?>
					<TD class=TABLE_COL_V1 width=27 rowspan='<?php echo($n); ?>'>
						<?php echo($PREPLIST[0]); ?>
					</TD>
			<?php } ?>
					<TD class=TABLE_COL1 width=19%>
						<div align=center><?php echo($col1); ?></div>
					</TD>
					<TD  class=TABLE_COL1>
						<div align=center><?php echo($col2); ?></div>
					</TD>
					<TD  class=TABLE_COL1 >
						<div align=left><?php echo($col3); ?></div>
					</TD>
					<TD  class=TABLE_COL2>
						<div align=center><?php echo($col4); ?></div>
					</TD>
				</TR>
			<?php } 

				$n = count($HSLIST)-2;
				for ($i = 1; $i < $n; $i+=2) {
					$col1 = $HSLIST[$i];
					$col2 = $HSLIST[$i+1];
				?>
				<TR>
			<?php if ($i==1) { ?>
					<TD class=TABLE_COL_V1 rowspan='<?php echo($rn); ?>'  width=27>
						<?php echo($HSLIST[0]); ?>
					</TD>
			<?php } ?>
					<TD class=TABLE_COL1>
						<div align=center><?php echo($col1); ?></div>
					</TD>
					<TD  class=TABLE_COL1>
						<div align=center><?php echo($col2); ?></div>
					</TD>
			<?php if ($i==1) { ?>
					<TD class=TABLE_COL1 rowspan='<?php echo($rn); ?>'>
						<div align=left><?php echo($HSLIST[$n]); ?></div>
					</TD>
					<TD class=TABLE_COL2 rowspan='<?php echo($rn); ?>'>
						<div align=center><?php echo($HSLIST[$n+1]); ?></div>
					</TD>
			<?php } ?>
				</TR>
			<?php } 
			$n = 6;
			for ($i = 1; $i < count($JJHSLIST); $i+=4) {
				$col1 = $JJHSLIST[$i];
				$col2 = $JJHSLIST[$i+1];
				$col3 = $JJHSLIST[$i+2];
				$col4 = $JJHSLIST[$i+3];
			?>
				<TR>
			<?php if ($i==1) { ?>
					<TD class=TABLE_COL_V1 rowspan='<?php echo($rn); ?>' width=27>
						<?php echo($JJHSLIST[0]); ?>
					</TD>
			<?php } ?>
					<TD class=TABLE_COL1>
						<div align=center><?php echo($col1); ?></div>
					</TD>
					<TD  class=TABLE_COL1>
						<div align=center><?php echo($col2); ?></div>
					</TD>
					<TD class=TABLE_COL1>
						<div align=left><?php echo($col3); ?></div>
					</TD>
					<TD  class=TABLE_COL2>
						<div align=center><?php echo($col4); ?></div>
					</TD>
				</TR>
				<?php } 
				
				$n = 6;
				for ($i = 0; $i < $rn; $i+=4) {
					$col1 = $PSLIST[$i+1];
					$col2 = $PSLIST[$i+2];
					$col3 = $PSLIST[$i+3];
					$col4 = $PSLIST[$i+4];
				?>
				<TR>
				<?php if ($i==0) { ?>
					<TD class=TABLE_COL_V1 rowspan='1'  width=27>
						<?php echo($PSLIST[0]); ?>
					</TD>
				<?php } ?>
					<TD class=TABLE_COL1>
						<div align=center><?php echo($col1); ?></div>
					</TD>
					<TD  class=TABLE_COL1>
						<div align=center><?php echo($col2); ?></div>
					</TD>
					<TD class=TABLE_COL1>
						<div align=left><?php echo($col3); ?></div>
					</TD>
					<TD  class=TABLE_COL2>
						<div align=center><?php echo($col4); ?></div>
					</TD>
				</TR>
				<?php } ?>
				<TR>
					<TD class=TABLE_COL1 height=30 colspan=2><div align=center>Private Tutoring</div></TD>
					<TD class=TABLE_COL1><div align=center>All grades<br>All subjects</div></TD>
					<TD class=TABLE_COL1><div align=left>Upon request</div></TD>
					<TD class=TABLE_COL2><div align=center>$65-85/hr</div></TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

<TR><TD  height=20> </TD></TR>
<?php if (1) {?>
<TR>
	<TD class=MEET_DATE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD width=5%></TD>
			<TD colspan=4 class=apsattext width=95%>
				<div align=left>* Tests will be given on the 4th, 8th, and 12th Saturday sessions</div>
			</TD>
		</TR>
		<TR>
			<TD width=5%></TD>
			<TD colspan=4 class=apsattext width=95%>
				<div align=left> &nbsp;&nbsp;&nbsp;On the days students should come to LIA at 8:30am instead of 9:30am.</div>
			</TD>
		</TR>
		
		<TR><TD colspan=5 height=20></TD></TR>
		<TR>
			<TD width=5%></TD>
			<TD class=apsattext colspan=4 height=30>
				<div align=left>* Hourly rate for private lesson:</div>
			</TD>
			
		</TR>
		<TR>
			<TD width=5%></TD>
			<TD height=20 width=5%></TD>
			<TD class=apsattext width=30%>
				<div align=left>1 student $65-85</div>
			</TD>
			<TD class=apsattext width=30%>
				<div align=left>2 students $50-55 each</div>
			</TD>
			<TD class=apsattext width=30%>
				<div align=left>3 students $40-45 each</div>
   			</TD>
			
		</TR>
		<TR><TD colspan=5 height=10></TD></TR>
		</TABLE>
	</TD>
</TR>
<?php  } ?>
</TABLE>
