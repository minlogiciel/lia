<?php

class StudentForm {

	var $DATA_BASE 	= 1;
	var $TABLE_NAME = "STUDENTS";
	var $IDS 		= "IDS";
	

	function getStudentData() 
	{
		$email = getPostValue("email");
		$civil = getPostValue("civil");
		$firstname = getPostValue("firstname");
		$lastname = getPostValue("lastname");
		$street1 = getPostValue("street1");
		$street2 = getPostValue("street2");
		$city = getPostValue("city");
		$postcode = getPostValue("postcode");
		$department = getPostValue("department");
		$country = getPostValue("country");
		$phone = getPostValue("phone");
		$mobile = getPostValue("mobile");
		
		$bday = getPostValue("bday");
		$bmonth = getPostValue("bmonth");
		$byear = getPostValue("byear");
		if ($bday == 0 || $bmonth == 0 || $byear == 0) {
			$birthday = "";
		}
		else {
			$birthday = $bmonth. "/" .$bday. "/" .$byear;
		}
		
		$grade = getPostValue("grade");
		$classes = getPostValue("classes");
		$classes2 = getPostValue("classes2");
		$classes3 = getPostValue("classes3");
		if ($classes2) {
			$classes .=";" .$classes2;
		}
		if ($classes3) {
			$classes .=";" .$classes3;
		}
		$rm = getPostValue("rm");
		$tuition = getPostValue("tuition");
		$comments = getPostValue("comments");
		$isdeleted = 0;
		
		$student = new StudentClass();
		$student->setTrace("");
		
		$student->setEmail($email);
		
		$student->setCivil($civil);
		$student->setFirstName($firstname);
		$student->setLastName($lastname);
		$student->setStreet1($street1);
		$student->setStreet2($street2);
		$student->setCity($city);
		$student->setPostCode($postcode);
		$student->setProvence($department);
		$student->setCountry($country);
	
		$student->setPhone($phone);
		$student->setMobile($mobile);
		$student->setBirthDay($birthday);
		$student->setGrade($grade);
		$student->setClasses($classes);
		$student->setRM($rm);
		
		$student->setCurrentGrade($grade);
		$student->setComments($comments);
		$student->setDeleted($isdeleted);
		return $student;
	}

	/*********   add no name student ****************/
	function addNoNameStudent() 
	{
		$grade = getPostValue("grade");
		$classes = getPostValue("classes");
		$student = new StudentClass();
		$student->setClasses($classes);
		$student->setGrade($grade);
		$student->setDeleted(0);
		$student->addUnknownNameStudent();
	}
	
	/*********   add student ****************/
	function addNewStudent($student) 
	{
		$err = "";

		if ($student->isUserDataOK()) {
			$student->addStudent();
		}
		else 
			$err = $student->getTrace();
		return $err;
	}
	
	function listSemester($sem) 
	{
		global $SEMESTERS;

		$seleted = 0;
		$m = getSemester();
		
		echo("<select name='semesters' STYLE='width: 120; color:blue; align: center' onclick='active_save();'>");
			echo ("<option  value=''> ALL  </option>");
		for ($i = 0; $i < count($SEMESTERS); $i++) {
			$semester = $SEMESTERS[$i];
			if ($semester == $sem) {
				echo ("<option value=".$semester." selected> " .$semester. " Semester </option>");
				$selected = 1;
			}
			else {
				if (($selected == 0) && ($semester == $m)) {
					echo ("<option value=".$semester." selected> " .$semester. " Semester </option>");
				}
				else {
					echo ("<option  value=".$semester."> " .$semester. " Semester </option>");
				}
			}
		}
		echo("</select>");
	}

	function listPrograms($prog) 
	{
		global $PROGRAMS_2;

		echo("<select name='programs' STYLE='width: 120; color:blue; align: center' onclick='active_save();'>");
			echo ("<option  value=''> ALL  </option>");
		for ($i = 0; $i < count($PROGRAMS_2); $i++) {
			$programs = $PROGRAMS_2[$i];
			if ($prog && ($programs == $prog)) {
				echo ("<option value=".$programs." selected> " .$programs. " </option>");
			}
			else {
				echo ("<option  value=".$programs."> " .$programs. " </option>");
			}
		}
		echo("</select>");
	}
	
function showNoNameStudentForm($url="") {
	if ($url)
		$formaction = $url;
	else 
		$formaction = "member.php";
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD>
		<?php FormTitle("Add Unknown Name Student"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0  class=registerborder>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% height=250 border=0 align=center>
		<TR>
			<TD width=100%>
				<FORM action='<?php echo($formaction); ?>' method=post>
				<INPUT type=hidden name='action' value='addnonamestudent'>
				<TABLE cellSpacing=0 cellPadding=0 width=100%  border=0 align=center>
				<TR><TD height=20>&nbsp;</TD></TR>
				
				<TR>
					<TD class=formlabel><div align=center>  Grade : 
						<INPUT class=fields type=text size=19 name="grade"  value="">
						</div>
					</TD>
				</TR>
				<TR><TD height=10>&nbsp;</TD></TR>
				<TR>
					<TD class=formlabel><div align=center>  Class :
						<select name="classes" STYLE='width: 120; color:blue; align: center'>
						<?php global $CLASS_NAME;
						for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
							$classname = $CLASS_NAME[$i];
							echo ("<option value='".$classname."'>" .$classname. "</option>");
						}
						?>
						</select>	
						</div>		
					</TD>
				</TR>
				<TR><TD class=formlabel height=30>&nbsp;</TD></TR>
				<TR>
					<TD height=30 class=formlabel >
						<div align=center>			
							<INPUT class=button type=submit value=' Add No Name Student '>
						</div>
					</TD>
				</TR>
				<TR><TD height=20>&nbsp;</TD></TR>
				</TABLE>
				</FORM>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE>

<?php 
}


	function showStudentForm($student, $url="") {
		$email = "";
		$civil = 'F';
		$lastname = "";
		$firstname = "";
		$street1 = "";
		$street2 = "";
		$city = "";
		$postcode = "";
		$country = "USA";
		$phone = "";
		$mobile = "";
		
		$bmonth = 0;
		$bday = 0;
		$byear = 0;
		
		$classes = "";
		$grade = "";
		$rm = "";
		
		$tuition = "";
		$comments = "";
		$isdeleted = 0;
		$department = "";
		if ($student) {	
			$civil = $student->getCivil();
			$firstname = $student->getFirstName();
			$lastname = $student->getLastName();
			$street1 = $student->getStreet1();
			$street2 = $student->getStreet2();
			$city  = $student->getCity();
			$postcode = $student->getPostCode();
			$department = $student->getProvence();
			$country = $student->getCountry();
			$phone = $student->getPhone();
			$mobile = $student->getMobile();
			$email = $student->getEmail();
			
			$birthday = $student->getBirthDay();
			if ($birthday && strstr($birthday,"/") && strlen($birthday) > 6) {
				list($bmonth, $bday, $byear) = explode("/", trim($birthday));
			}
			
			
			$grade = $student->getGrade();
			$classes = $student->getClasses();
			$classes2 = "";
			$classes3 = "";
			$classes4 = "";
			if ($classes ) {
				
			}
			$rm = $student->getRM();
		
			$comments = $student->getComments();
			$isdeleted = $student->isDeleted();
		}
		if ($url) {
			$formaction = $url;
		} else {
			$formaction = "member.php";
		}
			
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD>
		<?php FormTitle("Add New Student"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0  class=registerborder>
<TR>
	<TD class=background>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=100%>
		<FORM action='<?php echo($formaction); ?>' method=post>
		<INPUT type=hidden name='action' value='addnewstudent'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=10 colspan=2></TD></TR>
		<TR>
			<TD class=labelright width=30%><?php showmark( ); ?> Gender : </TD>
			<TD class=labelleft width=70%>
				<?php if ($civil == "M") { ?>
					<INPUT type=radio name="civil" value="M" CHECKED>Mr.
				<?php } else { ?>
					<INPUT type=radio name="civil" value="M">Mr.
				<?php } ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php if ($civil == "F") { ?>
					<INPUT type=radio name="civil" value="F" CHECKED>Ms.
				<?php } else { ?>
					<INPUT type=radio name="civil" value="F">Ms.
				<?php } ?>
			</TD>
		</TR>
		
		<TR>
			<TD class=labelright><?php showmark( ); ?> First Name : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="firstname"  value="<?php echo($firstname); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> Last Name : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="lastname"  value="<?php echo($lastname); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright> Email : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="email"  value="<?php echo($email); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright> Street : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="street1" value="<?php echo($street1); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Street2 : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="street2" value="<?php echo($street2); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright> City : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="city" value="<?php echo($city); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright> Zip Code : </TD>
			<TD class=labelleft>
				<INPUT size=15 class=fields type=text name="postcode" value="<?php echo($postcode); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Department : </TD>
			<TD class=labelleft>
				<INPUT size=15 class=fields type=text name="department" value="<?php echo($department); ?>" onclick="active_save();" >
			</TD>
		</TR>
		<TR>
			<TD class=labelright> Country : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="country"  value="<?php echo($country); ?>" onclick="active_save();">
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
			<TD class=labelright><?php showmark( ); ?> Grade : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=15 name="grade"  value="<?php echo($grade); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> Class : </TD>
			<TD class=labelleft>
			
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
				<?php 
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
			<TD class=labelright>RM : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="rm"  value="<?php echo($rm); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Phone : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="phone"  value="<?php echo($phone); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Mobile : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="mobile"  value="<?php echo($mobile); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Notes : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="comments"  value="<?php echo($comments); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR><TD height=30 colspan=2>All <?php showmark( ); ?> lines should be filled.</TD></TR>
		<TR>
			<TD colspan=2 class=labelright>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 class=formlabel width=50%>
						<div align=right>
						<INPUT class=button type=submit value=' Add Student ' id="savebuttonid" disabled="disabled">
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name='reset' VALUE=' Reset '>
						</div>
					</TD>
				</TR>
				<TR><TD height=15 colspan=2>&nbsp;</TD></TR>
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
	</TD>
</TR>
</TABLE>

<?php 
}

function listStudentScoresTable($studentid, $sem, $yy, $createdpdf) 
{
	$student = new StudentClass();
	$student->getUserByID($studentid);
	
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);
	$pp = "(" .$semester. "-" .$period. ")";
	$scorecalss = new ScoreClass();

	$slists = $scorecalss->getStudentScores($studentid, '', $semester, $period);
	$slists_nb = count($slists);
	if ($student) {
		$classname = $student->getClasses();	
		$name = $student->getStudentName(). " ( Class " .$classname. ", ID : ".$student->getID(). " )";
		
	}
	else {
		$name = $studentid;
	}
	$have_scores = 0;
?>		
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=70% class=TABLE_FTITLE height=25>
				<div align=left>
				<font color=blue>&nbsp;&nbsp;Student scores : &nbsp;<?php echo($name); ?></font>
				</div>
			</TD>
			<TD width=30% class=TABLE_FTITLE height=25>
				<div align=right>
				<font color=blue><?php echo($pp); ?>&nbsp;&nbsp;&nbsp;&nbsp;</font>
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='4%'></TD>
			<TD class=ITEMS_LINE_TITLE width='13%'> Date </TD>
			<TD class=ITEMS_LINE_TITLE width='15%'> Teacher </TD>
			<TD class=ITEMS_LINE_TITLE width='14%'> Subjects </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> MATH </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> READING </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> WRITING </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> SCORE </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> AVG </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> LS </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> HS </TD>
		</TR>
<?php 		
	for ($i = 0; $i < count($slists); $i++) {
		$total		= $slists[$i]->getTotalScores() ;
		if ($total) {
			$dates		= $slists[$i]->getDates();
			$semester	= $slists[$i]->getSemester();
			$teacher	= $slists[$i]->getTeacher();
			$titles		= $slists[$i]->getTitles() ;
			$subjects	= $slists[$i]->getSubjects();
			$types		= $slists[$i]->getTypes() ;
			
			$math		= $slists[$i]->getMathScores() ;
			$reading	= $slists[$i]->getReadingScores() ;
			$writing	= $slists[$i]->getWritingScores() ;
			$hscores	= $slists[$i]->getHighScores() ;
			$lscores	= $slists[$i]->getLowScores() ;
			$mscores	= $slists[$i]->getMoyenScores() ;
			$have_scores = 1;
?>			
		<TR>
			<TD class='listnum'><div align=center><?php echo($i+1); ?></div></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($dates); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($teacher); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($subjects); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($math); ?></TD>
			<TD class='listtext'><div align=center><?php echo($reading); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($writing); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($total); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($mscores); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($lscores); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($hscores); ?></div></TD>
		</TR>
<?php 
		}
	}
?>
		</TABLE>
	</TD>
</TR>
<TR><TD height=20></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='listtext'>
				<div align=right>
				<?php
				if ($have_scores && $slists_nb > 12) { 
					$record_file = '';
					$pdf = new StudentRecordPDF();
					/* should call first */
					$record_file = $pdf->getRecordFileName($studentid, $semester, $period);
					
					$pdf->AddPage();
					if ($pdf->createPage($studentid, $student, $slists))
					{
						$pdf->Output($record_file);
						echo("<a href='".$record_file."'>Download Scores (pdf)</a>");
					}
				}
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}


function listStudentAllScoresTable($studentid, $sem, $yy, $createdpdf) 
{
	$student = new StudentClass();
	$student->getUserByID($studentid);
	
	$semester = getSemesterByString($sem);
	$annee = getYearByString($yy);
	$pp = "(" .$semester. "-" .$annee.")";
	
	$scorecalss = new ScoreClass();

	$slists = $scorecalss->getStudentScores($studentid, '', $semester, $annee );
	$slists_nb = count($slists);
	if ($student) {
		$classes = $student->getClasses();	
		$name = $student->getStudentName(). " ( Class : " .getClassName($classes). ", ID : ".$student->getID(). " )";
	}
	else {
		$name = $studentid;
	}
	$record_file = '';
	$have_scores = 0;
?>		
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=70% height=25 class=TABLE_FTITLE>
				<div align=left>
				<font color=blue>&nbsp;&nbsp;Student scores : &nbsp;<?php echo($name); ?></font>
				</div>
			</TD>
			<TD width=30% height=25 class=TABLE_FTITLE>
				<div align=right>
				<font color=blue><?php echo($pp); ?></font>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='4%'></TD>
			<TD class=ITEMS_LINE_TITLE width='12%'> Date </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> Subjects </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> Teacher </TD>
			<TD class=ITEMS_LINE_TITLE width='10%'> Type </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'>  </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> SCORE1 </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> SCORE2 </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> TOTAL </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> AVG </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> LS </TD>
			<TD class=ITEMS_LINE_TITLE width='6%'> HS </TD>
		</TR>
<?php 		
	for ($i = 0; $i < count($slists); $i++) {
		$total		= $slists[$i]->getTotalScores() ;
		if ($total) {	
			$dates		= $slists[$i]->getDates();
			$semester	= $slists[$i]->getSemester();
			$teacher	= $slists[$i]->getTeacher();
			$titles		= $slists[$i]->getTitles() ;
			$subjects	= $slists[$i]->getSubjects();
			$types		= $slists[$i]->getTypes() ;
			$math		= $slists[$i]->getMathScores() ;
			$reading	= $slists[$i]->getReadingScores() ;
			$writing	= $slists[$i]->getWritingScores() ;
			$hscores	= $slists[$i]->getHighScores() ;
			$lscores	= $slists[$i]->getLowScores() ;
			$mscores	= $slists[$i]->getMoyenScores() ;
			$have_scores = 1;
?>			
		<TR>
			<TD class='listnum'><div align=center><?php echo($i+1); ?></div></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($dates); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($subjects); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($teacher); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($types); ?></TD>
			<TD class='listtext'>&nbsp;&nbsp;<?php echo($math); ?></TD>
			<TD class='listtext'><div align=center><?php echo($reading); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($writing); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($total); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($mscores); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($lscores); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($hscores); ?></div></TD>
		</TR>
<?php 
		}
	}
?>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='listtext'>
				<div align=right>
				<?php
				if ($have_scores && $slists_nb > 12) {
					$pdf = new StudentRecordPDF();
					/* should call first */
					$record_file = $pdf->getRecordFileName($studentid, $semester, $annee);
					$pdf->AddPage();
						
					if ($pdf->createPage($studentid, $student, $slists))
					{
						$pdf->Output($record_file);
						echo("<a href='".$record_file."'>Download My Scores (pdf)</a>");
					}
				}
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}


function listStudentReportTable($studentid, $sem, $yy, $createdpdf) 
{
	$isendsemester = 0;
	$student = new StudentClass();
	$student->getUserByID($studentid);
	$classes = $student->getClasses();	
	$subjs = getClassReportSubject($classes);
	$semester = getSemesterByString($sem);
	$annee = getYearByString($yy);
	
	$session_nb = 10;
	$test_nb = 3;
	if ($semester == "Spring") {
		$session_nb = 17;
	}
	else if ($semester == "Summer") {
		$session_nb = 28;
		$test_nb = 6;
	}
	$total_nb = $session_nb + $test_nb;
	$titles = array(); 
	for ($i = 1; $i <= $session_nb; $i++) {
		$titles[] = "Homework " .$i;
	}
	for ($i = 1; $i < $test_nb; $i++) {
		$titles[] = "TEST " .$i;
	}
	$titles[] = "Final Exam";
	
	$class_nb = getClassNumber($classes);
	
?>		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
for ($nc = 1; $nc <= $class_nb; $nc++) {
	$classname = getClassElementName($classes, $nc);
?>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<?php 
		$isendsemester = $this->listStudentSubjectsReportTable($student, $semester ,$annee, $titles, $classname, $test_nb, $createdpdf); 
		?>
	</TD>
</TR>
<?php } ?>
<TR>
	<TD height=20 class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=15 class=listtext> </TD></TR>
		<TR>
			<TD class='listtext'>
				<div align=right>
					<?php  
					$report_file = '';
					if ($isendsemester) {
						/* create report pdf */
						$pdf = new CreateReport();
						/* should call first */
						$pdf->init($semester, $annee);
						
						$report_file = $pdf->createStudentReport($student);
						echo("<a href='" .$report_file. "'>Download My Report Card (pdf)</a>");
					}
					?>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</TD>
		</TR>
		</TABLE>
	
	</TD>
</TR>

</TABLE>
<?php 
}


function listStudentTuitionBilling($studentid, $sem, $yy, $createdpdf) 
{
	$student = new StudentClass();
	$student->getUserByID($studentid);

	
	$name = $student->getStudentName(). " (Class : ".$student->getClasses(). ", ID : " .$studentid. ")";
	
	$semester = getSemesterByString($sem);
	$annee = getYearByString($yy);

	$tuitionClass = new TuitionClass();
	$ret 	= $tuitionClass->getStudentTuition($studentid, $semester, $annee);
	
	$total 			= 0;
	$balance		= 0;
	$balance_f		= 0;
	$balance_f_s 	= "";
	$paid			= 0;

	$tuition 		= 0;
	$otherfee 		= 0;
	$otherfee_str = "";
	if ($ret) {
		$tuition = $tuitionClass->getTuition();
		$v = $tuitionClass->getBuses();
		if ($v > 0) {
			$otherfee += $v;
			$otherfee_str .= "Bus";
		}
		$v = $tuitionClass->getBooks();
		if ($v > 0) {
			$otherfee += $v;
			if (strlen($otherfee_str) > 0)
				$otherfee_str .= ", ";
			$otherfee_str .= "Book";
		}
		
		$v = $tuitionClass->getTennis();
		if ($v > 0) {
			$otherfee += $v;
			if (strlen($otherfee_str) > 0)
				$otherfee_str .= ", ";
			$otherfee_str .= "Tennis";
		}
		
		$v = $tuitionClass->getOthers();
		if ($v > 0) {
			$otherfee += $v;
			if (strlen($otherfee_str) > 0)
				$otherfee_str .= ", ";
			$otherfee_str .= "Others";
		}
		
		$balance_f = $tuitionClass->getBalanceF();
		$balance_f_s = $tuitionClass->getBalanceFSemester();
		$paid = $tuitionClass->getPaid();
	}
	
	$total = $otherfee + $tuition;
	$balance = $total - $paid;
?>	

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=formlabel>
		<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
		<TR><TD height=30></TD></TR>
		<TR>
			<TD width=100% class=TUITION_TITLE height=30>
				<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;
				<font color=black><?php echo($name); ?></font>
				</div>
			</TD>
		</TR>
		<TR><TD height=20></TD></TR>	
		<TR>
			<TD width=100% class=TUITION_TITLE height=30>
				<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;
				<font color=black><?php echo(getTodayString()); ?></font>
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=40></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
		<TR>
			<TD width=40% class=TUITION_LABEL height=30> Balance forwarded : </TD>
			<TD width=60% class=TUITION_TEXT>
				<?php if ($balance_f) echo(getPrice($balance_f). " (" .$balance_f_s. ")"); ?> 
			</TD>
		</TR>
		<TR>
			<TD class=TUITION_LABEL height=30> Period : </TD>
			<TD class=TUITION_TEXT> <?php echo(getSemesterPeriod($semester, $annee)); ?></TD>
		</TR>
		<TR>
			<TD class=TUITION_LABEL height=30> Tuition : </TD>
			<TD class=TUITION_TEXT><?php if ($tuition) echo(getPrice($tuition)); ?> </TD>
		</TR>
		<TR>
			<TD class=TUITION_LABEL height=30> Other Fee : </TD>
			<TD class=TUITION_TEXT> 
			<?php 
				if ($otherfee > 0) {
					echo(getPrice($otherfee). " (" .$otherfee_str. ")");
				} 
			?> 
			</TD>
		</TR>
		<TR>
			<TD class=TUITION_LABEL height=30> Total : </TD>
			<TD class=TUITION_TEXT><?php if ($total) echo(getPrice($total)); ?> </TD>
		</TR>
		<TR>
			<TD class=TUITION_LABEL> Amount paid : </TD>
			<TD class=TUITION_TEXT> 
				<?php if ($paid) echo(getPrice($paid)); ?> 
			</TD>
		</TR>
		<TR>
			<TD class=TUITION_LABEL> Balance : </TD>
			<TD class=TUITION_TEXT> 
				<?php if ($balance) echo(getPrice($balance)); ?> 
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=30></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=15 class=TUITION_TEXT> </TD></TR>
		<TR>
			<TD class='TUITION_TEXT' colspan=2>
				<div align=center>
				 <em> Please make check payable to L.I.A. and mail it to : </em>
				</div>
			</TD>
		</TR>
		<TR><TD height=15 colspan=2></TD></TR>
		<TR>
			<TD width=35%></TD>
			<TD class='TUITION_TEXT' width=65%>
				<div align=left>
				<?php  	echo(schooladdr()); ?>
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>


<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=15 class=listtext> </TD></TR>
		<TR>
			<TD class='listtext'>
				<div align=right>
				<?php
				$report_file = '';
				if ($ret) {
					/* create report pdf */
					$pdf = new StudentTuitionPDF();
					/* should call first */
					$report_file = $pdf->getBillingFileName($studentid, $semester, $annee);
					$pdf->AddPage();
					if ($pdf->createPage($student, $tuitionClass))
					{
						$pdf->Output($report_file);
						echo("<a href='" .$report_file. "'>Download My Tuition Bill (pdf)</a>");
					}
				} 
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

//////////////////////////

function listStudentSubjectsReportTable($student, $semester, $annee, $titles, $classname, $all_test_nb, $createdpdf) 
{
	global $PROGRAMS;
	$report_file = "";
	$isendsemester = 0;

	$studentid = $student->getID();
	$memberList = new MemberList();
	
	$all_nb = count($titles);
	$test_nb = $all_test_nb;
	$total_nb = $all_nb;
	$session_nb = $all_nb - $all_test_nb;
	
	$page_nb = 1;
	if ($all_nb > 28) {
		$page_nb = 2;
		$total_nb = $all_nb / $page_nb;
		$test_nb = $all_test_nb / $page_nb;
		$session_nb = $session_nb/$page_nb;
	}
	$subs = getClassReportSubject($classname);
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
for ($is = 0; $is < count($subs); $is++) {
	$subjects = $subs[$is];
	
	$combClass = getCombinedClass($classname);
	if ($combClass && $subjects == $PROGRAMS[0]) {
		$studentlists 	= $memberList->getStudentLists($combClass, 0);
		$scoreslists 	= $memberList->getClassStudentScoresLists($combClass, $subjects, $semester, $annee);
	}
	else {
		$studentlists 	= $memberList->getStudentLists($classname, 0);
		$scoreslists 	= $memberList->getClassStudentScoresLists($classname, $subjects, $semester, $annee);
	}
	
	
	/* if no score for the student, we dont display */
	if (hasStudentScores($studentid, $scoreslists)) {
		if (isNoNameStudent($student)) {
			$name = $student->getFirstName(). " ( Class : " .$classname. " )";
			$report = "&nbsp; &nbsp; " .$subjects. " Scores For " .$semester. "-" .$annee; 
		}
		else {
			$name = $student->getStudentName(). " ( Class : " .$classname. ",&nbsp;&nbsp; ID : ".$studentid. " )";
			$report = $subjects. " Scores for " .$semester. "-" .$annee; 
		}
	
		$teacher = getSubjectsTeacherName($scoreslists);
		if ($teacher) {
			//$name .= "&nbsp;&nbsp; &nbsp;&nbsp;  Teacher : " .$teacher;
			$teacher = "Teacher : " .$teacher;
		}
		else {
			$teacher = "";
		}
		$ww = 40;
	
?>
<TR>
	<TD class=ITEMS_LINE_TITLE>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=100% class=TABLE_FTITLE height=20 colspan=2>
				<div align=center>
					<font color=red><?php echo(strtoupper($report)); ?></font>
				</div>
			</TD>
		</TR>
		<TR>
			<TD width=50% class=TABLE_FTITLE height=20>
				<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;
				<font color=blue><?php echo($name); ?></font>
				</div>
			</TD>
			<TD width=50%  class=TABLE_FTITLE>
				<div align=right>
					<font color=blue><?php echo($teacher); ?></font>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<?php 
for ($p = 0; $p < $page_nb; $p++) {
?>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=TABLE_COL1 height=25 width=30 NOWRAP rowspan=3>ID</TD>
			<TD class=TABLE_COL1 colspan=<?php echo($session_nb)?>>Homework</TD>
			<TD class=TABLE_COL1 colspan=<?php echo($test_nb)?>>Test</TD>
		</TR>
		<TR>
			<?php for ($i = 0; $i < $session_nb; $i++) { ?>
			<TD class=TABLE_COL_SCORES width=<?php echo($ww); ?>><?php echo($i+1+$p*$session_nb); ?></TD>
			<?php  }
			for ($i = 0; $i < $test_nb; $i++) { ?>
			<TD class=TABLE_COL_SCORES width=<?php echo($ww); ?>><?php echo($i+1+$p*$test_nb); ?></TD>
			<?php  } ?>
		</TR>
		<?php 
		$reportTable = getStudentSubjectsReportTable($studentlists, $scoreslists, $total_nb, $test_nb, $p);

		$reportTitle = $reportTable[count($reportTable)-1];
		$reportMoyen = $reportTable[count($reportTable)-2];
		$orderTable = $reportTable[count($reportTable)-3];
		?> 
		<TR>
		<?php for ($i = 0; $i < $total_nb; $i++) { ?>
				<TD class=TABLE_COL_SMALL><?php echo($reportTitle[$i]); ?></TD>
		<?php } ?>
		</TR>

		<TR>
			<TD class=TABLE_COL_SCORES height=25 NOWRAP><font color=#000090>AVG</font></TD>
		<?php for ($i = 0; $i < $total_nb; $i++) { ?>
			<TD class=TABLE_COL_SCORES><font color=#000090><?php echo($reportMoyen[$i]); ?></font></TD>
		<?php } ?>
		</TR>
		
		<?php 
		$noname = '';

		for($ns = 0; $ns < count($studentlists); $ns++)
		{
			$rn = $orderTable[$ns];
			$st = $studentlists[$rn];
			$id = $st->getID();
			$showid = getStudentShowID($st);
			$color = "black";
			if ($studentid == $id) {
				$color = "#FF0000";
			}
			if ($showid == "**") {
				if (!$noname) {
					$noname = "<font size=2 color=#000090><b>" .$showid. "</b></font>";
				}
				$showid = $noname;
			}
		?>
		<TR>
			<TD class='listtext'>
				<div align=center><font color='<?php echo($color); ?>'><?php echo($showid); ?></font></div>
			</TD>
		<?php 
			for ($cn = 0; $cn < $total_nb; $cn++) 
			{
				$backcolor = $color;
				$stscores = $reportTable[$rn][$cn];
				$total = 0;
				if ($stscores) {
					$total = $stscores->getTotalScores();
				}
				if (($cn == $total_nb -1) && $total) {
					$isendsemester = 1;
				}
				if (!$total) {
					$total = "-";
				}
				else {
					if ($total == $stscores->getHighScores()) {
						//$color = $color ." face='verdana,arial,sans-serif' size=2";
					}
				}
		?>
			<TD class='listtext'>
				<div align=center><font color=<?php echo($color); ?>><?php echo($total); ?></font></div>
			</TD>
		<?php 	
				$color = $backcolor;
			} 
		?>
		</TR>
	<?php 
		} 
	?>
		</TABLE>
	</TD>
</TR>
<?php if ($noname) {?>
<TR>
	<TD height=15 class='listtext'>
		<div align=left>
		&nbsp;&nbsp;&nbsp;&nbsp;<em><?php echo($noname. " " .getStudentNoNameNote()); ?></em>
		</div>
	</TD>
</TR>
<?php } ?>
<TR><TD height=15 class='listtext'></TD></TR>
<?php } ?>
</TABLE>
</TD>
</TR>
<?php 
	} // end if has score 
} // end for subs
?>
</TABLE>
<?php 
return $isendsemester;
}




}
?>
