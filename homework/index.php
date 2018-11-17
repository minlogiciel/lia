<?php 
include "../php/allinclude.php";
session_start();

include ("../php/title1.php");
$form = new HomeworkForm();
?>
<BODY>
<?php include "../php/maintitle.php"; ?>
<div class="content">
	<div class="left">
		<?php $form->showHomeworkList(); ?> 
	</div>

	<div class="right">
		<?php include "../php/right.php" ?>
	</div>
</div>
<?php include "../php/foot1.php"; ?>
</BODY>
</html>
