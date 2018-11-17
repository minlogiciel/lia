<?php
include ("../php/allinclude.php");
include ("../forum/forum_base.php");
session_start();
include '../Excel/excel_include.php';

$remoteip = $_SERVER['REMOTE_ADDR'];
if (isAdminAllowed($remoteip))
{

$action = isset($_POST["action"]) ? $_POST["action"] : (isset($_GET["action"]) ? $_GET["action"] : "");
$mtype = isset($_POST["mtype"]) ? $_POST["mtype"] : (isset($_GET["mtype"]) ? $_GET["mtype"] : 1);
$actiontype = isset($_POST["actiontype"]) ? $_POST["actiontype"] : (isset($_GET["actiontype"]) ? $_GET["actiontype"] : "");
$semester = isset($_GET["semester"]) ? $_GET["semester"] : (isset($_POST["semester"]) ? $_POST["semester"] : "");
$period = isset($_GET["period"]) ? $_GET["period"] : (isset($_POST["period"]) ? $_POST["period"] : 0);
$nindex = isset($_GET["nindex"]) ? $_GET["nindex"] : (isset($_POST["nindex"]) ? $_POST["nindex"] : -1);
$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 4);

$student = "";
$studentform = "";
$emailform= "";
$excelform = "";
$memberform = "";
$summermemberform = "";
$result = "";
$result2 = "";
$sform = "";
$annocestr = "";
$lastnewsstr = "";
$newtab = "";
if ($actiontype == "announcement") {
	$announceform = new AnnounceForm();
	if ($action == "updateannounce") {
		$annocestr = $announceform->writeAnnounce(0);
		$result = "Update Annoncement successfully!";
	}
	else if ($action == "updatelastnews") {
		$lastnewsstr = $announceform->writeAnnounce(1);
		$result2 = "Update Last News successfully!";
	}
}
else if ($actiontype == "classteacher") {
	$sform = new ClassTeacherForm();
	if ($action == "updateclassteacher") {
		if(empty($_REQUEST['reset']))   {
			$newtab = $sform->writeTeacher();
			$result = "Update Class Name and Teacher successfully!";
		}
	}
}
else if ($actiontype == "ttreport") {
	$summermemberform = new SummerMemberForm();
	$testyear = isset($_POST["testyear"]) ? $_POST["testyear"] : (isset($_GET["testyear"]) ? $_GET["testyear"] : 2012);	
}
else if ($actiontype == "admissiontype") {
	$admiform = new AdmissionForm();
	if (($action == "updateadmission") && empty($_REQUEST['addnewline'])) { 
		$newtab = $admiform->writeAdmission();
		$result = "Modified Admission successfully!";  
	}
}
else if ($actiontype == "testtakertype") {
	$admiform = new TestTakerForm();
	if (($action == "updatetesttaker") && empty($_REQUEST['reset'])) { 
		$admiform->WriteTestTakeTable();
		$result = "Modified TestTakers successfully!";
	}
}
else if ($actiontype == "regentstype") {
	$admiform = new RegentsForm();
	if (($action == "updatetesttaker") && empty($_REQUEST['reset'])) { 
		$admiform->WriteTestTakeTable();
		$result =  "Modified Regents successfully!"; 
	}
}
else if ($actiontype == "schedulemenutype" || $actiontype == "schedulemenunametype") {
	$admiform = new ScheduleMenu();
	if (($action == "modifymenu") && empty($_REQUEST['reset'])) { 
		$newtab = $admiform->WriteScheduleMenu();
		$result = "Modified Class Schedule Menu successfully!";
	}
	else if (($action == "modifymenuname") && empty($_REQUEST['reset'])) { 
		$newtab = $admiform->WriteScheduleMenuName();
		$result = "Modified Class Schedule Menu Name successfully!";
	}
}
else if ($actiontype == "homepagetype" || $actiontype == "homepagephototype") {
	$admiform = new HomePageForm();
	if (($action == "modifyhomepage") && empty($_REQUEST['reset'])) { 
		$newtab = $admiform->WriteHomePage();
		$result = "Modified Home Page successfully!";
	}
	else if (($action == "loadhomepagephoto") && empty($_REQUEST['reset'])) { 
		$newtab = $admiform->WriteHomePagePhoto();
		$result = "Upload Photos successfully!";
	}
}

else if ($actiontype == "sattype") {
	$psatform = new PSATForm();
	if ($action == "updatepsat") {
		$psatform->WritePSATTable();
		$result2 = "Update PSAT Schedule successfully!";
	}
	$satform = new SATForm();
	if ($action == "updatesat") {
		if(empty($_REQUEST['addnewline']))   {
			$satform->WriteSatTable();
			$result = "Update SAT Schedule successfully!";
		}
	}
}
else if ($actiontype == "homerighttype") {
	$sform = new HomeRightForm();
	
	if ($action == "updaterightitem") {
		if(!empty($_REQUEST['viewtiming'])) {
			$newtab = $sform->viewHomeRightTable();
		}
		else {
			$newtab = $sform->WriteHomeRightTable($nindex);
			if(empty($_REQUEST['addnewline'])) {
				$result = "Update Home Right information successfully!";
			}
		}
	}	
}
else if ($actiontype == "homerightpagetype") {
	$sform = new HomeRightForm();
	
	if ($action == "updatehomerightpage") {
		$newtab = $sform->WriteHomeRightPage();
	}	
}
else if ($actiontype == "apsatinfotype" || $actiontype == "coursinfotype") {
	$sform = new CoursInfoForm();
	if ($action == "updateapsat") {
		$newtab = $sform->WriteAPSATTable();		
		if(empty($_REQUEST['addnewline'])) {
			$result = "Update AP SAT II programs information successfully!";
		}
	}
	else if ($action == "updatecours") {
		$newtab = $sform->WriteCoursTable();
		if(empty($_REQUEST['addnewline'])) {
			$result = "Update Saturday Cours Information successfully!";
		}
		
	}
}

/***********************/
else if ($actiontype == "scheduletype" || $actiontype == "acttype") {
	$sform = new ScheduleForm();
	if ($action == "updateschedule" && empty($_REQUEST['addnewline'])) {
		if ($actiontype == "scheduletype") {
			$sform->WriteScheduleTable($SCHEDULE_ELEM);
			$result = "Update Schedule successfully!";
		}
		else if ($actiontype == "acttype") {
			$sform->WriteScheduleTable($ACT_ELEMS);
			$result = "Update ACT Schedule successfully!";
		}
	}
}
else if ($actiontype == "showreportform" || $actiontype == "showreportlist") {
	$sform = new ReportForm();
	if ($action == "createreport") {
		$sform->createReport($classes, $period, $semester);
	}
}

else if ($action == "register" || $action == "registerstudent" || $action == "showregister"  || $action == "updateregister" ) {
	$regform = new RegisterForm();
	$stlist="";
	if ($action == "registerstudent") {
		if(empty($_REQUEST['reset'])) {
			$stlist = $regform->getRegisterData();
			$result = $regform->addNewStudents($stlist);
		}
	}
	else if ($action == "updateregister") {
		if(empty($_REQUEST['reset'])) {
			$regform->toSemesterSchool();
		}
	}
}
/***************/
else if ($action == "allstudents" || $action == "oldstudents" || $action == "updateclass" || $action == "managestudents" || $action == "cleanstudents") {
	/* action update all students class name */
	if ($action == "updateclass") {
		$memmberList = new MemberList();
		$memmberList->updateAllStudentClassName();
		$result = "Modified Student's class name successfully!";
	}
	else if ($action == "cleanstudents") {
		$memmberList = new MemberList();
		$memmberList->manageStudentClassName();
		$result = "Clean Student successfully!";
	}
	$memberform = new MemberForm();
}
else if (($action == "newstudent") || ($action == "addnewstudent") || 
		($action == "nonamestudent") || ($action == "addnonamestudent")) {
	$studentform = new StudentForm();	
	if ($action == "addnewstudent") {
		if(empty($_REQUEST['reset']))  
		{  
			$student = $studentform->getStudentData();
			$err = $studentform->addNewStudent($student);
			if (!$err) {
				$memberform = new MemberForm();
				$result = "Added student successfully!";
			} 
		}
		else {
			$student = '';
		}
	}
	else if ($action == "addnonamestudent") {
		$studentform->addNoNameStudent();
		$memberform = new MemberForm();
		$result = "Added student no name successfully!";
	}
}
else if ($action == "createreport" || $action == "allteststudents" ) {
	$memberform = new MemberForm();
}

else if ($action == "emailtoparents" || $action == "sendtoparents" || 
		 $action == "sendclassemail" || $action == "sendmailtomember" ) {
	$emailform = new EmailForm();
}
else if ($action == "importform" || $action == "importtest") {
	$excelform = new ExcelForm();
	$excelscore = "";
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
		if (empty($_REQUEST['reset'])) {
			$summermemberform->addSummerStudentsScores();
			$summermemberform->writeTestWinner();
		}
	}
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
	$sform = new ClassTeacherForm();
	$actiontype = "classteacher";
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
<script language="javascript" type="text/javascript" src="../scripts/classvar.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/scores.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/schedulemenu.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/schedule.items.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/photo.items.js"></script>

<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
<tr>
	<td width=180 valign=top class=ITEMS_BG><?php include "adminleft.php"; ?></td>

<?php if ($mtype == $HOMEWORK_TYPE) {?>
	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td  valign=top class=background>
				<?php include ("../homework/homework.php"); ?>
			</td>
		</tr>
		<tr>
			<td  height=10 class=background>	</TD>
		</tr>
		</table>
	</td>
		
<?php }	else if ($actiontype == "classteacher") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td  valign=top>
				<?php $sform->showClassTeacherTable($newtab, $result); ?>
			</td>
		</tr>
		</table>
	</td>

<?php } else if ($actiontype == "announcement") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top>
			<?php 
				$announceform->ShowAnnouncementForm(0, $annocestr, $result);
			?>
			</td>
		</tr>
		<tr>
			<td  height=10 class=background>	</TD>
		</tr>
		<tr>
			<td valign=top>
			<?php 
				$announceform->ShowAnnouncementForm(1, $lastnewsstr, $result2);
			?>
			</td>
		</tr>
		<tr>
			<td height=10 class=background>	</TD>
		</tr>
		</table>
	</td>


<?php } else if ($actiontype == "ttreport") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				if ($testyear == 2012) {
					$summermemberform->showSummerStudentsScores(0,0);
					
				}
				else {
					$summermemberform->showTTStudentsScores(0,$testyear, 0);
				}
			?>
			</td>
		</tr>
		</table>
	</td>
	
	
<?php } else if ($actiontype == "acttype") { ?>
	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td  valign=top class=background>
			<?php 
				$sform->ShowScheduleTable($ACT_ELEMS, $result);
			?>
			</td>
		</tr>
		</table>
	</td>

<?php }	else if ($actiontype == "scheduletype") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td  valign=top>
				<?php $sform->ShowScheduleTable($SCHEDULE_ELEM, $result);?>
			</td>
		</tr>
		</table>
	</td>


<?php } else if ($actiontype == "sattype") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$psatform->ShowPSATTable($result2);
			?>
			</TD>
		</tr>
		<tr>
			<td width=100% valign=top class=background>
			<?php 
				$satform->ShowSATTable($result);
			?>
			</TD>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "homerighttype") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$sform->ShowHomeRightTable($newtab, $nindex, $result);
			?>
			</TD>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "homerightpagetype") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$sform->showHomeRightPageForm($newtab, $result);
			?>
			</TD>
		</tr>
		</table>
	</td>

<?php } else if ($actiontype == "apsatinfotype") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$sform->ShowAPSATTable($newtab, $result);
			?>
			</TD>
		</tr>
		</table>
	</td>

<?php } else if ($actiontype == "coursinfotype") { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$sform->ShowCoursInformationTable($newtab, $result);
			?>
			</TD>
		</tr>
		</table>
	</td>

<?php } else if ($actiontype == "admissiontype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->ShowAdmissionTable($nindex, $result, $newtab);
			?>
			</td>
		</tr>
		</table>
	</td>
		
<?php } else if ($actiontype == "testtakertype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->ShowTestTakeTable($result);
			?>
			</td>
		</tr>
		</table>
	</td>
		
<?php } else if ($actiontype == "regentstype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->ShowRegentsTable($result);
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "schedulemenutype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->showSchduleMenuForm($newtab, $result);
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "schedulemenunametype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->showSchduleMenuNameForm($newtab, $result);
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "homepagetype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->showHomePageForm($newtab, $result);
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "homepagephototype") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$admiform->showHomePagePhotoForm($newtab, $result);
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "showreportform") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$sform->showReportForm();
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($actiontype == "showreportlist") {?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
			<?php 
				$sform->showReportList();
			?>
			</td>
		</tr>
		</table>
	</td>
<?php } else if ($action == "showregister" || $action == "updateregister" || $action == "register" || $action == "registerstudent") { ?>
		<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td class=error height=30><?php echo($result); ?></td>
		</tr>
		<tr>
			<td valign=top class=background>
			<?php 
			if ($action == "showregister" || $action == "updateregister")
				$regform->listRegisterStudentTable(); 
			else {
				if ($stlist && !$result)
					$regform->showRegisterFormOK($stlist); 
				else
					$regform->showRegisterForm($stlist, $result); 
			}
			?>
			</td>
		</tr>
		</table>
	</td>						
<?php } else if ($studentform || $memberform || $emailform) { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td class=error height=30><?php echo($result); ?></td>
		</tr>
		
		<tr>
			<td valign=top class=background>
<?php 
		if ($studentform) {
			if (($action == "nonamestudent") || ($action == "addnonamestudent")) {
				$studentform->showNoNameStudentForm("admin.php");
			}
			else {
				$studentform->showStudentForm($student, "admin.php");
			}
		}
		else if ($memberform) { 
			if ($action == "oldstudents") {
				$memberform->listClassMemberTable($OLD_STUDENT_CLASS, 0, "admin.php" ) ;
			}
			else if ($action == "managestudents" || $action == "cleanstudents") {
				$memberform->ManageStudentForm() ;
			}
			else if ($action == "allteststudents" || $action == "updatetestclass") {
				$memberform->listTestMemberTable() ;
			}
			else if ($action == "createreport") {
				$cr = new CreateReport();
				$cr->init($semester, $period);
				$cr->createAllStudentReport();
			}
			else {
				$memberform->listClassMemberTable(-1, 0, "admin.php", $semester, $period) ;
			}
		} 
		else if ($emailform) {
			if (($action == "sendtoparents" ) && empty($_REQUEST['reset'])) {
				$sendtype = 1;
				$emailid = isset($_POST["emailid"]) ? $_POST["emailid"] : (isset($_GET["emailid"]) ? $_GET["emailid"] : "");
				if ($emailid) {
					$emailform->showReSendEmailForm($emailid, "admin.php");
				}
				else {
					if(!empty($_REQUEST['viewmail']))  
					{
						$sendtype = 0;
					
					} 
					$emailform->showSendEmailForm($sendtype, "admin.php");
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
				
				$emailform->showClassEmailForm($classes, '', $email_title, $email_msg, 0, '', "admin.php");	
			}
			else if ( $action == "sendmailtomember" ) {
				if(!empty($_REQUEST['viewmail']))  
				{
					$emailform->showSendClassEmailForm(1, "admin.php");
				}
				else {
					$emailform->showSendClassEmailForm(0, "admin.php");
				}
			}
			else {
				$emailform->showEmailForm('', '', '', 0, 0, '', "admin.php");	
			}
		}
?>	
			</td>
		</tr>
		</table>
	</td>	

<?php } else if ($summermemberform) { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td class=error height=30><?php echo($result); ?></td>
		</tr>
		
		<tr>
			<td valign=top class=background>
<?php 
	if ($action == "summerresults" || $action == "updatesummerresults" ) {
		$summermemberform->listMemberScoreTable();
	}
	else if ($action == "summerstudents" || $action == "updatesummerstudents" ) {
		$summermemberform->listMemberTable();
	}
	else if ($action == "importtestscore" ) {
		$excelform = new ExcelForm();
		$lsccores = $excelform->getImportTestScores();
		$summermemberform->showMemberScoreTable($lsccores);
	}
	else if ($action == "emailtoplacement" || $action == "sendtoplacement" ) {
		if ($action == "sendtoplacement" ) {
			if(empty($_REQUEST['viewmail']))  
			{
				$summermemberform->showSendEmailForm(1, "");
			}
			else {
				$summermemberform->showSendEmailForm(0, "");
			} 
		}
		else {
			$summermemberform->showEmailForm("","","",0, "");	
		}
	}
	else if ($action == "ttreport") {

		$summermemberform->showTTStudentsScores("", $testyear, 0);
	}
	else if ($action == "findttresult") {
		$stid = getPostValue("mystudentid");
		$summermemberform->showTTStudentsScores($stid, $testyear, 0);
	}
	else if ($action == "findmytestresult") {
		$stid = getPostValue("mystudentid");
		$summermemberform->showSummerStudentsScores($stid);
	}
	else {
		$summermemberform->showSummerStudentsScores("");
	}
?>
			</td>
		</tr>
		</table>
	</td>	


<?php } else if ($excelform) { ?>

	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
<?php 
	if ($action == "importtest") {
		$excelform->showTestImportForm("admin.php");
	}
	else {
		$excelform->showImportForm($excelscore, $semester, $period);
	}
?>
			</td>
		</tr>
		</table>
	</td>	
		
<?php } else { ?>
	<td width=770 valign=top>
		<table width=100% cellspacing=0 cellpadding=0 align=center border=0>
		<tr>
			<td valign=top class=background>
				<?php $sform->listScheduleTable(); ?>
			</td>
		</tr>
		</table>
	</td>

<?php } ?>

</TR>
</table>
<?php
include "../php/footer.php";
} else {
include "../php/empty.php"; 
}
?>
