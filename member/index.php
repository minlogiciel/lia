<?php

session_start();

include "../php/allinclude.php";

if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $TIME_OUT) {
    	unset($_SESSION['start_time']);
    	$ACTIVE_LOGIN = 1;
    	session_destroy();
       	header("Location: ../home/"); 
    }
}

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 1);
$studentid = isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);
$prog = isset($_GET["programs"]) ? $_GET["programs"] : (isset($_POST["programs"]) ? $_POST["programs"] : "");
$semester = isset($_GET["semester"]) ? $_GET["semester"] : (isset($_POST["semester"]) ? $_POST["semester"] : '');
$period = isset($_GET["period"]) ? $_GET["period"] : (isset($_POST["period"]) ? $_POST["period"] : 0);
$createdpdf = isset($_GET["createdpdf"]) ? $_GET["createdpdf"] : (isset($_POST["createdpdf"]) ? $_POST["createdpdf"] : 0);

$student = '';
$studentform = '';
$loginform = '';
$tuto = 0;
if (isset($_SESSION['log_user_id'])) {
	$studentid = $_SESSION['log_user_id'];
	$student = new StudentClass();
	if (!$student->getUserByID($studentid)) {
		$student = "";
	}
}

if ($student) {
	$cls = $student->getClasses();
	if ($cls == $CLASS_NAME[count($CLASS_NAME)-2]) {
		$tuto = 1;
	}
}

if ($action == "reportcard" || $action == "tuitionbill" || $action =="allscores") {
	if (!$studentid && $student) {
		$studentid = $student->getID();
	}
	if ($studentid) {
		$studentform = new StudentForm(); 
	}
}
else {
	if ($studentid) {
		$studentform = new StudentForm(); 
	}
	else {
		$loginform = new LoginForm();
	}
}
include ("../php/title1.php");
?>

<BODY>
<?php include "../php/maintitle.php"; ?>
<div class="content">
	<div class="left">
		<div class="left_box">
<?php 

if ($action == "reportcard") {
	if ($studentform)  {
		$studentform->listStudentReportTable($studentid, $semester, $period, $createdpdf) ;
	}
}
else if ($action == "tuitionbill") {
	if ($studentform)  {
		$studentform->listStudentTuitionBilling($studentid, $semester, $period, $createdpdf) ;
	}
}
else if ($action == "allscores") {
	if ($studentform)  {
		$studentform->listStudentAllScoresTable($studentid, $semester, $period, $createdpdf) ;
	}
}
else {
	if (!$loginform) {
		$loginform = new LoginForm();
	}
	
	if ($student) {
		if ($tuto) { 
			$sessionform = new PrivateForm();
			$sessionform->showTeacherPrivateSessionForStudent("", "", "", $student->getID());
		} else {
			$loginform->showMyAccountDetailForm($student);
		}
 	} else { 
		$loginform->getLoginForm();
 	}
}													
?>
		</div>
		<div><img src="../images/box_bg.gif"></div>
	</div>
	<div class="right">
		<?php include "../member/indexright.php"; ?>
		<?php include "../php/right.php" ?>
	</div>
</div>
<?php include "../php/foot1.php"; ?>

</BODY>
</html>
