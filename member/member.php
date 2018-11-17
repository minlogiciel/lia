<?php
include "../php/allinclude.php";
session_start();
include "../teacher/TeacherForm.php";
include '../Excel/excel_include.php';

$remoteip = $_SERVER['REMOTE_ADDR'];
if (isAdminAllowed($remoteip))
{

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 0);
$studentid = isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);
$subjects = isset($_GET["subjects"]) ? $_GET["subjects"] : (isset($_POST["subjects"]) ? $_POST["subjects"] : "");
$teacherid = isset($_GET["teacherid"]) ? $_GET["teacherid"] : (isset($_POST["teacherid"]) ? $_POST["teacherid"] : 0);

$semester = isset($_GET["semester"]) ? $_GET["semester"] : (isset($_POST["semester"]) ? $_POST["semester"] : "");
$period = isset($_GET["period"]) ? $_GET["period"] : (isset($_POST["period"]) ? $_POST["period"] : 0);
$createdpdf = isset($_GET["createdpdf"]) ? $_GET["createdpdf"] : (isset($_POST["createdpdf"]) ? $_POST["createdpdf"] : 0);

$testyear = isset($_GET["testyear"]) ? $_GET["testyear"] : (isset($_POST["testyear"]) ? $_POST["testyear"] : 2014);

$err = '';
$ok = 0;
$scoresform = '';
$memberform = '';
$studentform = '';
$student = '';
$scoreslists = '';
$groups = '';
$tuitionform = '';
$emailform = '';
$result = '';
$teacherform = '';
$teacherdata = '';
$summermemberform = '';
$excelform= '';

if (($action == "allteachers") || ($action == "newteacher") || ($action == "addnewteacher")) {
	$teacherform = new TeacherForm();
	if ($action == "addnewteacher") {
		$teacherdata = $teacherform->getTeacherData();
		if(empty($_REQUEST['reset'])) {
			$teacherform->addNewTeacher($teacherdata);
			$result = "Teacher has been added.";
		}
	}
}
else if (($action == "teacherprofil") || ($action == "changeteacherprofil") ||  ($action == "delteachers") ) {
	$teacherform = new TeacherForm();
	if ($action == "changeteacherprofil") {
		if(empty($_REQUEST['reset'])) {
			$teacherdata = $teacherform->changeTeacherProfil();
			$teacherid = $teacherdata->getID();
			$result = "Teacher profile has been changed.";
		}
	}
	if ($action == "delteachers") {
		$teacherform->deleteTeacher();
	}	
}

else if ($action == "classmember" || $action == "showdelmember" || $action == "allstudents" || $action == "createreport" || $action == "allteststudents" ) {
	$memberform = new MemberForm();
}
else if ($action == "studentscores") {
	$studentform = new StudentForm();

}
else if ($action == "studentprofil") {
	$memberform = new MemberForm();
}
else if ($action == "changeprofil") {
	$memberform = new MemberForm();
	if(empty($_REQUEST['reset'])) {
		if ($memberform->changeStudentProfil()) {
			$result = "Student Profil has been changed.";
		}
	}
}
else if ($action == "delmember") {
	$memmberList = new MemberList();
	$memmberList->deleteMember();

	$memberform = new MemberForm();
}
else if ($action == "updateclass") {
	$memmberList = new MemberList();
	$memmberList->updateAllStudentClassName();

	$memberform = new MemberForm();
}
else if ($action == "updatetestclass") {
	$memmberList = new MemberList();
	$memmberList->updateAllTestStudentClassName();

	$memberform = new MemberForm();
}
else if ($action == "delscores") {
	$scoresform = new ScoresForm();
	$scoresform->deleteScoresList();
	
}
else if ($action == "showscores"  || $action == "updatescores" || $action == "changescores") {
	$groups = isset($_GET["groups"]) ? $_GET["groups"] : (isset($_POST["groups"]) ? $_POST["groups"] : "");
	$scoresform = new ScoresForm();
	
	if ($action == "changescores" ) {
		if(empty($_REQUEST['reset'])) {
			$scoreslists = $scoresform->updateScoresList($groups); 
			$result = "Scores have been changed.";
		}
	}
}

else if ($action == "showtuition" || $action == "updatetuition") {
	$tuitionform = new TuitionForm();
	if ($action == "updatetuition") {
		if(empty($_REQUEST['reset'])) {
			$tuitionform->updateTuitionList();
			$result = "Tuitions have been changed.";
		}
	}
}

else if ($action == "inputscores" || $action == "savescores" || $action == "viewscores") {
	$scoreslists = "";
	$scoresform = new ScoresForm();
	if(empty($_REQUEST['reset']))  
	{  
		if (!empty($_REQUEST['viewscores']) || ($action == "viewscores")) {
			$scoreslists = $scoresform->getScoreslist();
		}
		else if ($action == "savescores") {	
			$scoreslists = $scoresform->addNewScoresList();
			$result = "Scores have been saved.";
			//$scoreslists = "";
			$action = "showscores";
		}
	}
}

else if (($action == "newstudent") || ($action == "addnewstudent")) {
	$studentform = new StudentForm();
	
	if ($action == "addnewstudent") {
		if(empty($_REQUEST['reset']))  
		{  
			$student = $studentform->getStudentData();
			$err = $studentform->addNewStudent($student);
			if (!$err) {
				$memberform = new MemberForm();
				$result = "Student has been added.";
			} 
		}
		else {
			$student = '';
		}
	}
}
else if (($action == "nonamestudent") || ($action == "addnonamestudent")) {
	$studentform = new StudentForm();
	
	if ($action == "addnonamestudent") {
		$studentform->addNoNameStudent();
		$memberform = new MemberForm();
		$result = "No Name Student has been added.";
	}
}
else if ($action == "emailtoparents" || $action == "sendtoparents") {
	$emailform = new EmailForm();
}
else if ($action == "summerstudents" || $action == "updatesummerstudents" || 
		$action == "summerresults"  || $action == "updatesummerresults" || $action == "importtestscore" || 
		$action == "trophyawards" ||  $action == "findmytestresult" ||
		$action == "ttreport" || $action == "findttresult" ||
		$action == "emailtoplacement" || $action == "sendtoplacement") {
	$summermemberform = new SummerMemberForm();
	if ($action == "updatesummerstudents") {
		if (empty($_REQUEST['reset']))
			$summermemberform->addSummerStudents();
	}
	else if ($action == "updatesummerresults") {
		if (empty($_REQUEST['reset']))
			$summermemberform->addSummerStudentsScores();
	}
	if (1) {
		$summermemberform->writeTestWinner();
	}
}
else if ($action == "sendclassemail" || $action == "sendmailtomember" ) {
	$emailform = new EmailForm();
}
else if ($action == "savestudentmember") {
	$memberform = new MemberForm();
	if(empty($_REQUEST['reset']) && empty($_REQUEST['showdeleted']) )  
	{  
		$err = $memberform->saveClassMember();
	}
}
else if ($action == "importform" || $action == "importtest") {
	$excelform = new ExcelForm();
	$excelscore = "";
}
else if ($action == "importexcel") {
	$excelform = new ExcelForm();
	$excelscore = $excelform->getNewScores();
	if ($excelscore->isOK()) {
		if (empty($_REQUEST['viewscores'])) {
			$excelscore->addNewScoresList();
			$result = $excelscore->getSubjects(). " test scores for class ". $excelscore->getClasses(). " have been imported.";
		}
		else {
			$scoresform = new ScoresForm();
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
else {
	$memberform = new MemberForm();
}

$export = new ExportClass();
if ($export->shouldExport()) {
//	$export->ExportBase();
}



include "../admin/adminheader.php";
?>
<script language="JavaScript" type="text/javascript"> 
function active_save() 
{ 
	document.getElementById("savebuttonid").disabled='';
} 
function popup_detail(page) {
    Window.open(page, "TESTDetail", "menubar=no, status=no, scrollbars=no, menubar=no, width=400, height=400");
}
function Message() {
    alert("Message sur la ligne 1.nMessage sur la ligne 2.n...")
}
</script> 

<script language="javascript" type="text/javascript" src="../scripts/scores.js"></script>

<TABLE width=950 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD valign=top>
		<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
		<tr>
			<td width=180 valign=top class=ITEMS_BG><?php include "../member/memberleft.php"; ?></td>
			<td width=770 valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  align=center>
						<TR>
							<TD class=formlabel>
							<?php 
								if ($scoresform) {
									getSemesterBar("member.php", $action, 0, $classes, $semester, $period, $subjects);
								}
								else if ($tuitionform) {
									getSemesterBar("member.php", $action, 0, $classes, $semester, $period, '');
								}
								else if ($studentform) {
									getSemesterBar("member.php", $action, $studentid, $classes, $semester, $period, '');
								}
								?>
							</TD>
						</TR>
						<?php if ($err) { ?>
						<TR>
							<TD class=error height=30>
								<DIV align=center><?php echo($err); ?></DIV>
							</TD>
						</TR>
						<?php } ?>
						<TR>
							<TD class=error height=20>
								<DIV align=center><b><?php echo($result); ?></b></DIV>
							</TD>
						</TR>
					
						<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center> 
								<TR>
									<TD>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<TD valign=top>
												<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
												<TR>
													<TD width=100%>
<?php 
if ($excelform) {
	if ($action == "importtest") {
		$excelform->showTestImportForm();
	}
	else {
		$excelform->showImportForm($excelscore, $semester, $period);
	}
}
else if ($scoresform) {
	if ($action == "showscores" || $action == "delscores" ) {
		$scoresform->showClassStudentsScoresList($classes, $subjects, $semester, $period, $createdpdf);
	}
	else if ($action == "updatescores" || $action == "changescores") {
		$scoresform->getUpdateScoresForm($classes, $groups, $subjects);
	}
	else  {												
		$scoresform->showScoresForm($classes, $scoreslists, $subjects, $semester, $period);
	}														
}
else if ($tuitionform) {
	$tuitionform->showTuitionForm($classes, $semester, $period);
}
else if ($studentform) {
	if ($action == "studentscores") {
		$studentform->listStudentScoresTable($studentid, $semester, $period, $createdpdf) ;
	}
	else if (($action == "nonamestudent") || ($action == "addnonamestudent")) {
		$studentform->showNoNameStudentForm();
	}
	else {
		$studentform->showStudentForm($student);
	}
}
else if ($memberform) {
	if ($action == "studentprofil" || $action == "changeprofil") {
		$memberform->getStudentProfilForm($studentid);
	}
	else if ($action == "showdelmember") {
		$memberform->listClassMemberTable($classes, 1, "") ;
	}
	else if ($action == "allstudents") {
		$memberform->listClassMemberTable(-1, 0, "", $semester, $period) ;
	}
	else if ($action == "allteststudents" || $action == "updatetestclass") {
		$memberform->listTestMemberTable() ;
	}
	else if ($action == "createreport") {
		$cr = new CreateReport();
		$cr->init($semester, $period);
		$cr->createAllStudentReport();
		$memberform->listClassMemberTable(-1, 0, "", $semester, $period) ;
	}
	else if ($action == "savestudentmember") {
		if (!empty($_REQUEST['showdeleted']))
			$memberform->ModifyClassMember($classes, 1) ;
		else 
			$memberform->ModifyClassMember($classes, 0) ;
	}
	else if ($action == "oldstudents") {
		$memberform->listClassMemberTable($OLD_STUDENT_CLASS, 0, "") ;
	}
	else if ($action == "updateclass") {
		$memberform->listClassMemberTable(-1, 0, "") ;
	}
	else {
		if ($classes != "-1" && $classes != $OLD_STUDENT_CLASS)
			$memberform->ModifyClassMember($classes, 0) ;
		else
			$memberform->listClassMemberTable($classes, 0, "") ;
		
	}
}
else if ($teacherform) {
	if ($action == "newteacher") {
		$teacherform->showTeacherForm('');	
	}
	else if ($action == "addnewteacher") {
		$teacherform->showTeacherForm($teacherdata);	
	}
	else if ($action == "teacherprofil" || $action == "changeteacherprofil") {
		$teacherform->getTeacherProfileForm($teacherid);	
	}
	else {
		$teacherform->listAllTeachers(0);
	}
}
else if ($summermemberform) {
	if ($action == "summerresults" || $action == "updatesummerresults" ) {
		$summermemberform->listMemberScoreTable();
	}
	else if ($action == "importtestscore" ) {
		$excelform = new ExcelForm();
		$lsccores = $excelform->getImportTestScores();
		$summermemberform->showMemberScoreTable($lsccores);
	}
	else if ($action == "summerstudents" || $action == "updatesummerstudents" ) {
		$summermemberform->listMemberTable();
	}
	else if ($action == "emailtoplacement" || $action == "sendtoplacement" ) {
		if ($action == "sendtoplacement" ) {
			if(empty($_REQUEST['viewmail']))  
			{
				$summermemberform->showSendEmailForm(1, "member.php");
			}
			else {
				$summermemberform->showSendEmailForm(0, "member.php");
			} 
		}
		else {
			$summermemberform->showEmailForm("","","",0, "member.php");	
		}
	}
	else if ($action == "ttreport") {

		$summermemberform->showTTStudentsScores("", $testyear, 0);
	}
	else if ($action == "findttresult") {
		$stid = getPostValue("mystudentid");
		$summermemberform->showTTStudentsScores($stid, $testyear,0);
	}
	else if ($action == "findmytestresult") {
		$stid = getPostValue("mystudentid");
		$summermemberform->showSummerStudentsScores($stid);
	}
	else {
		$summermemberform->showSummerStudentsScores("");
	}
}
else if ($action == "sendclassemail") {
	$email_title = "";
	$email_msg = "";
	if (isset($_SESSION['email_title'])) {
		$email_title = $_SESSION['email_title'];
	}
	if (isset($_SESSION['email_message'])) {
		$email_msg = $_SESSION['email_message'];
	}
	
	$emailform->showClassEmailForm($classes, '', $email_title, $email_msg, 0, '');	
}
else if ( $action == "sendmailtomember" ) {
	if(!empty($_REQUEST['viewmail']))  
	{
		$emailform->showSendClassEmailForm(1);
	}
	else {
		$emailform->showSendClassEmailForm(0);
	}
}
else { 
	if ($action == "emailtoparents" || $action == "sendtoparents" ) {
		if (!$emailform) {
			$emailform = new EmailForm();
		}
		if (($action == "sendtoparents" ) && empty($_REQUEST['reset'])) {
			$sendtype = 1;
			if(!empty($_REQUEST['viewmail']))  
			{
				$sendtype = 0;
			
			} 
			$emailform->showSendEmailForm($sendtype, "");
		}
		else {
			$emailform->showEmailForm('', '', '', 0, 0, '');	
		}
	}
	else {
		echo("<font color=red>error</font>");
	}
}
?>
													</TD>
												</TR>
												</TABLE>
											</TD>
										</TR>
										
										<TR>
											<TD class=error>
												
											</TD>
										</TR>
										</TABLE>
									</TD>
								</TR>
								</TABLE>	
							</TD>
						</TR>
						</TABLE>
					</td>
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
} else {
include "../php/empty.php"; 
}
?>

