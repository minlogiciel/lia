<?php 

include ("regents.inc");

class RegentsForm {

var $SEP_LINE = 3;

function ShowRegentsTable($result) {
	global $RegentsList, $RegentsNote;
?>

<!-- FORM method=post action='admin.php' -->
<FORM action='admin.php' name="uploadtesttaker" method=post enctype="multipart/form-data">
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='testtakertype'>
<INPUT type=hidden name='action' value='updatetesttaker'>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=TUITION_TITLE width=100% height=40>
				<div align=center>
					<font color=red>Revised</font>
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=TUITION_TITLE width=100% height=50>
				<div align=center>
				<font size=4>Regents Review Courses Schedule</font>
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=MEET_AUTOR width=100% height=70>
				<font color=black>
				<br> For <br>
				<b>June 2014</b><br>
				<b>New York State Regents Exams</b>
				</font>
			</TD>
		</TR>
		<TR>
			<TD height=30 class=labelright width=100%>
				5-26*  Memorial Day  - Class hour will be announced.&nbsp;&nbsp;&nbsp;   
			</TD>
		</TR>
		</TABLE>
<!--  
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=30 class=error><?php echo($result); ?></TD></TR>
		<TR><TD height=50><font color=red size=4><b>Regents Courses Schedule (New York State Regents Exams)</b></font></TD></TR>
		<TR>
			<TD class=TUITION_TITLE width=100% height=40>
				<div align=center>
					<font color=red><?php echo($RegentsNote[0]); ?></font>
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=MEET_AUTOR width=100% height=70>
				<b><?php echo($RegentsNote[1]); ?></b>
			</TD>
		</TR>
		<TR>
			<TD height=30 class=labelright width=100%>
				5-26*  Memorial Day  - Class hour will be announced.&nbsp;&nbsp;&nbsp;   
			</TD>
		</TR>
		</TABLE>
-->
	</TD>
</TR>
<TR>
	<TD class=background valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30 width=22%>Subject</TD>
			<TD class=ITEMS_LINE_TITLE height=30 width=6%>Grade</TD>
			<TD class=ITEMS_LINE_TITLE height=30 width=6%>Date</TD>
			<TD class=ITEMS_LINE_TITLE height=30 width=48%>Class Schedule</TD>
			<TD class=ITEMS_LINE_TITLE height=30 width=6%>Tuition</TD>
		</TR>
<?php 
$nline = count($RegentsList);
for ($i = 0; $i < $nline; $i++) {
	$items = $RegentsList[$i];
	$subject = $items[0];
	$grade = $items[1];
	$dates = $items[2];
	$schedule = $items[3];
	$tuittion = $items[4];
?>
		<TR>
			<TD class=lcenter>
<?php
			echo("<b>".$subject[0]."</b><br><br>");
			for ($j = 1; $j < count($subject); $j++) { 
				echo("( ".$subject[$j]." )<br>");
			}
?>
			</TD>
			<TD class=lcenter>
				<?php echo($grade."<sup>th</sup>"); ?>
			</TD>
			<TD class=lcenter>
<?php 		for ($j = 0; $j < count($dates); $j++) { 
				echo($dates[$j]."<br>");
			}
?>
			</TD>
			<TD class=lcenter>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
<?php
 				for ($k = 0; $k < count($schedule); $k++) {
 					$elem = $schedule[$k];
?>
				<TR>
					<TD class=REGENT_COL2 width=5><?php echo($elem[0]); ?></TD>
					<TD class=REGENT_COL1 width=98%>
						<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD class=REGENT_COL2 colspan=2><?php echo($elem[1]); ?> : </TD>
						</TR>
					<?php 
						for ($j = 2; $j < count($elem); $j+=2) { ?>
						<TR>
							<TD class=REGENT_COL1 width=50%>
								<div align=left><?php echo($elem[$j]); ?></div>
							</TD>
							<TD class=REGENT_COL1>
								<div align=right><?php echo($elem[$j+1]); ?></div>
							</TD>
						</TR>
					<?php	}?>
						</TABLE>
					</TD>
				</TR>
	<?php 		if ($k < count($schedule) -1)  { ?>
				<TR><TD class=registerborder height=1 colspan=2></TD></TR>
 		<?php 	}	}	?>
				</TABLE>
			</TD>
			<TD class=lcenter><?php echo($tuittion); ?></TD>
		</TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR> <TD height=20></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
		<TR>
			<TD class=LIST_LINE2 width=20><IMG src="../images/ok.gif"></TD>
			<TD class=LIST_LINE2 height=30>
					Schedule for certain day is subject to change according to teachers' and students' need.
			</TD>
		</TR>
		<TR>
			<TD class=LIST_LINE2 width=20><IMG src="../images/ok.gif"></TD>
			<TD class=LIST_LINE2 height=30>
				Tuition may vary if there are less than 5 students in the class. 
       			Small group lessons are available for all courses priced as below:
			</TD>
		</TR>
		<TR>
			<TD class=LIST_LINE2 width=20></TD>
			<TD class=LIST_LINE2 height=30>
   					2 students: $50-55 each; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           			3 students: $45-50 each; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           			4 students: $40-45 each
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=60><a href='<?php echo($RegentsLink); ?>'>Download Regents Review Courses Schedule (.doc)</a></TD></TR>
</TABLE>
</FORM>
<?php 
}

}
?>
