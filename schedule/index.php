<?php 
include "../php/allinclude.php";
include ("../schedule/schedule_var.inc");
include_once ("ImageSchedule.php");
session_start();

$scheduletype = isset($_POST["scheduletype"]) ? $_POST["scheduletype"] : (isset($_GET["scheduletype"]) ? $_GET["scheduletype"] : -1);
if ($scheduletype < 0) {
	$scheduletype = $S_INDEX_MENU[0][2];
}

include ("../php/title1.php");
?>
<BODY>
<?php include "../php/maintitle.php"; ?>
<div class="content">
<div class="left">
	<div class=left_submenu>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
		<TR>
<?php 	
		for ($i = 0; $i< count($S_INDEX_MENU); $i++) { 
			$el = $S_INDEX_MENU[$i];
			if ($el[1]) {
?>
			<TD class=SCHEDULE_BAR height=30>
				<A class=SCHEDULE_BAR href='../schedule/?scheduletype=<?php echo($el[2]); ?>'>
				<?php echo($el[0]); ?>
				</A>
			</TD>
<?php 		} 
		}
?>
		</TR>
		</TABLE>
	</div>
	<div class="left_tab">
	<?php 
	$elem = getMenuImageElementByKey($S_INDEX_MENU, 2, $scheduletype);
	if ($elem) {
		$sch = new ImageSchedule();
		$sch->ShowImageSchdule($elem);
	}
	else {
		switch ($scheduletype) { 
			case $M_REGENTS:
				include "../schedule/RegentsSchedule.php"; 
			break;
			case $M_ACT:
				include "../schedule/page_act.php";
			break;
			case $M_APSAATII:
				include "../schedule/APSATDate.php";
			break;
			case $M_FALL:
				include "../schedule/Fall_Schedule.php"; 
				break;
			case $M_SPRING:
				include "../schedule/SpringSchedule.php"; 
				break;
			case $M_NYSELA:
				include "../schedule/NYSELA.php";
				break;
			case $M_PSAT:
				include "../schedule/page_psat.php";
			break;
			case $M_TAKERS:
				include "../schedule/TestTakerTable.php";
			break;
			case $M_CTY:
				include "../schedule/CTYTable.php";
			break;
			case $M_SAT:
				include "../schedule/SATTable.php";
			break;
			case $M_SUMMER:
				include "../schedule/Summer14.php";
			break;
			default:
				include "../schedule/Summer14.php"; 
			break;
		}
	}
	 ?>
	</div>
</div>

<div class="right">
	<?php include "../php/right.php" ?>
</div>
</div>
<?php include "../php/foot1.php"; ?>
</BODY>
</html>
