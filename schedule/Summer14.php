<?php 

$GRADE_TT = "Grade<br>(In Sept. 14)";
$P_PRIX = "$1,840 (1,380)";
$P_TENNIS = "$60-80/day";
$N_TENNIS = "Tennis*<br>(M&W/T&TH/M-Th)";

$GRADELIST = array("2<sup>nd</sup>-4<sup>th</sup>",
array(	"9:00am-12:00pm",  
		"Art & Craft*<br>(M&W / T&Th)",
		"$720"
),
array(	array("12:30-3:30pm"), 
		array("English & Math **<br> (Mon - Thurs)"),
		array($P_PRIX)
));

$GLIST56= array( "5<sup>th</sup> or 6<sup>th</sup>",
array(	"9:00am-12:00pm", 
		"English & Math **<br> (Mon - Thurs)", 
		$P_PRIX
),
array(	array("12:30pm-2:30pm"),
		array("Writing <br>(Tue & Thurs)", "Art & Craft* <br>(M & W)", "Book Club <br>( M & W  / T&Th)"),
		array("$480", "$580", "$280")
));


$GLIST78 = array("7<sup>th</sup> or 8<sup>th</sup>", 
array(	"9:00am-12:00pm",
		"English & Math **<br> (Mon - Thurs)",
		$P_PRIX
),
array(	array("12:30pm-2:30pm"),
		array("Writing <br>(M & W)", "Art & Craft*<br>( T & Th )", "Earth Science<br>(T & Th)", "Book Club <br>(M&W/T&Th)"),
		array("$480", "$580", "$480", "$280")
));

$GLIST910 = array("9<sup>th</sup> or 10<sup>th</sup>",
array(	"9:00am-12:00pm", 
		"English & Math **<br> (Mon - Thurs)",
		$P_PRIX
),
array(	array("12:30pm-3:00pm", "12:30pm-2:30pm"),
		array("New SAT for Gr. 9<br>( T & Th )",
		"Writing <br>(T & Th)", "Living Env. (Bio.)<br>(M & W)", "Chemistry<br>(M&W/T&Th)"),
		array("$680", "$480", "$480", "$480")
));


$GLIST1011 = array("10<sup>th</sup> or 11<sup>th</sup>", 
array(	"9:00am-12:00pm",
		"SAT/PSAT **<br> (Mon - Thurs)",
		$P_PRIX
),
array(	array("12:30pm-2:30pm"),
		array("Writing <br>(T & Th)", "Chemistry<br>(M & W)", "AP Physics <br>(M & W)"),
		array("$480", "$480", "$480")
));

$GLIST1112 = array("11<sup>th</sup> or 12<sup>th</sup>", 
array(	" ",
		" ",
		" "
),
array(	array("12:30pm-3:00pm", "12:30pm-3:30pm"),
		array("ACT<br>( Tue & Thurs )", "SAT <br>(Mon & Wed )"),
		array("$1,050", "$1,470 (seniors only)")
));


$GRADELISTF = array($GRADELIST, $GLIST56, $GLIST78, $GLIST910, $GLIST1011, $GLIST1112);
?>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0>

<?php
$_OPENHOUSE = array(
"Subject", "English & Math",
"Date", "May 30 (Fri.) 6:00pm<br>May 31 (Sat.) 1:00pm",
"Grade", "2<sup>nd</sup> - 11<sup>th</sup>",
"Fee", "Free",
"Location", "Long Island Academy",
"Award", "Trophy  awards<br>(1<sup>st</sup>, 2<sup>nd</sup> & 3<sup>rd</sup> place winners in each grade level.)"
);
if (1) {
?>
				<TR><TD  height=20> </TD></TR>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
						<TR>
							<TD class=class=MEET_DATE>
								<TABLE cellSpacing=0 cellPadding=0 width=60% border=0 align="center">
								<TR>
									<TD class=OPEN_HOUSE_TITLE>
										<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
										<TR>
											<TD class=OPEN_HOUSE_TITLE height=40>
												May 30 or May 31, 2014
											</TD>
										</TR>
										<TR>
											<TD class=OPEN_HOUSE_TITLE height=20>
												Open House Test
											</TD>
										</TR>
										<!--  TR>
											<TD class=OPEN_HOUSE_TITLE height=20>
												(Summer Placement Test)
											</TD>
										</TR -->
										<TR><TD height=5 class=OPEN_HOUSE_LINE></TD></TR>
										</TABLE>
									</TD>
								</TR>
								<TR><TD  height=20> </TD></TR>
								<TR>
									<TD class=OPEN_HOUSE_LINE>
										<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
										<TR><TD colspan=2 height=5 class=OPEN_HOUSE_LINE></TD></TR>
										<?php for ($i = 0; $i < count($_OPENHOUSE); $i+=2) { ?>
										<TR>
											<TD class=OPEN_HOUSE_LINE height=20 width=30% valign="top">
												<div align=left> <?php echo($_OPENHOUSE[$i]); ?> : </div>
											</TD>
											<TD  class=OPEN_HOUSE_LINE width=70%>
												<div align=left><?php echo($_OPENHOUSE[$i+1]); ?></div>
											</TD>
										</TR>
										<?php } ?>
										<TR><TD colspan=2 height=5 class=OPEN_HOUSE_LINE></TD></TR>
										</TABLE>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
<?php } ?>
		<!-- TR vAlign=top>
			<TD class=apsattitle height=60>
				<a  href="../files/TestReport.doc"><font color=red size=3>Download Test Result Explanation</font></a>
			</TD>
		<TR -->


		<TR vAlign=top>
			<TD class=apsattitle height=50>
				&diams;&diams;&diams; 2014 Summer School Information &diams;&diams;&diams;
			</TD>
		<TR>
		<TR vAlign=top>
			<TD class=apsattext height=40>
				( July 1 - August 14 )
			</TD>
		<TR>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR><TD  height=15> </TD></TR>
<?php for ($g = 0; $g < count($GRADELISTF); $g++) {
			$alist = $GRADELISTF[$g];
?>
				<TR>
					<TD class=MEET_DATE>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
		<TR>
			<TD class=TABLE_TITLE12 rowspan=3 width=15%><?php echo($GRADE_TT); ?></TD>
			<TD class=TABLE_TITLE12 height=25 width=20%>MORNING</TD>
			<TD class=TABLE_TITLE12 width=65%>AFTERNOON</TD>
		</TR>
<?php  
	$morning = $alist[1];
	$afternoon = $alist[2];
	$nb_line = count($morning);
	$nb_p = count($afternoon[1]);
	for ($i = 0; $i < $nb_line; $i++) {
?>
		<TR>
<?php if ($i == $nb_line - 1 ) { ?>
			<TD class=TABLE_COL10 height=20>
				<?php echo($alist[0]); ?>
			</TD>
<?php } if ($i == 0 ) { ?>
			<TD class=TABLE_COL10 height=20>
				<?php echo($morning[$i]); ?>
			</TD>
<?php } else { ?>
			<TD class=right_nobord height=20>
				<?php echo($morning[$i]); ?>
			</TD>
<?php } ?>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
<?php 	
		$ww = (int) (100/$nb_p); 
		if ($i == 0) {
			$nn = $nb_p - count($afternoon[0])+1;
			$j = 0;
			$ws = 100;
			if (count($afternoon[0]) > 1) { 
				$j = 1;
				$ws = 100 - $ws;
				
?>
				<TD class=right_bordb height=40 width=<?php echo($ww)?>%>
					<?php echo($afternoon[$i][0]);?>
				</TD>
<?php    	} 
?>
				<TD class=TABLE_COL10 height=40 colspan=<?php echo($nn)?> width=<?php echo($ws)?>%>
					<?php echo($afternoon[$i][$j]);?>
				</TD>

<?php 
		}
		else {
			for ($j = 0; $j < $nb_p; $j++) { 
				if ($j == $nb_p - 1) {
?>
				<TD class=right_nobord height=40 width=<?php echo($ww)?>%>
					<?php echo($afternoon[$i][$j]);?>
				</TD>
<?php  			} else  { ?>
				<TD class=right_bord height=40 width=<?php echo($ww)?>%>
					<?php echo($afternoon[$i][$j]);?>
				</TD>
<?php 			}
			} 
		}
?>
				</TR>
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
				<TR><TD  height=10> </TD></TR>
<?php } ?>
				<TR><TD  height=10> </TD></TR>
<!-- 1 -->
				<TR>
					<TD class=SUMMER_REG_LINE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
						<TR>
							<TD valign=top>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
								<TR>
									<TD width=10%></TD>
									<TD class=SUMMER_REG_LINE height=20 width=100% valign=top>
										<div align=left>** Early bird registration rate applicable ( for English & Math only )</div>
									</TD>
								</TR>
								<TR><TD height=25 colspan=2></TD></TR>
								<TR>
									<TD width=10%></TD>
									<TD class=SUMMER_REG_LINE height=20 width=100% valign=top>
										<div align=left>New  SAT  for  Gr.  9 (T&Th 12:30 -3:00pm) <br>
										- Reading <br>
										- Writing & Language<br></div>
									</TD>
								</TR>
								<TR><TD height=25 colspan=2></TD></TR>
								</TABLE>
							</TD>
						</TR>
						<TR>
							<TD class=SUMMER_REG_LINE>
								<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
								<TR>
									<TD class=SUMMER_REG_TITLE height=40 colspan=2>
										Early Special  (English &amp; Math Only) by June 14
									</TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20 width=60%>
										 25% off for 7 weeks 
									</TD>
									<TD class=SUMMER_REG_LINE height=20 width=40%>
										
									</TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20 width=60%>
										 20% off for 6 weeks 
									</TD>
									<TD class=SUMMER_REG_LINE height=20 width=40%>
										
									</TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20 width=60%>
										 15% off for 5 weeks 
									</TD>
									<TD class=SUMMER_REG_LINE height=20 width=40%>
										
									</TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20 width=60%>
										 10% off for 4 weeks 
									</TD>
									<TD class=SUMMER_REG_LINE height=20 width=40%>
										
									</TD>
								</TR>
								<TR><TD  height=20 colspan=2> </TD></TR>
<!-- 2 -->
								<TR>
									<TD class=SUMMER_REG_TITLE height=40 colspan=2>
										Sibling Special
									</TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20>
										 10% off for the 2nd child
									</TD>
									<TD class=SUMMER_REG_LINE> </TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20>
										  20% off for the 3rd child  
									</TD>
									<TD class=SUMMER_REG_LINE> </TD>
								</TR>
								<TR><TD  height=20 colspan=2> </TD></TR>
<!-- 3 -->
								<TR>
									<TD class=SUMMER_REG_TITLE height=40 colspan=2>
										Multi Course Special
									</TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20>
										 10% off for the 2nd  course 
									</TD>
									<TD class=SUMMER_REG_LINE> </TD>
								</TR>
								<TR>
									<TD class=SUMMER_REG_LINE height=20>
										 20% off for the 3rd course 
									</TD>
									<TD class=SUMMER_REG_LINE> </TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD height=40>
						<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
						<a  href='../files/su14.doc'><font color=red><b>Download Summer School Program (doc)</b></font></a>
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
</table>
