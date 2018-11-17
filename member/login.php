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

$action = isset($_POST["action"]) ? $_POST["action"] : "";


$err = '';
$result = '';
$resulttitle = '';

$savetobase = $action;

$loginform = new LoginForm();
$loginok = 0;

if ($action == "login") {
	$loginclass = new LoginClass();
	$student = $loginclass->getLogin();
	if ($student) {
		$_SESSION['log_user_id'] = $student->getID();
		$loginok = 1;
		$ACTIVE_LOGIN = 1;
	}
	else {
		unset($_SESSION['log_user_id']);
		$err = $loginclass->getError();
		$ACTIVE_LOGIN = 0;
	}	
}
else if ($action == "changepass") 
{
	if(empty($_REQUEST['reset'])) 
	{
		$loginclass = new LoginClass();
		if ($loginclass->changePassword()) {
			$result = "Your password has been changed!";
			$resulttitle = "Change Password";
		}
		$err = $loginclass->getError();
	}
	$student = '';
	if (isset($_SESSION['log_user_id'])) {
		$studentid = $_SESSION['log_user_id'];
		$student = new StudentClass();
		if ($student->getUserByID($studentid)) {
			$loginok = 1;
		}
	}
}
else if ($action == "changeinfo") 
{
	if(empty($_REQUEST['reset']))  
	{  
		$loginclass = new LoginClass();
		$student = $loginclass->changeInfo();
		if ($student) {
			//$_SESSION['log_user'] = $student;
			$_SESSION['log_user_id'] = $student->getID();
			$result = "Your address has been changed!";
			$resulttitle = "Change Profile";
		}
	}
	$student = '';
	/*if (isset($_SESSION['log_user'])) {
		$student = $_SESSION['log_user'];
		$loginok = 1;
	} */
	if (isset($_SESSION['log_user_id'])) {
		$studentid = $_SESSION['log_user_id'];
		$student = new StudentClass();
		if ($student->getUserByID($studentid)) {
			$loginok = 1;
		}
	}

}
else if ($action == "getpasswd") {
	$loginclass = new LoginClass();
	$result = $loginclass->getForgotPassword();
	if ($result[0] == '!') {
		$err = substr($result, 1);
		$result = '';
	}
	else {
		$resulttitle = "Get Password";
	}
	$student = '';
	/*if (isset($_SESSION['log_user'])) {
		$student = $_SESSION['log_user'];
	}*/
	if (isset($_SESSION['log_user_id'])) {
		$studentid = $_SESSION['log_user_id'];
		$student = new StudentClass();
		if ($student->getUserByID($studentid)) {
			$loginok = 1;
		}
	}
}
else {
	$student = '';
	if (isset($_SESSION['log_user_id'])) {
		$studentid = $_SESSION['log_user_id'];
		$student = new StudentClass();
		if ($student->getUserByID($studentid)) {
			$loginok = 1;
		}
	}
	/*if (isset($_SESSION['log_user'])) {
		$student = $_SESSION['log_user'];
		$loginok = 1;
	}*/
}
$tuto = 0;
if ($student) {
	$cls = $student->getClasses();
	if ($cls == $CLASS_NAME[count($CLASS_NAME)-2]) {
		$tuto = 1;
	}
	$savetobase .= " for " .$student->getStudentName(). " OK!";
}
else {
	if (isset($_POST['log_name']))
		$savetobase .= " for " .$_POST['log_name']. " KO!";
}
?>
<script language="JavaScript" type="text/javascript"> 
function active_save() 
{ 
	document.getElementById("saveinofid").disabled='';
} 
function active_savepasswd() 
{ 
	document.getElementById("savepasswdid").disabled='';
} 
function loadSession(url, value) 
{ 
	window.open(url+'&dates='+value,'_self');
} 
</script> 
<?php 
include ("../php/title1.php");
?>

<BODY>
<?php include "../php/maintitle.php"; ?>
<div class="content">
	<div class="left">
		<div class="left_box">

<?php 
		if ($loginok && ($action == "login") && $tuto) { 
			$sessionform = new PrivateForm();
			$sessionform->showTeacherPrivateSessionForStudent("", "", "", $student->getID());
		} else { 
			if ($err) {
				echo("<DIV align=center>".$err."</DIV>"); 
			}
			if ($result) {
				$loginform->showResultForm($resulttitle, $result);
			}
			else {
				if ($loginok) {
					if ($action == "login") {
						$loginform->showMyAccountDetailForm($student);
					}
					else {
						$loginform->getAccountForm($student);
					}
				} else { 
					$loginform->getLoginForm();
				}
			}	 
		} 
?>
		</div>
		<div><img src="../images/box_bg.gif"></div>
	</div>
	<div class="right">
		<?php include "../member/indexright.php"; ?>
		<?php include "../php/right.php"; ?>
	</div>
</div>
<?php include "../php/foot1.php"; ?>

</BODY>
</html>

