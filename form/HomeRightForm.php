<?php
include_once ("../php/right_information.inc");
include_once ("../php/right1.php");

class HomeRightForm {
	var $_FILENAME = "../php/right_information.inc";

function getRightListArray() {
	$lists = array();
	$ll = array();
	$lists[] =  getPostValue('title');
		
	$nb 		= $_POST['itemnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vdate = "date_".$i;
		$vtime = "time_".$i;
		$vsubject = "subject_".$i;
		$dates 		= getPostValue($vdate);
		$times 		= getPostValue($vtime);
		$subject 		= getPostValue($vsubject);
		
		if ($dates) {
			$ll = array();
			$ll[] = $dates;
			$ll[] = $times;
			$slist = AreaTextToTable($subject);
			for ($j = 0; $j < count($slist); $j++) {
				$ll[] = $slist[$j];
			}
			$lists [] = $ll;
		}
	}
	return $lists;
}

function getItemTableString($lists, $vname) {
	$text = "\$".$vname." = array(\n";
	$text .="\"" .$lists[0]. "\", \n";
	for ($i = 1; $i < count($lists); $i++) {
		$text .= "array(";
		for ($j = 0; $j < count($lists[$i]); $j++) {
			if ($j > 0)
				$text .= ", ";
			$text .="\"" .$lists[$i][$j]. "\"";
		}
		$text .= ")" ; 
		if ($i < (count($lists)-1)) { 
			$text .= ",\n"; 
		}
		else { 
			$text .= "\n" ;
		}
	}
	$text .= ");\n\n";
	return $text;
}


function WriteHomeRightTable($nindex) {
	global $RIGHT_LIST;
	
	$newlists = $this->getRightListArray();
	
	if(empty($_REQUEST['addnewline']))   {
		$text  = "<?php\n\n"; 
		for ($i = 0; $i < count($RIGHT_LIST); $i++) {
			$vname = $RIGHT_LIST[$i][3];
			if ($i == $nindex) {
				$text .= $this->getItemTableString($newlists, $vname);
			}
			else {
				$text .= $this->getItemTableString($RIGHT_LIST[$i][2], $vname);
			}
			
		}
		$text .= "?>\n\n";
		
		$fp = fopen($this->_FILENAME, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	else {
		$newlists[] =  array("", "", "");
	}
	return $newlists;
}

function viewHomeRightTable() {

	$lists = array();
	$ll = array();
	$lists[] =  getPostValue('title');
		
	$nb 		= $_POST['itemnumber'];
	$dates 		= getPostValue('date_1');
	$times 		= getPostValue('time_1');
	$subject 	= getPostValue('subject_1');
	$ll = array();
	$ll[] = $dates;
	$ll[] = $times;
	$ll[] = $subject. " 1";
	$lists [] = $ll;
	list($m,$d, $y) = explode("/", $dates);
	for ($i = 2; $i < $nb; $i++) {
		$ll = array();
		$dd  = mktime(0, 0, 0, $m  , $d+7, $y);
		$todayh = getdate($dd);
		$d = $todayh['mday'];
     	$m = $todayh['mon'];
     	$y = $todayh['year'];
     	$dates =$m. "/" .$d. "/".$y;
		$ll[] = $dates;
		$ll[] = $times;
		$ll[] = $subject. " " . $i;
		$lists [] = $ll;
	}
	return $lists;
}

function ShowHomeRightTable($newtab, $nindex, $result) 
{
	global $RIGHT_LIST;

	if($newtab)   {
		$lists = $newtab;
	}
	else {
		$lists = $RIGHT_LIST[$nindex][2];		
	}
	$nb = count($lists);
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='homerighttype'>
<INPUT type=hidden name='action' value='updaterightitem'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='itemnumber' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b><?php echo($RIGHT_LIST[$nindex][0]) ?></b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input  type='text' size='80' name='title' value="<?php echo($lists[0]); ?>">
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20></TD></TR>
		<TR>
			<TD class=background valign=top>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30 width='3%'></TD>
					<TD class=ITEMS_LINE_TITLE width='15%'> Date  </TD>
					<TD class=ITEMS_LINE_TITLE width='15%'> Time </TD>
					<TD class=ITEMS_LINE_TITLE width='67%'> Subjects </TD>
				</TR>
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$elem 		= $lists[$i];
			$nb_elem = count($elem);
			$dates 		= $elem[0];
			$times		= $elem[1];
			if ($nb_elem > 2) {
				$subject 	=  $elem[2];
				for ($j = 3; $j < $nb_elem; $j++) {
					$subject .=  "\n". $elem[$j];
				}
			}
			else 
				$subject 	=   " ";
?>
				<TR>
					<TD class='listnum' height=30><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext'>
						<input  type='text' size='12' name="date_<?php echo($i); ?>" value="<?php echo($dates); ?>">
					</TD>
					<TD class='listtext'>
						<input  type='text' size='12' name="time_<?php echo($i); ?>" value="<?php echo($times); ?>">
					</TD>
					<TD class='listtext'>
						<textarea name="subject_<?php echo($i); ?>" cols="60" rows="2"><?php echo($subject); ?></textarea>
					</TD>
				</TR>
<?php 	}
?>

				</TABLE>
			</TD>
		</TR>
		<TR><TD height=15></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=100% class=formlabel colspan=2>
						<div align=center>
						<INPUT class=button type=submit name="viewtiming" value=' View Timing'>
						&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="addnewline" VALUE=' Add Line  '>
						&nbsp;&nbsp;
						<INPUT class=button type=submit name="updaterightt" value=' Update '>
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


		
function getHomeRightPage() {
	global $RIGHT_LIST;
	$items = array();
	$order = array();
	$nb_item = count($RIGHT_LIST);
	for ($i = 0; $i < $nb_item; $i++) {
		$title = getPostValue("title_".$i);
		$oo = getPostValue("itemorder_".$i);
		if ($oo == $nb_item) {
			$active = 0;
		}
		else {
			$active = 1;
		}
		$order[] = $oo;
		
		$elem = $RIGHT_LIST[$i];
		$elem[1] = $active;
		$elem[0] = $title;
		$items[] = $elem;
	}
	
	for ($k = 0; $k < ($nb_item-1); $k++) {
		for ($i = 0; $i < ($nb_item-1); $i++) {
			if ($order[$i] > $order[$i+1]) {
				$v = $order[$i];
				$order[$i] = $order[$i+1];
				$order[$i+1] = $v;
				$v = $items[$i];
				$items[$i] = $items[$i+1] ;
				$items[$i+1] =$v;
			}
		}
	}
	
	
	return $items;
}
	
function WriteHomeRightPage()
{
	$lists = $this->getHomeRightPage();
	$nb = count($lists);
	$text  = "<?php\n\n\$RIGHT_LIST = array(\n";
	for ($i = 0; $i < $nb; $i++) {
		$elem = $lists[$i];
		if (trim($elem[3]))
			$dola = "\$";
		else 
			$dola = "\"\"";
		if ($elem[1] == 1) {
			$text .= "array(\"".$elem[0]."\", 1, ".$dola.$elem[3]. ", \"".$elem[3]. "\"";
		}
		else {
			$text .= "array(\"".$elem[0]."\", 0, ".$dola.$elem[3]. ", \"".$elem[3]. "\"";
		}
		if ($i == $nb-1) {
			$text .= ")\n";
		}
		else {
			$text .= "),\n";
		}
	}
	$text .= ");\n?>\n";
	
	$fp = fopen("../php/right1.php", "w");
	fwrite($fp, $text);
	fclose($fp);
	return $lists;
}
	


function showHomeRightPageForm($newtab, $result) {
	global $RIGHT_LIST;
	if ($newtab) {
		$tab = $newtab;
	}
	else {
		$tab = $RIGHT_LIST;
	}
?>
<FORM action='admin.php' method=post>
<INPUT type=hidden name='action' value='updatehomerightpage'>
<INPUT type=hidden name='actiontype' value='homerightpagetype'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($result) ?></TD></TR>
<TR>
	<TD height=80><div class=item_tit>
		<h2>Home Page Right Part</h2>
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
					<TD class=labelleft height=30 height=30>
					
					<TD width=40% class=labelleft> 
						
					</TD>
					<TD width=50% class=labelleft>
						
					</TD>
				</TR>				
				
				
<?php
		$nb_items = count($tab);
		$active_n = 0;
 		for ($i = 0; $i < $nb_items; $i++) { 
 			$elem = $tab[$i];
			$active = $elem[1];
 			$title = $elem[0];
			if ($active == 1) 
				$active_n++;
			$tvar = $elem[3];
 
?>
				<TR>
					<TD width=10% class=lcenter height=30>
						<select name="itemorder_<?php echo($i); ?>" >
							<option value="<?php echo($nb_items); ?>"> --- </option>
	<?php 
						for ($k = 1; $k <= $nb_items; $k++) {
							if (($active == 1) && $active_n == $k) {
								echo ("<option value=".$k." selected> " .$k. " </option>");
							}
							else {
								echo ("<option value=".$k."> " .$k. " </option>");
							}
						}
						?>
						</select>					
					<TD class=labelleft colspan=2> 
						<input name="tvariable_<?php echo($i); ?>" id="tvariable_<?php echo($i); ?>" type="hidden" value="<?php echo($tvar); ?>">
						<input name="title_<?php echo($i); ?>" size=45 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
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





}

?>