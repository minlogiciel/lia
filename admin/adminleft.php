<?php 
include_once("../php/right1.php");

$nb_cls =  count($CLASS_NAME) - 2; 

if ($mtype == $HOMEWORK_TYPE) {
?>


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

<?php } else { ?>
<TABLE cellSpacing=0 cellPadding=0 width=100% align=center>
<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Students / Teachers</TH>
		</TR>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=classteacher">Class &amp; Teacher</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=managestudents">Student Manager</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=newstudent">New Student</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		   <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=nonamestudent">New No Name Student</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=showregister">All Registered Students</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=register">Registration</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=allstudents">All Students</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=oldstudents">Old Students</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=emailtoparents">Send email to classes</a>
		    	</div>
		    </td>
		</tr>
    	<tr>
    		<td valign=top class=list1>
    			<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
    			<a href="../admin/admin.php?action=sendclassemail">Send email to students</a>
    			</div>
    		</td>
    	</tr>
		<TR>
   			<td  class=list1 height=25>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../admin/admin.php?actiontype=showreportform">Create Students Reports</a>
   				</div>
   			</td>
   		</TR>
		<TR>
   			<td  class=list1 height=25>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../admin/admin.php?actiontype=showreportlist">Students Reports</a>
   				</div>
   			</td>
   		</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Class Schedule</TH>
		</TR>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=schedulemenutype">Schedule Menu</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=schedulemenunametype">Schedule Menu Name</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=announcement">Announcement</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=testtakertype">TestTakers's SAT</a>
		    	</div>
		    </td>
		</tr>
		
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=acttype">ACT Schedule</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=sattype">SAT/PSAT Schedule</a>
		    	</div>
		    </td>
		</tr>

<!-- 
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=regentstype">Regents Schedule</a>
		    	</div>
		    </td>
		</tr>
-->
		</TABLE>
	</TD>
</TR>
<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Home Page </TH>
		</TR>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=homepagetype">Home Page Items</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=homepagephototype">Upload Photos</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=admissiontype">New Admission</a>
		    	</div>
		    </td>
		</tr>

<?php for ($i = 0; $i < count($ADMISSION_VAR); $i++) { ?>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=admissiontype&nindex=<?php echo(($i+1)); ?>"><?php echo($ADMISSION_VAR[$i][0]); ?></a>
		    	</div>
		    </td>
		</tr>
<?php } ?>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=coursinfotype">Saturday Class</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=apsatinfotype">AP/SAT Programs</a>
		    	</div>
		    </td>
		</tr>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Home Page Right Part</TH>
		</TR>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=homerightpagetype">Home Page Right Items</a>
		    	</div>
		    </td>
		</tr>
<?php for ($i = 0; $i < count($RIGHT_LIST); $i++) { ?>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?actiontype=homerighttype&nindex=<?php echo($i); ?>"><?php echo($RIGHT_LIST[$i][0])?></a>
		    	</div>
		    </td>
		</tr>
<?php } ?>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD valign=top>
    	<TABLE class=moduletable cellSpacing=0 cellPadding=0 width=100% align=center>
		<TR>
        	<TH vAlign=top>Summer Test </TH>
		</TR>
<?php $m = date("n"); if ($m > 5 && $m < 9) { ?>
		<TR>
   			<td  class=list1 height=25>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../admin/admin.php?action=summerstudents">All Test Students</a>
   				</div>
   			</td>
   		</TR>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=allteststudents">To Open Test Student</a>
		    	</div>
		    </td>
		</tr>
		<TR>
   			<td  class=list1 height=25>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../admin/admin.php?action=summerstudents">Input Test Students</a>
   				</div>
   			</td>
   		</TR>
		<TR>
   			<td  class=list1 height=25>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../admin/admin.php?action=summerresults">Input Test Scores</a>
   				</div>
   			</td>
   		</TR>

		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=importtest">Import Test Scores</a>
		    	</div>
		    </td>
		</tr>
		<tr>
		    <td  class=list1 height=25>
		    	<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
		    	<a href="../admin/admin.php?action=emailtoplacement">Email To Test Taker</a>
		    	</div>
		    </td>
		</tr>		
<?php }

$c_year = 2018;
		for ($n_y = $c_year;  $n_y > 2011; $n_y--) {
?>
	<TR>
   			<td  class=list1 height=25>
   				<div align=left>&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;
   				<a href="../admin/admin.php?actiontype=ttreport&testyear=<?php echo($n_y); ?>">Test Report <?php echo($n_y); ?></a>
   				</div>
   			</td>
   		</TR>
<?php } ?>

		</TABLE>
	</TD>
</TR>

</table>
<?php } ?>

