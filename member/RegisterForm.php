<?php

$Morning = array("English & Math",  "PSAT & Alg 2", "STA1","","","");
$Afternoon = array(
		"Writing",
		"Robotics",
		"Coding",
		"Earth Science",
		"Living Environment (Biology)",
		"Chemistry",
		"AP Physics",
		"ACT",
		"SAT Practice Test",
		"SAT Essay",
		"Pre-calc","" );

class RegisterForm {
	var $TABLE_NAME = "STUDENTS";
	var $IDS 		= "IDS";
	var $ST_NUMBER = 4;
	var $error;
	
	
function getRegisterData() {
	global $Morning, $Afternoon;
	$stlist = array();
	$street1 = getPostValue("street1");
	$city = getPostValue("city");
	$postcode = getPostValue("postcode");
	$department = getPostValue("department");

	$email = getPostValue("email");
	$phone = getPostValue("phone");
	$mobile = "";
	//$mobile = getPostValue("mobile");
	$comments = getPostValue("comments");
	$courses = "";
	for ($i = 0; $i < 6; $i++) {
		$v= getPostValue("morning_".$i);
		if ($v) {
			if ($courses)
				$courses.= ";";
			$courses.= $Morning[$i];
		}
		$n = $i * 2;
		$v = getPostValue("afternoon_".$n);
		if ($v) {
			if ($courses)
				$courses.= ";";
			$courses.= $Afternoon[$n];
		}
		$n = $n + 1;
		$v = getPostValue("afternoon_".$n);
		if ($v) {
			if ($courses)
				$courses.= ";";
			$courses.= $Afternoon[$n];
		}
	}
		
	for ($i = 1; $i < $this->ST_NUMBER; $i++) {
		$civil = getPostValue("civil".$i);
		$firstname = getPostValue("firstname".$i);
		$lastname = getPostValue("lastname".$i);
		$grade = getPostValue("grade".$i);
		if ($firstname || $lastname) {
			$student = new RegStudentClass();
			$student->setTrace("");
			$student->setCivil($civil);
			$student->setFirstName($firstname);
			$student->setLastName($lastname);
			$student->setGrade($grade);	
			
			$student->setStreet1($street1);
			$student->setCity($city);
			$student->setPostCode($postcode);
			$student->setProvence($department);
			$student->setEmail($email);
			$student->setPhone($phone);
			$student->setCourses($courses);
			$student->setComments($comments);
			$stlist[] = $student;
		}
	}
	return $stlist;
}

/*********   add register students ****************/
function addNewStudents($stlist) 
{
	$err = "";
	for ($i = 0; $i < count($stlist); $i++) {
		$student = $stlist[$i];
		if ($student->isUserDataOK()) {
			$student->addStudent();
		}
		else {
			$err .= $student->getTrace();
		}
	}
	return $err;
}


function showRegisterForm($stlist, $result, $url='') {
	global $Morning, $Afternoon;
	if ($url) {
		$formaction = $url;
	} else {
		$formaction = "admin.php";
	}

	$street1 = "";
	$city = "";
	$postcode = "";
	$department = "";
	
	$phone = "";
	$mobile = "";
	$email = "";
	$comments = "07/02 to 08/16";
	
	$civil = array("M", "F", "M");
	$firstname = array("", "", "");
	$lastname = array("", "", "");
	$grade =  array("2", "3", "4");
	
	if ($stlist) {
		for ($i = 0; $i < count($stlist); $i++) {
			$student = $stlist[$i];
			if ($i == 0) {
				$street1 = $student->getStreet1();
				$city  = $student->getCity();
				$postcode = $student->getPostCode();
				$department = $student->getProvence();

				$phone = $student->getPhone();
				$mobile = $student->getMobile();
				$email = $student->getEmail();
				$comments = $student->getComments();
			}
			$civil[$i] = $student->getCivil();
			$firstname[$i] = $student->getFirstName();
			$lastname[$i] = $student->getLastName();
			$grade[$i] = $student->getGrade();
		}
	}	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR><TD class=error height=20></TD></TR>
<TR><TD class=error height=30><b><?php echo($result); ?></b></TD></TR>

<TR><TD height=40><H1> Registration Form For <?php echo(getSemesterSchoolName()); ?> </H1></TD></TR>
<TR><TD><H3>( July 2 -- August 16 ) </H3></TD></TR>
<TR><TD height=40></TD></TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=90% border=0  align=center>
<TR>
	<TD class=background>
<FORM action='<?php echo($formaction); ?>' method=post>
<INPUT type=hidden name='action' value='registerstudent'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=17%> 
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR><TD class=labelleft>&nbsp;</TD></TR>
				<?php for ($i = 1; $i < $this->ST_NUMBER; $i++) {?>
				<TR><TD class=labelright height=30><?php echo($i); ?>. &nbsp;</TD></TR>
				<?php } ?>
				</TABLE>
			</TD>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelleft width=15%>Gender</TD>
					<TD class=labelleft width=30%><?php showmark( ); ?> First Name</TD>
					<TD class=labelleft width=30%><?php showmark( ); ?> Last Name</TD>
					<TD class=labelleft width=25%>Grade in Sep. <?php echo(date('Y')); ?></TD>
				</TR>
				<?php for ($i = 1; $i < $this->ST_NUMBER; $i++) { 
						$gender = $civil[$i-1];
						$grad = $grade[$i-1];
						$fname = $firstname[$i-1];
						$laname = $lastname[$i-1];
				?>
				<TR>
					<TD class=labelleft height=30>
						<select name="civil<?php echo($i); ?>" >
						<?php if ($gender == 'M') { ?>
							<option value='M' selected>Mr</option>
							<option value='F' >Miss</option>
						<?php } else { ?>
							<option value='M' >Mr</option>
							<option value='F' selected>Miss</option>
						<?php } ?>
						</select>
					</TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=20 name="firstname<?php echo($i); ?>"  value="<?php echo($fname); ?>">
					</TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=20 name="lastname<?php echo($i); ?>"  value="<?php echo($laname); ?>">
					</TD>
					<TD class=labelleft>
						<select name="grade<?php echo($i); ?>" >
						<?php for ($g=2; $g < 13; $g++) {?>
							<?php if ($grad == $g) { ?>
							<option value='<?php echo($g); ?>' selected><?php echo($g); ?></option>
						<?php } else { ?>
							<option value='<?php echo($g); ?>'><?php echo($g); ?></option>
						<?php } ?>
						<?php } ?>
						</select>
					</TD>
				</TR>
				<?php } ?>
				</TABLE>
			</TD>
		</TR>

		<TR>
			<TD class=labelright height=40>Street : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="street1" value="<?php echo($street1); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40> City : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="city" value="<?php echo($city); ?>">
		</TR>
		<TR>
			<TD class=labelright height=40> State : </TD>
			<TD class=labelleft>
				<INPUT size=20 class=fields type=text name="department" value="<?php echo($department); ?>">
			&nbsp;&nbsp;&nbsp;&nbsp;Zip Code : 
			
				<INPUT size=20 class=fields type=text name="postcode" value="<?php echo($postcode); ?>">
		</TR>
		<TR>
			<TD class=labelright height=40><?php showmark( ); ?> Email : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="email"  value="<?php echo($email); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40><?php showmark( ); ?> Parent's cell phone : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=tel size="20" minlength="9" maxlength="14" placeholder="516-123-4567" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
					name="phone"  value="<?php echo($phone); ?>">
			</TD>
		</TR>
		<!-- TR>
			<TD class=labelright height=40>Cell Phone : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="mobile"  value="<?php echo($mobile); ?>">
			</TD>
		</TR -->
		<TR>
			<TD class=labelright height=40>Notes : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 placeholder="" name="comments"  value="<?php echo($comments); ?>" >
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=20> </TD>
			<TD class=labelleft>
				Please specify the dates attenting __/__/ to __/__/
			</TD>
		</TR>
		<TR><TD class=labelright colspan=2 height=25></TD></TR>
		<TR>
			<TD class=labelright colspan=2>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=1 align=center>
					<TR>
						<TD class=TABLE_TITLE width=70% colspan=3  height=30>Choose your summer courses</TD>
					</TR>
					<TR>
						<TD class=TABLE_TITLE width=30% height=30>Morning</TD>
						<TD class=TABLE_TITLE width=70% colspan=2 >Afternoon</TD>
					</TR>
					<?php for ($i = 0; $i < 6; $i++) { ?>
					<TR>
						<TD class=labelleft height=30>
							<?php 
								$mc = $Morning[$i];
								if ($mc) {
									echo("&nbsp;&nbsp;<INPUT class=box type='checkbox' name='morning_" .$i. "'> ");
									echo($mc); 
									
								}
							?>
						</TD>
						<TD class=labelleft width=40% >
							<?php
							$n = $i * 2;
							$af = $Afternoon[$n];
							if ($af) {
								echo("&nbsp;&nbsp;<INPUT class=box type='checkbox' name='afternoon_" .$n. "'> ");
								echo($af); 
								
							}
							?>
						</TD>
						<TD class=labelleft width=30% >
							<?php
							$n = $i * 2+1;
							$af = $Afternoon[$n];
							if ($af) {
								echo("&nbsp;&nbsp;<INPUT class=box type='checkbox' name='afternoon_" .$n. "'> ");
								echo($af); 
							}
							?>
						</TD>
					</TR>
					<?php } ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD colspan=2 class=labelcenter height=80>
				<INPUT  type=submit value=" Register ">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<INPUT TYPE='submit' name='reset' VALUE=" Reset ">
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
	</TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE>

<?php 
}


function showRegisterFormOK($stlist) {
	$nmember = count($stlist)+1;
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR><TD height=80><H1> Register Students successfully !</H1></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
<?php for ($i = 1; $i < $nmember; $i++) {
			$student = $stlist[$i-1];
			if ($i == 1) {
				$street1 = $student->getStreet1();
				$city  = $student->getCity();
				$postcode = $student->getPostCode();
				$department = $student->getProvence();

				$phone = $student->getPhone();
				$email = $student->getEmail();
				$courses = $student->getCourses();
				$comments = $student->getComments();
			}
			$gender = $student->getCivil();
			$fname = $student->getFirstName();
			$lname = $student->getLastName();
			$grad = $student->getGrade();
 ?>
		<TR>
			<TD class=labelright height=40 width=25%><font color=black><?php echo($i); ?>.  </font></TD>
			<TD class=labelleft width=75%>
				<?php echo($gender. ".&nbsp;&nbsp;&nbsp;&nbsp;" .$fname. "&nbsp;&nbsp;&nbsp;&nbsp;".$lname); ?>
			</TD>
		</TR>
		<?php } ?>
		<TR>
			<TD class=labelright height=40><font color=black>Street :  </font></TD>
			<TD class=labelleft>
				<?php echo($street1); ?>
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40><font color=black>City :  </font></TD>
			<TD class=labelleft>
				<?php echo($city. "&nbsp;&nbsp;&nbsp;&nbsp;" .$department. "&nbsp;&nbsp;&nbsp;&nbsp;" .$postcode); ?>
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40><font color=black>Email : </font></TD>
			<TD class=labelleft>
				<?php echo($email); ?>
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40><font color=black>Parent's cell phone :  </font></TD>
			<TD class=labelleft>
				<?php echo($phone); ?>
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40><font color=black>Courses : </font></TD>
			<TD class=labelleft>
				<?php echo(str_replace(";", ",&nbsp;&nbsp;&nbsp", $courses));?>
				
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=40><font color=black>Dates Attending :  </font></TD>
			<TD class=labelleft>
				<?php echo($comments); ?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}


function toSemesterSchool() {
	$stlist = array();
	$nblist = getPostValue("nblist");
	$this->error = "";
	for ($i = 1; $i <= $nblist; $i++) {
		$select = getPostValue("select_".$i);
		if ($select) {
			$studentid = getPostValue("studentid_".$i);
			$student = new RegStudentClass();
			if ($student->getStudentByID($studentid)) {
				$grade = getPostValue("grade_".$i);
				$classes = getPostValue("class1_".$i);
				$classes2 = getPostValue("class2_".$i);
				if ($classes2) {
					$classes .= ";" .$classes2;					
				}
				$student->setGrade($grade);
				$student->setCurrentGrade($grade);
				$student->setClasses($classes);
				$err = $student->toSemesterSchool();
				if ($err) {
					$this->error .= $err. "<br>";
				}
			} 
		}
	}
	return  $this->error;
}

function getError() {
	return $this->error;
}


function listRegisterStudentTable($url='', $result='') {
	global $CLASS_NAME;

	if ($url) {
		$formaction = $url;
	} else {
		$formaction = "admin.php";
	}
	
	$mlists = new MemberList();
	$lists = $mlists->getRegisteStudentLists();
	$nbmember = count($lists);
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=100% class=TABLE_FTITLE>
				<H2><font color=blue>REGISTERED STUDENTS</font></H2>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<FORM action='<?php echo($url); ?>' method=post>
		<INPUT NAME='nblist' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
		<INPUT NAME=action TYPE=HIDDEN VALUE="updateregister">
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
					<TD class=ITEMS_LINE_TITLE width='18%'> Student </TD>
					<!-- >TD class=ITEMS_LINE_TITLE width='20%'> Address  </TD -->
					<TD class=ITEMS_LINE_TITLE width='10%'> Phone  </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'>R. Date  </TD>
					<TD class=ITEMS_LINE_TITLE width='8%'> Grade </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Class1 </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Class2 </TD>
					<TD class=ITEMS_LINE_TITLE width='5%'> Select </TD>
				</TR>
		<?php 		
			for ($i = 0; $i < $nbmember; $i++) {
				$n = $i + 1;
				$id 	= $lists[$i]->getID();
				$name	= $lists[$i]->getStudentName();
				$address = $lists[$i]->getStudentAddress();
				$grade 	= $lists[$i]->getGrade();
				$phone	= $lists[$i]->getPhone();
				$rdate	= $lists[$i]->getRegisterDate();
				$courses	= $lists[$i]->getCourses();
				$comments	= $lists[$i]->getComments();
				list($dd, $tt) =  explode("-", $rdate);
			?>			
				<TR>
					<TD class='listnum' rowspan=2><?php echo($n); ?>
						<INPUT TYPE=HIDDEN  name='studentid_<?php echo($n); ?>' VALUE='<?php echo($id); ?>'>
					</TD>
					<TD class='listtesttext'><?php echo($name); ?></TD>
					<!-- TD class='listtesttext'><?php echo($address); ?></TD -->
					<TD class='listtesttext'><?php echo($phone); ?></TD>
					<TD class='listtesttext'><?php echo($dd); ?></TD>
					<TD class='listtesttext'>
						<select name="grade_<?php echo($n); ?>">
				<?php 
				for ($g = 2; $g < 13; $g++) {
					if ($grade == $g) { ?>
							<option value="<?php echo($g); ?>" selected><?php echo($g); ?></option>
				<?php } else { ?>
							<option value="<?php echo($g); ?>"><?php echo($g); ?></option>
				<?php } 
				} ?>
						</select>
					</TD>
					<TD class='listtesttext'>
						<select name="class1_<?php echo($n); ?>">
				<?php for ($g = 0; $g < count($CLASS_NAME); $g+=2) { $cname = $CLASS_NAME[$g]; ?>
					<option value="<?php echo($cname); ?>"><?php echo($cname); ?></option>
				<?php } ?>
						</select>
					</TD>
					<TD class='listtesttext'>
						<select name="class2_<?php echo($n); ?>">
						<option value=""> - - - </option>
				<?php for ($g = 0; $g < count($CLASS_NAME); $g+=2) { $cname = $CLASS_NAME[$g]; ?>
					<option value="<?php echo($cname); ?>"><?php echo($cname); ?></option>
				<?php } ?>
						</select>
					</TD>
					<TD class='listtesttext' rowspan=2>
						<INPUT class=box type='checkbox' name='select_<?php echo($n); ?>' value='1'>
					</TD>
				</TR>
				<TR>
					<TD class='listtesttext' colspan=4 height=20>
						<font color=blue>Courses : </font><?php  echo(str_replace(";", ",&nbsp;&nbsp;&nbsp", $courses)); ?>
					</TD>
	
					<TD class='listtesttext' colspan=2>
						<font color=blue>Attending :</font>  <?php  echo( $comments); ?>
					</TD>
					
				</TR>
				<TR>
					<TD class='listtesttext' colspan=8 height=5></TD></TR>
		<?php } ?>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD class=labelcenter colspan=8 height=60>
				<INPUT type="submit"  NAME="update" value=" To <?php echo(getSemesterSchoolName()); ?> ">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<INPUT type="submit" NAME="reset" value=" Reset ">
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
