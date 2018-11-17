<?php

class TuitionForm {

	var $DATA_BASE 	= 1;
	var $TABLE_NAME = "STUDENTS";
	var $IDS 		= "IDS";
	
	
function getTuitionlist() {
	$tuitionlists = array();
	
	$period 	= getPostValue("period");
	$semester	= getPostValue("semester");
	$classes	= getPostValue("classes");
	$nb 		= getPostValue("studentnumber");

	$nn = 0;
	for ($i = 0; $i < $nb; $i++) {
		$studentid = getPostValue("studentid_".$i);
		$tuitionid = getPostValue("tuitionid_".$i);
		$tuition = getPostValue("tuition_".$i);
		$books = getPostValue("books_".$i);
		$buses = getPostValue("buses_".$i);
		$tennis = getPostValue("tennis_".$i);
		$others = getPostValue("others_".$i);
		$paid = getPostValue("paid_".$i);
		$balancef = getPostValue("balancef_".$i);
		$balancef_s = getPostValue("balancefs_".$i);
			
		$tuitionclass = new TuitionClass();
		if ($tuitionid) {
			$tuitionclass->setID($tuitionid);
		}
		$tuitionclass->setStudentID($studentid);
		$tuitionclass->setSemester($semester);
		$tuitionclass->setPeriods($period);
		$tuitionclass->setTuition($tuition);
		$tuitionclass->setBooks($books);
		$tuitionclass->setBuses($buses);
		$tuitionclass->setTennis($tennis);
		$tuitionclass->setOthers($others);
		$tuitionclass->setPaid($paid);
		$tuitionclass->setBalanceF($balancef);
		$tuitionclass->setBalanceFSemester($balancef_s);
		$tuitionlists[] = $tuitionclass;
	}
	return $tuitionlists;
}

/* update student tuition */
function updateTuitionList() {
	
	$tuitionlists = $this->getTuitionlist();
	if ($tuitionlists && count($tuitionlists) > 0) {
		$studenttuition = $tuitionlists[0];
		$fname = getBackupFileName($studenttuition->getTableName(), $studenttuition->getID());
		$fp = fopen($fname, "w");
		
		$text = $studenttuition->getBackupTitle()."\n";
		fwrite($fp, $text);
		
		$nb = count($tuitionlists);
		for ($i = 0; $i < $nb; $i++) {
			$studenttuition = $tuitionlists[$i];

			if ($studenttuition->getID()) {
				$studenttuition->updateStudentTuition();
			}
			else {
				$studenttuition->addStudentTuition();
			}
			if ($i == $nb-1) {
				$text = $studenttuition->getData(). ";\n";
			}
			else {
				$text = $studenttuition->getData(). ",\n";
			}
			fwrite($fp, $text);
		}
		fclose($fp);
	}
	return $tuitionlists;
}


	
function showTuitionForm($classes, $sem, $yy)  
{
	$mlists = new MemberList();
	$studentlist = $mlists->getStudentLists($classes, 0);
	$nbstudent =  count($studentlist);
	
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
	
		
?>
<FORM action='member.php' method=post>
<INPUT type=hidden name='studentnumber' value='<?php echo($nbstudent); ?>'>		
<INPUT type=hidden name='classes' value='<?php echo($classes); ?>'>
<INPUT type=hidden name='action' value='updatetuition'>
<INPUT type=hidden name='semester' value=<?php echo($semester); ?>>
<INPUT type=hidden name='period' value=<?php echo($period); ?>>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>

<TR><TD class=labelright>
<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
<TR>
	<TD width=100% class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=25 width=100% class=TABLE_FTITLE>
						<div align=left><font color=blue>&nbsp;&nbsp;
						Update Students Tuitions For Class  
						<?php echo(getClassName($classes). " (".$semester. "-" .$period. ")"); ?>&nbsp;</font></div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD>
				<?php
					$this->inputStudentsTuitionTable($studentlist, $semester, $period); 
				 ?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=20 class=labelleft></TD></TR>
</TABLE>
</TD></TR>

<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=40 class=labelright width=100%>
				<div align=center>
				<INPUT class=button type=submit value=' Update Tuition '>
				<INPUT class=button type=submit name="reset" value=' Reset '>
			</div>
			</TD>
		</TR>
		<TR><TD height=15 colspan=2>&nbsp;</TD></TR>
		</TABLE>
	</TD>
</TR>

</TABLE>
</FORM>
	
<?php	
}

function inputStudentsTuitionTable($studentlist, $semester, $period) 
{
?>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> FIRST Name  </TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> LAST Name  </TD>
			<TD class=ITEMS_LINE_TITLE width='5%'> ID  </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> Tuition </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> Book </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> Bus </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> Tennis </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> Other </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> Paid </TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> BalanceF </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'>BFPeriod </TD>
		</TR>
		<?php 
		for ($i = 0; $i < count($studentlist); $i++) {
			$student 	= $studentlist[$i];
			$id 		= $student->getID();
			$lastname 	= $student->getLastName();
			$firstname 	= $student->getFirstName();
			$tuitionClass = new TuitionClass();
			$tuitionid = 0;
			if ($tuitionClass->getStudentTuition($id, $semester, $period)) {
				$tuitionid 	= $tuitionClass->getID();
				$tuition 	= $tuitionClass->getTuition();
				$buses = $tuitionClass->getBuses();
				$books = $tuitionClass->getBooks();
				$tennis = $tuitionClass->getTennis();
				$others = $tuitionClass->getOthers();
				$balancef = $tuitionClass->getBalanceF();
				$balancef_s = $tuitionClass->getBalanceFSemester();
				$paid = $tuitionClass->getPaid();
			}
			else {
				$tuition 	= 0;
				$buses = 0;
				$books = 0;
				$tennis = 0;
				$others = 0;
				$balancef = 0;
				$balancef_s = "";
				$paid = 0;
			}
		?>
		<TR>
			<TD class='listnum'><div align=center><?php echo($i+1); ?></div></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($firstname); ?> </TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($lastname); ?></TD>
			<TD class='listtext'><div align=center><?php echo($id); ?></div></TD>
			<TD class='listtext'>
				<INPUT type=hidden name="tuitionid_<?php echo($i); ?>" value="<?php echo($tuitionid); ?>">
				<INPUT type=hidden name="studentid_<?php echo($i); ?>" value="<?php echo($id); ?>">
				<INPUT class=fnborder type=text size=5 name="tuition_<?php echo($i); ?>" value="<?php echo($tuition); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=5 name="books_<?php echo($i); ?>" value="<?php echo($books); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=5 name="buses_<?php echo($i); ?>" value="<?php echo($buses); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=5 name="tennis_<?php echo($i); ?>" value="<?php echo($tennis); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=5 name="others_<?php echo($i); ?>" value="<?php echo($others); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=5 name="paid_<?php echo($i); ?>" value="<?php echo($paid); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=5 name="balancef_<?php echo($i); ?>" value="<?php echo($balancef); ?>">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=10 name="balancefs_<?php echo($i); ?>" value="<?php echo($balancef_s); ?>">
			</TD>
		</TR>
		<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

}
?>
