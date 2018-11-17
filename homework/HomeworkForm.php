<?php


class HomeworkForm {

function getHomeworkPath() {
	$path = "../homeworkfile/".getSemester().date("Y");
	return $path;
}
	
function uploadFile($srcfile, $destfile, $path) 
{
	$ret = 1;
	if (!file_exists($path)) {
 		mkdir($path, 0777, true);
	}
	if (file_exists($path.$destfile)) {
      	
    } else {
		$ret = move_uploaded_file($srcfile, $path."/".$destfile);
    }
	return $ret;
}

function uploadHomework() {

	if(isset($_FILES['homework_file']))
	{ 
    	$homeworkfile = basename($_FILES['homework_file']['name']);
     	$inputFileName = $_FILES['homework_file']['tmp_name'];
	}
	else {
		$inputFileName = getPostValue("hw_file");
		$homeworkfile = $inputFileName;
	}
	
	$subjects = getPostValue("subjects");
	$duedate = getPostValue("duedate");
	$classes = getPostValue("classes");
	$comments = getPostValue("comments");
	$uid = getPostValue("hindex");
	
	$HWClass = new HomeworkClass();
	$HWClass->setError("");
	
	$HWClass->setID($uid);
	$HWClass->setClasses($classes);
	$HWClass->setSubjects($subjects);
	$HWClass->setDates($duedate);
	$HWClass->setYear(date('Y'));
	$HWClass->setSemester(getSemester());
	$HWClass->setComments($comments);
	
	$path = $this->getHomeworkPath();
	
	if ($this->uploadFile($inputFileName, $homeworkfile, $path)) {
		$HWClass->setFiles($path."/".$homeworkfile);
		$HWClass->addNewHomework();
		$HWClass->setError("Homework ".$homeworkfile. " is uploaded!");
	}
	else {
		$HWClass->setError("Error : Upload ".$homeworkfile);
	}
	return $HWClass;
}


function showUploadHomeForm($homework, $classid, $hindex)  {
	global $HOMEWORK_TYPE, $CLASS_NAME, $SATURDAYLIST;
	
	$comments = "";
	$subjects = "";
	$filename = "";
	$err = "";
	if ($homework) {
		$classes = $homework->getClasses();
		$subjects = $homework->getSubjects();
		$dates = $homework->getDates();
		$err = $homework->getError();
		$hid = $homework->getID();
		$comments = $homework->getComments();
	}
	else {
		$hid = $hindex;
		if ($hindex > 0) {
			$hw = new HomeworkClass();
			if ($hw->getHomework($hindex)) {
				$classes = $hw->getClasses();
				$subjects = $hw->getSubjects();
				$dates = $hw->getDates();
				$filename = $hw->getFiles();
				$comments = $hw->getComments();
				$filename = substr(strrchr($filename, "/"), 1);
			}
		}
		else {
			$classes = getClassName($classid);
			$dates = date("m/d/Y");
		}
	}
	$programlist = getClassReportSubject($classes);
	
?>
<FORM action='admin.php' name="uploadform" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='uploadhomework'>
<INPUT type=hidden name='mtype' value='<?php echo($HOMEWORK_TYPE); ?>'>
<INPUT type=hidden name='action' value='uploadhomework'>
<INPUT type=hidden name='hindex' value='<?php echo($hid); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>

<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=80 colspan=2>
				<div class=item_tit><h2>Upload Homework</h2></div>
			</TD>
		</TR>
		<TR>
			<TD class=error height=30 colspan=2><?php echo($err); ?></TD>
		</TR>
		<TR>
			<TD class=labelright height=30>Class : </TD>
			<TD class=labelleft>
				<select name="classes" id="classes" STYLE='width: 180; color:blue; align: center' >
				<?php 	
				for ($i = 0; $i < count($CLASS_NAME)-2; $i+=2) {
					$slsname = $CLASS_NAME[$i];
					if ($classes == $slsname)
						echo ("<option value=".$slsname." selected > " .$slsname. " </option>");
					else
						echo ("<option  value=".$slsname."> " .$slsname. " </option>");
				}
		
				?>
				</select>
			</TD>
		</TR>
		
		<TR>
			<TD class=labelright width=30%  height=30>Subject : </TD>
			<TD class=labelleft width=70%>
				<select name="subjects" id="subjects" STYLE='width: 180; color:blue; align: center'>
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
		</TR>
		<TR>
			<TD class=labelright  height=30>Due Date : </TD>
			<TD class=labelleft>
				<select name="duedate" STYLE='width:180; color:blue; align: center' >
				<?php 	$first = 0;
				for ($i = 0; $i < count($SATURDAYLIST); $i++) {
					if ($dates <= date($SATURDAYLIST[$i])) {
						$first++;
					}
					if ($first == 0)
						echo ("<option value=".$SATURDAYLIST[$i]." selected> " .$SATURDAYLIST[$i]. " </option>");
					else
						echo ("<option  value=".$SATURDAYLIST[$i]."> " .$SATURDAYLIST[$i]. " </option>");
				}
				?>
				</select>
			</TD>
		</TR>
		<TR>
			<TD class=labelright height=30>Comments : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="comments" id="comments" value="<?php echo($comments); ?>">
			</TD>
		</TR>

		<TR><TD height=20 class=labelleft colspan=2></TD></TR>
		<?php if ($filename) { ?>
		<TR>
			<TD class=labelright height=30>Homework File : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=30 name="hw_file" id="hw_file" value="<?php echo($filename); ?>"  disabled>
			</TD>
		</TR>
		<?php } ?>
		<TR><TD height=20 class=labelleft colspan=2></TD></TR>
		<TR>
			<TD class=labelright height=30>Upload File : </TD>
			<TD class=labelleft>
				<input name="homework_file" size=40 type="file" id="homwork_file" title="homework file" value="homework_file" />
			</TD>
		</TR>
		<TR><TD height=50 class=labelleft colspan=2></TD></TR>
		<TR>
			<TD height=50 class=labelright colspan=2>
				<div align=center>
				<?php if ($hindex > 0) { ?>
					<INPUT class=button type=submit name="savescores" value=' Modify ' id="uploadhomeworkid">
				<?php } else { ?>
					<INPUT class=button type=submit name="savescores" value=' Upload ' id="uploadhomeworkid">
				<?php } ?>
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


function showHomeworkList($modif=0) {
	global $CLASS_NAME, $SATURDAYLIST,$HOMEWORK_TYPE;
	
	$title = date("Y")." ".getSemester(). " Semester Homework Answer" ;
	
	$mwlist = new HomeworkList(); 
	
?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
		<?php if ($modif == 0) { ?>
		<TR>
			<TD height=70 width=100% colspan=4>
				<div class=item_tit><h2><?php echo($title); ?> </h2></div>
			</TD>
		</TR>
<?php 
		}
	for ($n = 0; $n < count($CLASS_NAME)-2; $n+=2) {
		$classname = $CLASS_NAME[$n]; 
 		$lists = $mwlist->getHomeworkClassLists($classname);
 		$np = count($lists);
 		if ($np > 0) {
?>
		<TR>
			<TD height=25 width=100% colspan=4>
				<div class=item_tit><h4>Class <?php echo($classname); ?></h4></div>
			</TD>
		</TR>
<?php  	
		$p = 0;
		for ($i = 0; $i < $np; $i+=4) {
?>			
		<TR>
<?php 
		for ($m = 0; $m < 4; $m++) {
?>
			<TD class='listtext' height=30 width=20%><div align=center>
<?php 			
			if ($p < $np) {
				$str = $lists[$p]->getDates(). "-" .$lists[$p]->getSubjects();
				$files = $lists[$p]->getFiles();
				$hid = $lists[$p]->getID();
				$comments =  $lists[$p]->getComments();
				if (!$comments) {
					$comments = substr(strrchr($files, "/"), 1);
				}
				
				echo("<div title='".$comments."' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)'>");
				if ($modif) {
					echo("<a href='../admin/admin.php?action=addhomework&mtype=".$HOMEWORK_TYPE."&classes=".$classname."&hindex=".$hid."'>".$str."</a>");
				}
				else {
					echo("<a href='".$files."' target='pdffile_".$m."'>".$str."</a>");
				}
				echo("</div>");
			}
			$p++;
?>
			&nbsp;</div></TD>
<?php 	} } ?>
		</TR>
<?php 
	}
?>
		<TR><TD width=100% class=listtext colspan=5 height=20>&nbsp;</TD></TR>
<?php 
	}
?>		

		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}


}
?>
