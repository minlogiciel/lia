<?php
class MemberForm {

	var $MEMBER_TYPE = 1;

	function getEmailLink($email) {
		if ($email)
			return ("<a href='mailto:"  .$email. "'>"  .$email. "</a>");
		else 
			return "";
	}
	function getStudentScoresLink($id, $classes, $name) {
		return ("<a href='../member/member.php?action=studentscores&studentid="  .$id. "&classes=".$classes."'>"  .$name. "</a>");
	}
	function getStudentProfilLink($id, $classes, $name) {
		return ("<a href='../member/member.php?action=studentprofil&studentid="  .$id. "&classes=".$classes."'>"  .$name. "</a>");
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
					$student->setClasses($classes);
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
		$studentform = new StudentForm();
		$students = $this->getModifyStudents();
		$nb_st =  count($students);
		if ($nb_st > 0) {
			for ($i = 0; $i < $nb_st; $i++) {
				$student = $students[$i];
				if ($student->getID() > 0) {
					if ($student->updateProfile()) {
					}
					else {
						$err = "Update Student Error : ".$student->getTrace();
						return $err;
					}
				}
				else {
					if ($student->isUserDataOK()) {
						$student->addStudent();
					}
					else {
						$err = "Add News Strudent Error : " .$student->getTrace();
						return $err;
					}
				}
			}
		}
		return "";
	}
	
function ModifyClassMember($classes, $loaddel) {
	$mlists = new MemberList();
	$lists = $mlists->getStudentLists($classes, $loaddel);
	$nbmember = count($lists);
	$showAllStudent = 0;
	$n_grade = getClassGrade($classes);
	$classname = getClassName($classes);
	if (strstr($classname, "TUTO"))
		$showname = "Tutoring Student Member";
	else
		$showname = "Class " .$classname. " Student Member";
	
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
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
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
		<FORM action='../member/member.php' method=post>
		<INPUT NAME='action' TYPE=HIDDEN VALUE='savestudentmember'>
		<INPUT NAME='classes' TYPE=HIDDEN VALUE='<?php echo($classname); ?>'>
		<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nb_loop); ?>'>
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
				<INPUT class=button TYPE='submit' name="save" VALUE=' Save ' id="savebuttonid" disabled="disabled">
				<INPUT class=button TYPE='submit' name="reset" VALUE=' Reset '>
				<INPUT class=button TYPE='submit' name="showdeleted" VALUE=' Show Deleted Student '>
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

function getStudentProfilForm($studentid) 
{
	$memberList = new MemberList();
	$student = $memberList->getStudent($studentid);
?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD>
		<?php FormTitle("Student Profile"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0  class=registerborder>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD>
						<FORM method="post" action="member.php">
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
								
						<TR>
							<TD height=25 class=formlabel2>
								<img src="../images/puce_red.gif" border=0>&nbsp;&nbsp;Change Student Infomation
							</TD>
						</TR>
		        		<TR>
							<TD>
								<?php $this->studentInfomationForm($student); ?>
							</TD>
		        		</TR>
						<TR>
							<TD class=background height=50>
								<div align=center>
									<INPUT NAME=studentid TYPE=HIDDEN VALUE="<?php echo($studentid); ?>">
									<INPUT NAME=action TYPE=HIDDEN VALUE="changeprofil">
									<INPUT type="submit" class=button NAME="update" value=" Update " id="savebuttonid" disabled="disabled">
									<INPUT type="submit" class=button NAME="reset" value=" Reset ">
								</div>
							</TD>
						</TR>
						</TABLE>
						</FORM>
					</TD>
				</TR>
        		<TR><TD height=20>&nbsp;</TD></TR>

				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD class=formlabel height=30></TD></TR>
</TABLE>
<?php 
}


function studentInfomationForm($student) 
{
	
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
	$classes = "";
	$rm = "";
	
	if ($student) {
		$pseudo 		= $student->getPseudo();
		$user_email 	= $student->getEmail();
		$civil = $student->getCivil();
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
		
		
		$rm = $student->getRM();
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
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Student Name :</TD>
	<TD class=formlabel><?php echo($user_name); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Student ID :</TD>
	<TD class=formlabel><?php echo($user_id); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Login Name : </TD>
	<TD class=formlabel><?php echo($pseudo); ?>
		<INPUT TYPE=HIDDEN name="pseudo" value="<?php echo($pseudo); ?>" >
	</TD>
</TR>

<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Gender : </TD>
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
	<TD class=labelright height=25>&nbsp;&nbsp;First Name : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="firstname" value="<?php echo($firstname); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Last Name : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="lastname" value="<?php echo($lastname); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Email : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="email" value="<?php echo($user_email); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright>Birthday : </TD>
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
	<TD class=labelright height=25>&nbsp;&nbsp;Grade : </TD>
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
	<TD class=labelright height=25>&nbsp;&nbsp;Class : </TD>
	<TD class=formlabel>
		<select name="classes" onclick="active_save();">
		<?php global $CLASS_NAME;
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
		<?php global $CLASS_NAME;
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$classname = $CLASS_NAME[$i];
			if ($classname == $classes2)
				echo ("<option value='".$classname."' selected>" .$classname. "</option>");
			else
				echo ("<option value='".$classname."'>" .$classname. "</option>");
		}
		?>
		</select>
		<select name="classes3" onclick="active_save();">
		<option value=''> - 3rd - </option>
		<?php global $CLASS_NAME;
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
		<?php global $CLASS_NAME;
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
	<TD class=labelright height=25>&nbsp;&nbsp;RM : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=15 name="rm" value="<?php echo($rm); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Street : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="street" value="<?php echo($user_street1. " " .$user_street2); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;City :</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="city" value="<?php echo($user_city); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;ZipCode : </TD>
	<TD class=formlabel>
		<INPUT size=20 class=fields type=text name="postcode" value="<?php echo($user_postcode); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Department : </TD>
	<TD class=formlabel>
		<INPUT size=20 class=fields type=text name="department" value="<?php echo($user_department); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Country : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="country"  value="<?php echo($user_country); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Phone : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="phone"  value="<?php echo($user_phone); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Cell : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="mobile"  value="<?php echo($user_mobile); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Notes : </TD>
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
	$rm = getPostValue('rm');
		
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
		
	if ($studentid) {
		$student = new StudentClass();
		if ($student->getUserByID($studentid)) {
			$student->setPseudo($pseudo);
			$student->setCivil($civil);
			$student->setFirstName($firstname);
			$student->setLastName($lastname);
			$student->setEmail($email);
			$student->setStreet1($street);
			$student->setStreet2("");
			$student->setCity($city);
			$student->setPostCode($postcode);
			$student->setProvence($provence);
			$student->setCountry($country);
			$student->setPhone($phone);
			$student->setMobile($mobile);
			$student->setBirthDay($birthday);
			
			$student->setClasses($classes);
			$student->setGrade($grade);
			$student->setRM($rm);
			$student->setCurrentGrade($grade); ///TODO	
			$student->setComments($notes);
			
			if ($student->updateProfile()) {
				$isOK = 1;
			}
			else {
				$this->error = "Modify Information Error : ";
				$this->error .= $student->getTrace();
				$student = '';
			}
		}
		else {
			$student = '';
		}
	}
	return $student;
}

	
}

?>