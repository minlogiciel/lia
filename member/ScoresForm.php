<?php

class ScoresForm {

	var $BACKUP_DATA = 0;
	var $DATA_BASE 	= 1;
	var $TABLE_NAME = "STUDENTS";
	var $IDS 		= "IDS";

function isDigitalString($str) {
	if(	($str == "0") || ($str == "1") ||($str == "2") || ($str == "3") || ($str == "4") ||
		($str == "5") || ($str == "6") ||($str == "7") || ($str == "8") || ($str == "9")) {
			return 1;
	}
	else {
		return 0;
	}
}
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
	global $PROGRAM_PSAT;
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
	$question1 = getPostValue("question_1");
	$question2 = getPostValue("question_2");

	for ($i = 0; $i < $nb; $i++) {
		$studentid = getPostValue("studentid_".$i);
		$scoresid = getPostValue("scoresid_".$i);
		$total = 0;
		if (isPSATSubject($subjects)) {
			$math = getPostValue("math_".$i);
			$reading = getPostValue("reading_".$i);
			$writing = getPostValue("writing_".$i);
			if ($math || $reading || $writing) {
				$total = $math + $reading + $writing; 
			}
		}
		else {
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
		}
			
		if ($total) {
			$v = $this->getScoreValue($total);
			//if(is_numeric($total)) {
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
		{
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
	$fp = '';
	$scoreslists = $this->getScoreslist();
	if ($scoreslists && count($scoreslists) > 0) {
		$studentscores = $scoreslists[0];
		$scoresRef = new ScoreRefClass();
		
		$scoresRef->setClasses($studentscores->getClasses());
		$scoresRef->setSubjects($studentscores->getSubjects());
		$scoresRef->setTypes($studentscores->getTypes());
		$scoresRef->setSemester($studentscores->getSemester());
		$scoresRef->setPeriods($studentscores->getPeriods());
		$scoresRef->setDates($studentscores->getDates());
		
		$groups = $scoresRef->addScoresRef();
		
		if ($this->BACKUP_DATA) {		
			$fname = getBackupFileName($studentscores->getTableName(), $groups);
			$fp = fopen($fname, "w");
			
			$text = $scoresRef->getBackupTitle(). "\n";
			fwrite($fp, $text);
			
			$text = $scoresRef->getData(). ";\n\n";
			fwrite($fp, $text);
			
			$text = $studentscores->getBackupTitle(). "\n";
			fwrite($fp, $text);
		}
		$nb = count($scoreslists);
		for ($i = 0; $i < $nb; $i++) {
			$studentscores = $scoreslists[$i];
			$studentscores->setGroups($groups);
			$studentscores->addStudentScores();

			if ($this->BACKUP_DATA) {		
				if ($i == $nb-1) {
					$text = $studentscores->getScoresData(). ";\n";
				}
				else { 
					$text = $studentscores->getScoresData(). ",\n";
				}
				fwrite($fp, $text);
			}
		}
		
		if ($fp)
			fclose($fp);
	}
	return $scoreslists;
}

/* delete student scores */
function deleteScoresList() {
	
	$nb = getPostValue("scoresnumber");
	$scoreRef = new ScoreRefClass();
	$mlists = new MemberList();
	for ($i = 0; $i < $nb; $i++) {
		
		if (getPostValue("delscores_".$i)) {
				
			$scoresid = getPostValue("scoresid_".$i);
			$scoreRef->deleteScores($scoresid ) ;

			$scoreslist = $mlists->getClassStudentGroupsScoresLists($scoresid);
			if ($scoreslist) {
				for ($j = 0; $j < count($scoreslist); $j++) {
					$scoreslist[$j]->deleteStudentScores(1);
				}
			}
		}
	}
	
}

/* update student scores */
function updateScoresList($groups) {
	$fp = '';
	$scoreslists = $this->getScoreslist();
	if ($scoreslists && count($scoreslists) > 0) {

		$studentscores = $scoreslists[0];
		
		if ($this->BACKUP_DATA) {
			$fname = getBackupFileName($studentscores->getTableName(), $groups);
			$fp = fopen($fname, "w");
			
			$text = $studentscores->getBackupTitle(). "\n";
			fwrite($fp, $text);
		}		
		$nb = count($scoreslists);
		$firsttime = 1;
		for ($i = 0; $i < $nb; $i++) {
			$studentscores = $scoreslists[$i];
		
			$studentscores->setGroups($groups);
			if ($studentscores->getID()) {
				$studentscores->updateStudentScores();
				if ($firsttime) {
					$scoresRef = new ScoreRefClass();
					if ($scoresRef->getScoresRefByID($groups)) {
						$scoresRef->setDates($studentscores->getDates());
						$scoresRef->setSubjects($studentscores->getSubjects());
						$scoresRef->setTypes($studentscores->getTypes());
						$scoresRef->setSemester($studentscores->getSemester());
						$scoresRef->setPeriods($studentscores->getPeriods());
						$scoresRef->updateScoresRef();
						$firsttime = 0;
					}
				}
			}
			else {
				$studentscores->addStudentScores();
			}
			
			if ($this->BACKUP_DATA) {
				if ($i == $nb-1) {
					$text = $studentscores->getScoresData(). ";\n";
				}
				else { 
					$text = $studentscores->getScoresData(). ",\n";
				}
				fwrite($fp, $text);
			}
		}
		
		if ($fp) {
			fclose($fp);
		}
	}
	return $scoreslists;
}

function getUpdateScoresForm($classes,  $groups, $subjects)  
{
	$mlists = new MemberList();
	$studentlist = $mlists->getStudentLists($classes, 0);
	$nbstudent =  count($studentlist);
	$scoreslist = $mlists->getClassStudentGroupsScoresLists($groups);
	$classname = getClassName($classes);
	$sscores = '';
	if ($scoreslist && count($scoreslist) > 0) {
		for ($i = 0; $i < count($scoreslist); $i++) {
			$sscores = $scoreslist[$i];
			if ($sscores->getTotalScores()) {
				break;
			}
		}	
	}
	$semester = "";
	$period = 0;
	if ($sscores) {
		$semester = $sscores->getSemester();
		$period = $sscores->getPeriods();
	}
	if ($period == 0)
		$period = date("Y");
	if (!$semester)
		$semester = getSemesterByString("");
		
	$nScores = $mlists->getClassStudentScoresNumber($classes, $semester, $period);
	$nenglish = $nScores[0]+1;
	$nmath = $nScores[1]+1;
	$tenglish = $nScores[2]+1;
	$tmath = $nScores[3]+1;
	
?>
<FORM action='member.php' name="scoresform" method=post>
<INPUT type=hidden name='studentnumber' value='<?php echo($nbstudent); ?>'>		
<INPUT type=hidden name='classes' id='classes' value='<?php echo($classes); ?>'>		
<INPUT type=hidden name='classname' id='classname' value='<?php echo($classname); ?>'>		
<INPUT type=hidden name='groups' value='<?php echo($groups); ?>'>		
<INPUT type=hidden name='action' value='changescores'>
<INPUT type=hidden name='nenglish' id='nenglish' value='<?php echo($nenglish); ?>'>				
<INPUT type=hidden name='tenglish' id='tenglish' value='<?php echo($tenglish); ?>'>		
<INPUT type=hidden name='nmath' id='nmath' value='<?php echo($nmath); ?>'>
<INPUT type=hidden name='tmath' id='tmath' value='<?php echo($tmath); ?>'>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>

<TR><TD class=labelright>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD width=100% class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=25 width=50% class=TABLE_FTITLE>
						<div align=left><font color=blue>&nbsp;&nbsp;Update Students Scores For Class <?php echo($classname); ?>&nbsp;</font></div>
					</TD>
					<TD height=25 width=50%  class=TABLE_FTITLE>
						<div align=right>&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
			
		<TR>
			<TD >
				<?php $this->showStudentsScoresTitle($classes, $sscores, $subjects); ?>
			</TD>
		</TR>
		<TR>
			<TD>
				<?php
					if (isPSATSubject($subjects)) 
						$this->inputStudentsPSATScoresTable($studentlist, $scoreslist); 
					else 
						$this->inputStudentsScoresTable($studentlist, $scoreslist); 
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
			<TD height=40 class=labelright width=100%><div align=center>
				<INPUT class=button type=submit name="update" value=' Update ' id="savebuttonid" disabled="disabled">
				<INPUT class=button type=submit name="reset" value=' Cancel '>
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

	
function showScoresForm($classes,  $scoreslist, $subjects, $sem, $yy)  
{
	$mlists = new MemberList();
	$studentlist = $mlists->getStudentLists($classes, 0);
	$nbstudent =  count($studentlist);
	
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
	$classname = getClassName($classes);
	$sscores = 0;
	if ($scoreslist && count($scoreslist) > 0) {
		$sscores = $scoreslist[0];
	}
	$nScores = $mlists->getClassStudentScoresNumber($classes, $semester, $period);
	$nenglish = $nScores[0]+1;
	$nmath = $nScores[1]+1;
	$tenglish = $nScores[2]+1;
	$tmath = $nScores[3]+1;
		
?>
<FORM action='member.php' method=post>
<INPUT type=hidden name='studentnumber' id='studentnumber' value='<?php echo($nbstudent); ?>'>		
<INPUT type=hidden name='classes' id='classes' value='<?php echo($classes); ?>'>		
<INPUT type=hidden name='classname' id='classname' value='<?php echo($classname); ?>'>		
<INPUT type=hidden name='nenglish' id='nenglish' value='<?php echo($nenglish); ?>'>				
<INPUT type=hidden name='tenglish' id='tenglish' value='<?php echo($tenglish); ?>'>		
<INPUT type=hidden name='nmath' id='nmath' value='<?php echo($nmath); ?>'>
<INPUT type=hidden name='tmath' id='tmath' value='<?php echo($tmath); ?>'>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>

<TR><TD class=labelright>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD width=100% class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=25 width=50% class=TABLE_FTITLE>
						<div align=left><font color=blue>&nbsp;&nbsp;Input Scores For Class  
						<?php echo($classname. " Students (" .$semester. "-".$period. ") "); ?>&nbsp;
						
						</font></div>
					</TD>
					<TD height=25 width=50%  class=TABLE_FTITLE>
						<div align=right>&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
			
		<TR>
			<TD >
				<?php $this->showStudentsScoresTitle($classes, $sscores, $subjects, $nenglish, $semester, $period); ?>
			</TD>
		</TR>
		<TR>
			<TD>
				<?php
					if (isPSATSubject($subjects)) 
						$this->inputStudentsPSATScoresTable($studentlist, $scoreslist); 
					else 
						$this->inputStudentsScoresTable($studentlist, $scoreslist); 
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
			<TD height=40 class=labelright width=100%><div align=center>
				<INPUT type=hidden name='action' value='savescores'>
				<INPUT class=button type=submit name="savescores" value=' Save ' id="savebuttonid" disabled="disabled">
				<INPUT class=button type=submit name="viewscores"  value=' View '>
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


function inputStudentsPSATScoresTable($studentlist, $scoreslist) 
{
?>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
			<TD class=ITEMS_LINE_TITLE width='20%'> FIRST Name  </TD>
			<TD class=ITEMS_LINE_TITLE width='20%'> LAST Name  </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> ID  </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> MATH </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> READING </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> WRITING</TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> SCORE </TD>
		</TR>
		<?php 
		for ($i = 0; $i < count($studentlist); $i++) {
			$student 	= $studentlist[$i];
			$id 		= $student->getID();
			$lastname 	= $student->getLastName();
			$firstname 	= $student->getFirstName();
			$math		= "";
			$reading	= "";
			$writing	= "";
			$total		= "";
			$scoresid   = 0;
			if ($scoreslist) {
				$studentscores = getSctudentScores($id, $scoreslist);
				if ($studentscores) {
					$scoresid 	= $studentscores->getID();
					$math 	= $studentscores->getMathScores();
					$reading 	= $studentscores->getReadingScores();
					$writing = $studentscores->getWritingScores();
					$total 	= $studentscores->getTotalScores();
					if (!$total)
						$total = "";
				}
			}
		?>
		<TR>
			<TD class='listnum'><div align=center><?php echo($i+1); ?></div></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($firstname); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($lastname); ?> </TD>
			<TD class='listtext'><div align=center><?php echo($id); ?></div></TD>
			<TD class='listtext'>
				<INPUT type=hidden name="studentid_<?php echo($i); ?>" value="<?php echo($id); ?>">
				<INPUT type=hidden name="scoresid_<?php echo($i); ?>" value="<?php echo($scoresid); ?>">
				<INPUT class=fnborder type=text size=7 name="math_<?php echo($i); ?>" value="<?php echo($math); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="reading_<?php echo($i); ?>" value="<?php echo($reading); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="writing_<?php echo($i); ?>" value="<?php echo($writing); ?>" onclick="active_save();">
			</TD>
			<TD class='listtext'>
				<INPUT class=fnborder type=text size=7 name="total_<?php echo($i); ?>" value="<?php echo($total); ?>" onclick="active_save();">
			</TD>
		</TR>
		<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function inputStudentsScoresTable($studentlist, $scoreslist) 
{
?>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
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
			<TD class='listtext' colspan=4 height=25><div align=right>Total Questions : &nbsp;&nbsp;&nbsp;&nbsp;</div></TD>
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
	<TD class=labelright10>Due Date : </TD>
	<TD class=labelleft>
		<select name="dmonth" STYLE='width:65; color:blue; align: center' onclick="active_save();">
		<?php 	
		for ($i = 1; $i < 13; $i++) {
			if ($mm == $i)
				echo ("<option value=".$i." selected> " .$i. " </option>");
			else
				echo ("<option  value=".$i."> " .$i. " </option>");
		}
		?>
		</select>
		<select name="dday" STYLE='width:65; color:blue; align: center' onclick="active_save();">
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
	<?php if (isPSATSubject($subjects)) { ?>
	<TD class=labelright10>Subjects : </TD>
	<TD class=labelleft> 
		<INPUT type=hidden name="subjects" value="PSAT">PSAT
	</TD>
		
	<TD class=labelright10>Types : </TD>
	<TD class=labelleft> 
		<INPUT type=hidden name="types" value="Test">Test	
	</TD>
	<?php } else { ?>
	<TD class=labelright10>Subjects : </TD>
	<TD class=labelleft>
		<select name="subjects" id="subjects" STYLE='width: 160; color:blue; align: center' onChange="change_teacher();">
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
		<select name="types" id="types" STYLE='width: 134; color:blue; align: center' onChange="change_title();">
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
	<?php } ?>
</TR>
<TR>
	<TD class=labelright10>Semester : </TD>
	<TD class=labelleft>
	<?php if (0) {?>
		<select name="semester" STYLE='width: 60; color:blue; align: center' onclick="active_save();">
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
	<?php } ?>
		<INPUT class=fields type=text size=7 maxLength=6 name="semester" value="<?php echo($semester); ?>" >
		<INPUT class=fields type=text size=5 maxLength=6 name="period" value="<?php echo($period); ?>" >
	</TD>
	<TD class=labelright10>Teacher : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=25 name="teacher" id="teacher" value="<?php echo($teacher); ?>" onclick="active_save();">
	</TD>
	<TD class=labelright10>Title : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=20 name="titles" id="titles" value="<?php echo($titles); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright10>AVG : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=20 name="mscores" value="<?php echo($mscores); ?>" readonly>
	</TD>
	<TD class=labelright10>LS : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=25 name="lscores" value="<?php echo($lscores); ?>" readonly>
	</TD>
	<TD class=labelright10>HS : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=20 name="hscores" value="<?php echo($hscores); ?>" readonly>
	</TD>
</TR>
<TR><TD height=15 class=labelleft colspan=6></TD></TR>
</TABLE>
<?php 
}

function getScoresTitleLink($title, $groups, $classes, $subjects, $cn, $test) 
{
	$url = "";
	if ($groups) {
		$url .= "<div title='".$title."' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)'>";
		$url .= "<a href='../member/member.php?action=updatescores&groups="  .$groups. "&classes=".$classes;
		if ($subjects) {
			$url .= "&subjects=" .$subjects;
		}
		//$url .= "'>"  .$title. "</a>";
		if ($test) {
			$url .= "'><font color=red>"  .($cn+1). "</font></a>";
		}
		else
		{
			$url .= "'>"  .($cn+1). "</a>";
		}
		$url .="</div>";
	}
	else {
		
	}
	return $url;
}


function showClassStudentsPSATScores($classes, $students, $scoreslists, $titles, $groups, $subjects, $tt) 
{
$lists_nb = count($titles);
?>		

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD height=25 width=50% class=TABLE_FTITLE>
								<div align=center><font color=blue><?php echo($tt); ?></font></div>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD>
						<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD colspan=3 height=25 width=28% class=TABLE_FTITLE>
								STUDENT&nbsp;
							</TD>
					<?php for ($cn = 0; $cn < $lists_nb; $cn++) { ?>
							<TD colspan=4 height=25 width=18% class=TABLE_FTITLE>
								<div align=center><?php echo($this->getScoresTitleLink( $titles[$cn], $groups[$cn], $classes, $subjects, $cn, 0)); ?></div>
							</TD>
					<?php } ?>		
						</TR>
						<TR>
							<TD class=ITEMS_LINE_TITLE height=25> FNAME </TD>
							<TD class=ITEMS_LINE_TITLE> LNAME </TD>
							<TD class=ITEMS_LINE_TITLE> ID </TD>
					<?php for ($cn = 0; $cn < $lists_nb; $cn++) { ?>
							<TD class=ITEMS_LINE_TITLE width=20> M </TD>
							<TD class=ITEMS_LINE_TITLE  width=20> R </TD>
							<TD class=ITEMS_LINE_TITLE  width=20> W </TD>
							<TD class=ITEMS_LINE_TITLE  width=25> T </TD>
					<?php } ?>
						</TR>
					<?php 
					foreach($students as $student) {
						$id 		= $student->getID();
						$lastname 	= $student->getLastName();
						$firstname 	= $student->getFirstName();
					?>
						<TR>
							<TD class='listtext' height=15>&nbsp;&nbsp;<?php echo($firstname); ?> </TD>
							<TD class='listtext'>&nbsp;&nbsp;<?php echo($lastname); ?></TD>
							<TD class='listtext'><div align=center><?php echo($id); ?></div></TD>
						<?php 	
						for ($cn = 0; $cn < $lists_nb; $cn++) {
							$stscores = getSctudentScores($id, $scoreslists[$cn]);
							$total = 0;
							if ($stscores) {
								$math = $stscores->getMathScores();
								$reading = $stscores->getReadingScores();
								$writing = $stscores->getWritingScores();
								$total = $stscores->getTotalScores();
								if ($math == 0)
									$math = "-";
								if ($reading == 0)
									$reading = "-";
								if ($writing == 0)
									$writing = "-";
							}
							if (!$total) {
								$math = "-";
								$reading = "-";
								$writing = "-";
								$total = "-";
							}
							?>
							<TD class='listtext'><div align=center><?php echo($math); ?></div></TD>
							<TD class='listtext'><div align=center><?php echo($reading); ?></div></TD>
							<TD class='listtext'><div align=center><?php echo($writing); ?></div></TD>
							<TD class='listtext'><div align=center><?php echo($total); ?></div></TD>
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

function showClassStudentsSubjectsScores($classes, $students, $scoreslists, $titles, $groups, $tests, $subjects, $tt, $n_disp) 
{
$lists_nb = count($titles);
?>		

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD height=25 width=50% class=TABLE_FTITLE>
								<div align=center><font color=blue><?php echo($tt); ?></font></div>
							</TD>
						</TR>
						</TABLE>
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
							?>
							<TD class='listtext' width=28><div align=center><?php echo($total); ?></div></TD>
						<?php 
						}
						?>
						</TR>
				<?php } ?>
<?php if (0) { ?>
						<FORM action='member.php' method=post>
						<TR>
							<TD colspan=2 class='listtext'>
								<div align=right>
								<INPUT class=button TYPE='submit' name="delete" VALUE='Delete Scores > '>
								</div>
							</TD>
						<?php 
						$nscores = 0;
						for ($cn = 0; $cn < $lists_nb; $cn++) {
							
							$scouesid = 0;
							if ($scoreslists[$cn] && count($scoreslists[$cn]) > 0) {
								
								$stscores = $scoreslists[$cn][0];
								if ($stscores) {
									$scouesid = $stscores->getGroups();
								}
							}
							if ($scouesid) { 
							?>
							<TD class='listtext' width=28>
								<div align=center>
								<INPUT class=box type='checkbox' name='delscores_<?php echo($nscores); ?>' value='1'>
								<INPUT NAME='scoresid_<?php echo($nscores); ?>' TYPE=HIDDEN VALUE='<?php echo($scouesid); ?>'>
								</div>
							</TD>
							<?php
								$nscores++; 
							}
							else {
								echo("<TD class='listtext' width=28></TD>");
							}
						}
						?>
						</TR>
						<INPUT NAME='scoresnumber' TYPE=HIDDEN VALUE='<?php echo($nscores); ?>'>
						<INPUT NAME='action' TYPE=HIDDEN VALUE='delscores'>
						<INPUT NAME='classes' TYPE=HIDDEN VALUE='<?php echo($classes); ?>'>
						</FORM>
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

function showClassStudentsScoresList($classes, $subjects, $sem, $yy, $createdpdf) 
{
	if (isPSATSubject($subjects))
		$this->showClassStudentsPSATScoresList($classes, $subjects, $sem, $yy, $createdpdf); 
	else
		$this->showClassStudentsSubjectsScoresList($classes, $subjects, $sem, $yy, $createdpdf); 
}

function showClassStudentsSubjectsScoresList($classes, $subjects, $sem, $yy, $createdpdf) 
{
	$subs = getClassReportSubject($classes);
	
	$max_show_nb 	= 18;
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
		
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
<?php 
	$n_page = 1;
	for ($nt = 0; $nt < count($subs); $nt++) {

		$classscoreslist 	= $mlists->getClassStudentScoresLists($classes, $subs[$nt], $semester, $period);
		$list_nb 		= 0;
		if ($classscoreslist ) {
			$list_nb = count($classscoreslist);
		}
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
		$tabTitle = $subs[$nt]. " SCORES FOR Class " .getClassName($classes). " STUDENTS (" .$semester. "-" .$period. ")";
		$this->showClassStudentsSubjectsScores($classes, $students, $sliste, $titles, $groups, $tests, $subjects, $tabTitle, $n_disp);
	?>
	</TD>
</TR>
<?php 
}
?>
<TR><TD height=20 class=background></TD></TR>
<?php 

	}	
?>		

<TR><TD height=20 class=labelleft></TD></TR>
<?php if (0) { ?>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='listtext'>
				<div align=right>
				<?php 
				if ($list_nb > 0) { 
					$pdf = new ClassRecordPDF();
					/* should call first */
					$record_file = $pdf->getRecordFileName($classes, $subjects);
					if ($createdpdf) {
						$pdf->AddPage();
						if ($pdf->createPage($students, $classscoreslist, $titles))
						{
							$pdf->Output($record_file);
						}
						echo("<a href='" .$record_file. "'>Download Scores (pdf)</a>"); 
					}
					else {
						echo("<a href='../member/member.php?classes=".$classes."&action=showscores&createdpdf=1'>Generate Scores (pdf)</a>"); 
					}
				}
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=20 class=labelleft></TD></TR>
<?php  } ?>
</TABLE>

<?php 
}


function showClassStudentsPSATScoresList($classes, $subjects, $sem, $yy, $createdpdf) 
{
	$max_show_nb 	= 4;
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
	$mlists 			= new MemberList();
	$students 			= $mlists->getStudentLists($classes, 0);
	
	$classscoreslist 	= $mlists->getClassStudentScoresLists($classes, $subjects, $semester, $period);
		
	$list_nb 		= 0;
	
	if ($classscoreslist ) {
		$list_nb = count($classscoreslist);
	}

	$titles = array();
	$groups = array();
	for ($i = 0; $i < $max_show_nb; $i++) {
		$titles[] = "";
		$groups[] = "0";
	}
	$nb_table = $list_nb/$max_show_nb;

	$nn = 0;
?>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php 
	for ($nt = 0; $nt < $nb_table; $nt++) {
		$sliste = array();
		for ($i = 0; $i < $max_show_nb; $i++) {
			if ($nn  < $list_nb) {
				//$scoreslist = $classscoreslist[$list_nb-$nn-1];
				$scoreslist = $classscoreslist[$nn];
				$sliste[$i] = $scoreslist;
				
				$titles[$i] = getScoresTitleName($scoreslist);	
				$groups[$i] = getScoresGroupId($scoreslist);
			}
			else {
				$sliste[$i] = array();
				$titles[$i] = ""; 
				$groups[$i] = 0;
			}
			$nn++;
		}
?>

<TR>
	<TD class=background>
	<?php 
		$tabTitle =  " SCORES FOR Class " .getClassName($classes). " STUDENTS (" .$semester. "-" .$period. ")";
		$this->showClassStudentsPSATScores($classes, $students, $sliste, $titles, $groups, $subjects, $tabTitle);
	?>
	</TD>
</TR>
<?php 
	}	
?>		
<TR><TD height=20 class=labelleft></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='listtext'>
				<div align=right>
				<?php 
				if ($list_nb > 0) { 
					$pdf = new ClassRecordPSATPDF('L');
					/* should call first */
					$record_file = $pdf->getRecordFileName($classes, $subjects);
					if ($createdpdf) {
						$pdf->AddPage();
						if ($pdf->createPage($students, $classscoreslist, $titles))
						{
							$pdf->Output($record_file);
						}
						echo("<a href='" .$record_file. "'>Download Scores (pdf)</a>"); 
					}
					else {
						echo("<a href='../member/member.php?classes=".$classes."&action=showscores&createdpdf=1'>Generate Scores (pdf)</a>"); 
					}
				}
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=20 class=labelleft></TD></TR>
</TABLE>

<?php 
}


}
?>
