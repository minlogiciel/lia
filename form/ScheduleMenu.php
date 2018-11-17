<?php
include_once ("../schedule/schedule_var.inc");
include_once ("schedule_menu_include.inc");

class ScheduleMenu {
	var $error = "";
function uploadFile($srcfile, $destfile, $path, $size=0) 
{
	if ($destfile && $srcfile) {
		$lowstr = strtolower($destfile);
		if (strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) {
			$ret = move_uploaded_file($srcfile, $path."/".$destfile);
		}
		else {
			if (!file_exists($path)) {
	 			mkdir($path, 0777, true);
			}
			$ret = move_uploaded_file($srcfile, $path."/".$destfile);
			resize_photo($destfile, $destfile, $path, $size);
		}
	}
}

function findElementFromList($lists, $elem) {
	for ($i = 0; $i < count($lists); $i++) {
		if ($lists[$i][0] == $elem[0] && $lists[$i][3] == $elem[3]) {
			return 1;
		}
	}
	return 0;
}

function getSchduleMenu() {
	global $S_INDEX_MENU;
	$items = array();
	$nb_item = count($S_INDEX_MENU);
	for ($i = 0; $i < $nb_item; $i++) {
		$mname = getPostValue("mname_".$i);
		$ll = explode("|", $mname);
		$index = $ll[0];
		if ($index != -1) {
			$title = getPostValue("title_".$i);
			$photo = getPostValue("tphoto_".$i);
			$docfile = getPostValue("tdocfile_".$i);
		
			if(isset($_FILES['docfile_'.$i])) {
				$filename = basename($_FILES['docfile_'.$i]['name']);
			    $tmpName = $_FILES['docfile_'.$i]['tmp_name'];
			    if ($filename) {
				    $tmp = strtoLower($filename);
				    if (strstr($tmp, ".pdf") || strstr($tmp, ".doc") || strstr($tmp, ".xdoc"))	{
				    	$this->uploadFile($tmpName,  $filename, "../files");
				    }
				    else {
				    	$this->error = "Doc file should be PDF or Word type.";
				    }
			    }
			}
			if(isset($_FILES['photo_'.$i])) { 
			    $photoname = basename($_FILES['photo_'.$i]['name']);
			    $tmpName = $_FILES['photo_'.$i]['tmp_name'];
			    if ($photoname) {
				    $tmp = strtoLower($photoname);
				    if (strstr($tmp, ".jpg") || strstr($tmp, ".gif") || strstr($tmp, ".png"))	{
				    	$this->uploadFile($tmpName, $photoname, "../schedulephotos", 800);
				    }
				    else {
				    	$this->error = "Image file should be JPG, GIF or PNG type.";
				    }
			    }
			}
		
			$elem = $S_INDEX_MENU[$index];
			if ($this->findElementFromList($items, $elem) == 0) {
				$elem[1] = 1;
				if ($photo || $docfile) {
					$elem[4] = array($title, $docfile, $photo);
				}
				else {
					$elem[4] = "";
				}
				$items[] = $elem;
			}
		}
	}
	
	for ($i = 0; $i < $nb_item; $i++) {
		$elem = $S_INDEX_MENU[$i];
		if ($this->findElementFromList($items, $elem) == 0) {
			$elem[1] = 0;
			$items[] = $elem;
		}
	}
	return $items;
}

function WriteNewSchduleIndex($varname, $n) {

	$filename = "../schedule/schedule_var.inc";
	$lines = file($filename);
	$text = "";
	foreach ($lines as $line_num => $line) {
		if (strstr($line, "schedule_menu_include.inc")) {
			$text .= "\$".$varname. " = ".$n.";\n";
		}
		$text .= $line;
	}

	$filename = "../schedule/schedule_var.inc";
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
}


function getSchduleMenuName() {
	global $S_INDEX_MENU;
	$items = array();
	$nb_item = count($S_INDEX_MENU);
	for ($i = 0; $i < $nb_item; $i++) {
		$title = getPostValue("title_".$i);
		$elem = $S_INDEX_MENU[$i];
		$elem[0] = $title;
		$items[] = $elem;
	}
	$title = getPostValue("title_".$nb_item);
	if ($title && count($title > 2)) {
		$names  = explode(" ", $title);
		$vname = strtoupper("M_".$names[0].$nb_item);
		$this->WriteNewSchduleIndex($vname, $nb_item);
		$items[] = array($title, 0, "", $vname);
	}
	return $items;
}

function WriteScheduleList($lists)
{
	$nb = count($lists);
	$text  = "<?php\n\n\$S_INDEX_MENU = array(\n";
	for ($i = 0; $i < $nb; $i++) {
		$elem = $lists[$i];
		if ($elem[1] == 1) {
			$text .= "\tarray(\"".$elem[0]."\", 1,\t\$" .$elem[3]. ", \"".$elem[3]. "\"";
		}
		else {
			$text .= "\tarray(\"".$elem[0]."\", 0,\t\$" .$elem[3]. ", \"".$elem[3]. "\"";
		}
		if ((count($elem) > 4) && $elem[4])  {
			$text .= ", array(\"".$elem[4][0]."\", \"" .$elem[4][1]. "\", \"".$elem[4][2]. "\")";
		}
		if ($i == $nb-1) {
			$text .= ")\n";
		}
		else {
			$text .= "),\n";
		}
	}
	$text .= ");\n?>\n";
	
	$fp = fopen("../form/schedule_menu_include.inc", "w");
	fwrite($fp, $text);
	fclose($fp);

	
	$text  = "var SCHEDULELISTS = [\n";
	for ($i = 0; $i < $nb; $i++) {
		$elem = $lists[$i];
		$text .= "[\"" .$elem[3]. "\", ";
		if ((count($elem) > 4) && count($elem[4])>2)  {
			$text .= "\"".$elem[4][0]."\", \"" .$elem[4][1]. "\", \"".$elem[4][2]. "\"]";
		}
		else {
			$text .= "\"\", \"\", \"\"]";
		}
		if ($i == $nb-1) {
			$text .= "\n";
		}
		else {
			$text .= ",\n";
		}
	}
	$text .= "];\n\n";
	
	$fp = fopen("../scripts/schedule.items.js", "w");
	fwrite($fp, $text);
	fclose($fp);
	
	
	return $lists;
}
	
function WriteScheduleMenu()
{
	$lists = $this->getSchduleMenu();
	$this->WriteScheduleList($lists);
	return $lists;
}

function WriteScheduleMenuName()
{
	$lists = $this->getSchduleMenuName();
	$this->WriteScheduleList($lists);
	return $lists;
}

function showSchduleMenuForm($newtab, $result) {
	global $S_INDEX_MENU;
	if ($newtab) {
		$tab = $newtab;
	}
	else {
		$tab = $S_INDEX_MENU;
	}
	
?>

<FORM action='admin.php' name="uploadschedulemenu" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='modifymenu'>
<INPUT type=hidden name='actiontype' value='schedulemenutype'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($result) ?></TD></TR>
<TR>
	<TD height=80><div class=item_tit>
		<h2>Schdule Menu</h2>
		<h4><font color=red>(If document file is PDF format, Image file is not needed!)</font></h4>
		</div>
	</TD>
</TR>
<TR><TD class=error height=20></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30 height=30>
					</TD>
					<TD width=40% class=ITEMS_LINE_TITLE> 
						Menu Name
					</TD>
					<TD width=50% class=ITEMS_LINE_TITLE>
						Title
					</TD>
				</TR>				
<?php
		$nb_items = count($tab); 
 		for ($i = 0; $i < $nb_items; $i++) { 
 			$elem = $tab[$i];
 			$title = "";
 			$doctile = "";
 			$imagefile = "";
 			$tvar = "";
 			if ($elem[1] && (count($elem) > 4) && (count($elem[4]) > 2)) {
 				$tvar = $elem[3];
 				$title = $elem[4][0];
 				$doctile = $elem[4][1];
 			 	$imagefile = $elem[4][2];
 			}
?>
				<TR>
					<TD width=10% class=lcenter height=30>
						<?php echo(($i+1)); ?>.
					</TD>
					<TD width=40% class=labelleft> 
						<select name="mname_<?php echo($i); ?>" STYLE='width:280px; color:black; align: center' onChange='javascript:setSchduleTitle3(this, <?php echo($i); ?>);'>
							<option value="-1"> --- </option>
					<?php 
				 		for ($k = 0; $k < $nb_items; $k++) { 
							$ee = $tab[$k];
							$vstr = $k."|".$ee[3]. "|". str_replace(" ", "*-", $ee[4][0]). "|" .str_replace(" ", "*-", $ee[4][1]). "|" .str_replace(" ", "*-", $ee[4][2]);
				 			
							if ($k == $i && $tab[$k][1]) {
								echo ("<option value=".$vstr." selected> " .$ee[0]." </option>");
							}
							else {
								echo ("<option value=".$vstr."> "  .$ee[0]. " </option>");
							}
			 			}
			 		?>
			 			</select>
						
					</TD>
					<TD width=50% class=labelleft>
						<input name="tvariable_<?php echo($i); ?>" id="tvariable_<?php echo($i); ?>" type="hidden" value="<?php echo($tvar); ?>">
						<input name="title_<?php echo($i); ?>" size=45 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
					</TD>
				</TR>				
				<TR>
					<TD class=lcenter height=30 >PDF
					</TD>
					<TD class=labelleft>
						<input name="docfile_<?php echo($i); ?>" type="file" id="docfile_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 0);'>
					</TD>
					<TD  class=labelleft>
						<input name="tdocfile_<?php echo($i); ?>" size=45 type="text" id="tdocfile_<?php echo($i); ?>" value="<?php echo($doctile); ?>">
					</TD>
				</TR>				
				<TR>
					<TD  class=lcenter height=30 >IMAGE
					</TD>
					<TD class=labelleft>
						<input name="photo_<?php echo($i); ?>" type="file" id="photo_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 1);'>
					</TD>
					<TD  class=labelleft>
						<input name="tphoto_<?php echo($i); ?>" size=45 type="text" id="tphoto_<?php echo($i); ?>" value="<?php echo($imagefile); ?>">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=20></TD></TR>				
<?php 		} ?>
			
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' Update '>
			</TD>
		</TR>
		</TABLE>

	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

function ooshowSchduleMenuForm($newtab, $result) {
	global $S_INDEX_MENU;
	if ($newtab) {
		$tab = $newtab;
	}
	else {
		$tab = $S_INDEX_MENU;
	}
	
?>

<FORM action='admin.php' name="uploadschedulemenu" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='modifymenu'>
<INPUT type=hidden name='actiontype' value='schedulemenutype'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($result) ?></TD></TR>
<TR>
	<TD height=80><div class=item_tit>
		<h2>Schdule Menu</h2>
		<h4><font color=red>(IMAGE file should be JPG type and width=800px)</font></h4>
		</div>
	</TD>
</TR>
<TR><TD class=error height=20></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30 height=30>
					</TD>
					<TD width=40% class=ITEMS_LINE_TITLE> 
						Menu Name
					</TD>
					<TD width=50% class=ITEMS_LINE_TITLE>
						Title
					</TD>
				</TR>				
<?php
		$nb_items = count($tab); 
 		for ($i = 0; $i < $nb_items; $i++) { 
 			$elem = $tab[$i];
 			$title = "";
 			$doctile = "";
 			$imagefile = "";
 			$tvar = "";
 			if ($elem[1] && (count($elem) > 4) && (count($elem[4]) > 2)) {
 				$tvar = $elem[3];
 				$title = $elem[4][0];
 				$doctile = $elem[4][1];
 			 	$imagefile = $elem[4][2];
 			}
?>
				<TR>
					<TD width=10% class=lcenter height=30>
						<?php echo(($i+1)); ?>.
					</TD>
					<TD width=40% class=labelleft> 
						<select name="mname_<?php echo($i); ?>" STYLE='width:280px; color:black; align: center' onChange='javascript:setSchduleTitle(this, <?php echo($i); ?>);'>
							<option value="-1"> --- </option>
					<?php 
				 		for ($k = 0; $k < $nb_items; $k++) { 
							if ($k == $i && $tab[$k][1]) {
								echo ("<option value=".$k." selected> " .$tab[$k][0]." </option>");
							}
							else {
								echo ("<option value=".$k."> "  .$tab[$k][0]. " </option>");
							}
			 			}
			 		?>
			 			</select>
						
					</TD>
					<TD width=50% class=labelleft>
						<input name="tvariable_<?php echo($i); ?>" id="tvariable_<?php echo($i); ?>" type="hidden" value="<?php echo($tvar); ?>">
						<input name="title_<?php echo($i); ?>" size=45 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
					</TD>
				</TR>				
				<TR>
					<TD class=lcenter height=30 >PDF/DOC
					</TD>
					<TD class=labelleft>
						<input name="docfile_<?php echo($i); ?>" type="file" id="docfile_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 0);'>
					</TD>
					<TD  class=labelleft>
						<input name="tdocfile_<?php echo($i); ?>" size=45 type="text" id="tdocfile_<?php echo($i); ?>" value="<?php echo($doctile); ?>">
					</TD>
				</TR>				
				<TR>
					<TD  class=lcenter height=30 >IMAGE
					</TD>
					<TD class=labelleft>
						<input name="photo_<?php echo($i); ?>" type="file" id="photo_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 1);'>
					</TD>
					<TD  class=labelleft>
						<input name="tphoto_<?php echo($i); ?>" size=45 type="text" id="tphoto_<?php echo($i); ?>" value="<?php echo($imagefile); ?>">
					</TD>
				</TR>				

				<TR><TD colspan=3 height=20></TD></TR>				
<?php 		} ?>
			
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' Update '>
			</TD>
		</TR>
		</TABLE>

	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

function showSchduleMenuNameForm($newtab, $result) {
	global $S_INDEX_MENU;
	if ($newtab) {
		$tab = $newtab;
	}
	else {
		$tab = $S_INDEX_MENU;
	}
	
?>

<FORM action='admin.php' name="uploadschedulemenu" method=post>
<INPUT type=hidden name='action' value='modifymenuname'>
<INPUT type=hidden name='actiontype' value='schedulemenunametype'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($result) ?></TD></TR>
<TR>
	<TD height=80><div class=item_tit>
		<h2>Schdule Menu Name</h2>
		</div>
	</TD>
</TR>
<TR><TD class=error height=20></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30 width=10% >
					</TD>
					<TD class=ITEMS_LINE_TITLE width=90%> 
						Schedule Menu Name
					</TD>
				</TR>				
<?php
		$nb_items = count($tab); 
 		for ($i = 0; $i < $nb_items; $i++) { 
 			$elem = $tab[$i];
 			$title = $elem[0];
?>
				<TR>
					<TD class=lcenter height=30>
						<?php echo(($i+1)); ?>.
					</TD>
					<TD class=labelleft>
						<input name="title_<?php echo($i); ?>" size=70 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=10></TD></TR>				
<?php 		} ?>
				<TR>
					<TD class=lcenter height=30>
						New Item
					</TD>
					<TD width=50% class=labelleft>
						<input name="title_<?php echo($i); ?>" size=70 type="text" id="title_<?php echo($$nb_items); ?>" value="">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=20></TD></TR>				
			
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' Update '>
			</TD>
		</TR>
		</TABLE>

	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

}
?>