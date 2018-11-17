<?php  

class TestTakerForm {


function getDownloadFile() 
{
	if(isset($_FILES['uploadfile']))
	{ 
	   	$filename = basename($_FILES['uploadfile']['name']);
		$tmpName = $_FILES['uploadfile']['tmp_name'];
		if ($tmpName && $filename) {
			move_uploaded_file($tmpName, "../files/".$filename);
		}
	}
	if (!$filename) {
		$filename = getPostValue("docfile");
	}
	return $filename;
}
	

function getTestTakerList() {
	global $TESTTAKER;
	$lists 	= array();

	$note 	= array();
	$note[] 	= getPostValue("title1");
	$note[] 	= getPostValue("title2");
	$note[] 	= getPostValue("note1");
	$note[] 	= getPostValue("note2");
	$note[] 	= $this->getDownloadFile();
	
	$lists[] = $note;
	
	$nb = count($TESTTAKER);
	for ($i = 0; $i < $nb; $i++) {
		$elem = array();
		$vname  = "date_".$i;
		$elem[] = getPostValue($vname);
		
		$vname 	= "time_".$i;
		$elem[] = getPostValue($vname);

		$vname 	= "title1_".$i;
		$elem[] = getPostValue($vname);

		$vname 	= "subject1_".$i;
		$elem[] = getPostValue($vname);
		
		$vname 	= "title2_".$i;
		$elem[] = getPostValue($vname);

		$vname 	= "subject2_".$i;
		$elem[] = getPostValue($vname);
		
		$lists[] = $elem;
	}
	return $lists;
}


function getTestTakerListString($lists) {
	$text 	= "";
	for ($i = 1; $i < count($lists); $i++) {
		$elem  	= $lists[$i];
		if ($elem[0]) {
			$text .= "\tarray( ";
			for ($j = 0; $j < count($elem); $j++)  {
				$text .= "\"" .$elem[$j]. "\",\t" ;
			}
			$text .= "),\n";
		}
	}
	return $text;
}

function getTestTakerNodeString($elem) {
	$text  = "\"" .$elem[0]. "\",\n";
	$text .= "\"" .$elem[1]. "\",\n";
	
	$text .= "array(\"" .changeReturnToArray($elem[2]). "\"),\n";
	$text .= "array(\"" .changeReturnToArray($elem[3]). "\"),\n";
	$text .= "\"" .$elem[4]. "\"\n";
	
	return $text;
}


function WriteTestTakeTable() {
	$filename = "../public/testtaker.inc";

	$lists = $this->getTestTakerList();
	
	$text  = "<?php\n\n";
	
	$text .= "\$TESTTAKER = array("; 
	$text .= $this->getTestTakerListString($lists);
	$text .= ");\n\n\n";

	$text .= "\$TESTTAKERNOTE = array(\n"; 
	$text .= $this->getTestTakerNodeString($lists[0]);
	$text .= ");\n\n";
	
	
	$text .="?>\n\n";
	
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);

}



function ShowTestTakeTable($result) {
	global $TESTTAKERNOTE, $TESTTAKER;

?>

<!-- FORM method=post action='admin.php' -->
<FORM action='admin.php' name="uploadtesttaker" method=post enctype="multipart/form-data">
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='testtakertype'>
<INPUT type=hidden name='action' value='updatetesttaker'>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=30 class=error><?php echo($result); ?></TD></TR>
		<TR><TD height=50><font color=red size=4><b>TestTakers' SAT</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input class='fnborder' type='text' size='70' name='title1' value='<?php echo($TESTTAKERNOTE[0]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> SUBTITLE : </TD>
					<TD class='listtext' >
						<input class='fnborder' type='text' size='70' name='title2' value='<?php echo($TESTTAKERNOTE[1]); ?>'>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20></TD></TR>


		<TR>
			<TD class=COL_LABEL_UPPER valign=top>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE width=15% height=30>
						Date									
					</TD>
					<TD class=ITEMS_LINE_TITLE width=15%>									
						Time								
					</TD>
					<TD class=ITEMS_LINE_TITLE width=5%>									
						Title 1								
					</TD>
					<TD class=ITEMS_LINE_TITLE width=30%>									
						Subject 1
					</TD>
					<TD class=ITEMS_LINE_TITLE width=5%>									
						Title 2									
					</TD>
					<TD class=ITEMS_LINE_TITLE width=30%>									
						Subject 2
					</TD>
				</TR>


<?php for ($i = 0; $i < count($TESTTAKER); $i++) {
				$elem = $TESTTAKER[$i];
				$dates = $elem[0];
				$times = $elem[1];
				$title1 = $elem[2];
				$subject1 = $elem[3];
				$title2 = $elem[4];
				$subject2 = $elem[5];
?>
				<TR>
					<TD class=TABLE_COL1 height=30>
						<input class='fnborder' type='text' size='12' name='date_<?php echo($i); ?>' value='<?php echo($dates); ?>'>									
					</TD>
					<TD class=TABLE_COL1>									
						<input class='fnborder' type='text' size='12' name='time_<?php echo($i); ?>' value='<?php echo($times); ?>'>									
					</TD>
					<TD class=TABLE_COL1>									
						<input class='fnborder' type='text' size='3' name='title1_<?php echo($i); ?>' value='<?php echo($title1); ?>'>									
					</TD>
					<TD class=TABLE_COL2>									
						<input class='fnborder' type='text' size='25' name='subject1_<?php echo($i); ?>' value='<?php echo($subject1); ?>'>
					</TD>
					<TD class=TABLE_COL1 >									
						<input class='fnborder' type='text' size='5' name='title2_<?php echo($i); ?>' value='<?php echo($title2); ?>'>									
					</TD>
					<TD class=TABLE_COL2>									
						<input class='fnborder' type='text' size='25' name='subject2_<?php echo($i); ?>' value='<?php echo($subject2); ?>'>
					</TD>
				</TR>
		<?php } ?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20> </TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%'> Note 1 : </TD>
					<TD class='listtext' width=85%>
			<?php 
				$note1 = "";
				$note2 = "";
				for ($i = 0; $i < count($TESTTAKERNOTE[2]); $i++) {
					$note1 .= $TESTTAKERNOTE[2][$i]. "\n";
				} 
				for ($i = 0; $i < count($TESTTAKERNOTE[3]); $i++) {
					$note2 .= $TESTTAKERNOTE[3][$i]. "\n";
				}
				$docfile = $TESTTAKERNOTE[4];
			?>
						<textarea class=fields name="note1" cols="80" rows="6"><?php echo($note1); ?></textarea>
					</TD>
				</TR>
				<TR>
					<TD class=labelright > Note 2 : </TD>
					<TD class='listtext' >
						<textarea class=fields name="note2" cols="80" rows="6"><?php echo($note2); ?></textarea>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> Upload PDF: </TD>
					<TD class='listtext' >
						<input name="uploadfile" size=35 type="file" id="uploadfile">
						<INPUT type=hidden name='docfile' value='<?php echo($docfile); ?>'>
					</TD>
				</TR>
				
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=25>&nbsp;</TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
						<INPUT class=button type=submit name="update" value=' Update Testtaker '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="reset" VALUE=' Cancel '>
						</div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=15>&nbsp;</TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}

}

?>
