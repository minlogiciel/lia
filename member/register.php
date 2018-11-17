<?php
include "../php/allinclude.php";
session_start();

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");

$regform = new RegisterForm();
$stlist = "";
$result = "";
if ($action == "registerstudent") {
	if(empty($_REQUEST['reset'])) {
		$stlist = $regform->getRegisterData();
		$result= $regform->addNewStudents($stlist);
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
			if ($stlist && !$result)
				$regform->showRegisterFormOK($stlist); 
			else {
				$regform->showRegisterForm($stlist, $result, "register.php"); 
			}
		?>
		</div>
		<div><img src="../images/box_bg.gif"></div>
	</div>
	<div class="right">
		<?php include "../php/right.php" ?>
	</div>
</div>
<?php include "../php/foot1.php"; ?>

</BODY>
</html>
