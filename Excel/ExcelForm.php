<?php

class ExcelForm {

	
/*********   add students scores ****************/
function getNewScores() {

	$inputFileType = 'Excel5';
	
	if(isset($_FILES['import_file']))
	{ 
    	$importfile = basename($_FILES['import_file']['name']);
     	$inputFileName = $_FILES['import_file']['tmp_name'];
	}
	else {
		$inputFileName = getPostValue("import_file");
		$importfile = $inputFileName;
	}
	
	$subjects = getPostValue("subjects");
	$titles = getPostValue("titles");

	$semester = getPostValue("semester");
	$period = getPostValue("period");
	$dd 		= getPostValue("dday");
	$mm 		= getPostValue("dmonth");
	$dates = "";
	if ($mm < 10)
		$dates .= "0";
	$dates 	.= $mm. "/";
	if ($dd < 10)
		$dates .= "0";
	$dates 		.= $dd;
	
	$ExClass = new ExcelClass();
	try {
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$ExClass->parser($sheetData);
	} catch(PHPExcel_Reader_Exception $e) {
		die('Error loading file "'.pathinfo($importfile,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	
	$ExClass->setTitle($titles);
	$ExClass->setSubjects($subjects);
	$ExClass->setDates($dates);
	return $ExClass;

}

function importNewScores() {

	$ExClass = $this->getNewScores();

	return $ExClass->addNewScoresList();

}

function showStudentsScoresTitle($excelscore, $semester, $period) 
{
	global $CLASS_NAME;
	
	if ($excelscore) {
		$classes = $excelscore->getClasses();
		$subjects = $excelscore->getSubjects();
		$titles = $excelscore->getTitle();
		$teacher = $excelscore->getTeacher();
		$dates = $excelscore->getDates();
		$programlist = getClassReportSubject($classes);
	}
	else {
		$classes = "";
		$titles = "Test #";
		$teacher = "";
		$dates = '';	
		$programlist = getClassReportSubject($CLASS_NAME[0]);
		$subjects = "";
	}
	

	if ($dates && strstr($dates,"/")) {
		list($mm,$dd) =  explode("/", $dates);
	}
	else {
		$mm = date("m");
		$dd = date("d");
		if ($dd > 1)
			$dd = $dd-1;
	}	
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright height= 20 width=20%> </TD>
	<TD class=labelleft  width=25%> </TD>
	<TD class=labelright width=15%></TD>
	<TD class=labelleft  width=40%></TD>
</TR>
<TR>
	<TD class=labelright10>Subjects : </TD>
	<TD class=labelleft>
		<select name="subjects" id="subjects" STYLE='width: 160; color:blue; align: center'>
		<?php 	
		for ($i = 0; $i < count($programlist); $i++) {
			$program = $programlist[$i];
			if ($program == $subjects)
				echo ("<option value=".$program." selected> " .$program. " </option>");
			else
				echo ("<option  value=".$program."> " .$program. " </option>");
		}

		?>
		</select>
	</TD>
	<TD class=labelright10>Title : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=26 name="titles" id="titles" value="<?php echo($titles); ?>" onclick="active_save();">
	</TD>
</TR>

<TR>
	<TD class=labelright10>Due Date : </TD>
	<TD class=labelleft>
		<select name="dmonth" STYLE='width:78; color:blue; align: center' onclick="active_save();">
		<?php 	
		for ($i = 1; $i < 13; $i++) {
			if ($mm == $i)
				echo ("<option value=".$i." selected> " .$i. " </option>");
			else
				echo ("<option  value=".$i."> " .$i. " </option>");
		}
		?>
		</select>
		<select name="dday" STYLE='width:78; color:blue; align: center' onclick="active_save();">
		<?php 	
		for ($i = 1; $i < 32; $i++) {
			if ($dd == $i)
				echo ("<option value=".$i." selected> " .$i. " </option>");
			else
				echo ("<option  value=".$i."> " .$i. " </option>");
		}
		?>
		</select>
	</TD>
	<TD class=labelright10>Semester : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=10 name="semester" value="<?php echo($semester); ?>" >
		<INPUT class=fields type=text size=10 name="period" value="<?php echo($period); ?>" >
	</TD>
</TR>
<TR>
	<TD class=labelright10>Teacher : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=26 name="teacher" id="teacher" value="<?php echo($teacher); ?>" onclick="active_save();">
	</TD>
	<TD class=labelright10>Class : </TD>
	<TD class=labelleft>
		<select name="classes" id="classes" STYLE='width: 160; color:blue; align: center' >
			<option value=" " selected> --- </option>
		<?php 	
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$cl = $CLASS_NAME[$i];
			if ($cl == $classes)
				echo ("<option value=".$cl." selected > " .$cl. " </option>");
			else
				echo ("<option  value=".$cl." disabled='disabled'> " .$cl. " </option>");
		}

		?>
		</select>
	</TD>
</TR>
<TR><TD height=15 class=labelleft colspan=4></TD></TR>
</TABLE>
<?php 
}

function showImportForm($excelscore, $sem, $yy)  
{
	$semester = getSemesterByString($sem);
	$period = getYearByString($yy);		
?>
<FORM action='member.php' name="importform" method=post enctype="multipart/form-data">
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD height=15 class=labelright> </TD></TR>

<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD >
						<?php $this->showStudentsScoresTitle($excelscore, $semester, $period); ?>
					</TD>
				</TR>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR><TD height=30 colspan=2 class=labelleft ></TD></TR>
						<TR>
							<TD class=labelright10>Import Excel File : </TD>
							<TD class=labelleft>
								<input name="import_file" size=60 type="file" id="import_file" title="import file" value="import_file" />
							</TD>
						</TR>
						<TR><TD height=30 class=labelleft colspan=2></TD></TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20 class=labelleft></TD></TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=40 class=labelright width=100%><div align=center>
				<INPUT type=hidden name='action' value='importexcel'>
				<INPUT class=button type=submit name="savescores" value=' Import ' id="importbuttonid" disabled="disabled">
				<INPUT class=button type=submit name="viewscores" value=' View '>
			</div>
			</TD>
		</TR>
		<TR><TD height=15 colspan=2>&nbsp;</TD></TR>
		</TABLE>
	</TD>
</TR>

</TABLE>
</FORM>
	
<?php	
}


function getImportTestScores() {

	$inputFileType = 'Excel5';
	
	if(isset($_FILES['import_file']))
	{ 
    	$importfile = basename($_FILES['import_file']['name']);
     	$inputFileName = $_FILES['import_file']['tmp_name'];
	}
	else {
		$inputFileName = getPostValue("import_file");
		$importfile = $inputFileName;
	}
	
	$subjects = getPostValue("subjects");

	$ExClass = new ExcelClass();
	try {
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$ExClass->parserTest($sheetData);
	} catch(PHPExcel_Reader_Exception $e) {
		die('Error loading file "'.pathinfo($importfile,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	
	
	return $ExClass->getTestScoresList($subjects);

}


function showTestImportForm($url='')  
{
	if ($url)
		$action = $url;
	else 
		$action="member.php";
		
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright>
		<FORM action='<?php echo($action); ?>' name="importform" method=post enctype="multipart/form-data">
		<INPUT type=hidden name='action' value='importtestscore'>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=50 colspan=2 class=labelleft ></TD></TR>
		<TR>
			<TD class=labelright height=50 width=30%>Subject : </TD>
			<TD class=labelleft>
				<INPUT class=box type='radio' name='subjects' value='English' checked> English
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<INPUT class=box type='radio' name='subjects' value='Math' > Math
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=50>Import Excel File : </TD>
			<TD class=labelleft>
				<input name="import_file" size=60 type="file" id="import_file" title="import file" value="import_file" />
			</TD>
		</TR>
		<TR><TD height=50 class=labelleft colspan=2></TD></TR>
		<TR>
			<TD class=lcenter height=50 colspan=2>
				<INPUT class=button type=submit name="importtestscore" value=' Import ' id="importbuttonid" >
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php	
}



}
?>
