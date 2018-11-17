<?php
include_once("../public/admission.inc");
include_once ("../home/apsat_information.inc");
include_once ("../home/cours_information.inc");
include_once ("../home/home_item_include.inc");
include_once ("../home/home_item_photo.inc");
class HomePageForm {

function getHomePageOrder() {
	global $CONGRATOPPHOTOS;
	$nb = count($CONGRATOPPHOTOS);
	for ($i = 0; $i < $nb; $i++) {
		$oo = getPostValue("itemorder_".$i);
		$CONGRATOPPHOTOS[$i][2] = $oo;
	}
	$nb--;
	for ($i = 0; $i < $nb-1; $i++) {
		for ($j = 0; $j < $nb; $j++) {
			if ($CONGRATOPPHOTOS[$j][2] > $CONGRATOPPHOTOS[$j+1][2]) {
				$ll = $CONGRATOPPHOTOS[$j];
				$CONGRATOPPHOTOS[$j] = $CONGRATOPPHOTOS[$j+1];
				$CONGRATOPPHOTOS[$j+1] = $ll;
			}
		}
	}
	for ($i = 0; $i < $nb+1; $i++) {
		if ($CONGRATOPPHOTOS[$i][2] < $nb+2) {
			$CONGRATOPPHOTOS[$i][2] = $i+1;
		}
	}
	return $CONGRATOPPHOTOS;
}	
function WriteHomePage() {
	$lists = $this->getHomePageOrder();
	$nb = count($lists);
	$text  = "<?php\n\n\$CONGRATOPPHOTOS = array(\n";
	for ($i = 0; $i < $nb; $i++) {
		$elem = $lists[$i];
		if ($elem[1])
			$velem = "\$".$elem[0];
		else 
			$velem = "\"\"";
		if ($elem[2]) {
			$text .= "array(\"".$elem[0]."\", ".$velem. ", ".$elem[2]. ", \"".$elem[3]."\"";
		}
		else {
			$text .= "array(\"".$elem[0]."\", ".$velem. ", 0, \"".$elem[3]."\"";
		}
		if ($i == $nb-1) {
			$text .= ")\n";
		}
		else {
			$text .= "),\n";
		}
	}
	$text .= ");\n?>\n";
	
	$fp = fopen("../home/home_item_include.inc", "w");
	fwrite($fp, $text);
	fclose($fp);
	return $lists;
}
	


function showHomePageForm($newtab, $result) {
	global $CONGRATOPPHOTOS;
	if ($newtab) {
		$tab = $newtab;
	}
	else {
		$tab = $CONGRATOPPHOTOS;
	}
?>

<FORM action='admin.php' method=post>
<INPUT type=hidden name='action' value='modifyhomepage'>
<INPUT type=hidden name='actiontype' value='homepagetype'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($result) ?></TD></TR>
<TR>
	<TD height=80>
		<div class=item_tit><h2>Home Page Display Order</h2></div>
	</TD>
</TR>
<TR><TD class=error height=20></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				
<?php
		$nb_items = count($tab);
 		for ($i = 0; $i < $nb_items; $i++) { 
 			$elem = $tab[$i];
 			if ($elem[3]) {
 				$title = $elem[3];
 			}
 			else {
	 			if ($elem[0] == "ADMISSION_VAR[0]")
	 				$title = $elem[1][1];
	 			else if ($elem[0] == "ADMISSION_VAR")
	 				$title = $elem[1][0][1];
	 			else 
	 				$title = $elem[1][0][0];
 			}
 			$n = $elem[2];
?>
				<TR>
					<TD width=10% class=lcenter height=30>
						<select name="itemorder_<?php echo($i); ?>" >
							<option value="100"> --- </option>
	<?php 
						for ($k = 1; $k <= $nb_items; $k++) {
							if ($k == $n) {
								echo ("<option value=".$k." selected> " .$k. " </option>");
							}
							else {
								echo ("<option value=".$k."> " .$k. " </option>");
							}
						}
						?>
						</select>
					</TD>	
					<TD class=labelleft colspan=2> 
						<?php echo($title); ?>
					</TD>
				</TR>				
				<TR>
					<TD colspan=3 height=20>
					</TD>
				</TR>				
<?php 	} ?>
			
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


	



function uploadPhotos() {
	global $CPHOTOLIST;
	$nb_items = count($CPHOTOLIST);
	for ($i = 0; $i < $nb_items; $i++) { 
		$CPHOTOLIST[$i][0] = getPostValue("title_".$i);
	}
	 
	for ($i = $nb_items; $i < ($nb_items+3); $i++) { 
		if(isset($_FILES['photo_'.$i]))
		{ 
	   		$filename = basename($_FILES['photo_'.$i]['name']);
			$tmpName = $_FILES['photo_'.$i]['tmp_name'];
			if ($tmpName && $filename) {
				move_uploaded_file($tmpName, "../photos/".$filename);
				$title = getPostValue("title_".$i);
				if (!trim($title)) {
					list($title)  = explode(".", $filename);
				}
				$CPHOTOLIST[] = array($title, $filename, "");
			}
		}
	}
	
	return $CPHOTOLIST;
}

function WriteHomePagePhoto()
{
	$lists = $this->uploadPhotos();
	$nb = count($lists);

	$text = "";
	for ($i = 0; $i < $nb; $i++) {
		$elem = $lists[$i];
		$text .= "\tarray(\"".$elem[0]."\", \"" .$elem[1]. "\", \"" .$elem[2]. "\")";
		if ($i == $nb-1) {
			$text .= "\n";
		}
		else {
			$text .= ",\n";
		}
	}
	
	$phptext  = "<?php\n\n\$CPHOTOLIST = array(\n" .$text. ");\n\n?>\n\n";
	
	$fp = fopen("../home/home_item_photo.inc", "w");
	fwrite($fp, $phptext);
	fclose($fp);
	
	$text = str_replace("array(", "[", $text);
	$text = str_replace(")", "]", $text);
	
	$jstext = "var CPHOTOLIST = [\n" . $text. "];\n\n";
	
	$fp = fopen("../scripts/photo.items.js", "w");
	fwrite($fp, $jstext);
	fclose($fp);
	
	return $lists;
}

function showHomePagePhotoForm($newtab, $result) {
	global $CPHOTOLIST;
	if ($newtab) {
		$tab = $newtab;
	}
	else {
		$tab = $CPHOTOLIST;
	}
	
?>

<FORM action='admin.php' name="uploadphoto" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='loadhomepagephoto'>
<INPUT type=hidden name='actiontype' value='homepagephototype'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($result) ?></TD></TR>
<TR>
	<TD height=80><div class=item_tit>
		<h2>Load photos For Home Page</h2>
		</div>
	</TD>
</TR>
<TR><TD class=error height=20></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>		
<?php
			$nb_items = count($tab);
	 		for ($i = 0; $i < $nb_items; $i++) { 
	 			$elem = $tab[$i];
	 			$title = $elem[0];
	 			$photo = $elem[1];
?>
				<TR>
					<TD width=10% class=lcenter height=30><?php echo(($i+1)); ?></TD>	
					<TD class=labelleft width=45%> 
						<input name="title_<?php echo($i); ?>" size=45 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
					</TD>
					<TD  class=labelleft width=45%>
						<img src="../photos/<?php echo($photo); ?>" border="0" height="70" width="150">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=20></TD></TR>				
<?php 		}
			
	 		for ($i = $nb_items; $i < ($nb_items+3); $i++) { 
?>
				<TR>
					<TD width=10% class=lcenter height=30><?php echo(($i+1)); ?></TD>	
					<TD class=labelleft width=45%> 
						<input name="title_<?php echo($i); ?>" size=45 type="text" id="title_<?php echo($i); ?>" value="">
					</TD>
					<TD  class=labelleft width=45%>
						<input name="photo_<?php echo($i); ?>" size=35 type="file" id="photo_<?php echo($i); ?>">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=20></TD></TR>				
<?php 		} ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' Load Photos '>
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