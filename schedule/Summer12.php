<?php 

$GRADE_TT = "Grade<br>(In Sept. 14)";
$P_PRIX = "$1,840 (1,380)";
$P_TENNIS = "$60-80/day";
$N_TENNIS = "Tennis*<br>(M&W/T&TH/M-Th)";

$GRADELIST = array(
array("9:00am-12:00pm", "Tennis*<br>(M&W/T&TH/M-Th)", "Art & Craft*<br>(M&W / T&Th)"),
array("12:30-3:30pm", "English & Math **<br> (Mon - Thurs)"),
array("2<sup>nd</sup>-4<sup>th</sup>", "$40-60/day", "$630", "$1,840 ($1380)"),
);

$G_TIME = array("9:00am-12:00pm", "12:30-2:30pm", "12:30pm - 4:00pm");

$GLIST56= array(
array(	"",	
		"English & Math **<br> (Mon - Thurs)", 
		array("Writing <br>(Tue & Thurs)", "Art & Craft* <br>(M & W)", "Book Club <br>( M & W  / T&Th)"),$N_TENNIS),
		array("5<sup>th</sup> or 6<sup>th</sup>", $P_PRIX, array("$480", "$480", "$280"), $P_TENNIS),
);


$GLIST78 = array(
array(	"", 
		"English & Math **<br> (Mon - Thurs)",
		array("Writing <br>(M & W)", "Art & Craft*<br>( T & Th )", "Earth Science<br>(T & Th)", "Book Club <br>(M&W/T&Th)"), $N_TENNIS),
		array("7<sup>th</sup> or 8<sup>th</sup>", $P_PRIX, array("$480", "$480", "$480", "$280"), $P_TENNIS),
);

$GLIST910 = array(
array(	"", 
		"English & Math **<br> (Mon - Thurs)",
		array("Writing <br>(T & Th)", "Living Env. (Bio.)<br>(M & W)", "Chemistry<br>(M&W/T&Th)"),$N_TENNIS),
		array("9<sup>th</sup> or 10<sup>th</sup>", $P_PRIX, array("$480", "$480", "$480"), $P_TENNIS),
);

$GLIST1012 = array(
array(	
		"", 
		"SAT/PSAT **<br> (Mon - Thurs)",
		array("Writing <br>(T & Th)", "Chemistry<br>(M & W)", "AP Physics <br>(M & W)"),$N_TENNIS),
		array("10<sup>th</sup> or 12<sup>th</sup>", "$1,770 (1,327)", array("$480", "$480", "$480"), $P_TENNIS),
);


$GRADELISTF = array($GLIST56, $GLIST78, $GLIST910, $GLIST1012);
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
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_TITLE12 rowspan=3 width=15%>
										<?php echo($GRADE_TT); ?>
									</TD>
									<TD class=TABLE_TITLE12  colspan=2 width=67%>
										MORNING
									</TD>
									<TD class=TABLE_TITLE12 height=25 width=28%>
										AFTERNOON
									</TD>
								</TR>
								<?php 
								$arr0 = $GRADELIST[0];
								$arr1 = $GRADELIST[1];
								$arrend = $GRADELIST[2];
								?>
								<TR>
									<TD class=TABLE_COL10 colspan=2 height=20>
										<div align=center><?php echo($arr0[0]); ?></div>
									</TD>
									<TD  class=TABLE_COL10>
										<div align=center><?php echo($arr1[0]); ?></div>
									</TD>
								</TR>
								<TR>
									<TD class=right_nobord height=50>
										<?php echo($arr0[1]); ?>
									</TD>
									<TD class=right_nobord>
										<?php echo($arr0[2]); ?>
									</TD>
									<TD  class=right_nobord>
										<?php echo($arr1[1]); ?>
									</TD>
								</TR>
								<TR>
								<?php for ($i = 0; $i < count($arrend); $i++) { ?>
									<TD class=right_nobord height=25>
										<?php echo($arrend[$i]); ?>
									</TD>
								<?php } ?>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
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
									<TD class=TABLE_TITLE12 rowspan=3 width=15%>
										<?php echo($GRADE_TT); ?>
									</TD>
									<TD class=TABLE_TITLE12 height=25 width=20%>
										MORNING
									</TD>
									<TD class=TABLE_TITLE12 colspan=2 width=65%>
										AFTERNOON
									</TD>
								</TR>
						<?php  
								$arr1 = $alist[0];
								$arr2 = $alist[1];
						?>
								<TR>
									<TD class=TABLE_COL10 height=25 width=100>
										<div align=center><?php echo($G_TIME[0]); ?></div>
									</TD>
									<TD  class=TABLE_COL10 width=47%>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<TD class=TABLE_COL10>
												<div align=center><?php echo($G_TIME[1]); ?></div>
											</TD>
										</TR>
										</TABLE>									
									</TD>
									<TD  class=TABLE_COL10 width=18%>
										<div align=center><?php echo($G_TIME[2]); ?></div>
									</TD>
								</TR>
								<TR>
									<TD class=right_nobord height=20>
										<?php echo($arr1[1]); ?>
									</TD>
									<TD>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
									<?php	$nn = count($arr2[2]);
											$ww = (int) (270/$nn); 
											for ($i = 0; $i < $nn; $i++) { 
												if ($i == ($nn - 1)) {
									?>
											<TD class=right_nobord height=40>
									<?php 		} else { ?>
											<TD class=right_bord width=<?php echo($ww)?> height=40>
									<?php 		} 
												echo($arr1[2][$i]);?>
											</TD>
											<?php } ?>
										</TR>
										</TABLE>
									</TD>
									<TD  class=right_nobord>
										<?php echo($arr1[3]); ?>
									</TD>
								</TR>
								<TR>
									<TD class=TABLE_COL20 height=20>
										<div align=center><?php echo($arr2[0]); ?></div>
									</TD>
									<TD class=right_nobord height=20>
										<div align=center><?php echo($arr2[1]); ?></div>
									</TD>
									<TD  class=TABLE_COL10>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<?php 
											for ($i = 0; $i < $nn; $i++) {
												if ($i == ($nn - 1)) {
									?>
											<TD class=right_nobord height=30>
									<?php 		} else { ?>
											<TD class=right_bord width=<?php echo($ww)?> height=30>
									<?php 		} 
												 echo($arr2[2][$i]); ?>
											</TD>
											<?php } ?>
										</TR>
										</TABLE>
									</TD>
									<TD  class=right_nobord>
										<div align=center><?php echo($arr2[3]); ?></div>
									</TD>
								</TR>

								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR><TD  height=10> </TD></TR>
<?php } ?>
				<TR><TD  height=20> </TD></TR>
<!-- 1 -->
				<TR>
					<TD class=SUMMER_REG_LINE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
						<TR>
							<TD valign=top>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
								<TR>
									<TD class=SUMMER_REG_LINE height=20 width=50% valign=top>
										* Successive discounts available for multiple weeks.<br>
										    ( for afternoon courses &amp; Tennis )                                                       
									</TD>
									<TD class=SUMMER_REG_LINE height=20 width=50% valign=top>
										** Early bird registration rate applicable<br>
											( for English & Math only )
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
