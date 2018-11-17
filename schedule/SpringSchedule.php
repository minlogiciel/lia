<?php 

$FALLSEMESTERLINK = "../files/fa12bro.doc";
$FALLSEMESTERT=array("Fall 2012 Saturday Class Schedule", " ");


$PREPLIST = array(
"College Prep.",
	"AP",	"9<sup>th</sup>-12<sup>th</sup>",	
	"Lit. & Comp., Lang. & Comp. <br>Calculus AB / BC <br>European, World & US History <br>Gov.,Macro/Micro Economics <br>Biology, Chemistry & Physics",
	"Feb. / Mar. - May, 2014", 
	"$350-750 (class)<br>$80/hr (private)<br><font color=grey><em>*See AP & SAT II Schedule for details</em></font>",

	"SAT II", "9<sup>th</sup>-11<sup>th</sup>",	
	"Literature <br>Math IIC <br>World & U.S. History <br>Biology, Chemistry & Physics",  
	"Feb. / Mar. - May, 2014", 
	"$350-750 (class)<br>$80/hr (private)",

	"SAT I <br>(TestTakers)", "11<sup>th</sup>",
	"Critical Reading <br>Math <br>Writing", 
	"1/06- 3/05 2014<br>Mon. & Wed. <br>6:00/6:30pm - 9:30/10:00pm",	"$1,845 (new) <br>$445 (returning)",
);

$HSLIST = array(
"H.S. Enrichment",
	"HS-B", 	"10<sup>th</sup>/11<sup>th</sup>", 	"Algebra II & Trigonometry <br>PSAT/SAT Reading & Writing",
	"HS-C",		"9<sup>th</sup>/10<sup>th</sup>",	"Geometry <br>English Enrichment & PSAT Prep.",
	"HS-D",		"7<sup>th</sup>/9<sup>th</sup>",	"Integrated Algebra <br>English Enrichment",
	"1/18 - 5/31/2014 <br>(Saturday)<br>9:30am-12:30pm",	"$1,750 <br>(18 weeks)<br><br><font color=#FC0000>25% off before 1/11/14</font>"
);

$JJHSLIST = array(
"J.H.S. Enrichment",
	"IS-A",	"7<sup>th</sup> / 8<sup>th</sup>", 
	"IS-B",	"6<sup>th</sup> / 7<sup>th</sup>", 
	"IS-C", "5<sup>th</sup> / 6<sup>th</sup>",
	"English & Math Enrichment <br>Intermediate Level State Test Prep.",
	"1/18 - 5/31/2014 <br>(Saturday)<br>9:30am-12:30pm",	"$1,750 <br>(18 weeks)"
);

$PSLIST = array(
	"P.S. Enrichment",
	"PS-A",	"5<sup>th</sup>", 
	"PS-B",	"4<sup>th</sup>", 
	"PS-C", "3<sup>rd</sup>",
	"English & Math Enrichment <br>Elementary Level State Test Prep.",
	"1/18 - 5/31/2014 <br>(Saturday)<br>9:30am-12:30pm	",	"$1,750 <br>(18 weeks)"
);

?>

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
										<div align=center>
										<a  href='../files/sp14bro.doc'>
										<font color=red>*** 2014 SPRING COURSE INFORMATION ***</font></a>
										<font color=black><?php echo($FALLSEMESTERT[1]); ?> </font>
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=TABLE_TITLE height=30 colspan=2 width=15%>
										Course
									</TD>
									<TD class=TABLE_TITLE height=30 width=12%>
										Grade
									</TD>
									<TD class=TABLE_TITLE height=30 width=30%>
										Description
									</TD>
									<TD class=TABLE_TITLE height=30 width=20%>
										Schedule
									</TD>
									<TD class=TABLE_TITLE height=30 width=20%>
										Tuition
									</TD>
								</TR>
								<?php
								$rn = 3; //// should modify 
								$rn3 = 9; //// should modify 
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
									<TD class=TABLE_COL_V1 width=27 rowspan='<?php echo($rn); ?>'>
										<?php echo($PREPLIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL1 width=9%>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($col3); ?></div>
									</TD>
									<TD  class=TABLE_COL2>
										<div align=center><?php echo($col4); ?></div>
									</TD>
									<TD  class=TABLE_COL2>
										<div align=center><?php echo($col5); ?></div>
									</TD>
								</TR>
								<?php } 
								$n = count($HSLIST)-3;
								for ($i = 1; $i < $n; $i+=3) {
									$col1 = $HSLIST[$i];
									$col2 = $HSLIST[$i+1];
									$col3 = $HSLIST[$i+2];
								?>
								<TR>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL_V1 rowspan='<?php echo($rn); ?>'>
										<?php echo($HSLIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL1>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($col3); ?></div>
									</TD>
									<?php if ($i==1) { ?>
									<TD class=TABLE_COL2 rowspan='<?php echo($rn3); ?>'>
										<div align=center><?php echo($HSLIST[$n+1]); ?></div>
									</TD>
									<TD class=TABLE_COL2 rowspan='<?php echo($rn3); ?>'>
										<div align=center><?php echo($HSLIST[$n+2]); ?></div>
									</TD>
									<?php } ?>
								</TR>
								<?php } 
								$n = 6;
								for ($i = 0; $i < $rn; $i++) {
									$col1 = $JJHSLIST[$i*2+1];
									$col2 = $JJHSLIST[$i*2+2];
								?>
								<TR>
									<?php if ($i==0) { ?>
									<TD class=TABLE_COL_V1 rowspan='<?php echo($rn); ?>'>
										<?php echo($JJHSLIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL1>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<?php if ($i==0) { ?>
									<TD  class=TABLE_COL1 rowspan='<?php echo($rn); ?>'>
										<div align=left><?php echo($JJHSLIST[$n+1]); ?></div>
									</TD>
									<?php } ?>
								</TR>
								<?php } 
								
								$n = 6;
								for ($i = 0; $i < $rn; $i++) {
									$col1 = $PSLIST[$i*2+1];
									$col2 = $PSLIST[$i*2+2];
								?>
								<TR>
									<?php if ($i==0) { ?>
									<TD class=TABLE_COL_V1 rowspan='<?php echo($rn); ?>'>
										<?php echo($PSLIST[0]); ?>
									</TD>
									<?php } ?>
									<TD class=TABLE_COL1>
										<div align=center><?php echo($col1); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=center><?php echo($col2); ?></div>
									</TD>
									<?php if ($i==0) { ?>
									<TD  class=TABLE_COL1 rowspan='<?php echo($rn); ?>'>
										<div align=left><?php echo($PSLIST[$n+1]); ?></div>
									</TD>
									<?php } ?>
								</TR>
								<?php } ?>
								<TR>
									<TD class=TABLE_COL1 height=30 colspan=2><div align=center>Private Tutoring</div></TD>
									<TD class=TABLE_COL1><div align=center>All grades</div></TD>
									<TD class=TABLE_COL1><div align=center>All subjects &amp; tests</div></TD>
									<TD class=TABLE_COL2><div align=center>Flexile hours</div></TD>
									<TD class=TABLE_COL2><div align=center>$65-85/hr</div></TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR><TD  height=20> </TD></TR>
				<?php if (0) {?>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD width=5%></TD>
							<TD colspan=4 class=apsattext width=95%><div align=left>
							<font color=orange>* 25% off (before 1/11/2014)</font>
							</div></TD>
						</TR>
						<TR><TD colspan=5 height=20></TD></TR>
						<TR>
							<TD width=5%></TD>
							<TD class=apsattext width=15%><div align=left>
							* Hourly rate:
							</div></TD>
							<TD class=apsattext width=20%><div align=left>
   							1 student $60-80
							
							</div></TD>
							<TD class=apsattext width=20%><div align=left>
   							2 students $45-50 each
							</div>
							</TD>
							<TD height=20 width=20%></TD>
						</TR>
						<TR>
							<TD width=5%></TD>
							<TD class=apsattext></TD>
							<TD class=apsattext ><div align=left>
   							3 students $35-40 each
							
							</div></TD>
							<TD class=apsattext ><div align=left>
   							4 students $30-35 each
							</div>
							</TD>
							<TD height=20 ></TD>
						</TR>
						<TR><TD colspan=5 height=10></TD></TR>
						</TABLE>
					</TD>
				</TR>
				<?php  } ?>

				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
