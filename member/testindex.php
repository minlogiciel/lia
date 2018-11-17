<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Long Island Academy</title>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<?php 
include "../php/allinclude.php";
include "testitems.php";

$remoteip = $_SERVER['REMOTE_ADDR'];
if (isAdminAllowed($remoteip))
{
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$studentid = isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);

$summermemberform = new SummerMemberForm();

if ($action == "updatetestdetail") {
	if (empty($_REQUEST['reset']))
		$summermemberform->addStudentDetails();

}

}

?>

<BODY > <CENTER>
<TABLE  width=600 cellspacing=0 cellpadding=0 align=center bgColor=#FFFFFF>
<TR>
	<TD valign=top>
		<TABLE  width=100% cellspacing=0 cellpadding=0 align=center>
		<TR>
			<TD valign=top>
				<TABLE  width=100% cellspacing=0 cellpadding=0 align=center >
				<TR>
					<TD valign=top>
						<?php $summermemberform->showStudentScoreDetail($studentid); ?>
					</TD>
				</TR>
				<TR><TD height=30 width=100%></TD></TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

</TABLE>

</CENTER>
</body>
</html>


