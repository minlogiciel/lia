<?php
include "../php/allinclude.php";
session_start();
include "../teacher/TeacherForm.php";
include '../Excel/excel_include.php';

$remoteip = $_SERVER['REMOTE_ADDR'];
if (isAdminAllowed($remoteip)) {

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 0);
$studentid = isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);
$subjects = isset($_GET["subjects"]) ? $_GET["subjects"] : (isset($_POST["subjects"]) ? $_POST["subjects"] : "");
$semester = isset($_GET["semester"]) ? $_GET["semester"] : (isset($_POST["semester"]) ? $_POST["semester"] : "");
$period = isset($_GET["period"]) ? $_GET["period"] : (isset($_POST["period"]) ? $_POST["period"] : 0);
$createdpdf = isset($_GET["createdpdf"]) ? $_GET["createdpdf"] : (isset($_POST["createdpdf"]) ? $_POST["createdpdf"] : 0);
$testyear = isset($_GET["testyear"]) ? $_GET["testyear"] : (isset($_POST["testyear"]) ? $_POST["testyear"] : 2014);
$groups = isset($_GET["groups"]) ? $_GET["groups"] : (isset($_POST["groups"]) ? $_POST["groups"] : "");

$err = '';
$ok = 0;
$scoresform = new ScoresForm();
$memberform = new ClassForm();
$studentform = new StudentForm();
$memmberList = new MemberList();
$emailform = new EmailForm();
$summermemberform = new SummerMemberForm();
$excelform = new ExcelForm();
$ctform = new ClassTeacherForm();
$regform = new RegisterForm();
	
$student = '';
$scoreslists = '';
$result = '';
$excelscore = "";

/*
if ($action == "delmember") {
	$memmberList->deleteMember();
}
else if ($action == "updateclass") {
	$memmberList->updateAllStudentClassName();
}
else if ($action == "updatetestclass") {
	$memmberList->updateAllTestStudentClassName();
}
else if ($action == "delscores") {
	$scoresform->deleteScoresList();
	
}
else if ($action == "changescores" ) {
	if(empty($_REQUEST['reset'])) {
		$scoreslists = $scoresform->updateScoresList($groups); 
		$result = "Scores have been changed.";
	}
}
else if (($action == "newstudent") || ($action == "addnewstudent")) {
	if ($action == "addnewstudent") {
		if(empty($_REQUEST['reset']))  
		{  
			$student = $studentform->getStudentData();
			$err = $studentform->addNewStudent($student);
			if (!$err) {
				$result = "Student has been added.";
			} 
		}
		else {
			$student = '';
		}
	}
}
else if ($action == "addnonamestudent") {
	$studentform->addNoNameStudent();
	$result = "No Name Student has been added.";
}
else if ($action == "summerstudents" || $action == "updatesummerstudents" || 
		$action == "summerresults"  || $action == "updatesummerresults" || $action == "importtestscore" || 
		$action == "trophyawards" ||  $action == "findmytestresult" ||
		$action == "ttreport" || $action == "findttresult" ||
		$action == "emailtoplacement" || $action == "sendtoplacement") {

	if ($action == "updatesummerstudents") {
		if (empty($_REQUEST['reset']))
			$summermemberform->addSummerStudents();
	}
	else if ($action == "updatesummerresults") {
		if (empty($_REQUEST['reset']))
			$summermemberform->addSummerStudentsScores();
	}
}
else if ($action == "importexcel") {
	$excelscore = $excelform->getNewScores();
	if ($excelscore->isOK()) {
		if (empty($_REQUEST['viewscores'])) {
			$excelscore->addNewScoresList();
			$result = $excelscore->getSubjects(). " test scores for class ". $excelscore->getClasses(). " have been imported.";
		}
		else {
			$scoreslists = $excelscore->getScoreslist();
			$classes = $excelscore->getClasses();
			$action == "viewscores";
			$excelform = "";
		}
	}
	else {
		$err = "Error : Excel File is not correct test result format! <br>Excel File should has <font color=blue><b>ID Number</b></font> and <font color=blue><b> % </b></font> column.";
	}
}
*/
include "../admin/adminheader.php";
?>
<script language="javascript" type="text/javascript" src="../scripts/classvar.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/scores.js"></script>

<TABLE width=950 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD valign=top>
		<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
		<tr>
			<td width=180 valign=top class=ITEMS_BG><?php include "../member/studentleft.php"; ?></td>
			<td width=770 valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
				<TR>
					<TD class=error height=30><DIV align=center><b><?php echo($result); ?></b></DIV></TD>
				</TR>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center> 
						<TR>
							<TD width=100%>
<?php 
/********* show and modify class students ***********/ 
if ($action == "classmember") {
	$memberform->ModifyClassMember($classes, 0, $result) ;
}		
else if ($action == "saveclassmember") {
	if (!empty($_REQUEST['showdeleted']))
		$memberform->ModifyClassMember($classes, 1, $result) ;
	else {
		if(empty($_REQUEST['reset'])) {
			$result = $memberform->saveClassMember();
		}  
		$memberform->ModifyClassMember($classes, 0, $result) ;
	}	
}
else if ($action == "studentprofil") {
	$memberform->showStudentProfilForm($studentid, "", $result);
}
else if ($action == "changeprofil") {
	if(empty($_REQUEST['reset'])) {
		$student = $memberform->changeStudentProfil();
		$result = $memberform->getError();
	}
	$memberform->showStudentProfilForm($studentid, $student, $result);
}

/********* input class students scores ***********/ 
else if ($action == "inputscores") {
	$memberform->showScoresForm($classes, $scoreslists, $subjects, $semester, $period, $result);
}
else if ($action == "updatescores") {
	$scoreslists = $memmberList->getClassStudentGroupsScoresLists($groups);
	$memberform->showScoresForm($classes, $scoreslists, $subjects, $semester, $period, $result);
}
else if ($action == "savescores") {
	if(empty($_REQUEST['reset'])) {  
		$scoreslists = $memberform->addNewScoresList();
		//$memberform->showScoresForm($classes, $scoreslists, $subjects, $semester, $period, $result);
		$memberform->showClassStudentsScoresList($classes, $subjects, $semester, $period, 0);
	}
	else {
		$memberform->showScoresForm($classes, $scoreslists, $subjects, $semester, $period, $result);
	}
}

else if ($action == "viewscores" || $action == "showscores") {
	$memberform->showClassStudentsScoresList($classes, $subjects, $semester, $period, 0);
}

/******************************************************/

else if ($action == "managestudents") {
	$memberform->ManageStudentForm() ;
}
else if ($action == "cleanstudents") {
	$memberform->ManageStudentForm() ;
}
else if ($action == "allstudents") {
	$memberform->listClassMemberTable(-1, 0, "", $semester, $period) ;
}
else if ($action == "oldstudents") {
	$memberform->listClassMemberTable($OLD_STUDENT_CLASS, 0, "") ;
}
else if ($action == "registerstudent" || $action == "register") {
	$stlist="";
	if ($action == "registerstudent") {
		if(empty($_REQUEST['reset'])) {
			$stlist = $regform->getRegisterData();
			$result = $regform->addNewStudents($stlist);
		}
	}
	$regform->showRegisterForm($stlist, $result, "student.php"); 
}
else if ($action == "showregister"  || $action == "updateregister" ) { 
	if ($action == "updateregister") {
		if(empty($_REQUEST['reset'])) {
			$result = $regform->toSemesterSchool();
		}
	}
	$regform->listRegisterStudentTable("student.php", $result);
}

/******************************************************/

else if ($action == "sendclassemail") {
	$email_title = "";
	$email_msg = "";
	if (isset($_SESSION['email_title'])) {
		$email_title = $_SESSION['email_title'];
	}
	if (isset($_SESSION['email_message'])) {
		$email_msg = $_SESSION['email_message'];
	}
	
	$emailform->showClassEmailForm($classes, '', $email_title, $email_msg, 0, '', "student.php");	
}
else if ( $action == "sendmailtomember" ) {
	if(!empty($_REQUEST['reset'])) {
		$emailform->showClassEmailForm($classes, '', "", "", 0, '', "student.php");	
	}
	else {
		if(!empty($_REQUEST['viewmail']))  
		{
			$emailform->showSendClassEmailForm(1, "student.php");
		}
		else {
			$emailform->showSendClassEmailForm(0, "student.php");
		}
	}
}
else if ($action == "sendtoparents" ) {
	$sendtype = 1;
	if(!empty($_REQUEST['reset'])) {
		$emailform->showEmailForm('', '', '', 0, 0, '', "student.php");	
	}
	else {
		if(!empty($_REQUEST['viewmail']))
			$sendtype = 0;
		$emailform->showSendEmailForm($sendtype, "student.php");
	}
}
else if ($action == "emailtoparents" ){
	$emailform->showEmailForm('', '', '', 0, 0, '', "student.php");	
}

/*********** for summer school ***************/
else if ($action == "allteststudents" || $action == "updatetestclass") {
	if ($action == "updatetestclass") {
		$memmberList = new MemberList();
		$memmberList->updateAllTestStudentClassName();
	}
	$summermemberform->listToTestMemberTable("student.php") ;
}

else if (($action == "summerstudents") || ($action == "updatesummerstudents")) {
	if ($action == "updatesummerstudents") {
		if (empty($_REQUEST['reset']))
			$summermemberform->addSummerStudents();
	}
	$summermemberform->listMemberTable("student.php");
}

else if ($action == "summerresults" || $action == "updatesummerresults" ) {
	if ($action == "updatesummerresults") {
		if (!empty($_REQUEST['winner'])) {
				$summermemberform->writeTestWinner();
		}
		else if (empty($_REQUEST['reset'])) {
			$summermemberform->addSummerStudentsScores();
		}
	}
	$summermemberform->listMemberScoreTable("student.php");
}
else if ($action == "importtest") {
	$excelform->showTestImportForm();
	$excelform->showImportForm($excelscore, $semester, $period);
}
else if ($action == "importtestscore" ) {
	$lsccores = $excelform->getImportTestScores();
	$summermemberform->showMemberScoreTable($lsccores);
}
else if ($action == "sendtoplacement" ) {
	if(empty($_REQUEST['viewmail'])) {
		$summermemberform->showSendEmailForm(1, "student.php");
	}
	else {
		$summermemberform->showSendEmailForm(0, "student.php");
	} 
}
else if ($action == "emailtoplacement"){
	$summermemberform->showEmailForm("","","",0, "student.php");	
}

else if ($action == "ttreport") {
	$summermemberform->showTTStudentsScores("", $testyear, 0, "student.php");
}
else if ($action == "findttresult") {
	$stid = getPostValue("mystudentid");
	$summermemberform->showTTStudentsScores($stid, $testyear, 0, "student.php");
}
else if ($action == "findmytestresult") {
	$stid = getPostValue("mystudentid");
	$summermemberform->showSummerStudentsScores($stid);
}

/**************** class and teacher **********************/
else if ($action == "updateclassteacher") {
	$newtab = '';
	if(empty($_REQUEST['reset']))   {
		$newtab = $ctform->writeTeacher();
		$result = "Update Class Name and Teacher successfully!";
	}
	$ctform->showClassTeacherTable($newtab, $result, "student.php");
}
else {
	$ctform->showClassTeacherTable('', $result, "student.php");
}
?>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>	
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<?php 
include "../php/footer.php";
}else {
include "../php/empty.php"; 
}
?>

