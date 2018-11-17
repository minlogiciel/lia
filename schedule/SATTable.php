<?php  
include "../public/sat_variable.inc"; 
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
							<TD class=lcenter height=40>
								<font color=red size=3><b><?php echo($SATLIST[0][0]); ?></b></font>
							</TD>
						</TR>
						<TR>
							<TD class=lcenter height=40>
								<br><font color=black><b>(<?php echo($SATLIST[0][1]); ?>)</b></font>
							</TD>
						</TR>

						<TR>
							<TD class=background>
							<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
								<TR>
									<TD class=ITEMS_LINE_TITLE height=30 width=18%>
										Date
									</TD>
									<TD class=ITEMS_LINE_TITLE height=30 width=18%>
										Time
									</TD>
									<TD class=ITEMS_LINE_TITLE height=30 width=64%>
										Subject
									</TD>
								</TR>
								<?php $list_nb = count($SATLIST);
								for ($i = 1; $i < $list_nb; $i++) {
									$elem = $SATLIST[$i];
									$dates = $elem[0];
									if (strpos($dates, "(") && strpos($dates, ")")) {
									}
									else {
										$dates .= "<br>(" .getWeekdayFromYear($dates).  ")";
									}
									
									$times = $elem[1];
									$title = $elem[2];
									if (count($elem) > 3) {
										$times .= "<br>" .$elem[3];
										$title .= "<br>&nbsp;&nbsp;" .$elem[4];
									}
								?>
								<TR>
									<TD class=REGENT_COL2 height=50>
										<div align=center><?php echo($dates); ?></div>
									</TD>
									<TD  class=lcenter>
										<div align=center><?php echo($times); ?></div>
									</TD>
									<TD  class=lcenter>
										<div align=left><?php echo("&nbsp;&nbsp;".$title); ?></div>
									</TD>
								</TR>
								<?php } ?>
								<TR>
									<TD class=REGENT_COL2>
										<div align=center>TUITION : </div>
									</TD>
									<TD  class=TABLE_COL2 colspan=2>
										<div align=left>
										<?php echo($SATLIST[0][2]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .$SATLIST[0][3]); ?>
										</div>
									</TD>
								</TR>
								
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=10> </TD></TR>
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
