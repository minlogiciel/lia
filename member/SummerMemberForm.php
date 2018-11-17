<?php
class SummerMemberForm {
	var $END_INPUT_STUDENT = 0;
	
function writeTestWinner() {
	$text  = "<?php\n\$_SUMMERTOP = array(\n";
	$mlists = new MemberList();
	for ($i = 2; $i < 12; $i++) {

		$lists = $mlists->getTTGradeStudentScores($i, date("Y"), 1);

		$n_total = 0;
		$prev_total = 0;
		$nb = count($lists);
		
		if (count($lists) > 1) {
		if ($i<11) {
			$text  .= "\"Grade ".$i. " :\", \" \",\n";
		}
		else {
			$text  .= "\"Grade 11-12 :\", \" \",\n";
		}
		
		
		for ($j = 1; $j < $nb; $j++) {
			$score 		= $lists[$j];
			$total		= $score[2][0];
			$totalname	= $score[2][2];

			if ($prev_total != $total) {
				$n_total++;
			}
			$prev_total = $total;
			
			if ($n_total > 3) {
				$text  .= "\" \", \" \",\n\n";
				break;
			}
			
			$text  .= "\"".$totalname. "\", \"".$total. "\",\n";
		}}
	}
	$text  .= ");\n\n?>\n";
	
	$fname = "../home/TestWinnerStudent_".date("Y").".inc";
	$fp = fopen($fname, "w");
	fwrite($fp, $text);
	fclose($fp);
}

function getSummerStudentsList() {

	$studentslist = array();
	$nb = getPostValue("nblist");
	for ($i = 1; $i <= $nb; $i++) {
		$studentid = getPostValue("studentid_".$i);
		$civil = getPostValue("civil_".$i);
		$lastname = getPostValue("lastname_".$i);
		$firstname = getPostValue("firstname_".$i);
		$grade = getPostValue("grade_".$i);
		$classes = getPostValue("classes_".$i);
		$studentno = getPostValue("studentno_".$i);
		$email = getPostValue("email_".$i);
			
		if ($lastname || $firstname) {
			$student = new TestStudent();
			$student->setID($studentid);
			$student->setCivil($civil);
			$student->setFirstName($firstname);
			$student->setLastName($lastname);
			$student->setGrade($grade);
			$student->setClasses($classes);
			$student->setStudentId($studentno);
			$student->setEmail($email);
			$studentslist[] = $student;
		}
	}
	
	return $studentslist;
}


/*********   add students ****************/
function addSummerStudents() {

	$studentslist = $this->getSummerStudentsList();
	if (count($studentslist) > 0) {
		if ($this->END_INPUT_STUDENT) {
			for ($i = 0; $i < count($studentslist); $i++) {
				$student = $studentslist[$i];
				if ($student->getClasses()) {
					$st = new  StudentClass();
					if ($st->findStudent($student->getStudentName())) {
						$st->updateStudentClassGrade($student->getClasses(), $student->getGrade());
					}
					else {
						$st->addStudentFromTest($student);
					}
					$student->updateClasses();
				}
			}		
		}
		else {
			for ($i = 0; $i < count($studentslist); $i++) {
				$student = $studentslist[$i];
				$student->addStudent();
			}
		}		
	}
}

function listToTestMemberTable($url="") {
	$mlists = new MemberList();
	$lists = $mlists->getCurrentStudentLists();
	$nbmember = count($lists);
	
	if ($url)
		$a_url = "../member/".$url;
	else 
		$a_url = "../member/member.php";
	
?>

<FORM action='<?php echo($a_url); ?>' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updatetestclass'>
<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=50% class=TABLE_FTITLE>
				<div align=left><font color=blue>&nbsp;&nbsp;&nbsp;&nbsp;ALL Students</font></div>
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


function listMemberTable($url="") {
	global $CLASS_NAME;
	$mlists = new MemberList();
	$lists = $mlists->getTTStudentLists();
	$nbmember = count($lists);
	if ($this->END_INPUT_STUDENT)
		$nb_list = $nbmember;
	else 
		$nb_list = $nbmember+20;
	if ($url)
		$a_url = "../member/".$url;
	else 
		$a_url = "../member/member.php";
	
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=100% class=TABLE_FTITLE>
				<div align=center><font color=blue>OPEN HOUSE TEST STUDENTS</font></div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<FORM action='<?php echo($a_url); ?>' method=post>
		<INPUT NAME='nblist' TYPE=HIDDEN VALUE='<?php echo($nb_list); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> ID </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Gender </TD>
					<TD class=ITEMS_LINE_TITLE width='15%'> First Name </TD>
					<TD class=ITEMS_LINE_TITLE width='15%'> Last Name </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Grade </TD>
					<TD class=ITEMS_LINE_TITLE width='20%'> Email  </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Class  </TD>
				</TR>
		<?php 		
			for ($i = 0; $i < $nb_list; $i++) {
				$n = $i+1;
				if ($i < $nbmember) {
					$id 		= $lists[$i]->getID();
					$civil		= $lists[$i]->getCivil();
					$firstname	= $lists[$i]->getFirstName();
					$lastname	= $lists[$i]->getLastName();
					$email 		= $lists[$i]->getEmail();
					$studentno	= $lists[$i]->getStudentId();
					$grade 		= $lists[$i]->getGrade();
					$classes	= $lists[$i]->getClasses();
				}
				else {
					$id 		= 0;
					$civil		= "M";
					$firstname	= "";
					$lastname	= "";
					$email 		= "";
					$studentno 	= 0;
					$grade 		= 0;
					$classes	= "";
				}
			?>			
				<TR>
					<TD class='listnum'><?php echo($n); ?></TD>
					<TD class='listtesttext'>
						<INPUT TYPE=HIDDEN  name='studentid_<?php echo($n); ?>' VALUE='<?php echo($id); ?>'>
						<INPUT class=fields type=text size=5 name="studentno_<?php echo($n); ?>" value="<?php echo($studentno); ?>">
					</TD>
					<TD class='listtesttext'>
						<select name="civil_<?php echo($n); ?>">
					<?php if ($civil == "M") { ?>
							<option value="M" selected>Mr</option>
							<option value="F">Ms</option>
					<?php } else { ?>
							<option value="M" >Mr</option>
							<option value="F" selected>Ms</option>
					<?php } ?>
						</select>
					</TD>
					<TD class='listtesttext'>
						<INPUT class=fields type=text size=15 name="firstname_<?php echo($n); ?>" value="<?php echo($firstname); ?>">
					</TD>
					<TD class='listtesttext'>
						<INPUT class=fields type=text size=15 name="lastname_<?php echo($n); ?>" value="<?php echo($lastname); ?>">
					</TD>
					<TD class='listtesttext'>
						<select name="grade_<?php echo($n); ?>">
						<option value="13" selected>-</option>
				<?php 
				for ($g = 2; $g < 13; $g++) {
					if ($grade == $g) { ?>
							<option value="<?php echo($g); ?>" selected><?php echo($g); ?></option>
				<?php } else { ?>
							<option value="<?php echo($g); ?>"><?php echo($g); ?></option>
				<?php } 
				}
				if ($grade > 12 || $grade < 2) { ?>
					<option value="13" selected>DEL</option>
				<?php } else { ?>
					<option value="13">DEL</option>
				<?php } ?>
						</select>
					</TD>
					<TD class='listtesttext'>
						<INPUT class=fields type=text size=35 name="email_<?php echo($n); ?>" value="<?php echo($email); ?>">
					</TD>
					<TD class='listtesttext'>
				<?php if ($this->END_INPUT_STUDENT) { ?>
						<select name="classes_<?php echo($n); ?>">
						<option value="" selected>-</option>
				<?php 
				$nbc = count($CLASS_NAME)-2;
				for ($g = 0; $g < $nbc; $g+=2) {
					$cl = $CLASS_NAME[$g];
					if ($classes == $cl) { ?>
							<option value="<?php echo($cl); ?>" selected><?php echo($cl); ?></option>
				<?php } else { ?>
							<option value="<?php echo($cl); ?>"><?php echo($cl); ?></option>
				<?php } 
				}
				?>
						</select>
						<?php } ?>
					</TD>
				</TR>
		<?php } ?>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD class=background colspan=7 height=50>
				<div align=center>
				<INPUT NAME=action TYPE=HIDDEN VALUE="updatesummerstudents">
				<?php if ($this->END_INPUT_STUDENT) { ?>
				<INPUT type="submit" class=button NAME="update" value=" To Summer Class ">
				<?php  } else { ?>
				<INPUT type="submit" class=button NAME="update" value=" Save ">
				<?php } ?>
				<INPUT type="submit" class=button NAME="reset" value=" Reset ">
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php 
}



function getSummerStudentsScoresList() {

	$scoreslist = array();
	$nb = getPostValue("nblist");
	for ($i = 1; $i <= $nb; $i++) {
		$id = getPostValue("studentid_".$i);
		$student = new TestStudent();
		if ($student->getStudentByID($id)) {
			$scoreid = getPostValue("scoreid_".$i);
			$english = getPostValue("english_".$i);
			$math = getPostValue("math_".$i);
			$student->setMath($math);
			$student->setEnglish($english);
			$scoreslist[] = $student;
		}
	}
	
	return $scoreslist;
}
	
/*********   add students scores ****************/
function addSummerStudentsScores() {
	$scoreslist = $this->getSummerStudentsScoresList();
	if (count($scoreslist) > 0) {
		for ($i = 0; $i < count($scoreslist); $i++) {
			$student = $scoreslist[$i];
			$student->updateScores();
		}			
	}
}

function showStudentScoresLink($id, $studentno) {
 	if ($studentno) {
 		echo($studentno);
 	}
}


function listMemberScoreTable($url="") {
	$mlists = new MemberList();
	$lists = $mlists->getTTStudentLists();
	$this->showMemberScoreTable($lists, $url);
}

function showMemberScoreTable($lists, $url="") {
	if ($url)
		$a_url = "../member/".$url;
	else 
		$a_url = "../member/member.php";
	$nbmember = count($lists);
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=100% class=TABLE_FTITLE>
				<div align=center><font color=blue>OPEN HOUSE TEST STUDENTS SCORES</font></div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<FORM action='<?php echo($a_url); ?>' method=post>
		<INPUT NAME='nblist' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=25 width='10%'></TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> ID </TD>
					<TD class=ITEMS_LINE_TITLE width='20%'> First Name </TD>
					<TD class=ITEMS_LINE_TITLE width='20%'> Last Name </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Grade </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Math  </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> English  </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Combined  </TD>
				</TR>
		<?php 		
			for ($i = 0; $i < $nbmember; $i++) {
				$n = $i+1;
				$studentid 	= $lists[$i]->getID();
				$studentno 	= $lists[$i]->getStudentId();
				$firstname	= $lists[$i]->getFirstName();
				$lastname	= $lists[$i]->getLastName();
				$grade 		= $lists[$i]->getGrade();
				$english	= $lists[$i]->getEnglish();
				$math		= $lists[$i]->getMath();
				$total 		= $lists[$i]->getTotal();
			?>			
				<TR>
					<TD class='listnum'><?php echo($n); ?></TD>
					<TD class='listtesttext'>
						<?php $this->showStudentScoresLink($studentid, $studentno); ?>
						<INPUT TYPE=HIDDEN  name='studentid_<?php echo($n); ?>' VALUE='<?php echo($studentid); ?>'>
					</TD>
					<TD class='listtesttext'>
						<?php echo($firstname); ?>
					</TD>
					<TD class='listtesttext'>
						<?php echo($lastname); ?>
					</TD>
					<TD class='listtesttext'>
						<?php echo($grade); ?>
					</TD>
					<TD class='listtesttext'>
						<INPUT class=fields type=text size=10 name="math_<?php echo($n); ?>" value="<?php echo($math); ?>">
					</TD>
					<TD class='listtesttext'>
						<INPUT class=fields type=text size=10 name="english_<?php echo($n); ?>" value="<?php echo($english); ?>">
					</TD>
					<TD class='listtesttext'>
						<?php echo($total); ?>
					</TD>
				</TR>
		<?php } ?>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD class=background colspan=7 height=50>
				<div align=center>
				<INPUT NAME=action TYPE=HIDDEN VALUE="updatesummerresults">
				<INPUT type="submit" class=button NAME="update" value=" Save ">
				<INPUT type="submit" class=button NAME="reset" value=" Reset ">
				<INPUT type="submit" class=button NAME="winner" value=" Write Winner ">
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php 
}

function getShortStudentName($name) {

	$listname  = explode(" ", $name);
	$firstname = $listname[0];
	$lasttname = "";
	
	if (count($listname) > 1) {
		$lasttname = $listname[1];
	}
	if (strlen($firstname) > 5)
		$str = substr($firstname,0,5);
	else 
		$str = $firstname;
	if ($lasttname && $lasttname[0] != '?')
		$str .= " " .$lasttname. ".";
		
	return strtolower($str);
}

function showTTGradeStudentsScores($grade, $studentid, $studentname, $testyear, $forpublic) {
	$GRADE_TABLE = array("","1st", "2nd", "3rd", "4th", "5th","6th","7th","8th","9th","10th", "11-12th");
	
	$mlists = new MemberList();
	$lists = $mlists->getTTGradeStudentScores($grade, $testyear);
	$nbmember = count($lists);
	if ($nbmember > 0) {
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=titleplacement>

				<TR>
					<TD  height=25 class=titleplacement colspan=6>
						Score Report For All <?php echo($GRADE_TABLE[$grade]); ?> Grade Test Taker 
					</TD>
				</TR>

				<TR>
					<TD class=soustitleplacement colspan=2 width='33%' height=20> Math  </TD>
					<TD class=soustitleplacement colspan=2 width='33%'> English  </TD>
					<TD class=soustitleplacement colspan=2 width='33%'> Combined  </TD>
				</TR>
				<TR>
					<TD class='soustitleplacement' width=8%>AVG</TD>
					<TD class='soustitleplacement' width=25%>
						<div align=center><?php echo($lists[0][0]); ?></div>
					</TD>
					<TD class='soustitleplacement' width=8%>AVG</TD>
					<TD class='soustitleplacement' width=25%>
						<div align=center><?php echo($lists[0][1]); ?></div>
					</TD>
					<TD class='soustitleplacement' width=8%>AVG</TD>
					<TD class='soustitleplacement' width=25%>
						<div align=center><?php echo($lists[0][2]); ?></div>
					</TD>
				</TR>


		<?php 
			$prev_math = -1;
			$prev_en = -1;
			$prev_total = -1;
			$n_math = 0;
			$n_en = 0;
			$n_total = 0;
			
			if ($forpublic)
				$al = "center";
			else 
				$al = "left";
			
			for ($i = 1; $i < $nbmember; $i++) {
				$score 		= $lists[$i];
				$math		= $score[0][0];
				$mathid		= $score[0][1];
				$mathname2		= $score[0][2];
				if ($forpublic)
					$mathname	= $score[0][1];
				else
					$mathname	= $score[0][2];
				$english	= $score[1][0];
				$englishid	= $score[1][1];
				$englishname2	= $score[1][2];
				
				if ($forpublic)
					$englishname	= $score[1][1];
				else
					$englishname	= $score[1][2];
				
				$total		= $score[2][0];
				$totalid	= $score[2][1];
				$totalname2	= $score[2][2];
				if ($forpublic)
					$totalname	= $score[2][1];
				else
					$totalname	= $score[2][2];

				if ($prev_math != $math) {
					$n_math++;
				}
				$prev_math = $math;
				
				if ($prev_en != $english) {
					$n_en++;
				}
				$prev_en = $english;

				if ($prev_total != $total) {
					$n_total++;
				}
				$prev_total = $total;
				
				if ($total == 0)
					break;
				
					
			?>			
				<TR>
					<?php if ($n_math < 4) {?>
					<TD class='numplacement1' width=8%><?php echo($n_math); ?></TD>
					<?php } else { ?>
					<TD class='numplacement' width=8%><?php echo($n_math); ?></TD>
					<?php } ?>
					<TD class='listtesttext' width=25%><div align=<?php echo($al); ?>>&nbsp;
					<?php if ($math) {
						if ($studentid && ($studentid == $mathid) || $studentname == strtolower($mathname2)) {
							echo("<font color=red >". $math. " (". $mathname. ")</font>") ; 
						}
						else {
							echo("<font color=black >". $math. " </font><font color=#888888 >(". $mathname. ")</font>") ; 
						}
					}
					?>
					</div>
					</TD>
					<?php if ($n_en < 4) {?>
					<TD class='numplacement1' width=8%><?php echo($n_en); ?></TD>
					<?php } else { ?>
					<TD class='numplacement' width=8%><?php echo($n_en); ?></TD>
					<?php } ?>
					<TD class='listtesttext' width=25%><div align=<?php echo($al); ?>>&nbsp;
					<?php if ($english) {
						if ($studentid && ($studentid == $englishid) || $studentname == strtolower($englishname2)) {
							echo("<font color=red >". $english. " (". $englishname. ")</font>") ; 
						}
						else {
							echo("<font color=black >". $english. " </font> <font color=#888888  >(". $englishname. ")</font>") ; 
						}
					}
					?></div>
					</TD>
					<?php if ($n_total < 4) {?>
					<TD class='numplacement1' width=8%><?php echo($n_total); ?></TD>
					<?php } else { ?>
					<TD class='numplacement' width=8%><?php echo($n_total); ?></TD>
					<?php } ?>
					<TD class='listtesttext' width=25%><div align=<?php echo($al); ?>>&nbsp;
					<?php if ($total) {
						if ($studentid && ($studentid == $totalid) || $studentname == strtolower($totalname2)) {
							echo("<font color=red >". $total. " (". $totalname. ")</font>") ; 
						}
						else {
							echo("<font color=black >". $total. " </font> <font color=#888888  >(". $totalname. ")</font>") ; 
						}
					}
					?></div>
					</TD>
				</TR>
		<?php } ?>		
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
</TABLE>
<?php 
	}
}

function showTTStudentsScores($studentid, $testyear, $forpublic=0, $url="") {
	if ($forpublic)
		$url_form = "../schedule/OpenTestResult.php";
	else {
		if ($url)
			$url_form = "../member/".$url;
		else
			$url_form = "../member/member.php";
	}
	$cstid = strtoupper($studentid);
	$linkid = 1;
	$studentname = $this->getShortStudentName($studentid);
	$start = 2;
	$end = 12;
	if ($testyear == 2015) {
		$start = 5;
		$end = 11;
	}
	else if ($testyear == 2016) {
		$start = 5;
		$end = 12;
	}
	else if ($testyear >= 2017) {
		$start = 4;
		$end = 12;
	}
	?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD>
		<FORM action='<?php echo($url_form); ?>' method=post>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=50 colspan=3>
			<div align=center><font color=green size=3><b>Open House Test Report <?php echo($testyear); ?></b></font></div>
		</TD></TR>
<?php for ($grade = $start; $grade < $end; $grade+=2) { 
		$linkid = $grade/2; 
?>
		<TR>
			<TD class=TABLE_COL2 colspan=3><div id="link<?php echo($linkid); ?>">To Grade :
			<?php
			for ($gg = $start; $gg < $end; $gg+=2) { 
				$lnid = $gg/2;
				if ($grade != $gg) {	
			?>
					&nbsp;&nbsp;&nbsp;<a href="#link<?php echo($lnid); ?>"><?php echo($gg); ?></a> 
					&nbsp;&nbsp;&nbsp;<a href="#link<?php echo($lnid); ?>"><?php echo($gg+1); ?></a>
					
			<?php
				} else { ?>
					&nbsp;&nbsp;&nbsp;<?php echo($gg); ?> 
					&nbsp;&nbsp;&nbsp;<?php echo($gg+1); ?>
			<?php 				
				} 
				} ?>
			</div></TD>
		</TR>
		<TR>
			<TD width=49% valign=top>
				<?php $this->showTTGradeStudentsScores($grade, $cstid, $studentname, $testyear, $forpublic); ?>
			</TD>
			<TD width=1%></TD>
			<TD width=50% valign=top>
			<?php 
				$this->showTTGradeStudentsScores($grade+1, $cstid, $studentname, $testyear, $forpublic); 
				if ($testyear == 2015 && $grade == 9) {
					$this->showTTGradeStudentsScores(11, $cstid, $studentname, $testyear, $forpublic); 
				}
			?>
				
			</TD >
		</TR>
<?php } ?>
		<TR>
			<TD class=formlabel colspan=3 height=50>
				<div align=center>
					Your ID # : <INPUT class=fields type=text size=10 name="mystudentid" value="">
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=formlabel colspan=3 height=50>
				<div align=center>
				<INPUT NAME=action TYPE=HIDDEN VALUE="findttresult">
				<INPUT NAME=testyear TYPE=HIDDEN VALUE="<?php echo($testyear); ?>">
				<INPUT NAME=annee TYPE=HIDDEN VALUE="<?php echo($testyear); ?>">
				<INPUT type="submit" class=button NAME="myresult" value=" Find My Placement In Ranking ">
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php 

}

function showGradeStudentsScores($grade, $studentid, $forpublic) {
	$GRADE_TABLE = array("","1st", "2nd", "3rd", "4th", "5th","6th","7th","8th","9th","10th", "11-12th");
	
	$mlists = new MemberList();
	$lists = $mlists->getSummerGradeStudentScores($grade);
	$nbmember = count($lists);
	if ($nbmember > 0) {
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=titleplacement>

				<TR>
					<TD  height=25 class=titleplacement colspan=6>
						Score Report For All <?php echo($GRADE_TABLE[$grade]); ?> Grade Test Taker 
					</TD>
				</TR>

				<TR>
					<TD class=soustitleplacement colspan=2 width='33%' height=20> Math  </TD>
					<TD class=soustitleplacement colspan=2 width='33%'> English  </TD>
					<TD class=soustitleplacement colspan=2 width='33%'> Combined  </TD>
				</TR>
				<TR>
					<TD class='soustitleplacement' width=8%>AVG</TD>
					<TD class='soustitleplacement' width=25%>
						<div align=center><?php echo($lists[0][0]); ?></div>
					</TD>
					<TD class='soustitleplacement' width=8%>AVG</TD>
					<TD class='soustitleplacement' width=25%>
						<div align=center><?php echo($lists[0][1]); ?></div>
					</TD>
					<TD class='soustitleplacement' width=8%>AVG</TD>
					<TD class='soustitleplacement' width=25%>
						<div align=center><?php echo($lists[0][2]); ?></div>
					</TD>
				</TR>


		<?php 
			$prev_math = -1;
			$prev_en = -1;
			$prev_total = -1;
			$n_math = 0;
			$n_en = 0;
			$n_total = 0;
			
			if ($forpublic)
				$al = "center";
			else 
				$al = "left";
			
			for ($i = 1; $i < $nbmember; $i++) {
				$score 		= $lists[$i];
				$math		= $score[0][0];
				$mathid		= $score[0][1];
				if ($forpublic)
					$mathname	= $score[0][1];
				else
					$mathname	= $score[0][2];
				$english	= $score[1][0];
				$englishid	= $score[1][1];

				if ($forpublic)
					$englishname	= $score[1][1];
				else
					$englishname	= $score[1][2];
				
				$total		= $score[2][0];
				$totalid	= $score[2][1];
				if ($forpublic)
					$totalname	= $score[2][1];
				else
					$totalname	= $score[2][2];

				if ($prev_math != $math) {
					$n_math++;
				}
				$prev_math = $math;
				
				if ($prev_en != $english) {
					$n_en++;
				}
				$prev_en = $english;

				if ($prev_total != $total) {
					$n_total++;
				}
				$prev_total = $total;
				
				if ($total == 0)
					break;
				
					
			?>			
				<TR>
					<?php if ($n_math < 4) {?>
					<TD class='numplacement1' width=8%><?php echo($n_math); ?></TD>
					<?php } else { ?>
					<TD class='numplacement' width=8%><?php echo($n_math); ?></TD>
					<?php } ?>
					<TD class='listtesttext' width=25%><div align=<?php echo($al); ?>>&nbsp;
					<?php if ($math) {
						if ($studentid == $mathid) {
							echo("<font color=red >". $math. " (". $mathname. ")</font>") ; 
						}
						else {
							echo("<font color=black >". $math. " </font><font color=#888888 >(". $mathname. ")</font>") ; 
						}
					}
					?>
					</div>
					</TD>
					<?php if ($n_en < 4) {?>
					<TD class='numplacement1' width=8%><?php echo($n_en); ?></TD>
					<?php } else { ?>
					<TD class='numplacement' width=8%><?php echo($n_en); ?></TD>
					<?php } ?>
					<TD class='listtesttext' width=25%><div align=<?php echo($al); ?>>&nbsp;
					<?php if ($english) {
						if ($studentid == $englishid) {
							echo("<font color=red >". $english. " (". $englishname. ")</font>") ; 
						}
						else {
							echo("<font color=black >". $english. " </font> <font color=#888888  >(". $englishname. ")</font>") ; 
						}
					}
					?></div>
					</TD>
					<?php if ($n_total < 4) {?>
					<TD class='numplacement1' width=8%><?php echo($n_total); ?></TD>
					<?php } else { ?>
					<TD class='numplacement' width=8%><?php echo($n_total); ?></TD>
					<?php } ?>
					<TD class='listtesttext' width=25%><div align=<?php echo($al); ?>>&nbsp;
					<?php if ($total) {
						if ($studentid == $totalid) {
							echo("<font color=red >". $total. " (". $totalname. ")</font>") ; 
						}
						else {
							echo("<font color=black >". $total. " </font> <font color=#888888  >(". $totalname. ")</font>") ; 
						}
					}
					?></div>
					</TD>
				</TR>
		<?php } ?>		
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
</TABLE>
<?php 
	}
}

function showSummerStudentsScores($studentid, $forpublic=0) {
	if ($forpublic)
		$url_form = "../schedule/OpenTestResult.php";
	else 
		$url_form = "../member/member.php";
	$cstid = strtoupper($studentid);
	$linkid = 1;
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD>
		<FORM action='<?php echo($url_form); ?>' method=post>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php for ($grade = 2; $grade < 12; $grade+=2) { 
		$linkid = $grade/2; 
?>
		<TR>
			<TD class=TABLE_COL2 colspan=3><div id="link<?php echo($linkid); ?>">To Grade :
			<?php 
			for ($gg = 2; $gg < 12; $gg+=2) { 
				$lnid = $gg/2;
				if ($grade != $gg) {	
			?>
					&nbsp;&nbsp;&nbsp;<a href="#link<?php echo($lnid); ?>"><?php echo($gg); ?></a> 
					&nbsp;&nbsp;&nbsp;<a href="#link<?php echo($lnid); ?>"><?php echo($gg+1); ?></a>
					
			<?php
				} else { ?>
					&nbsp;&nbsp;&nbsp;<?php echo($gg); ?> 
					&nbsp;&nbsp;&nbsp;<?php echo($gg+1); ?>
			<?php 				
				} 
				} ?>
			</div></TD>
		</TR>
		<TR>
			<TD width=49% valign=top>
				<?php $this->showGradeStudentsScores($grade, $cstid, $forpublic); ?>
			</TD>
			<TD width=1%></TD>
			<TD width=50% valign=top>
				<?php $this->showGradeStudentsScores($grade+1, $cstid, $forpublic); ?>
			</TD >
		</TR>
<?php } ?>
		<TR>
			<TD class=formlabel colspan=3 height=50>
				<div align=center>
					Your ID # : <INPUT class=fields type=text size=10 name="mystudentid" value="">
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=formlabel colspan=3 height=50>
				<div align=center>
				<INPUT NAME=action TYPE=HIDDEN VALUE="findmytestresult">
				<INPUT NAME=annee TYPE=HIDDEN VALUE="2012">
				<INPUT type="submit" class=button NAME="myresult" value=" Find My Placement In Ranking ">
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php 

}

function getGradeEmailList() 
{
	$gradelist = array();
	for ($i = 2; $i < 13; $i++) {
		if (getPostValue("selectgrade_".$i)) {
			$gradelist[] = $i;
		}
		else {
			$gradelist[] = 0;
		}
	}
	return $gradelist;
}

function sendEmailToAllStudents($title, $messages, $sendtype)  {
	$MAX_EMAIL_NB = 15;

	$tolists = array();
	$memberList = new MemberList();
	$mailtoparent = new MailToParent();
	
	$gradelist = $this->getGradeEmailList();
	
	$studentlists 	= $memberList->getSummerTestGradeStudentLists($gradelist);
	$isindivituel = hasStudentVariable($messages);
	$n_send = 0;
	$emailstring = '';
	foreach($studentlists as $st) 
	{
		$studentid = $st->getID();
		if($sendtype) {
			if ($st->getEmail()) {
				if ($isindivituel) {
					$msg =  getStudentScoreText($messages, $st);
					$mailtext = $mailtoparent->SendToPlacement($title, $msg, $st);
					$tolists[] = $mailtext;
				}
				else {
					if ($emailstring) {
						$emailstring .=", ";
					}
					$emailstring .= $mailtoparent->getStudentEmail($st);
					if ($n_send >= $MAX_EMAIL_NB) {
						$mailtext = $mailtoparent->SendToGroupParent($title, $messages, $emailstring);
						$tolists[] = $emailstring. "  " .$mailtext;
						$n_send = 0;
						$emailstring = '';
					}
					$n_send++;
				}
			}
		}
		else {
			$msg =  getStudentScoreText($messages, $st);
		
			$mailtext = $mailtoparent->getEmailTextSimple($title, $msg, $st);
			$tolists[] = $mailtext;
			break;
		}
		
	}
	if ($emailstring) {
		$mailtext = $mailtoparent->SendToGroupParent($title, $messages, $emailstring);
		$tolists[] = $emailstring. "  " .$mailtext;
	}
	if($sendtype) {
		$mailtoparent->SendToLIA($title, $messages, "");
	}
	return $tolists;
}

function oldsendEmailToAllStudents($title, $messages, $sendtype)  {
	$MAX_EMAIL_NB = 15;

	$tolists = array();
	$memberList = new MemberList();
	$mailtoparent = new MailToParent();
	
	$gradelist = $this->getGradeEmailList();
	
	$studentlists 	= $memberList->getSummerTestGradeStudentLists($gradelist);
	$isindivituel = hasStudentVariable($messages);
	$n_send = 0;
	$emailstring = '';

	foreach($studentlists as $st) 
	{
		$studentid = $st->getID();
		$score = new TestScoreClass();
		if($sendtype) {
			if ($st->getEmail()) {
				if ($isindivituel) {
					if ($score->getScores($studentid)) {
						$msg =  getScoreText($messages, $score);
						$mailtext = $mailtoparent->SendToPlacement($title, $msg, $st);
						$tolists[] = $mailtext;
					}
				}
				else {
					if ($emailstring) {
						$emailstring .=", ";
					}
					$emailstring .= $mailtoparent->getStudentEmail($st);
					if ($n_send >= $MAX_EMAIL_NB) {
						$mailtext = $mailtoparent->SendToGroupParent($title, $messages, $emailstring);
						$tolists[] = $emailstring. "  " .$mailtext;
						$n_send = 0;
						$emailstring = '';
					}
					$n_send++;
				}
			}
		}
		else {
			if ($score->getScores($studentid)) {
				$msg =  getScoreText($messages, $score);
				$mailtext = $mailtoparent->getEmailTextSimple($title, $msg, $st);
				$tolists[] = $mailtext;
				break;
			}
		}
		
	}
	if ($emailstring) {
		$mailtext = $mailtoparent->SendToGroupParent($title, $messages, $emailstring);
		$tolists[] = $emailstring. "  " .$mailtext;
	}
	if($sendtype) {
		$mailtoparent->SendToLIA($title, $messages, "");
	}
	return $tolists;
}


function showSendEmailForm($sendtype, $url)  
{
	$messages = getPostValue("messages");
	$title = getPostValue("msgtitle");
	$selectedgrade = $this->getGradeEmailList();
	$err = "Error : ";
	$haserr = 0;
	if (!$title) {
		$err .= "No Title For Email .";
		$haserr = 1;
	}
	if ($messages) {
		$messages = replace($messages);	
	}
if ($haserr) {
	$this->showEmailForm($title, $messages, $err, $selectedgrade, $url);
}
else {
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>

<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD height=25 width=100% class=TABLE_FTITLE>
								<div align=left>
								<font color=blue>&nbsp;&nbsp;
								<?php if ($sendtype == 0) { ?>
									Example of Email Send To Students's Parents  
								<?php } else { ?>
									Email has been Sent To Students's Parents 
								<?php  } ?>
								</font>
								</div>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				
				<TR>
					<TD class=listtext>
					<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
					<TR><TD height=10 class=listtext></TD></TR>
				<?php 
				$tolists = $this->sendEmailToAllStudents($title, $messages, $sendtype);
				$n_to = count($tolists);
				if ($sendtype)	{
					for ($i = 0; $i < $n_to; $i+=1) {
							$nn = $i + 1;
				?>
					<TR><TD height=10></TD></TR>
					<TR><TD class=listtext><?php echo($nn. ". " .$tolists[$i]); ?></TD></TR>	
				<?php 
					}
				}
				else 
				{
				?>
					<TR><TD class=listtext><?php echo($tolists[0]); ?></TD></TR>
				<?php 
				}
				?>
					<TR><TD height=10 class=listtext></TD></TR>
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
<TR>
	<TD>
		<?php 
			if ($sendtype == 0) {
				$this->showEmailForm($title, $messages, '', $selectedgrade, $url);
			}
		?>
	</TD>
</TR>
</TABLE>
	
<?php
}
}
	



function showEmailForm($msgtitle, $messages, $err, $selectedgrade, $url)  {
	global $SCORE_VAR;
	$start_g = 4;
	$end_g = 13;
	if ($url)
		$a_url = "../member/".$url;
	else 
		$a_url = "admin.php";
?>
<FORM action='<?php echo($a_url);?>' method=post>
<INPUT type=hidden name='action' value='sendtoplacement'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>
	<TR>
		<TD class=error height=30><?php echo($err); ?></TD>
	</TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD height=25 width=100% class=ITEMS_LINE_TITLE>
				<font color=white>&nbsp;&nbsp;Send Email to Test taker</font>
			</TD>
		</TR>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=listtext>
						<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
						<TR><TD height=15 colspan=2 class=listtext></TD></TR>
						<TR>
							<TD class=listtext height=30 width=15%><div align=right>Grades : &nbsp;&nbsp;</div></TD>
							<TD class=listtext width=85%>
		<?php
				for ($i = $start_g; $i < $end_g; $i++) { 
					if ($selectedgrade && $selectedgrade[$i-2] == $i) { ?> 							
								<INPUT class=box type='checkbox' name='selectgrade_<?php echo($i); ?>' value='1' checked>
		<?php 		} else { ?>
								<INPUT class=box type='checkbox' name='selectgrade_<?php echo($i); ?>' value='1'>
		<?php 		} 
					echo($i."&nbsp;&nbsp;&nbsp;&nbsp;"); } 
		?>
							</TD>
						</TR>
						<TR>
							<TD class=listtext height=30><div align=right>VARIABLES : &nbsp;&nbsp;</div></TD>
							<TD class=listtext height=30 >
								<font color=#008000 size=2> #studentname #studentid
								<?php 
								for ($ii = 0; $ii < count($SCORE_VAR); $ii++) {
									echo($SCORE_VAR[$ii]. " ");
								}
								?>
								
								</font>
							</TD>
						</TR>
						<TR>
							<TD class=listtext height=30><div align=right>TITLE : &nbsp;&nbsp;</div></TD>
							<TD class=listtext>
								<INPUT class=fields type=text size=80 name="msgtitle" value="<?php echo($msgtitle); ?>">
							</TD>
						</TR>
						<TR>
							<TD class=listtext valign="top"><div align=right>MESSAGE : &nbsp;&nbsp;</div></TD>
							<TD class=listtext>
								<textarea name="messages" id="messages" cols="70" rows="20" class="area-fields" ><?php echo($messages); ?></textarea>
							</TD>
						</TR>
						<TR><TD height=10 colspan=2 class=listtext></TD></TR>
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
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=40 class=labelright width=100%>
				<div align=center>
				<INPUT class=button type=submit name="viewmail" value=' View '>
				<INPUT class=button type=submit name="sendmail" value=' Send '>
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


function getStudentTestDetail() {
	global $MAX_DETAIL_ITEM;

	$detail = new TestDetailClass();
	$detail->setID(getPostValue("detailid"));
	$detail->setStudentID(getPostValue("studentid"));
	$detail->setQuestions(getPostValue("questions"));
	$detail->setRowScore(getPostValue("row_score"));
	$detail->setPerScore(getPostValue("per_score"));
	$detail->setTestDate(getPostValue("test_date"));
	
	$detaillist = array();
	for ($i = 0; $i < $MAX_DETAIL_ITEM; $i++) {
		$detaillist[] = getPostValue("english_item_".$i);
	}
	for ($i = 0; $i < $MAX_DETAIL_ITEM; $i++) {
		$detaillist[] = getPostValue("math_item_".$i);
	}
	
	$detail->setDetailItems($detaillist);
	
	return $detail;
}

function addStudentDetails() {
	$detail = $this->getStudentTestDetail();
	if ($detail->getID() > 0 ) {
		$detail->updateStudentTestDetails();
	}
	else {
		$detail->addStudentTestDetails();
	}
	
}

function showStudentScoreDetail($studentid) {
	global $MAX_DETAIL_ITEM;
	
	$grade = 2;
	$question = "";
	$rowscore = "";
	$perscore = "";
	$testdate = "";
	$itemdetails = "";
	$detailid = 0;
	$studentname = "";
	$studentno = "";
	$student = new StudentTestClass();
	if ($student->getUserByID($studentid)) {
		$grade = $student->getGrade();
		$studentname = $student->getStudentName();
		$studentno = $student->getStudentNo();	
			
		$score = new TestScoreClass();
		if (!$score->getScores($studentid)) {
			$score = "";
		}
		$detail = new TestDetailClass();
		if ($detail->getStudentTestDetail($studentid)) {
			$detailid =  $detail->getID();;
			$question = $detail->getQuestions();
			$rowscore = $detail->getRowScore();
			$perscore = $detail->getPerScore();
			$testdate = $detail->getTestDate();
			$itemdetails = $detail->getDetailItems();
		}
			
	}

	$items = getGradeSubjectItems($grade);
	$englishitems = $items[0];
	$mathitems = $items[1];
	
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=100% class=TABLE_FTITLE>
				<div align=center><font color=blue>INDIVIUAL OPEN HOUSE  TEST RESULTS</font></div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD class=background>
		<FORM action='../member/testindex.php' method=post>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD  class=formlabel height=20 width=25%> Student Name : </TD>
					<TD  class=formlabel height=20 width=25%><font color=orange> <?php echo($studentname); ?></font> </TD>
					<TD  class=formlabel height=20 width=25%> Student ID No. : </TD>
					<TD  class=formlabel height=20 width=25%><font color=orange> <?php echo($studentno); ?></font> </TD>
				</TR>
				<TR>
				</TR>
				<TR>
					<TD  class=formlabel height=20 > Total Questions : </TD>
					<TD  class=formlabel > 
						<INPUT class=fields type=text size=20 name="questions"  value="<?php echo($question); ?>">
					</TD>
					<TD  class=formlabel height=20 width=25%> Grade : </TD>
					<TD  class=formlabel height=20 width=25%><font color=orange> <?php echo($grade); ?> </font></TD>
				</TR>
				<TR>
					<TD  class=formlabel height=20> Raw Score : </TD>
					<TD  class=formlabel> 
						<INPUT class=fields type=text size=20 name="row_score"  value="<?php echo($rowscore); ?>">
					</TD>
					<TD  class=formlabel> Test Date :  </TD>
					<TD  class=formlabel> 
						<INPUT class=fields type=text size=20 name="test_date"  value="<?php echo($testdate); ?>">
					</TD>
				</TR>
				<TR>
					<TD  class=formlabel height=20> Percent Score : </TD>
					<TD  class=formlabel>
						<INPUT class=fields type=text size=20 name="per_score"  value="<?php echo($perscore); ?>">
					 </TD>
					<TD  class=formlabel>  </TD>
					<TD  class=formlabel>  </TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD  class=apsattitle height=50 colspan=3>
						&diams;&diams;&diams; English Test Detail &diams;&diams;&diams;
					</TD>
				</TR>
		<?php
			$n = 0;
			$item = "";
			for ($i = 0; $i < count($englishitems); $i++) {
				if ($itemdetails) {
					$item = $itemdetails[$n++];
				}
			?>			
				<TR>
					<TD class='formlabel' width=40>
						<div align=center> <?php echo($i+1); ?> .</div>
					</TD>
					<TD class='formlabel'>
						<?php echo($englishitems[$i]); ?>
					</TD>
					<TD class='listtesttext' width=30%>
						<INPUT class=fields type=text size=20 name="english_item_<?php echo($i); ?>"  value="<?php echo($item); ?>">
					</TD>
				</TR>
		<?php } ?>	
				<TR>
					<TD  class=apsattitle height=50 colspan=3>
						&diams;&diams;&diams; Math Test Detail &diams;&diams;&diams;
					</TD>
				</TR>
				
		<?php 
			$n = $MAX_DETAIL_ITEM;
			
			for ($i = 0; $i < count($mathitems); $i++) {
				if ($itemdetails) {
					$item = $itemdetails[$n++];
				}
			?>			
				<TR>
					<TD class='formlabel'>
						<div align=center> <?php echo($i+1); ?> .</div>
					</TD>
					<TD class='formlabel'>
						<?php echo($mathitems[$i]); ?>
					</TD>
					<TD class='listtesttext'>
						<INPUT class=fields type=text size=20 name="math_item_<?php echo($i); ?>"  value="<?php echo($item); ?>">
					</TD>
				</TR>
		<?php } ?>	
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD class=background height=50>
				<div align=center>
				<INPUT NAME="detailid" TYPE=HIDDEN VALUE="<?php echo($detailid); ?>">
				<INPUT NAME="studentid" TYPE=HIDDEN VALUE="<?php echo($studentid); ?>">
				<INPUT NAME=action TYPE=HIDDEN VALUE="updatetestdetail">
				<INPUT type="submit" class=button NAME="update" value=" Save ">
				<INPUT type="submit" class=button NAME="reset" value=" Reset ">
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php 
}



}

?>