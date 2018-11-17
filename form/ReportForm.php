<?php
include_once("ReportClass.php");

class ReportForm {

function getReportFile($classname, $year, $semester) {
	$path = getReportPath($semester, $year);
	$path .= "/".$classname."_".$semester."_".$year."_".date("m_d").".pdf";
	return $path;
}
function createReport($classes, $period, $semester) {
	$rclass = new ReportClass();
	$classname = getClassName($classes);
	$sem = getSemesterByString($semester);
	$year = getYearByString($period);
	
	$cr = new CreateReport();
	$cr->init($semester, $period);
	$cr->setClassReportFileNameClass($classname);
	$path = $cr->createClassStudentsReports($classname);
	
	if ($rclass->getClassReport($classname, $year, $sem)) {
		$rclass->setDate(getCurrentDate());
		$rclass->setPath($path);
		$rclass->setReport("report1");
	}
	else {
		$title = $classname. " " .$sem. " " .$year. " Students Report";
		$rclass->setTitle($title);
		$rclass->setClasses($classname);
		$rclass->setYear($year);
		$rclass->setSemester($sem);
		$rclass->setDate(getCurrentDate());
		$rclass->setPath($path);
		$rclass->setReport("report");
	}
	$rclass->addReport();
}
	
function showReportForm()  
{	
	global $CLASS_NAME;
	$class_nb = count($CLASS_NAME)-2;

	$annee = getAnnee();
	$semester = getSemester();
	
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background valign=top>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
				<TR>
					<TD height=40 colspan=3 class=ITEMS_LINE_TITLE>
						<b><?php echo("Create ".$semester. " " .$annee. " students report for classes"); ?></b>   
					</TD>
				</TR>
<?php 
			for ($i = 0; $i <$class_nb; $i+=2) { 
				$clsname = $CLASS_NAME[$i];
				$rclass = new ReportClass();
				$has = 0;
				if ($rclass->getClassReport($i, "", "")) {
					$report = $rclass->getTitle();
					$path = $rclass->getPath();
					$has = 1;
					$creport = "Update Report";
				}
				else {
					$report = "No Students Report!";
					$creport = "Generate Report";
				}
?>
				<TR>
					<TD class=listtext width=25% height=30>&nbsp;&nbsp;
						<?php echo(($i/2+1). ". Class " .$clsname); ?>
					</TD>
					<TD class=listtext width=25%>&nbsp;&nbsp;
						<a href="../admin/admin.php?actiontype=showreportform&action=createreport&classes=<?php echo($i); ?>"><?php echo($creport); ?></a>
					</TD>
					<TD class=listtext width=50%>&nbsp;&nbsp;
					<?php if ($has) {?>
						Download <a href="<?php echo($path); ?>" target=_blank><?php echo($report); ?></a>
					<?php } else {
						echo("<font color=red>".$report."</font>");
					 } ?>
					</TD>
				</TR>
<?php } ?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=10 class=listtext></TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>

<?php	
}

function getReportList() {
	$y = date("Y");
	$SEMES = array("Spring", "Summer", "Fall");
	
	$lists = array();
	for ($i = 2014; $i < $y; $i++) {
		for ($j = 0; $j < count($SEMES); $j++) {
			$path = "../reports/".$SEMES[$j]."_".$i;
			if (file_exists($path) && $handle = opendir($path)) {
				$files = array();
				$files[] = $SEMES[$j];
				$files[] = $i;
				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						if(is_file($path."/".$file) && strpos($file, '.pdf',1) ) {
							$files[] = $file;
						}
					}
				}
				closedir($handle);
				$lists[] = $files;
			}
		}
	}
	return $lists;
}


function showReportList() {	
	$lists = $this->getReportList();
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background valign=top>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
<?php 
	for ($i = 0; $i < count($lists); $i++) { 
		$elem = $lists[$i];
		$title = $elem[0]. "-" .$elem[1];
		$path = "../reports/".$elem[0]."_".$elem[1];
		echo("<TR><TD height=40 colspan=4 class=ITEMS_LINE_TITLE><b>".$title. " Students Reports</b></TD></TR>");
		$nb_elem = count($elem);
		for ($j = 2; $j < $nb_elem; $j+=4) {
			echo("<TR>");
			for ($cn = 0; $cn < 4; $cn++) {
				if ($j+$cn < $nb_elem) {
					$file = $elem[$j+$cn];
					$arr = explode("_", $file);
					$str = $arr[0]. " " . $arr[1]. " " .$arr[2]; 
				}
				else {
					$file = "";
					$str = "";
				} 
				echo("<TD class=listtext width=25% height=30><div align=center>");
				if ($str) {
					echo("<A href='".$path."/".$file."' target=_blank>".$str."</A>");
				}
				echo("</div></TD>");
			} 
			echo("</TR>");
		} 
	}
?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=10 class=listtext></TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>

<?php	
}


}
?>
