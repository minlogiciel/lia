<?php 
$nb_cls =  count($CLASS_NAME) - 2; 
$TEST_ST = 0;
$LIST_TEACHER = 0;
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
<TR>
	<TD valign=top height=10>
	</TD>
</TR>
<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Classes </TH>
		</TR>
		<TR><TD valign=top class=list1 height=10></TD></TR>
<?php if (0) { ?>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=newstudent">New Student</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=nonamestudent">New No Name Student</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=allstudents">All Students</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=oldstudents">Old Students</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=emailtoparents">Send Email To Parents</a>
		    	</div>
		    </td>
		</tr>
<?php if ($LIST_TEACHER) { ?>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=newteacher">New Teacher</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=allteachers">All Teachers</a>
		    	</div>
		    </td>
		</tr>
<?php } ?>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?classes=<?php echo($nb_cls); ?>&action=classmember">Tutoring</a>
   				</div>
   			</td>
   		</TR>
<?php if ($TEST_ST) { ?>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=allteststudents">Select Test Students</a>
		    	</div>
		    </td>
		</tr>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?action=summerstudents">Input Test Students</a>
   				</div>
   			</td>
   		</TR>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?action=summerresults">Input Test Scores</a>
   				</div>
   			</td>
   		</TR>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=importtest">Import Test Scores</a>
		    	</div>
		    </td>
		</tr>
<?php } else { ?>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?action=summerstudents">All Test Students</a>
   				</div>
   			</td>
   		</TR>
<?php } ?>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?action=ttreport&testyear=2014">Test Report 2014</a>
   				</div>
   			</td>
   		</TR>
<?php if ($TEST_ST) { ?>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?action=ttreport&testyear=2013">Test Report 2013</a>
   				</div>
   			</td>
   		</TR>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../member/member.php?action=trophyawards">Test Report 2012</a>
   				</div>
   			</td>
   		</TR>
		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=emailtoplacement">Email To Test Taker</a>
		    	</div>
		    </td>
		</tr>
<?php 
	}
if ($GENERATE_REPORT) {?>
		<TR>
   			<td valign=top class=list1 height=20>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="<?php echo(getCreateReportURL()); ?>">Create Students Report</a>
   				</div>
   			</td>
   		</TR>
<?php } ?>

		<tr>
		    <td valign=top class=list1 height=20>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../member/member.php?action=importform">Import Excel</a>
		    	</div>
		    </td>
		</tr>

<?php } ?>
		<TR>
        	<TD>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
<?php 
		for ($i = 0; $i < $nb_cls; $i+=2 ) { 
			$clsname = $CLASS_NAME[$i];
?>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;Class <?php echo($clsname); ?></div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=classmember">Class members</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=inputscores">Input Scores</a>
	    				</div>
	    			</td>
	    		</tr>
	   <?php if ($i > 100) { ?>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=inputscores&subjects=PSAT">Input PSAT scores</a>
	    				</div>
	    			</td>
	    		</tr>
	    <?php } ?>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=showscores">Show scores</a>
	    				</div>
	    			</td>
	    		</tr>
	   <?php if ($i > 100) { ?>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=showscores&subjects=PSAT">Show PSAT scores</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=showtuition">Update Tuitions</a>
	    				</div>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td valign=top class=list1>
	    				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
	    				<a href="../member/member.php?classes=<?php echo($i); ?>&action=sendclassemail">Send Email</a>
	    				</div>
	    			</td>
	    		</tr>
	    <?php } ?>
	    		<tr><TD height=15 class=list1></TD></tr>
				<?php } ?>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

</table>
