<?php 
class ImageSchedule {

function ShowImageSchdule($tab) {
	$doctitle = trim($tab[0]);
	$docfile = $tab[1];
?>

<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0>
		<?php if ($doctitle) { ?>
		<TR>
			<TD class=TUITION_TITLE width=100% height=50>
				<div align=center>
			<?php 
					if ($docfile && (strstr($docfile, ".doc") || strstr($docfile, ".pdf"))) {
						echo("<a href='../files/".$docfile."' target=_blanck><font color=red size=4>". $tab[0]."</font></a>");
					}
					else {
						echo("<font color=red size=4>". $tab[0]."</font>");
					}
			?>
				</div>
			</TD>
		</TR>
		<?php } if ($docfile && strstr($docfile, ".pdf")) { ?>
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<div align=center>
					<embed src='../files/<?php echo($docfile); ?>' width='100%' height='850'
			           	pluginspage='http://www.adobe.com/products/acrobat/readstep3.html' />
				</div>
			</TD>
		</TR>
		<?php } else { ?>
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<IMG src='../schedulephotos/<?php echo($tab[2]); ?>' width=600>
			</TD>
		</TR>
		<?php } ?>
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<div align=center>
				<?php 
					if ($docfile && (strstr($docfile, ".doc") || strstr($docfile, ".pdf"))) {
						echo("<a href='../files/".$docfile."' target=_blanck><font color=red>Download Program</font></a>");
					}
				?>
				</div>
			</TD>
		</TR>
	
		</TABLE>
	</TD>
</TR>		
</table>
<?php 
}
}
?>
