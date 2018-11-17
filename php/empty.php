<?php
include "../php/header.php"; 
?>
<table  width=100% height=500 cellspacing=0 cellpadding=0 align=center>
<tr>
	<td width=100% valign=middle>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD>
				<IMG SRC=../images/Picture_020-758x300.jpg height=300>			
			</TD>
		</TR>
		<TR>
			<TD height=50>
				<?php echo("<b>Your IP address (".$remoteip.") is not allowed</b>"); ?>
			</TD>
		</TR>
		</TABLE>
	</td>
</TR>		
</table>
<?php 
include "../php/footer.php";
?>

