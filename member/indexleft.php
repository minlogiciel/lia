
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
<TR>
	<TD valign=top>
<?php 
if ($student) {
	$firstname =  $student->getFirstname();
	$studentname = $firstname[0]. ". " .$student->getLastname();
	$studentid = $student->getID();
	$stclass = $student->getClasses();
?>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Welcome <?php echo($studentname); ?></TH>
		</TR>
		<TR>
        	<TD>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
	    		<tr><TD height=10 class=list1></TD></tr>
	    		<tr>
	    			<td valign=top height=20 class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    				<a href="../member/login.php?action=changeprofile">Change My Profile</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top height=20 class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    				<a href="../member/?action=reportcard&studentid=<?php echo($studentid); ?>">My Report Card</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top height=20 class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    				<a href="../member/?action=tuitionbill&studentid=<?php echo($studentid); ?>">My Tuition Bill</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top height=20 class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    				<a href="../member/?action=allscores&studentid=<?php echo($studentid); ?>">All Scores</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<?php if (1) { ?>
	    		<tr>
	    			<td valign=top height=20 class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;&nbsp;
	    				<a href="../private/?action=privatesession&studentid=<?php echo($studentid); ?>">Private Session</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<?php } ?>
	    		<tr><TD height=15 class=list1></TD></tr>
				
				</TABLE>
			</TD>
		</TR>
		</TABLE>
<?php } ?>
	</TD>
</TR>
</table>
