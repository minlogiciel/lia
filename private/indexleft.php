
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
<TR><TD height=10></TD></TR>
<TR>
	<TD valign=top>
		<?php include "../utils/calendar.php"; ?>
	</TD>
</TR>
<TR><TD height=10></TD></TR>
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
	    				<a href="../private/?action=privatesession&studentid=<?php echo($studentid); ?>">Private Session</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr><TD height=15 class=list1></TD></tr>
				
				</TABLE>
			</TD>
		</TR>
		</TABLE>
<?php } ?>
	</TD>
</TR>

<TR><TD height=10></TD></TR>

<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TD>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
		<?php 
		$memLists = new MemberList();
		$teacherlists = $memLists->getTeacherSubjectsLists(0);
		for ($i = 0; $i < count($teacherlists); $i++) { 
			$TN = $teacherlists[$i];
			$subjs = $PROGRAMS[$i];
		?>
				<TR><TH ><?php echo($subjs); ?> Teachers</TH></TR>
	    		<tr><TD height=10 class=list1></TD></tr>
		<?php 
			for ($j=0; $j < count($TN); $j++) {
				$tname = $TN[$j]->getTeacherFullName();
		?>
	    		<tr>
	    			<td valign=top height=20 class=list1>
	    				<div align=left>&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../private/?teacher=<?php echo($tname); ?>&studentid=<?php echo($studentid); ?>&subjects=<?php echo($subjs); ?>">
	    					<?php echo($tname. " (" .$subjs. ")"); ?></a>
	    				</div>
	    			</td>
	    		</tr>
	    <?php } 
		 } ?>
	    		<tr><TD height=15 class=list1></TD></tr>
				
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

</table>
