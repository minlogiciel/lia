<?php 
$AP_DAY = -1;
$AP_TEST = -2;
$SAT_DAY = -3;
$SAT_TEST = -4;
$AP_TEST_SAT = -5;
$AP_SAT_DAY = -6;

$aptestc = "&diams;";
$sattestc = "&hearts;"; 
$aptestsatc = "&#x22c6;";

function getDayStar($tab, $m, $jour) {
	for ($i = 0; $i < count($tab); $i+=2) {
		if ($tab[$i] == $m+1 && $tab[$i+1] == $jour) {
			return $jour."*";
		}
	}
	return $jour;
}
?>
<TABLE cellSpacing=1 cellPadding=0 width="100%" align=center border=0>

<TR><TD colspan=3 height=15></TD></TR>	
<TR>
	<TD colspan=3 class=PAGE_TITLE height=20>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		
	</TD>
</TR>	


<TR><TD colspan=3 height=15></TD></TR>

<?php 
$title = "SAT II Biology Prep. Course";
$biologymonth = array("February", "March", "April", "May-June");
$biologydate = array(
array(0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6, 7, -3, 9, 10, -1, 23, 13, 14, -3, 16, 17, -1, 19, 20, 21, -3, 23, 24, -1, 26, 27, 28),
array(0, 0, 0, 0, 0, 0, -3, 2, 3, -1, 5, 6, 7, -3, 9, 10, -1, 23, 13, 14, -3, 16, 17, -1, 19, 20, 21, -3, 23, 24, -1, 26, 27, 28,-3),
array(0, 0, -1, 2, 3, 4, -3, 6,7, -1,9, 10,11,  -3, 13,14,  -1, 16, 17,18,   -3, 20, 21,   -1, 23, 24, 25,   -3,27, 28,   -1,30),
array(0, 0, 0, 0, 1, 2,  -3, 4,5,   -1, 7,8, 9,   -3, 11,12,   -1,14, 15, 16,   -3, 18, 19,  -1,21, 22, 23,   -3,25, 26,   -1,28, 29, 30, -3,1,2, -1,4,5,6,-4),
);

$jourstar = array(1, 15,   1, 18,   2, 15, 2, 18,  3, 5,   3, 8,  4, 3,  4, 6,  4, 31);
?>
<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=30 colspan=4 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				(For 9<sup>th</sup>/10<sup>th</sup> grade Biology honors students) 
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				Class Time: 5:00pm - 7:00pm (Tuesday except Feb.18 & Apr.15, 1-2:30pm & 1:30-3:30pm )
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				   or 1:00pm - 3:00pm (Saturday)
			</TD>
		</TR>
		<TR>
			<TD height=30 colspan=3 valign="bottom" class=apsattext> 
				<div align=center>Tuition : $760</div>
			</TD>
			<TD height=30  valign="bottom" class=apsattext> 
			* Practice Tests (1.5 hr)
			</TD>
			
		</TR>

		<TR>
<?php  for ($m = 0; $m < count($biologymonth); $m++) { ?>
			<TD width=25%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($biologymonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $biologydate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										//echo("<TD class='dayap'>". $jj."</TD>");
										echo("<TD class='mathtest'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										//echo("<TD class='daysat'>". $jj."</TD>");
										echo("<TD class='mathlesson'>".$jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									
									else if ($mitem[$d] == $AP_SAT_DAY) {
										echo("<TD class='dayap_sat'>".$jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST_SAT) {
										echo("<TD class='dayaptest_sat'>".$aptestsatc."</TD>");
									}
									else {
										$jour = $mitem[$d];
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR>
			<TD colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width="95%" align=center border=0>
				<TR>
					<TD class=apsattext colspan=4><div align=left>
						* On Tue. April 15, class is scheduled at 1:30-3:30pm for both Tue. & Sat. Classes.
						</div>
					</TD>
				</TR>
				<TR>
					<TD >
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='mathtest' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Tuesday session</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='mathlesson' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Saturday session</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD colspan=2></TD>
							<!-- TD class='dayap_sat' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Class &amp; Test </div></TD -->
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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

<TR><TD colspan=3 height=30>&nbsp;</TD></TR>		


<?php 
$title = "SAT II Chemistry Prep. Course";
$biologymonth = array("February", "March", "April", "May-June");
$biologydate = array(
array(0, 0, 0, 0, 0, 0, -3, 2,3,   4, -1,6, 7, -3, 9, 10, 11, -1, 13, 14,  -3, 16,17, 18, -1, 20, 21,  -3,23, 24, 25, -1, 27, 28),
array(0, 0, 0, 0, 0, 0,  -3, 2,3, 4, -1, 6, 7,  -3, 9, 10, 11, -1, 13, 14,  -3,16, 17, 18, -1, 20, 21,  -3,23, 24, 25, -1,  27,28, -3),
array(0, 0, 1, -1, 3, 4,  -3,6, 7, 8, -1, 10,11,  -3, 13,14,15, -1, 17,18,   19,20, 21, 22, -1, 24, 25,  -3, 27,28, 29, -1),
array(0, 0, 0, 0, 1, 2,   -3,4, 5, 6, -1, 8, 9,  -3, 11,12, 13, -1, 15, 16,   -3, 18, 19, 20, -1, 22, 23,   -3, 25, 26, 27, -1, 29, 30, -3, 1,2,3,-1,5,6,-4),
);

$jourstar = array(1, 1,   1, 5,   2, 1,2,5, 2, 29,  3, 2,  3, 26,  3,30,  4, 4,  4, 31);

?>
<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=30 colspan=4 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				(For 10<sup>th</sup>/11<sup>th</sup> grade Chemistry honors students) 
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				Class Time: 5:00pm - 7:00pm (Wednesday except Feb.19 & Apr.16, 1-3pm)
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				   or 1:00pm - 3:00pm (Saturday)
			</TD>
		</TR>
		<TR>
			<TD height=30 colspan=3 valign="bottom" class=apsattext> 
				<div align=center>Tuition : $780</div>
			</TD>
			<TD height=30  valign="bottom" class=apsattext> 
			* Practice Tests (1.5 hr)
			</TD>
			
		</TR>
		<TR>
<?php  for ($m = 0; $m < count($biologymonth); $m++) { ?>
			<TD width=25%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($biologymonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $biologydate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										//echo("<TD class='dayap'>". $jj."</TD>");
										echo("<TD class='mathtest'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										//echo("<TD class='daysat'>". $jj."</TD>");
										echo("<TD class='mathlesson'>".$jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									
									else if ($mitem[$d] == $AP_SAT_DAY) {
										echo("<TD class='dayap_sat'>".$jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST_SAT) {
										echo("<TD class='dayaptest_sat'>".$aptestsatc."</TD>");
									}
									else {
										$jour =  $mitem[$d];
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR>
			<TD colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width="95%" align=center border=0>
				<TR>
					<TD class=apsattext colspan=4><div align=left>
						* On Wed. April 16, class is scheduled at 1-3pm for both Wed. & Sat. Class.
						</div>
					</TD>
				</TR>
				<TR>
					<TD >
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='mathtest' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Wednesday session</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='mathlesson' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Saturday session</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='apsattext' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>&nbsp;</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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

<TR><TD colspan=3 height=30>&nbsp;</TD></TR>		

<?php 
$title = "SAT II Math IIC Prep. Course";
$mathmonth = array("March", "April", "May-June");
$mathdate = array(
array(0,0,0,0,0, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, -3, 15, 16, 17, 18, 19, 20,  -1,22, 23, 24, 25, 26, 27, -1, 29,30),
array(0,0, 1, 2, 3,  -3, 5,6, 7, 8, 9, 10,  -1, 12,13, 14, 15, 16, 17,   -1,19, 20, 21, 22, 23, 24, -3, 26, 27, 28, 29, 30),
array(0,0, 0, 0, 1,  -1, 3,4, 5, 6, 7, 8,   -1,10, 11, 12, 13, 14, 15,  -3, 17, 18, 19, 20, 21, 22, -1, 24, 25,  26, 27, 28, 29, -1, 31, 1,2,3,4,5,-3,-4),
);

?>
<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=30 colspan=3 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=4 class=apsattext>
				(For 9<sup>th</sup>-11<sup>th</sup> grade Precalculus students) 
			</TD>
		</TR>
		<TR>
			<TD colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD width=30%>&nbsp;</TD>
					<TD width=70%>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							
							<TD class='mathtestlesson' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Class Time : 4:30-5:30pm (Test only)</div></TD>
						</TR>
						<TR>
							<TD class='mathtest' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>Class Time : 4:30-6:30 (Test &amp; Lecture)</div></TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>


		<TR>
			<TD height=30 colspan=4 valign="bottom" class=apsattext>
				Tuition : $350 
			</TD>
		</TR>

		<TR>
<?php  for ($m = 0; $m < count($mathmonth); $m++) { ?>
			<TD width=33%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($mathmonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $mathdate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									if ($mitem[$d] > 0)
										$jour = $mitem[$d];
									else
										$jour++;
									if ($mitem[$d] == -1) {
										echo("<TD class='mathtestlesson'>". $jour."</TD>");
									}
									else if ($mitem[$d] == -2) {
										echo("<TD class='mathlesson'>".$jour."</TD>");
									}
									else if ($mitem[$d] == -3) {
										echo("<TD class='mathtest'>". $jour."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									else {
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD colspan=3 height=15></TD></TR>

<TR><TD colspan=3 height=30>&nbsp;</TD></TR>
<TR>
	<TD colspan=3>
		<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		<a  href='../files/2014SAT2-Science.doc'><font color=red><b>Download SAT II Science Programs (doc)</b></font></a>
		</div>
	</TD>
</TR>		
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>
<TR>
	<TD colspan=3 class=PAGE_TITLE height=20>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		
	</TD>
</TR>	

<!-- ------------------------------------------ -->

<TR><TD colspan=3 height=40></TD></TR>	
<TR><TD colspan=3 height=15></TD></TR>	

<?php 
$title = "AP &amp; SAT II Biology Prep. Course";
$apbiologymonth = array("March", "April", "May-June");
$apbiology = array(
array(0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, -1, 16, 17, 18, 19, 20, 21, -1, 23, 24, 25, 26, 27, 28, -1, 30,31),
array(0, 0, 1, 2, 3, 4, -1, 6, 7, 8, 9, 10, 11,  -1, 13, 14, -1, 16, 17, 18, 19, 30, 21, 22, 23, 24, 25,  -1, 27, 28, 29, 30),
array(0, 0, 0, 0, 1, 2,  -1, 4,5, 6, 7, 8, 9,  -1, 11,  -2, 13,14, 15, 16,  -3, 18, 19, 20, 21, 22, 23,  -3,25, 26, 27, 28, 29, 30, -3, 1,2,3,4,5,6,-4),
);


?>
<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=30 colspan=3 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=3 class=apsattext>
				   10:00am - 12:30pm (except Apr.15, 3:30-6:00pm)
			</TD>
		</TR>

		<TR>
			<TD colspan=3 class=apsattext>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD height=30 width=50% valign="bottom" class=apsattext> 
						<div align=center>Tuition : $680 / $840</div>
					</TD>
					<TD height=30  width=50% valign="bottom" class=apsattext> 
					* Practice AP Test (3hrs)
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
<?php  for ($m = 0; $m < count($apbiologymonth); $m++) { ?>
			<TD width=33%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($apbiologymonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $apbiology[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					$jourstar = array(3,4);
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									else {
										$jour =  $mitem[$d];
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} 
					?>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR><TD colspan=3 height=15>&nbsp;</TD></TR>
		<TR>
			<TD colspan=3>
				<TABLE cellSpacing=0 cellPadding=0 width="85%" align=center border=0>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayap' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>AP Course</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='daysat' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>SAT II Class</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayaptest' width=20> <?php echo($aptestc); ?> </TD>
							<TD class=apsattext><div align=left>AP Exam Day</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>

<?php 
$title = "AP &amp; SAT II Chemistry Prep. Course";
$apchemistrymonth = array("March", "April", "May-June");
$apchemistry = array(
array(0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, -1, 16, 17, 18, 19, 20, 21, -1, 23, 24, 25, 26, 27, 28, -1, 30),
array(0, 0, 1, 2, 3, 4,   -1,6, 7, 8, 9, 10, 11,   -1,13, 14, 15, -1, 17, 18,   19,20, 21, 22, -1, 24, 25,   -1,27, 28, 29, -1),
array(0, 0, 0, 0, 1, 2, -4, 4, -2, 6, 7, 8, 9, -3, 11, 12, 13, 14, 15, 16, -3, 18, 19, 20, 21, 22, 23, -3, 25, 26, 27, 28, 29, 30, -3, 1,2,3,4,5,6,-4),
);
$jourstar = array(2,26);
?>

<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=30 colspan=3 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=3 class=apsattext>
				                                10:30am - 1:00pm  
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=3 class=apsattext>
				        7:00pm - 9:00pm (Wed. 4/23 & 30)


			</TD>
		</TR>
		<TR>
			<TD colspan=3 class=apsattext>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD height=30 width=50% valign="bottom" class=apsattext> 
						<div align=center>Tuition : $680 / $880 </div>
					</TD>
					<TD height=30  width=50% valign="bottom" class=apsattext> 
					* Practice AP Test (3hrs)
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
<?php  for ($m = 0; $m < count($apchemistrymonth); $m++) { ?>
			<TD width=33%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($apchemistrymonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $apchemistry[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									else {
										$jour = $mitem[$d];
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} 
					?>
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR><TD colspan=3 height=15>&nbsp;</TD></TR>
		<TR>
			<TD colspan=3>
				<TABLE cellSpacing=0 cellPadding=0 width="85%" align=center border=0>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayap' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>AP Course</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='daysat' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>SAT II Class</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayaptest' width=20> <?php echo($aptestc); ?> </TD>
							<TD class=apsattext><div align=left>AP Exam Day</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>



<?php 

$title = "AP &amp; SAT II Physics Prep. Course";
$apphysicsmonth = array("March", "April", "May-June");
$apphysics = array(
array(0,0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, -1, 13, 14, 15, 16, 17, 18, -1, 20, 21, 22, 23, 24, 25, -1, 27, 28, 29, 30),
array(0,0, 1, -1, 3, 4, 5, 6, 7, 8, -1, 10, 11, 12, 13, 14, 15, -1, 17, 18, 19, 20, 21, 22, -1, 24, 25, 26, 27, 28, 29, -1),
array(0,0, 0, 0, 1, 2, -4, 4, 5, 6, -1, -1, 9, 10, 11, -2, 13, -3, 15, 16, 17, 18, 19, 20, -3, 22, 23, 24, 25, 26, 27, -3, 29, 30, 31, 1,2,3,-3,5,6,-4),
);
$jourstar = array(2,16);
?>

<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=30 colspan=3 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=3 class=apsattext>
				    Class Time: 5:00pm - 7:00pm 
			</TD>
		</TR>
		<TR>
			<TD colspan=3 class=apsattext>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD height=30 width=50% valign="bottom" class=apsattext> 
						<div align=center>Tuition : $680 / $880 </div>
					</TD>
					<TD height=30  width=50% valign="bottom" class=apsattext> 
					* Practice AP Test (3hrs)
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
<?php  for ($m = 0; $m < count($apphysicsmonth); $m++) { ?>
			<TD width=33%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($apphysicsmonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $apphysics[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									if ($mitem[$d] > 0)
										$jour= $mitem[$d];
									else 
										$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									else {
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR><TD colspan=3 height=15>&nbsp;</TD></TR>
		<TR>
			<TD colspan=3>
				<TABLE cellSpacing=0 cellPadding=0 width="85%" align=center border=0>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayap' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>AP Course</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='daysat' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>SAT II Class</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayaptest' width=20> <?php echo($aptestc); ?> </TD>
							<TD class=apsattext><div align=left>AP Exam Day</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>
<TR>
	<TD colspan=3>
		<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		<a  href='../files/2014AP_SAT2-Science.doc'><font color=red><b>Download AP &amp; SAT II Science Programs (doc)</b></font></a>
		</div>
	</TD>
</TR>		
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>
<TR>
	<TD colspan=3 class=PAGE_TITLE height=20>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		
	</TD>
</TR>	

<TR><TD colspan=3 height=20>&nbsp;</TD></TR>

<?php 

$title = "AP Euro &amp; SAT II World History Prep. Course";
$worldmonth = array("February","March", "April", "May-June");
$worlddate = array(
array(0,0, 0,0, 0, 0, 1, 2, 3, 4, 5, -1, 7, 8, 9, 10, 11, 12, -1, 14, 15, 16, 17, 18, 19, -1, 21, 22, 23, 24, 25, 26, -1, 28),
array(0,0, 0,0, 0, 0, 1, 2, 3, 4, 5, -1, 7, 8, 9, 10, 11, 12, -1, 14, 15, 16, 17, 18, 19, -1, 21, 22, 23, 24, 25, 26, -1, 28, 29),
array(0, 0, 1, 2, -1, 4, 5, 6, 7, 8, 9, -1, 11, 12, 13, 14, 15, 16, -1, 18, 19, 20, 21, 22, 23, -1, 25, 26, 27, 28, 29, 30),
array(0, 0, 0, 0, -1, 2, -4, 4, 5, 6, 7, -1, 9,10, 11, 12, 13, -2, -3, 16, 17, 18, 19, 20, 21, -3, 23, 24, 25, 26, 27, 28, -3, 30, 31, 1,2,3,4,-3,6,-4),
);

$jourstar = array(1, 20, 3, 17);


?>

<TR>
	<TD colspan=3 >
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=20 colspan=4 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=20 colspan=4 class=apsattext>
				Class Time : 5:00pm - 7:00pm (Thursday except Feb.20 & Apr.17, 9:30-12:35pm)
			</TD>
		</TR>
		
		<TR>
			<TD height=10 colspan=4 class=apsattext>$690 / $750</TD>
		</TR>
		<TR>
			<TD height=10 colspan=4 class=apsattext><div align=right>* Tentative Practice Test Dates</div></TD>
		</TR>
		<TR>
<?php  for ($m = 0; $m < count($worldmonth); $m++) { ?>
			<TD width=25%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($worldmonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $worlddate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									if ($mitem[$d] > 0)
										$jour = $mitem[$d];
									else
										$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									else {
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR><TD colspan=4 height=15>&nbsp;</TD></TR>
		<TR>
			<TD colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width="85%" align=center border=0>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayap' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>AP Course</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='daysat' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>SAT II Class</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayaptest' width=20> <?php echo($aptestc); ?> </TD>
							<TD class=apsattext><div align=left>AP Exam Day</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>

<?php 
$title = "AP &amp; SAT II World History Prep. Course";

$worldmonth =  array("February","March", "April", "May-June");
$worlddate = array(
array(0,0,0, 0,0, 0, 1, 2, 3, 4, 5, -1, 7, 8, 9, 10, 11, 12, -1, 14, 15, 16, 17, 18, 19, -1, 21, 22, 23, 24, 25, 26, -1, 28),
array(0,0,0, 0,0, 0, 1, 2, 3, 4, 5, -1, 7, 8, 9, 10, 11, 12, -1, 14, 15, 16, 17, 18, 19, -1, 21, 22, 23, 24, 25, 26, -1, 28, 29),
array(0,0, 1, 2, -1, 4, 5, 6, 7, 8, 9, -1, 11, 12, 13, 14, 15, 16, -1, 18, 19, 20, 21, 22, 23, -1, 25, 26, 27, 28, 29, 30),
array(0,0, 0, 0, -1, 2, -4, 4, 5, 6, 7, -1, 11,10, 11, 12, 13, 14, -2, 16, 17, 18, 19, 20, 21, -3, 23, 24, 25, 26, 27, 28, -3, 30, 31, 1,2,3,4,-3,6,-4),
);

?>

<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=20 colspan=4 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=20 colspan=4 class=apsattext>
				Class Time : 5:00pm - 7:00pm (Thursday except Feb.20 & Apr.17, 9:30-12:35pm )
			</TD>
		</TR>
		
		<TR>
			<TD height=10 colspan=4 class=apsattext>$690 / $750</TD>
		</TR>
		<TR>
			<TD height=10 colspan=4 class=apsattext><div align=right>* Tentative Practice Test Dates</div></TD>
		</TR>
	                                                                                                                       
		<TR>
<?php  for ($m = 0; $m < count($worldmonth); $m++) { ?>
			<TD width=25%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($worldmonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $worlddate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									if ($mitem[$d] > 0)
										$jour = $mitem[$d];	
									else
										$jour++;
									$jj = getDayStar($jourstar, $m, $jour);
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='daysat'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jj."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST_SAT) {
										echo("<TD class='dayaptest_sat'>".$aptestsatc."</TD>");
									}
									else {
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		<TR><TD colspan=4 height=15>&nbsp;</TD></TR>
		<TR>
			<TD colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width="85%" align=center border=0>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='dayap' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>AP Course</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>					
						<TR>
							<TD class='daysat' width=20>&nbsp;</TD>
							<TD class=apsattext><div align=left>SAT II Class</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysat' width=20> <?php echo($aptestc); ?> </TD>
							<TD class=apsattext><div align=left>AP Exam &amp; SAT II Class</div></TD>
						</TR>
						</TABLE>
					</TD>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
						<TR>
							<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
							<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
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
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>

<?php 

$title = "AP &amp; SAT II U.S. History Prep. Course";

$satmaymonth = array("April", "May");
$satmaydate = array(
array(0,0,1,2,3,4,-6, 6, 7, 8, 9, 10, 11, -6, 13, -6, -6, -6, -6, -6, -6, 20, 21, 22, 23, 24, 25, -6, 27, 28, 29, 30),
array(0,0,0,0,1,2, -4, 4, 5, 6, 7, 8, 9, -1, 11, 12, 13, $AP_TEST, 13, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31),
);

$satjunemonth = array("April", "May");
$satjunedate = array(
array(0,0,1,2,3,4,-1, 6, 7, 8, 9, 10, 11, -1, 13, -1, -1, -1, -1, -1, -1, 20, 21, 22, 23, 24, 25, -1, 27, 28, 29, 30),
array(0,0,0,0,1,2, -4, 4, 5, 6, 7, 8, 9, -1, 11, 12, 13, $AP_TEST, 13, 16, -3, 18, 19, 20, 21, 22, 23, -3, 25, 26, 27, 28, 29, 30, -3),
);

?>
<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=20 colspan=2 class=apsattitle>
				<?php echo($title); ?>
			</TD>
		</TR>
		<TR>
			<TD height=20 colspan=2 class=apsattext>
				$590 / $750
			</TD>
		</TR>
                 
<TR>
	<TD width=50%>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>

		<TR>
			<TD height=20 colspan=2 class=apsattext>
				For AP & May SAT II
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=2 class=apsattext>
				1:00-3:00pm For AP &amp; 3:00-4:00pm For SAT II
			</TD>
		</TR>


		<TR>
<?php  for ($m = 0; $m < count($satmaymonth); $m++) { ?>
			<TD width=50%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($satmaymonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $satmaydate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$prev_day = 1;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									$jour++;
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jour."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jour."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									
									else if ($mitem[$d] == $AP_SAT_DAY) {
										echo("<TD class='dayap_sat'>".$jour."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST_SAT) {
										echo("<TD class='dayaptest_sat'>".$aptestsatc."</TD>");
									}
									else {
										$jour = $mitem[$d];
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
										
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		</TABLE>
	</TD>
	
	<TD width=50%>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD height=20 colspan=2 class=apsattext>
				 For AP & June SAT II
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=2 class=apsattext>
				1:00-3:00pm For AP &amp; 1:00-3:00/4:00pm For SAT II
			</TD>
		</TR>
		<TR>
<?php  for ($m = 0; $m < count($satjunemonth); $m++) { ?>
			<TD width=33%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD>
						<TABLE class=mod_table cellSpacing=0 cellPadding=0 align=center>
						<TR>
							<TD class=apsatitemtitle colspan=7>
								<?php echo($satjunemonth[$m]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=daystandard><FONT color=red>Su</FONT></TD>
							<TD class=daystandard>Mo</TD>
							<TD class=daystandard>Tu</TD>
							<TD class=daystandard>We</TD>
							<TD class=daystandard>Th</TD>
							<TD class=daystandard>Fr</TD>
							<TD class=daystandard>Sa</TD>
						</TR>
					<?php  
					$mitem = $satjunedate[$m];
					$nitem = count($mitem);
					$jour = 0;
					$d = 0;
					for ($i = 0; $i < $nitem; $i += 7) {
						echo("<TR>");
						for ($j = 0; $j < 7; $j++) { 
							if ($d < $nitem) {
								if ($mitem[$d] == 0) {
									echo("<TD class=daystandard>&nbsp;</TD>");
								}
								else {
									$jour++;
									if ($mitem[$d] == $AP_DAY) {
										echo("<TD class='dayap'>". $jour."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST) {
										echo("<TD class='dayaptest'>".$aptestc."</TD>");
									}
									else if ($mitem[$d] == $SAT_DAY) {
										echo("<TD class='daysat'>". $jour."</TD>");
									}
									else if ($mitem[$d] == $SAT_TEST) {
										echo("<TD class='daysattest'>".$sattestc."</TD>");
									}
									
									else if ($mitem[$d] == $AP_SAT_DAY) {
										echo("<TD class='dayap_sat'>".$jour."</TD>");
									}
									else if ($mitem[$d] == $AP_TEST_SAT) {
										echo("<TD class='dayaptest_sat'>".$aptestsatc."</TD>");
									}
									else {
										$jour = $mitem[$d];
										echo("<TD class='daystandard'>". $mitem[$d]."</TD>");
									}
								} 
							}
							else {
								echo("<TD class=daystandard>&nbsp;</TD>");
							}
							$d++;
						} 
						echo("</TR>");
					} ?>
						
						
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		<?php } ?>
		</TR>
		</TABLE>
	</TD>
</TR>

<TR><TD colspan=2 height=15></TD></TR>
<TR>
	<TD colspan=3>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD width=10%>&nbsp;</TD>
			<TD width=25%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				<TR>
					<TD class='dayap' width=20>&nbsp;</TD>
					<TD class=apsattext><div align=left>AP Course</div></TD>
				</TR>
				<TR>
					<TD class='dayaptest' width=20> <?php echo($aptestc); ?> </TD>
					<TD class=apsattext><div align=left>AP Exam Day</div></TD>
				</TR>
				</TABLE>
			</TD>
			<TD width=25%>
				<TABLE  cellSpacing=0 cellPadding=0 align=center>
				<TR>
					<TD class='daysat' width=20>&nbsp;</TD>
					<TD class=apsattext><div align=left>SAT II Class</div></TD>
				</TR>
				<TR>
					<TD class='daysattest' width=20><?php echo($sattestc); ?> </TD>
					<TD class=apsattext><div align=left>SAT II Test Day</div></TD>
				</TR>
				</TABLE>
			</TD>
			<TD width=40%>
				<TABLE  cellSpacing=0 cellPadding=0 align=center>
				<TR>
					<TD class='dayap_sat' width=20>&nbsp;</TD>
					<TD class=apsattext><div align=left>AP &amp; SAT II Class</div></TD>
				</TR>
				<TR>
					<TD  width=20>&nbsp;</TD>
					<TD ><div align=left>&nbsp;</div></TD>
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
<TR><TD colspan=3 height=20>&nbsp;</TD></TR>
<TR>
	<TD colspan=3>
		<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		<a  href='../files/2014AP_SAT2-History.doc'><font color=red><b>Download AP &amp; SAT II History Program (doc)</b></font></a>
		</div>
	</TD>
</TR>		
<TR><TD colspan=3 height=30>&nbsp;</TD></TR>

</TABLE>
