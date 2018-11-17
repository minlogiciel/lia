<?php 
include "homework_include.php";


$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 0);
$hindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : -1);

$homework = "";
$form = new HomeworkForm();
if ($action == "uploadhomework") {
	$homework = $form->uploadHomework();
}

?>

<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td width=750 valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD>
				<?php 
					if ($action == "listhomework" ) {
						$form->showHomeworkList(); 
					}
					else if ($action == "modifyhomework") {
						$form->showHomeworkList(1); 
					}
					else {
						$form->showUploadHomeForm($homework, $classes, $hindex); 
					}
				?>
					</TD>
				</TR>
				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
