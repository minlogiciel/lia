<?php 
$SATWRITINGLIST = array(
"2/18/2012", "9.30am - 12:30pm",
"2/20/2012", "9.30am - 12:30pm",
"2/21/2012", "9.30am - 12:30pm",
"2/22/2012", "9.30am - 12:30pm"
);


$SATACTLIST = array(
"3/29/2012", "9:00am-12:00pm", "ACT Science", 
"3/30/2012", "9:00am-12:00pm", "ACT English & Reading", 
"3/31/2012", "9:00am-12:00pm", "ACT Mathematics", 
"4/01/2012", "9:00am-12:00pm", "ACT English & Reading", 
"4/02/2012", "9:00am-12:00pm", "ACT Mathematics", 
"4/05/2012", "9:00am-12:00pm", "ACT Science"
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
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=5>
										<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a  href='../files/2012.Feb.break.writing_1_.doc'>
										<font color=red size=3>SAT I Grammar &amp; Essay</font>
										</a><br>
										<font color=black>During February Break For 10th &amp; 11th Gr. ( Tuition : $360 )</font>
										<br>With <br>Ms. Difranco
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=TABLE_TITLE height=30 width=50%>
										Date
									</TD>
									<TD class=TABLE_TITLE height=30 width=50%>
										Time
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($SATWRITINGLIST); $i+=2) {
									$dates = $SATWRITINGLIST[$i];
									if (strpos($dates, "(") && strpos($dates, ")")) {
									}
									else {
										$dates .= " (" .getWeekdayFromYear($dates).  ")";
									}
									
									$times = $SATWRITINGLIST[$i+1];
								?>
								<TR>
									<TD class=TABLE_COL1>
										<div align=left><?php echo($dates); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($times); ?></div>
									</TD>
								</TR>
								<?php } ?>
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=10> </TD></TR>
						</TABLE>
					</TD>
				</TR>
<?php  if (0) { ?>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_FTITLE width=100% height=25 colspan=5>
										<div align=center><IMG height=9 src=../images/arrow.gif width=8>&nbsp;
										<a  href='../files/2012.Feb.break.writing_1_.doc'>
										<font color=red size=3>ACT</font>
										</a>
										<br> with <br>
										Dr. Danielowich, Ms. Difranco, Mr. Schqefer
										</div>
									</TD>
								</TR>
								<TR>
									<TD class=TABLE_TITLE height=30 width=25%>
										Date
									</TD>
									<TD class=TABLE_TITLE height=30 width=25%>
										Time
									</TD>
									<TD class=TABLE_TITLE height=30 width=50%>
										Subject
									</TD>
								</TR>
								<?php 
								for ($i = 0; $i < count($SATACTLIST); $i+=3) {
									$dates = $SATACTLIST[$i];
									if (strpos($dates, "(") && strpos($dates, ")")) {
									}
									else {
										$dates .= " (" .getWeekdayFromYear($dates).  ")";
									}
									
									$times = $SATACTLIST[$i+1];
									$title = $SATACTLIST[$i+2];
								?>
								<TR>
									<TD class=TABLE_COL1>
										<div align=left><?php echo($dates); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($times); ?></div>
									</TD>
									<TD  class=TABLE_COL1>
										<div align=left><?php echo($title); ?></div>
									</TD>
								</TR>
								<?php } ?>
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=10> </TD></TR>
						</TABLE>
					</TD>
				</TR>
<?php } ?>
				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
