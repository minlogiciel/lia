<?php
?>

<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0 align="center">
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
				<TR>
					<TD class=ITEMS_LINE_TITLE>
						<TABLE cellSpacing=1 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=TABLE_FTITLE width=100% height=25 colspan=3>
								<font color=red size=3><?php echo($SCHEDULELIST[0]); ?></font>
							</TD>
						</TR>
						<?php if ($SCHEDULELIST[1]) { ?>
						<tr>
							<td class=NEWS_LINE height=30 colspan=3>
								<div align=center><b><?php  echo($SCHEDULELIST[1]); ?></b></div>
							</TD>
						</TR>
						<?php
						}
							$n = count($SCHEDULELIST)/3;
							$start = 0;
							for ($i = 1; $i < $n; $i++) {
								$dates = $SCHEDULELIST[$i*3];
								$dates = getFullDateAll($dates);
								$times = $SCHEDULELIST[$i*3+1];
								$item = $SCHEDULELIST[$i*3+2];
						?>
						<TR>
							<TD class=NEWS_LINE width=30% valign=top>
								<div align=center><font color=Navy><b><?php echo($dates); ?></b></font></div>
							</TD>
							<TD class=NEWS_LINE width=30%>
								<div align=center><b><?php echo($times); ?></b></div>
							</TD>
							<TD class=NEWS_LINE width=40%>
								<div align=left><b><?php echo($item); ?></b></div>
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
	</TD>
</TR>
</TABLE>