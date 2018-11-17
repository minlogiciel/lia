<?php
include "../php/allinclude.php";
session_start();
include "../teacher/TeacherForm.php";


$action 	= isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$teacher 	= isset($_GET["teacher"]) ? $_GET["teacher"] : (isset($_POST["teacher"]) ? $_POST["teacher"] : "");
$startdate	= isset($_GET["startdate"]) ? $_GET["startdate"] : (isset($_POST["startdate"]) ? $_POST["startdate"] : "");

$teacherform = new TeacherForm();

$err = '';
$teacherlogok = 0;

if (isset($_SESSION['login_teacher'])) {
	$logteacher = $_SESSION['login_teacher'];
	if ($logteacher) {
		$teacher = $logteacher;
		$teacherlogok = 1;
	}
}

if ($action == "login") {
	if (isset($_POST['login_name']))
		$log_name = $_POST['login_name'];
	if (isset($_POST['login_passwd']))
		$log_passwd = $_POST['login_passwd'];
		
	$logteacher = new TeacherClass();
	if ($logteacher->getRegistedTeacher($log_name, $log_passwd)) {
		$teacher = $logteacher->getTeacherFullName();;
		$_SESSION['login_teacher'] 	= $teacher;
		$teacherlogok = 1;
	}
	else {
		unset($_SESSION['login_teacher']);
		$err = "Login name or password is not correct.";
	}
}
else if ($action == "updateteacheravailable") {
	if(empty($_REQUEST['reset']))   {
		$teacherform->updateAvailableTime();
	}
}
else if ($action == "logout") {
	if (isset($_SESSION['login_teacher'])) {
		unset($_SESSION['login_teacher']);
		$teacher = '';
		$teacherlogok = 0;
	}
}
else {
/*	if (isset($_SESSION['login_teacher'])) {
		unset($_SESSION['login_teacher']);
		$teacher = '';
		$teacherlogok = 0;
	}
*/
}


include "../php/header.php";
?>
<script language="JavaScript" type="text/javascript"> 
function active_save() 
{ 
	document.getElementById("savebuttonid").disabled='';
} 
</script> 

<TABLE width=950 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD valign=top>
		<table width=100% height=450 cellspacing=0 cellpadding=0 align=center>
		<?php if ($teacherlogok) { ?>
		<tr>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0  align=center>
				<TR>
					<TD class=formlabel>
						<?php getTeacherWeekBar($teacher, $startdate);	?>
					</TD>
				</TR>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD valign=top>
								<?php 
									$teacherform->listWeekTeacherAvailableTable($teacher, $startdate);
								?>
							</TD>
						</TR>
						</TABLE>
					</td>
				</TR>
				</TABLE>
			</td>
		</tr>
		<?php } else { ?>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center> 
				<TR>
					<TD class=error height=40>
						<DIV align=center><?php if ($err) echo($err); ?></DIV>
					</TD>
				</TR>
				<TR>
					<TD>
					<?php 
						$teacherform->getLoginForm();
					 ?>
					</TD>
				</tr>
				</TABLE>
			</TD>
		</TR>
		<?php } ?>
		</table>
	</td>
</tr>
</table>
<?php 
include "../php/footer.php";
?>
										
