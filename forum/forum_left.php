

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
<TR><TD height=10></TD></TR>
<TR>
	<TD valign=top> <?php include "../utils/calendar.php"; ?> </TD>
</TR>
<TR><TD height=10></TD></TR>
<?php  
for ($i = 0; $i < count($SUBJECTS_LIST); $i++) { 
	$SUBJ = $SUBJECTS_LIST[$i];
?>
<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top><?php echo($SUBJ[0]); ?></TH>
		</TR>
		<TR>
        	<TD>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
				<?php for ($j = 2; $j < count($SUBJ); $j++ ) { ?>
	    		<tr>
	    			<td valign=top class=list1 height=20>
						<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>
							<?php echo("<a href='" .$SUBJ[1]. "?subject=" .$j. "&courses=".$i."'>" .$SUBJ[$j]. "</a>"); ?>
		    			</div>
		    		</td>
		    	</tr>
				<?php } ?>
				
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=10 valign=top></TD></TR>
<?php 
}
?>


</TABLE>
