

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR><TH vAlign=top>Add Homework</TH></TR>
		<TR>
        	<TD>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
				<tr> <td valign=top class=list1 height=15>	</td> </tr>
				
<?php  
for ($i = 0; $i < count($CLASS_NAME)-2; $i+=2) { 
	$cls = $CLASS_NAME[$i];
?>
	    		<tr>
	    			<td valign=top class=list1 height=25>
						<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>
							<?php echo("<a href='../admin/admin.php?action=addhomework&mtype=".$HOMEWORK_TYPE."&classes=".$cls."'>Add ".$cls." Homework</a>"); ?>
		    			</div>
		    		</td>
		    	</tr>
<?php } ?>
				</TABLE>
			</TD>
		</TR>
		
		<TR>
        	<TH valign=top>List Homework</TH>
		</TR>
		<tr> <td valign=top class=list1 height=15>	</td> </tr>
    	<tr>
    		<td valign=top class=list1 height=30>
				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>
					<?php echo("<a href='../admin/admin.php?action=listhomework&mtype=".$HOMEWORK_TYPE."&classes=".$i."'>List Homework</a>"); ?>
    		</div>
    		</td>
    	</tr>
    	<tr>
    		<td valign=top class=list1 height=30>
				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>
					<?php echo("<a href='../admin/admin.php?action=modifyhomework&mtype=".$HOMEWORK_TYPE."&classes=".$i."'>Modify Homework</a>"); ?>
    		</div>
    		</td>
    	</tr>
		
		</TABLE>
	</TD>
</TR>
<TR><TD height=10 valign=top></TD></TR>
</TABLE>
