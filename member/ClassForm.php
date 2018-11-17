<?php
class ClassForm {

	var $MEMBER_TYPE = 1;
	var $error = "";

function getError() {
	return $this->error;
}
function setError($err) {
	 $this->error = $err;
}

function getEmailLink($email) {
	if ($email)
		return ("<a href='mailto:"  .$email. "'>"  .$email. "</a>");
	else 
		return "";
}
function getStudentScoresLink($id, $classes, $name) {
	return ("<a href='../member/student.php?action=studentscores&studentid="  .$id. "&classes=".$classes."'>"  .$name. "</a>");
}
function getStudentProfilLink($id, $classes, $name) {
	return ("<a href='../member/student.php?action=studentprofil&studentid="  .$id. "&classes=".$classes."'>"  .$name. "</a>");
}

function showClassLink($classes, $actionname) {
	global $CLASS_NAME;
?>
	<select name='classes' STYLE='width:150; height:25; FONT-WEIGHT:bold; color:blue; align:center;' 
	onchange='self.location.href="student.php?classes="+this.options[this.selectedIndex].value+"&action=<?php echo($actionname); ?>"'>
<?php 
	for ($i = 0; $i < count($CLASS_NAME) ; $i+=2 ) { 
		if ($classes == $CLASS_NAME[$i] || $classes == $i) { 
			echo("<option value=".$i." selected>&nbsp;&nbsp; ".$CLASS_NAME[$i]." &nbsp;&nbsp;</option>");
		}
		else {
			echo("<option value=".$i.">&nbsp;&nbsp; ".$CLASS_NAME[$i]." &nbsp;&nbsp;</option>");
		}
	}
?>
	</select>
<?php 
}

function getModifyStudents() {
	$students = array();
	$nb_student = getPostValue('studentnb');
	$classes = getPostValue('classes');
	for ($i = 0; $i < $nb_student; $i++) {
		$studentid = getPostValue('studentid_'.$i);
		$civil = getPostValue('civil_'.$i);
		$firstname = getPostValue('firstname_'.$i);
		$lastname = getPostValue('lastname_'.$i);
		$grade = getPostValue('grade_'.$i);
		$email = getPostValue('email_'.$i);
		$phone = getPostValue('phone_'.$i);
		$mobile = getPostValue('mobile_'.$i);
		if (getPostValue("delstudent_".$i)) {
			$isdelete = 1;
		}
		else 
			$isdelete = 0;
		if ($firstname || $lastname || $studentid) {
			$student = new StudentClass();
			if ($studentid) {
				$student->getUserByID($studentid);
			}
			else {
				$student->setID(0);
				$classname = getClassName($classes);
				$student->setClasses($classname);
			}

			$student->setCivil($civil);
			$student->setFirstName($firstname);
			$student->setLastName($lastname);
			$student->setEmail($email);
			$student->setPhone($phone);
			$student->setMobile($mobile);
			$student->setGrade($grade);
			$student->setDeleted($isdelete);
			if ($isdelete && !$studentid) {
				
			}
			else {
				$students[] = $student;
			}
		}
	}
	return $students;
}
	
function saveClassMember() {
	$this->error = "";
	$students = $this->getModifyStudents();
	$nb_st =  count($students);
	if ($nb_st > 0) {
		for ($i = 0; $i < $nb_st; $i++) {
			$student = $students[$i];
			if ($student->getID() > 0) {
				if ($student->updateProfile()) {
				}
				else {
					$this->error .= "Update Student Error : ".$student->getTrace()."<br>";
				}
			}
			else {
				if ($student->isUserDataOK()) {
					$student->addStudent();
					$this->error = "Add News Strudent OK!";
				}
				else {
					$this->error .= "Add News Strudent Error : " .$student->getTrace()."<br>";

				}
			}
		}
	}
	return $this->error;	
}
	
function ModifyClassMember($classes, $loaddel, $result) {
	global $CLASS_NAME;
	$mlists = new MemberList();
	$lists = $mlists->getStudentLists($classes, $loaddel);
	$nbmember = count($lists);
	$showAllStudent = 0;
	$n_grade = getClassGrade($classes);
	$classname = getClassName($classes);

	$nb_loop = 	$nbmember;	
	if ($nbmember < 5) {
		$nb_loop += 15;
	}
	else if ($nbmember < 10) {
		$nb_loop += 10;
	}
	else {
		$nb_loop += 5;
	}
		
?>
<FORM action='../member/student.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='saveclassmember'>
<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nb_loop); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=30 class=error><?php echo($result); ?></TD></TR>
<TR>
	<TD height=50>
		<h2> <?php $this->showClassLink($classname, "classmember"); ?>	Class Students</h2>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='5%'> Gender </TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> First Name </TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> Last Name</TD>
			<TD class=ITEMS_LINE_TITLE width='25%'> Email  </TD>
			<TD class=ITEMS_LINE_TITLE width='5%'> Grade </TD>
			<TD class=ITEMS_LINE_TITLE width='12%'> Phone </TD>
			<TD class=ITEMS_LINE_TITLE width='12%'> Cell </TD>
			<TD class=ITEMS_LINE_TITLE width='5%'> DEL  </TD>
		</TR>
<?php 	
		for ($i = 0; $i < $nb_loop; $i++) {
			if ($i < $nbmember) {
				$id 		= $lists[$i]->getID();
				$gender		= $lists[$i]->getCivil();
				$firstname	= $lists[$i]->getFirstName();
				$lastname	= $lists[$i]->getLastName();
				$classes	= $lists[$i]->getClasses();
				$grade		= $lists[$i]->getGrade();
				$email 		= $lists[$i]->getEmail();
				$phone 		= $lists[$i]->getPhone();
				$cell		= $lists[$i]->getMobile();
				$isdelete 	= $lists[$i]->isDeleted();
			}
			else {
				$id 		= 0;
				$gender		= "M";
				$firstname	= "";
				$lastname	= "";
				$classes	= "";
				$grade		= $n_grade;
				$email 		= "";
				$phone 		= "";
				$cell		= "";
				$isdelete 	= 0;
			}
			?>			
		<TR>
			<TD class='listnum'>
				<div align=center>
				<?php 
					if ($id) 
						echo($this->getStudentProfilLink($id, $classes, ($i+1))); 
					else 
						echo(($i+1)); 
				?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<select name="civil_<?php echo($i); ?>" onclick="active_save();">
<?php  if ($gender == 'F') { ?>
				<option value=M> Mr. </option>
				<option value=F selected> Ms. </option>
<?php  } else { ?>
				<option value=M selected> Mr. </option>
				<option value=F> Ms. </option>
<?php 	} ?>	
				</select>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<?php if ($id > 0) {?>
				<INPUT class=fields type=text size=15 name="firstname_<?php echo($i); ?>" value="<?php echo($firstname); ?>" onclick="active_save();">
				<?php } else { ?>
				<INPUT class=fields type=text size=15 name="firstname_<?php echo($i); ?>" value="<?php echo($firstname); ?>" onclick="active_save();">
				<?php } ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<?php if ($id > 0) {?>
				<INPUT class=fields type=text size=15 name="lastname_<?php echo($i); ?>" value="<?php echo($lastname); ?>" onclick="active_save();">
				<?php } else { ?>
				<INPUT class=fields type=text size=15 name="lastname_<?php echo($i); ?>" value="<?php echo($lastname); ?>" onclick="active_save();">
				<?php } ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<INPUT class=fields type=text size=30 name="email_<?php echo($i); ?>" value="<?php echo($email); ?>" onclick="active_save();">
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<select name="grade_<?php echo($i); ?>" onclick="active_save();">
				<?php  
				for ($gd = 2; $gd < 13; $gd++) {
					if ($grade == $gd) { ?>
						<option value="<?php echo($gd); ?>" selected> <?php echo($gd); ?> </option>
			<?php  	} else { ?>
						<option value="<?php echo($gd); ?>"> <?php echo($gd); ?> </option>
			<?php 	} } ?>	
				</select>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<INPUT class=fields type=text size=10 name="phone_<?php echo($i); ?>" value="<?php echo($phone); ?>" onclick="active_save();">
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<INPUT class=fields type=text size=10 name="mobile_<?php echo($i); ?>" value="<?php echo($cell); ?>" onclick="active_save();">
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<?php if ($isdelete) { ?>
					<INPUT class=box type='checkbox' name='delstudent_<?php echo($i); ?>' value='1' CHECKED onclick="active_save();">
				<?php } else { ?>
					<INPUT class=box type='checkbox' name='delstudent_<?php echo($i); ?>' value='1' onclick="active_save();">
				<?php } ?>
				<INPUT NAME='studentid_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($id); ?>'>
				</div>
			</TD>
		</TR>
<?php 
		}
?>		
		<TR>
			<TD height=30 class='formlabel' colspan=9>
				<div align=center>
				<INPUT class=button TYPE='submit' name="save" VALUE=' Save ' id="savebuttonid"">
				<INPUT class=button TYPE='submit' name="reset" VALUE=' Reset '>
				<INPUT class=button TYPE='submit' name="showdeleted" VALUE=' Show Deleted Student '>
				</div>
			</TD>
		</TR>

		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}

/*****************************************************************/

function getScoreValue($total) {
	$v = 0;
	if ($total) {
		if(is_numeric($total)) {
			$v = $total;
		}
		else {
			$len = strlen($total);
			$start = -1;
			$end = $len;
			for($i = 0; $i < $len; $i++) {
				if ($this->isDigitalString($total[$i])) {
					if ($start == -1) {
						$start = $i;
					}
	     		}
	     		else if ($start != -1) {
	     			$end = $i;
	     			break;
	     		}
			}
			if ($start != -1) {
				$v = substr($total, $start, ($end-$start));
			}
		}
	}
	return $v;
}

function mergeScores($item, $question) {
	$q = trim($question);
	$v = trim($item);
	if ($q && $v) {
		if (strstr($v, "/")) {
			list($d1, $d2) =  explode("/", $v);
		}
		else {
			$d1 = $v;
		}
		$ret = $d1."/".$q;
	}
	else {
		$ret = $item;
	}
	return $ret;
}

function getFirstValue($item) {
	$d1 = 0;
	$v = trim($item);
	if ($v) {
		if (strstr($v, "/")) {
			list($d1, $d2) =  explode("/", $v);
		}
		else {
			$d1 = $v;
		}
	}
	return $d1;
}

function getSecondValue($item) {
	$d2 = 0;
	$v = trim($item);
	if ($v) {
		if (strstr($v, "/")) {
			list($d1, $d2) =  explode("/", $v);
		}
	}
	return $d2;
}

function getTotalScores($item1, $item2, $question1, $question2) {
	$total = 0;
	$d1 = 0;
	$d2 = 0;
	$d3 = 0;
	$d4 = 0;
	$v1 = trim($item1);
	if ($v1) {
		if (strstr($v1, "/")) {
			list($d1, $d2) =  explode("/", $v1);
		}
		else {
			$d1 = $this->getScoreValue($v1);
			if ($d1 > 0) {
				$d2 = 100;
			}
		}
	}
	$v2 = trim($item2);
	if ($v2) {
		if (strstr($v2, "/")) {
			list($d3, $d4) =  explode("/", $v2);
		}
		else {
			$d3 = $this->getScoreValue($v2);
			if ($d3 > 0) {
				$d4 = 100;
			}
		}
	}
	
	if ($question1 && $question1 != $d2)
		$d2 = $question1;
	if ($question2 && $question2 != $d4)
		$d4 = $question2;
	
	if (!$d1)
		$d2 = 0;
	if (!$d3)
		$d4 = 0;
	if (($d2 + $d4) != 0) {
		$dd = ($d1 + $d3)*100;
		$v = $dd/($d2 + $d4);
		$total = (int)$v;
		if (($v - $total) > 0.5)
			$total++;
	}
	return $total;
}

function getScoreslist() {
	$scoreslist = array();
	
	$teacher 	= getPostValue("teacher");
	$titles 	= getPostValue("titles");
	$subjects 	= getPostValue("subjects");
	$types 		= getPostValue("types");
	$mscores 	= getPostValue("mscores");
	$lscores 	= getPostValue("lscores");
	$hscores 	= getPostValue("hscores");
	$dd 		= getPostValue("dday");
	$mm 		= getPostValue("dmonth");
	$period 	= getPostValue("period");
	$semester	= getPostValue("semester");
	$classes	= getPostValue("classes");

	$nb 		= getPostValue("studentnumber");
	$question1 	= getPostValue("question_1");
	$question2 	= getPostValue("question_2");
	
	$dates = "";
	if ($mm < 10)
		$dates .= "0";
	$dates 	.= $mm. "/";
	if ($dd < 10)
		$dates .= "0";
	$dates 		.= $dd;
	
	$mscores = 0.0;
	$hscores = 0.0;
	$lsocres = 0.0;
	$math = '';
	$reading = '';
	$writing = '';
	
	$nn = 0;
	$first = 1;

	for ($i = 0; $i < $nb; $i++) {
		$studentid = getPostValue("studentid_".$i);
		$scoresid = getPostValue("scoresid_".$i);
		$total = 0;

		$item1 = getPostValue("item1_".$i);
		$item2 = getPostValue("item2_".$i);
		$total = getPostValue("total_".$i);

		$tt = $this->getTotalScores($item1, $item2, $question1, $question2);
			
		if ($tt == 0) {
			$total = trim($total);
		}
		else {
			$total = $tt;
		}
		$reading = $this->mergeScores($item1, $question1);
		$writing = $this->mergeScores($item2, $question2);
			
		if ($total) {
			$v = $this->getScoreValue($total);
			if($v > 0) {
				$nn++;
				if ($hscores == 0) {
					$hscores = $v;
				}
				else if ($v > $hscores) {
					$hscores = $v;
				}
				if ($lsocres == 0) {
					$lsocres = $v;
				}
				else if ($v > 0 && $v < $lsocres) {
					$lsocres = $v;
				}
				$mscores += $v;
			}
		}
		else {
			$total = '';
		}

		$studentscores = new ScoreClass();
		if ($scoresid) {
			$studentscores->setID($scoresid);
		}
		$studentscores->setStudentID($studentid);
		$studentscores->setTeacher($teacher);
		$studentscores->setTitles($titles);
		$studentscores->setSubjects($subjects);
		$studentscores->setTypes($types);

		$studentscores->setMathScores($math);
		$studentscores->setReadingScores($reading);
		$studentscores->setWritingScores($writing);
		$studentscores->setTotalScores($total);
					
			
		$studentscores->setDates($dates);
		$studentscores->setSemester($semester);
		$studentscores->setPeriods($period);
		$studentscores->setClasses(getClassName($classes));
		$studentscores->setComments("");
		$scoreslist[] = $studentscores;
		
	}
	if ($nn > 0) {
		$mscores = (int)($mscores  / $nn);
	}
	for ($i = 0; $i < $nb; $i++) {
		$scoreslist[$i]->setMoyenScores($mscores);
		$scoreslist[$i]->setLowScores($lsocres);
		$scoreslist[$i]->setHighScores($hscores);
	}
	
	return $scoreslist;
}
	
/*********   add students scores ****************/
function addNewScoresList() {
	$scoreslists = $this->getScoreslist();
	if (count($scoreslists) > 0) {
		$groups		= getPostValue("groups");
		$scoresRef = new ScoreRefClass();
		if ($groups) {
			$scoresRef->getScoresRefByID($groups);
		}
		
		$studentscores = $scoreslists[0];
		$scoresRef->setClasses($studentscores->getClasses());
		$scoresRef->setSubjects($studentscores->getSubjects());
		$scoresRef->setTypes($studentscores->getTypes());
		$scoresRef->setSemester($studentscores->getSemester());
		$scoresRef->setPeriods($studentscores->getPeriods());
		$scoresRef->setDates($studentscores->getDates());
		$groups = $scoresRef->addScoresRef();

		$nb = count($scoreslists);
		for ($i = 0; $i < $nb; $i++) {
			$studentscores = $scoreslists[$i];
			$studentscores->setGroups($groups);
			$studentscores->addStudentScores();
		}
	}
	return $scoreslists;
}


function showStudentsScoresTitle($classes, $sscores, $subs, $ns=1, $sem='', $yy=0) 
{
		global $SEMESTERS, $EXAMS;
		$teacher = "";
		$subjects = $subs;
		$types = "Homework";
		$mscores = "";
		$lscores = "";
		$hscores = "";
		
		$semester = getSemesterByString($sem);
		$period = getYearByString($yy);
		
		$dates = '';
		$s = getSemester();

		$programlist = getClassReportSubject($classes);
		if ($sscores) {
			$teacher = $sscores->getTeacher();
			$titles = $sscores->getTitles();
			$subjects = $sscores->getSubjects();
			$types = $sscores->getTypes();
			$mscores = $sscores->getMoyenScores();
			$lscores = $sscores->getLowScores();
			$hscores  = $sscores->getHighScores();
			$dates = $sscores->getDates();
			$semester = $sscores->getSemester();
			$period = $sscores->getPeriods();
			if ($period == 0)
				$period = date("Y");
		}
		else {
			$teacher = getClassTeacherName($classes, $subjects);
			$titles = "HW #".$ns;
		}
		if ($dates && strstr($dates,"/")) {
			list($mm,$dd) =  explode("/", $dates);
		}
		else {
			$mm = date("m");
			$dd = date("d");
			if ($dd > 1)
				$dd = $dd-1;
		}
		
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright height= 15 width=10%> </TD>
	<TD class=labelleft  width=20%> </TD>
	<TD class=labelright width=10%></TD>
	<TD class=labelleft  width=25%></TD>
	<TD class=labelright width=10%> </TD>
	<TD class=labelleft  width=25%> </TD>
</TR>
<TR>
	<TD class=labelright10 height=30>Due Date : </TD>
	<TD class=labelleft>
		<select name="dmonth" STYLE='width:65; align: center' onclick="active_save();">
		<?php 	
		for ($i = 1; $i < 13; $i++) {
			if ($mm == $i)
				echo ("<option value=".$i." selected> " .$i. " </option>");
			else
				echo ("<option  value=".$i."> " .$i. " </option>");
		}
		?>
		</select>
		<select name="dday" STYLE='width:65; align: center' onclick="active_save();">
		<?php 	
		for ($i = 1; $i < 32; $i++) {
			if ($dd == $i)
				echo ("<option value=".$i." selected> " .$i. " </option>");
			else
				echo ("<option  value=".$i."> " .$i. " </option>");
		}
		?>
		</select>
	</TD>
	<TD class=labelright10>Subjects : </TD>
	<TD class=labelleft>
		<select name="subjects" id="subjects" STYLE='width: 160; align: center' onChange="change_teacher();">
		<?php 	
		for ($i = 0; $i < count($programlist); $i++) {
			$program = $programlist[$i];
			if ($program == $subjects)
				echo ("<option value=".$program." selected> " .$program. " </option>");
			else
				echo ("<option  value=".$program."> " .$program. " </option>");
		}

		?>
		</select>
	</TD>
	<TD class=labelright10>Types : </TD>
	<TD class=labelleft>
		<select name="types" id="types" STYLE='width: 140;  align: center' onChange="change_title();">
		<?php 	
		for ($i = 0; $i < count($EXAMS); $i++) {
			$exam = $EXAMS[$i];
			if ($exam == $types)
				echo ("<option  value=".$exam." selected> " .$exam. " </option>");
			else
				echo ("<option value=".$exam."> " .$exam. " </option>");
		}
		?>
		</select>
	</TD>
</TR>
<TR>
	<TD class=labelright10 height=30>Semester : </TD>
	<TD class=labelleft>
		<select name="semester" STYLE='width:65;  align: center' onclick="active_save();">
		<?php 	
		for ($i = 0; $i < count($SEMESTERS); $i++) {
			$sem = $SEMESTERS[$i];
			if ($sem == $semester)
				echo ("<option value=".$sem." selected> " .$sem. " </option>");
			else
				echo ("<option  value=".$sem."> " .$sem. " </option>");
		}

		?>
		</select>
		<select name="period" STYLE='width:65;  align: center' onclick="active_save();">
		<?php 	$yy = date("Y");
		for ($i = $yy; $i > 2014; $i--) {
			if ($i == $period)
				echo ("<option value=".$i." selected> " .$i. " </option>");
			else
				echo ("<option  value=".$i."> " .$i. " </option>");
		}

		?>
		</select>
	</TD>
	<TD class=labelright10>Teacher : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=20 name="teacher" id="teacher" value="<?php echo($teacher); ?>" onclick="active_save();">
	</TD>
	<TD class=labelright10>Title : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=18 name="titles" id="titles" value="<?php echo($titles); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright10 height=30>AVG : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=18 name="mscores" value="<?php echo($mscores); ?>" readonly>
	</TD>
	<TD class=labelright10>LS : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=20 name="lscores" value="<?php echo($lscores); ?>" readonly>
	</TD>
	<TD class=labelright10>HS : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=18 name="hscores" value="<?php echo($hscores); ?>" readonly>
	</TD>
</TR>
<TR><TD height=15 class=labelleft colspan=6></TD></TR>
</TABLE>
<?php 
}

function inputStudentsScoresTable($studentlist, $scoreslist) {
?>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
			<TD class=ITEMS_LINE_TITLE width='25%'> FIRST Name  </TD>
			<TD class=ITEMS_LINE_TITLE width='25%'> LAST Name  </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> ID  </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> SCORE1 </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> SCORE2 </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> TOTAL </TD>
		</TR>
		<?php 
		$tquestion1 = 0;
		$tquestion2 = 0;
		for ($i = 0; $i < count($studentlist); $i++) {
			$student 	= $studentlist[$i];
			$id 		= $student->getID();
			$lastname 	= $student->getLastName();
			$firstname 	= $student->getFirstName();
			$total		= "";
			$item1		= "";
			$item2		= "";
			$scoresid   = 0;
			if ($scoreslist) {
				$studentscores = getSctudentScores($id, $scoreslist);
				if ($studentscores) {
					$scoresid 	= $studentscores->getID();
					$total 	= $studentscores->getTotalScores();
					$item1 	= $studentscores->getReadingScores();
					if ($tquestion1 == 0)
						$tquestion1 = $this->getSecondValue($item1);
					
					$item1 = $this->getFirstValue($item1);
						
					$item2 	= $studentscores->getWritingScores();
					if ($tquestion2 == 0)
						$tquestion2 = $this->getSecondValue($item2);
					
					$item2 = $this->getFirstValue($item2);
						
					if (!$item1)
						$item1 = "";
					if (!$item2)
						$item2 = "";
					if (!$total)
						$total = "";
				}
			}
		?>
		<TR>
			<TD class='listnum'><div align=center><?php echo($i+1); ?></div></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($firstname); ?> </TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($lastname); ?></TD>
			<TD class='listtext'><div align=center><?php echo($id); ?></div></TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="item1_<?php echo($i); ?>" value="<?php echo($item1); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="item2_<?php echo($i); ?>" value="<?php echo($item2); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>
				<INPUT type=hidden name="studentid_<?php echo($i); ?>" value="<?php echo($id); ?>">
				<INPUT type=hidden name="scoresid_<?php echo($i); ?>" value="<?php echo($scoresid); ?>">
				<INPUT class=fnborder type=text size=7 name="total_<?php echo($i); ?>" value="<?php echo($total); ?>" onclick="active_save();">
			</TD>
		</TR>
		<?php } 
			if ($tquestion2 == 0)
				$tquestion2 = "";
			if ($tquestion1 == 0)
				$tquestion1 = "";
		
		?>
		<TR>
			<TD class='listtext' colspan=4><div align=right>Total Questions : &nbsp;&nbsp;&nbsp;&nbsp;</div></TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="question_1" value="<?php echo($tquestion1); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="question_2" value="<?php echo($tquestion2); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>&nbsp;	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}


function showScoresForm($classes,  $scoreslist, $subjects, $sem, $yy, $result) {
	$mlists = new MemberList();
	$studentlist = $mlists->getStudentLists($classes, 0);
	$nbstudent =  count($studentlist);
	
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
	$classname = getClassName($classes);
	$sscores = 0;
	$groups = 0;
	if ($scoreslist && count($scoreslist) > 0) {
		$sscores = $scoreslist[0];
		$groups = $sscores->getGroups();
	}
	$nScores = $mlists->getClassStudentScoresNumber($classes, $semester, $period);
	$nenglish = $nScores[0]+1;
	$nmath = $nScores[1]+1;
	$tenglish = $nScores[2]+1;
	$tmath = $nScores[3]+1;
		
?>
<FORM action='student.php' method=post>
<INPUT type=hidden name='action' value='savescores'>
<INPUT type=hidden name='groups' id='groups' value='<?php echo($groups); ?>'>		
<INPUT type=hidden name='studentnumber' id='studentnumber' value='<?php echo($nbstudent); ?>'>		
<INPUT type=hidden name='classes' id='classes' value='<?php echo($classes); ?>'>		
<INPUT type=hidden name='classname' id='classname' value='<?php echo($classname); ?>'>		
<INPUT type=hidden name='nenglish' id='nenglish' value='<?php echo($nenglish); ?>'>				
<INPUT type=hidden name='tenglish' id='tenglish' value='<?php echo($tenglish); ?>'>		
<INPUT type=hidden name='nmath' id='nmath' value='<?php echo($nmath); ?>'>
<INPUT type=hidden name='tmath' id='tmath' value='<?php echo($tmath); ?>'>		
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD height=30 class=error><?php echo($result); ?></TD></TR>
<TR>
	<TD height=50>
		<h2>Input Scores For <?php $this->showClassLink($classname, "inputscores"); echo(" Class Students (" .$semester. "-".$period. ")"); ?></h2>
	</TD>
</TR>

<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD >
				<?php $this->showStudentsScoresTitle($classes, $sscores, $subjects, $nenglish, $semester, $period); ?>
			</TD>
		</TR>
		<TR>
			<TD>
				<?php
					$this->inputStudentsScoresTable($studentlist, $scoreslist); 
				 ?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=20 class=labelleft></TD></TR>

<TR>
	<TD height=40 class=labelright width=100%><div align=center>
		<INPUT class=button type=submit name="savescores" value=' Save ' id="savebuttonid">

		<INPUT class=button type=submit name="reset" value=' Reset '>
		</div>
	</TD>
</TR>
<TR><TD height=20 class=labelleft></TD></TR>
</TABLE>
</FORM>
	
<?php	
}

/*****************************************************/

function getScoresTitleLink($title, $groups, $classes, $subjects, $cn, $test) 
{
	$url = "";
	if ($groups) {
		$url .= "<div title='".$title."' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)'>";
		$url .= "<a href='../member/student.php?action=updatescores&groups="  .$groups. "&classes=".$classes;
		if ($subjects) {
			$url .= "&subjects=" .$subjects;
		}
		//$url .= "'>"  .$title. "</a>";
		if ($test) {
			$url .= "'><font color=red>"  .($cn+1). "</font></a>";
		}
		else {
			$url .= "'>"  .($cn+1). "</a>";
		}
		$url .="</div>";
	}
	return $url;
}

function showClassStudentsSubjectsScores($classes, $students, $scoreslists, $titles, $groups, $tests, $subjects, $tt, $n_disp) {
$lists_nb = count($titles);
?>		

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=TABLE_FTITLE height=25>
						<div align=center><font color=blue><?php echo($tt); ?></font></div>
					</TD>
				</TR>
				<TR>
					<TD>
						<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD class=TUITION_TITLE ><div align=center>First Name</div></TD>
							<TD class=TUITION_TITLE ><div align=center>Last Name</div></TD>
					<?php for ($cn = 0; $cn < $lists_nb; $cn++) { ?>
							<TD class=COL_V>
								<?php echo($this->getScoresTitleLink( $titles[$cn], $groups[$cn], $classes, $subjects, ($cn+$n_disp), $tests[$cn])); ?>
							</TD>
					<?php } ?>		
						</TR>
					<?php 
					$firsttime = 1;
					foreach($students as $student) {
						$id 		= $student->getID();
						$lastname 	= $student->getLastName();
						$firstname 	= $student->getFirstName();
					?>
						<TR>
							<TD class='listtext'>&nbsp;&nbsp;<?php echo($firstname); ?> </TD>
							<TD class='listtext'>&nbsp;&nbsp;<?php echo($lastname); ?></TD>
						<?php 	
						for ($cn = 0; $cn < $lists_nb; $cn++) {
							$stscores = getSctudentScores($id, $scoreslists[$cn]);
							$total = 0;
							if ($stscores) {
								$total = $stscores->getTotalScores();
							}
							if (!$total) {
								$total = "-";
							}
							else if ($total > 100) {
								$total = "<font color=red>".$total."</font>";
							}
							?>
							<TD class='listtext' width=28><div align=center><?php echo($total); ?></div></TD>
						<?php 
						}
						?>
						</TR>
				<?php } ?>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20 class=labelleft></TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>

<?php 
}


function showClassStudentsScoresList($classes, $subjects, $sem, $yy) {
	$subs = getClassReportSubject($classes);

	$max_show_nb 	= 18;
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
		
	$classname = getClassName($classes);
	$mlists 			= new MemberList();
	$students 			= $mlists->getStudentLists($classes, 0);
	
	$titles = array();
	$groups = array();
	$tests = array();
	for ($i = 0; $i < $max_show_nb; $i++) {
		$titles[] = "";
		$groups[] = "0";
		$tests[] = 0;
	}
?>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD height=50>
		<h2>Scores For <?php $this->showClassLink($classname, "showscores"); ?></h2>
	</TD>
</TR>

<?php 
$n_page = 1;
for ($nt = 0; $nt < count($subs); $nt++) {
	$classscoreslist 	= $mlists->getClassStudentScoresLists($classes, $subs[$nt], $semester, $period);
	$list_nb  = count($classscoreslist);
	$n_page = ceil($list_nb/$max_show_nb);
	$nn = 0;
	for ($p = 0; $p < $n_page; $p++) {
		
		$n_disp = $p*$max_show_nb; 
		$sliste = array();
		for ($i = 0; $i < $max_show_nb; $i++) {
			if ($nn  < $list_nb) {
				//$scoreslist = $classscoreslist[$list_nb-$nn-1];
				$scoreslist = $classscoreslist[$nn];
				$sliste[$i] = $scoreslist;
				$titles[$i] = getScoresTitleName($scoreslist);	
				$groups[$i] = getScoresGroupId($scoreslist);
				$tests[$i] = getScoresTest($scoreslist);
			}
			else {
				$sliste[$i] = array();
				$titles[$i] = ""; 
				$groups[$i] = 0;
				$tests[$i] = 0;
			}
			$nn++;
		}
?>

<TR>
	<TD class=background>
<?php 
		$tabTitle = $subs[$nt]. " Scores For " .getClassName($classes). " Class Students (" .$semester. "-" .$period. ")";
		$this->showClassStudentsSubjectsScores($classes, $students, $sliste, $titles, $groups, $tests, $subjects, $tabTitle, $n_disp);
?>
	</TD>
</TR>
<?php } ?>
<TR><TD height=20 class=labelleft></TD></TR>
<?php } ?>
</TABLE>

<?php 
}



/*********************************************************************/

function ManageStudentForm() {
	 global $CLASS_NAME, $OLD_STUDENT_CLASS;
	$mlists = new MemberList();
	$lists = $mlists->getFullStudents();
	$nbmember = count($lists);
?>
<FORM action='admin.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='cleanstudents'>
<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD height=30><H2>Student Manager</H2></TD>
</TR>
<TR>
	<TD height=30><H4>(You can change student's grade and class)</H4></TD>
</TR>
<TR>
	<TD height=25><H4>(You can delete student!)</H4></TD>
</TR>
<TR>
	<TD height=25></TD>
</TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='7%'> DEL  </TD>
			<TD class=ITEMS_LINE_TITLE width='20%'> Name </TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> Class </TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> New Class </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> Grade </TD>
			<TD class=ITEMS_LINE_TITLE width='30%'> Email  </TD>
		</TR>
<?php 	
		$name1 = "";
		$same = 0;
		for ($i = 0; $i < $nbmember; $i++) {
			$id 		= $lists[$i]->getID();
			$name		= $lists[$i]->getStudentName();
			$clname		= $lists[$i]->getClasses();
			$grade		= $lists[$i]->getGrade();
			$email 		= $lists[$i]->getEmail();
			$name = trim($name);
			if (strtoupper($name) == $name1)
				$same = 1;
			else 
				$same = 0;
			$name1	= strtoupper($name);
?>			
		<TR>
			<TD class='listnum'>
				<div align=center><?php echo(($i+1)); ?>
				<INPUT NAME='studentid_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($id); ?>'>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center><INPUT class=box type='checkbox' name='delete_<?php echo($i); ?>' value='1'></div>
			</TD>
			<TD class='listtext'><div align=center>
			<?php
				if ($same) 
					echo("<font color=red>".$name."</font>"); 
				else 
					echo("<font color=black>".$name."</font>"); 
			?>	
				</div></TD>
			
			<TD class='listtext'><div align=center><?php echo($clname); ?></div></TD>
			<TD class='listtext'>
				<div align=center>
				<select name="classes_<?php echo($i); ?>">
<?php 
				echo ("<option value='".$clname."'> --- </option>");
				for ($cl = 0; $cl < count($CLASS_NAME); $cl+=2) {
					$classname = $CLASS_NAME[$cl];
					if ($classname == $clname) {
						echo ("<option value='".$classname."' selected>" .$classname. "</option>");
					}
					else
						echo ("<option value='".$classname."'>" .$classname. "</option>");
				}
				if ($OLD_STUDENT_CLASS == $clname) {
					echo ("<option value='".$OLD_STUDENT_CLASS."' selected>" .$OLD_STUDENT_CLASS. "</option>");
				}
				else {
					echo ("<option value='".$OLD_STUDENT_CLASS."'>" .$OLD_STUDENT_CLASS. "</option>");
				}
				?>
				</select>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<select name="grade_<?php echo($i); ?>">
			<?php  
				for ($gd = 2; $gd < 13; $gd++) {
					if ($grade == $gd) { ?>
						<option value="<?php echo($gd); ?>" selected> <?php echo($gd); ?> </option>
			<?php  	} else { ?>
						<option value="<?php echo($gd); ?>"> <?php echo($gd); ?> </option>
			<?php 	} } ?>	
				</select>
				</div>
			</TD>
			<TD class='listtext'><div align=center><?php echo($email); ?></div></TD>
		</TR>
<?php 
		}
?>		
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=labelcenter height=40>
		<INPUT TYPE='submit' name="cleanstudent" VALUE='STUDENTS MANAGER'>
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}



function listClassMemberTable($classes, $loaddel, $url, $semester='', $year='') {
	$mlists = new MemberList();
	if ($classes == -1)
		$lists = $mlists->getAllStudentLists();
	else 
		$lists = $mlists->getStudentLists($classes, $loaddel);

	$nbmember = count($lists);
	$showAllStudent = 0;
	$classname = "";
	if ($classes == -1) {
		$classname = "-1";
		$showname = "ALL Strudents";
		$showAllStudent = 1;
	}
	else {
		$classname = getClassName($classes);
		if (strstr($classname, "TUTO"))
			$showname = "Tutoring Student Member";
		else
			$showname = "Class " .$classname. " Student Member";
	}
	if ($url) {
		$formaction = $url;
	}
	else {
		$formaction = "../member/member.php";
	}
?>
<FORM action='<?php echo($formaction); ?>' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updateclass'>
<INPUT NAME='classes' TYPE=HIDDEN VALUE='<?php echo($classes); ?>'>
<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=50% class=TABLE_FTITLE>
				<div align=left><font color=blue>&nbsp;&nbsp; <?php echo($showname); ?></font></div>
			</TD>
			<TD height=25 width=50%  class=TABLE_FTITLE>
				<div align=right>&nbsp;</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> Name </TD>
			<TD class=ITEMS_LINE_TITLE width='8%'> Class </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> New CL</TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> Grade </TD>
			<TD class=ITEMS_LINE_TITLE width='18%'> address </TD>
			<TD class=ITEMS_LINE_TITLE width='12%'> Phone / Cell </TD>
			<TD class=ITEMS_LINE_TITLE width='25%'> Email  </TD>
		</TR>
<?php 		
		for ($i = 0; $i < $nbmember; $i++) {
			$id 		= $lists[$i]->getID();
			$name		= $lists[$i]->getStudentName();
			$clname		= $lists[$i]->getClasses();
			$grade		= $lists[$i]->getGrade();
			$email 		= $lists[$i]->getEmail();
			$address 	= $lists[$i]->getStudentAddress();
			$phone 		= $lists[$i]->getPhone();
			$cell		= $lists[$i]->getMobile();
			if ($phone && strlen($phone) < 3) {
				$phone	= $cell;
			}
			else if ($cell && strlen($cell) > 3) {
				$phone	.= "<br>" .$cell;
			}
?>			
		<TR>
			<TD class='listnum'><div align=center>
				<?php echo($this->getStudentScoresLink($id, $classes, ($i+1))); ?>
				<INPUT NAME='studentid_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($id); ?>'>
				</div>
			</TD>
			<TD class='listtext'><div align=center><?php echo($this->getStudentProfilLink($id, $classes, $name)); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($clname); ?></div></TD>
			<TD class='listtext'>
				<div align=center>
				<select name="classes_<?php echo($i); ?>">
				<?php global $CLASS_NAME, $OLD_STUDENT_CLASS;
				echo ("<option value='".$clname."'> --- </option>");
				for ($cl = 0; $cl < count($CLASS_NAME); $cl+=2) {
					$classname = $CLASS_NAME[$cl];
					if ($classname == $clname) {
						echo ("<option value='".$classname."' selected>" .$classname. "</option>");
					}
					else
						echo ("<option value='".$classname."'>" .$classname. "</option>");
				}
				if ($OLD_STUDENT_CLASS == $clname) {
					echo ("<option value='".$OLD_STUDENT_CLASS."' selected>" .$OLD_STUDENT_CLASS. "</option>");
				}
				else {
					echo ("<option value='".$OLD_STUDENT_CLASS."'>" .$OLD_STUDENT_CLASS. "</option>");
				}
				?>
				</select>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<select name="grade_<?php echo($i); ?>">
			<?php  
				for ($gd = 2; $gd < 13; $gd++) {
					if ($grade == $gd) { ?>
						<option value="<?php echo($gd); ?>" selected> <?php echo($gd); ?> </option>
			<?php  	} else { ?>
						<option value="<?php echo($gd); ?>"> <?php echo($gd); ?> </option>
			<?php 	} } ?>	
				</select>
				</div>
			</TD>
			<TD class='listtext'><div align=center><?php echo($address); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($phone); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($this->getEmailLink($email)); ?></div></TD>
		</TR>
<?php 
		}
?>		
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=formlabel>
				<div align=right>
				<INPUT class=button TYPE='submit' name="updateclass" VALUE='UPADATE'>
				</div>
			</TD>
		</TR>
		</TABLE>
		
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}

function listTestMemberTable() {
	$mlists = new MemberList();
	$lists = $mlists->getTTClassStudentLists_1();
	$nbmember = count($lists);
	$nb_list = $nbmember+20;
	$showname = "ALL Strudents";
?>
<FORM action='../member/member.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updatetestclass'>
<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=50% class=TABLE_FTITLE>
				<div align=left><font color=blue>&nbsp;&nbsp; <?php echo($showname); ?></font></div>
			</TD>
			<TD height=25 width=50%  class=TABLE_FTITLE>
				<div align=right>&nbsp;</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='20%'> Name </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> Select </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> Grade </TD>
			<TD class=ITEMS_LINE_TITLE width='12%'> Phone </TD>
			<TD class=ITEMS_LINE_TITLE width='12%'> Cell </TD>
			<TD class=ITEMS_LINE_TITLE width='25%'> Email  </TD>
		</TR>
<?php 		
		for ($i = 0; $i < $nbmember; $i++) {
			$id 		= $lists[$i]->getID();
			$civil		= $lists[$i]->getCivil();
			$firstname	= $lists[$i]->getFirstName();
			$lastname	= $lists[$i]->getLastName();
			$name		= $lists[$i]->getStudentName();
			$clname		= $lists[$i]->getClasses();
			$grade		= $lists[$i]->getGrade();
			$email 		= $lists[$i]->getEmail();
			$phone 		= $lists[$i]->getPhone();
			$cell		= $lists[$i]->getMobile();
		if ($lists[$i]->isTestStudent()) {
?>			
		<TR>
			<TD class='listnum'><div align=center><?php echo(($i+1)); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($name); ?></div></TD>
			<TD class='listtext'>
				<div align=center> <?php echo($clname); ?> </div>
			</TD>
			<TD class='listtext'>
				<div align=center> <?php echo($grade); ?> </div>
			</TD>
			<TD class='listtesttext'>
				<?php echo($phone); ?>
			</TD>
			<TD class='listtesttext'>
				<?php echo($cell); ?>
			</TD>
			<TD class='listtesttext'>
				<?php echo($email); ?>
			</TD>
		</TR>
<?php } else { ?>		
		<TR>
			<TD class='listnum'><div align=center>
				<?php echo(($i+1)); ?>
				<INPUT NAME='civil_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($civil); ?>'>
				<INPUT NAME='firstname_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($firstname); ?>'>
				<INPUT NAME='lastname_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($lastname); ?>'>
				</div>
			</TD>
			<TD class='listtext'><div align=center><?php echo($name); ?></div></TD>
			<TD class='listtext'>
				<div align=center><INPUT class=box type='checkbox' name='totest_<?php echo($i); ?>' value='1'></div>
			</TD>
			
			<TD class='listtext'>
				<div align=center>
				<select name="grade_<?php echo($i); ?>">
			<?php  
				for ($gd = 2; $gd < 13; $gd++) {
					if ($grade == $gd) { ?>
						<option value="<?php echo($gd); ?>" selected> <?php echo($gd); ?> </option>
			<?php  	} else { ?>
						<option value="<?php echo($gd); ?>"> <?php echo($gd); ?> </option>
			<?php 	} } ?>	
				</select>
				</div>
			</TD>
			<TD class='listtesttext'>
				<INPUT class=fields type=text size=15 name="phone_<?php echo($i); ?>" value="<?php echo($phone); ?>">
			</TD>
			<TD class='listtesttext'>
				<INPUT class=fields type=text size=15 name="cell_<?php echo($i); ?>" value="<?php echo($cell); ?>">
			</TD>
			<TD class='listtesttext'>
				<INPUT class=fields type=text size=35 name="email_<?php echo($i); ?>" value="<?php echo($email); ?>">
			</TD>
		</TR>
<?php 
		}
	}
?>		
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=formlabel>
				<div align=right>
				<INPUT class=button TYPE='submit' name="updatetestclass" VALUE='To Open House Test Student'>
				</div>
			</TD>
		</TR>
		</TABLE>
		
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}


/**********************OK ******/

function showStudentProfilForm($studentid, $st, $result) 
{
	if ($studentid) {
		$student = new StudentClass();
		if (!$student->getUserByID($studentid)) {
			$student = "";
		}
	}
	else {
		$student = $st;
	}
?>	
<FORM method="post" action="student.php">
<INPUT NAME=studentid TYPE=HIDDEN VALUE="<?php echo($studentid); ?>">
<INPUT NAME=action TYPE=HIDDEN VALUE="changeprofil">
<TABLE cellSpacing=0 cellPadding=0 width=720 border=0 align=center style="MARGIN: 10px 3px 10px 10px">
<TR><TD class=error height=30><?php echo($result); ?></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD width=12 height=24 class=registerborder>
				<IMG height=24 src="../images/left.gif" width=12 border=0>
			</TD>
			<TD width=100% class=registerbar>Student Infomation</TD>
			<TD width=14 height=24 class=registerborder>
				<IMG height=24 src="../images/right.gif" width=14 border=0>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=720 border=0  class=registerborder>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR><TD height=30 class=formlabel2></TD></TR>
		        <TR>
					<TD>
						<?php $this->studentInfomationForm($student); ?>
					</TD>
		        </TR>
				<TR>
					<TD class=background height=60>
<?php if ($student) { ?>						
						<INPUT type="submit" class=button value="&nbsp;&nbsp; Update Student &nbsp;&nbsp;" id="savebuttonid">
<?php } else { ?>
						<INPUT type="submit" class=button value="&nbsp;&nbsp; Add Student &nbsp;&nbsp;" id="savebuttonid">
<?php } ?>						
						&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="submit" class=button value="&nbsp;&nbsp; Reset &nbsp;&nbsp;">
						
					</TD>
				</TR>
				</TABLE>		
			</TD>
		</TR>
        
		</TABLE>
	</TD>
</TR>
<TR><TD height=40 class=formlabel>&nbsp;</TD></TR>
</TABLE>
</FORM>
<?php 
}


function studentInfomationForm($student) 
{
 	global $CLASS_NAME;
 	$pseudo 		= "";
	$user_email 	= "";
	$user_name 		= "";
	$user_street1 	= "";
	$user_street2 	= "";
	$user_city 		= "";
	$user_postcode 	= "";
	$user_department 	= "";
	$user_country 	= "";
	$user_phone 	= "";
	$grade 	= "";
	$classes1 = "";
	$classes2 = "";
	$classes3 = "";
	$classes4 = "";
	$civil = "M";
	$lastname 	= "";
	$firstname  = "";
	$n = 2;
	$currgrade = "";
	$notes = "";
	$user_street1 	= "";
	$user_street2 	= "";
	$user_city  	= "";
	$user_postcode 	= "";
	$user_department = "";
	$user_country 	= "USA";
	$user_phone 	= "";
	$user_mobile 	= "";
	$birthday = "";	
	$bmonth = $bday = $byear = 0;
	
	if ($student) {
		$pseudo 		= $student->getPseudo();
		$user_email 	= $student->getEmail();
		$civil 			= $student->getCivil();
		$lastname 		= $student->getLastName();
		$firstname 		= $student->getFirstName();
		if ($civil == 'F')
			$civil = "Ms.";
		else 
			$civil = "Mr.";
		
		$user_name 		= $civil." ".$firstname." ".$lastname;
		$user_id 		= $student->getID();
		
		$grade 	= $student->getGrade();
		$classes1 = $student->getClasses();
		$classes2 = "";
		$classes3 = "";
		$classes4 = "";
		$n = getClassNumber($classes1);
		if ($n < 2) {
			$classes = $classes1;
		}
		else if ($n == 2) {
			list($classes, $classes2) =  explode(";", $classes1);
		}
		else if ($n == 4) {
			list($classes, $classes2, $classes3, $classes4 ) =  explode(";", $classes1);
		}
		else {
			list($classes, $classes2, $classes3 ) =  explode(";", $classes1);
		}
		
		
		$currgrade = $student->getCurrentGrade();
		$notes = $student->getComments();
		
		$user_street1 	= $student->getStreet1();
		$user_street2 	= $student->getStreet2();
		$user_city  	= $student->getCity();
		$user_postcode 	= $student->getPostCode();
		$user_department 	= $student->getProvence();
		$user_country 	= $student->getCountry();
		$user_phone 	= $student->getPhone();
		$user_mobile 	= $student->getMobile();
		
		$bmonth = $bday = $byear = 0;
		$birthday = $student->getBirthDay();
		if ($birthday && $birthday != "NULL" && strstr($birthday,"/") && strlen($birthday) > 6) {
			list($bmonth, $bday, $byear) = explode("/", trim($birthday));
		}
		
	}
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php if ($student  && $student->isOK()) { ?>
<TR>
	<TD class=labelright height=25>Student Name &nbsp;:&nbsp;</TD>
	<TD class=formlabel><?php echo($user_name); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>Student ID &nbsp;:&nbsp;</TD>
	<TD class=formlabel><?php echo($user_id); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>Login Name &nbsp;:&nbsp;</TD>
	<TD class=formlabel><?php echo($pseudo); ?>
		<INPUT TYPE=HIDDEN name="pseudo" value="<?php echo($pseudo); ?>" >
	</TD>
</TR>
<?php } ?>
<TR>
	<TD class=labelright height=25 width=25%><?php showmark( ); ?> Gender &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<?php if ($civil == "M" || $civil == "Mr." ) { ?>
			<INPUT type=radio name="civil" value="M" CHECKED onclick="active_save();">Mr.
		<?php } else { ?>
			<INPUT type=radio name="civil" value="M" onclick="active_save();">Mr.
		<?php } ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php if ($civil == "F" || $civil == "Ms." ) { ?>
			<INPUT type=radio name="civil" value="F" CHECKED onclick="active_save();">Ms.
		<?php } else { ?>
			<INPUT type=radio name="civil" value="F" onclick="active_save();">Ms.
		<?php } ?>
	</TD>
</TR>
<TR>
	<TD class=labelright height=25><?php showmark( ); ?> First Name &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="firstname" value="<?php echo($firstname); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25><?php showmark( ); ?> Last Name &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="lastname" value="<?php echo($lastname); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Email &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="email" value="<?php echo($user_email); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright>Birthday &nbsp;:&nbsp;</TD>
	<TD class=labelleft>
		<select name="bmonth" onclick="active_save();">
			<option value=0>&nbsp;-&nbsp;  month &nbsp;-&nbsp; </option>
<?php 	
			for ($i = 1; $i < 13; $i++) {
				if ($i == $bmonth)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
				else
					echo ("<option value=". $i .">" .$i . "</option>");
			}
?>
		</select>
		<select name="bday" onclick="active_save();">
			<option value=0>&nbsp;-&nbsp;  day &nbsp;-&nbsp; </option>
<?php 	
			for ($i = 1; $i < 32; $i++) {
				if ($i == $bday)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
				else
					echo ("<option value=". $i .">" .$i . "</option>");
			}
?>
		</select>
		<select name="byear" onclick="active_save();">
			<option value=0>&nbsp;-&nbsp;  year &nbsp;-&nbsp; </option>
<?php 		
			$yy = Date('Y');
			for ($i = $yy; $i >= 1970; $i--) {
				if ($i == $byear)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
				else
					echo ("<option value=". $i .">" .$i . "</option>");
			}
?>
		</select>
	</TD>
</TR>
<TR>
	<TD class=labelright height=25><?php showmark( ); ?> Grade &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<select name="grade" STYLE='width:90; color:blue; align: center' onclick="active_save();">
<?php 	
			for ($i = 2; $i < 13; $i++) {
				if ($i == $grade)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
				else
					echo ("<option value=". $i .">" .$i . "</option>");
			}
?>
		</select>
	</TD>
</TR>
<TR>
	<TD class=labelright height=25><?php showmark( ); ?> Class &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<select name="classes" onclick="active_save();">
<?php
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$classname = $CLASS_NAME[$i];
			if ($classname == $classes)
				echo ("<option value='".$classname."' selected>" .$classname. "</option>");
			else
				echo ("<option value='".$classname."'>" .$classname. "</option>");
		}
?>
		</select>
		<select name="classes2" onclick="active_save();">
		<option value=''> - 2nd - </option>
<?php
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$classname = $CLASS_NAME[$i];
			if ($classname == $classes2)
				echo ("<option value='".$classname."' selected>" .$classname. "</option>");
			else
				echo ("<option value='".$classname."'>" .$classname. "</option>");
		}
?>
		</select><br>
		<select name="classes3" onclick="active_save();">
		<option value=''> - 3rd - </option>
<?php
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$classname = $CLASS_NAME[$i];
			if ($classname == $classes3)
				echo ("<option value='".$classname."' selected>" .$classname. "</option>");
			else
				echo ("<option value='".$classname."'>" .$classname. "</option>");
		}
?>
		</select>
		<select name="classes4" onclick="active_save();">
		<option value=''> - 4th - </option>
<?php
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$classname = $CLASS_NAME[$i];
			if ($classname == $classes4)
				echo ("<option value='".$classname."' selected>" .$classname. "</option>");
			else
				echo ("<option value='".$classname."'>" .$classname. "</option>");
		}
?>
		</select>
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Street &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="street" value="<?php echo($user_street1. " " .$user_street2); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>City &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="city" value="<?php echo($user_city); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Zip Code &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT size=20 class=fields type=text name="postcode" value="<?php echo($user_postcode); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>State &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT size=20 class=fields type=text name="department" value="<?php echo($user_department); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Country &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="country"  value="<?php echo($user_country); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Phone &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="phone"  value="<?php echo($user_phone); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Cell &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="mobile"  value="<?php echo($user_mobile); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>Notes &nbsp;:&nbsp;</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="notes" value="<?php echo($notes); ?>" onclick="active_save();">
	</TD>
</TR>
</TABLE>
<?php
}
	
function changeStudentProfil() {

	$isOK = 0;
		
	$pseudo = getPostValue('pseudo');
	$civil = getPostValue('civil');
	$firstname = getPostValue('firstname');
	$lastname = getPostValue('lastname');
	$street = getPostValue('street');
	$email = getPostValue('email');
	$city = getPostValue('city');
	$postcode = getPostValue('postcode');
	$provence = getPostValue('department');
	$country = getPostValue('country');
	$phone = getPostValue('phone');
	$mobile = getPostValue('mobile');
	$studentid = getPostValue('studentid');
		
	$classes = getPostValue('classes');
	$classes2 = getPostValue('classes2');
	$classes3 = getPostValue('classes3');
	$classes4 = getPostValue('classes4');
	if ($classes2) {
		$classes .= ";" .$classes2;
	}
	if ($classes3) {
		$classes .= ";" .$classes3;
	}
	if ($classes4) {
		$classes .= ";" .$classes4;
	}
	
	$grade = getPostValue('grade');
		
	$notes = getPostValue('notes');
	$bday = getPostValue("bday");
	$bmonth = getPostValue("bmonth");
	$byear = getPostValue("byear");
	if ($bday == 0 || $bmonth == 0 || $byear == 0) {
		$birthday = "";
	}
	else {
		$birthday = $bmonth. "/" .$bday. "/" .$byear;
	}
		
	$student = new StudentClass();
	if ($studentid) {
		$student->getUserByID($studentid);
	}
	$student->setCivil($civil);
	$student->setFirstName($firstname);
	$student->setLastName($lastname);
	$student->setEmail($email);
	$student->setStreet1($street);
	$student->setCity($city);
	$student->setPostCode($postcode);
	$student->setProvence($provence);
	$student->setCountry($country);
	$student->setPhone($phone);
	$student->setMobile($mobile);
	$student->setBirthDay($birthday);
			
	$student->setClasses($classes);
	$student->setGrade($grade);
	$student->setCurrentGrade($grade); ///TODO	
	$student->setComments($notes);
			
	if ($studentid) {
		if ($student->updateProfile()) {
			$this->error = "Modify Information OK!";
		}
		else {
			$this->error = "Modify Information Error : " .$student->getTrace();
		}
	}
	else {
		if ($student->isUserDataOK()) {
			$studentid = $student->addStudent();
			$this->error = "Add New Student OK!";
		}
		else  {
			$this->error = "Add New Student Error : " .$student->getTrace();
		}
	}
	return $student;
}

	
}

?>