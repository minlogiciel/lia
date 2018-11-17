<?php

include_once ("../public/announce.inc");
include_once ("../public/lastnews.inc");

class AnnounceForm {


function writeAnnounce($type=0) {
	$TTABLE = array("ANNOUNCEMENT", "LASTNEWS", "announce.inc", "lastnews.inc");
	
	$annonce  = $_POST["announce"];
	
	$tab = AnnonceTextToTable($annonce);
	
	$text  = "<?php\n\n\$".$TTABLE[$type]. "= array(\n";

	for ($i = 0; $i < count($tab); $i++) {
		$text  .=  "\t\"".$tab[$i]."\",\n";
	}
	$text .=");\n\n?>\n\n";
	
	
	$fp = fopen("../public/".$TTABLE[$type+2], "w");
	fwrite($fp, $text);
	fclose($fp);
	return $tab;
}



function ShowAnnouncementForm($type = 0, $annocestr, $result) {
	global $ANNOUNCEMENT, $LASTNEWS;
	$TTABLE = array("ANNOUNCEMENT", "LAST NEWS",  $ANNOUNCEMENT, $LASTNEWS, "updateannounce", "updatelastnews");
	if ($annocestr) {
		$tab  = $annocestr;
	}
	else {
		if ($type == 0) $tab = $ANNOUNCEMENT;
		else $tab = $LASTNEWS;
	}
	$announce = "";
	for ($i = 0; $i < count($tab); $i++) {
		$announce .= $tab[$i]. "\n";
	}
?>
<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='announcement'>
<INPUT type=hidden name='action' value='<?php echo($TTABLE[$type+4]); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=70% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30 >
				<b><?php echo($TTABLE[$type]); ?></b>
			</TD>
		</TR>
		<TR>
			<TD class='lcenter'>
				<textarea name="announce" cols="80" rows="15"><?php echo($announce); ?></textarea>
			</TD>
			</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
<TR>
	<TD height=30 class=lcenter>
		<INPUT class=button type=submit value=' Update <?php echo($TTABLE[$type]); ?>'>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
</TABLE>
</FORM>
<?php 
}

}

?>