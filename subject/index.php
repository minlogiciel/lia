<?php 
include "../php/allinclude.php";
session_start();

$subj_id = isset($_POST["subject"]) ? $_POST["subject"] : (isset($_GET["subject"]) ? $_GET["subject"] : 2);
$cour_id = isset($_POST["courses"]) ? $_POST["courses"] : (isset($_GET["courses"]) ? $_GET["courses"] : 0);
$SUBJ_COURSES = $SUBJECTS_LIST[$cour_id];
$SUBJ_TEXT = $SUBJECTS_TEXT_LIST[$cour_id];

include "../php/header.php"; 
?>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	
	<td width=200 valign=top class=ITEMS_BG> <?php include "courseleft.php" ?> </td>
	<td width=750 valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=PAGE_TITLE width=100% height=25>
										&nbsp;&nbsp;&nbsp;&nbsp; <?php echo($SUBJ_COURSES[$subj_id]); ?>
									</TD>
								</TR>
							    <TR>
							    	<TD > 
							    		<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 height=350>
							    		<TR>
							    			<TD valign=middle width=100% class=formlabel>
							    				<div align=center>
							    				<?php echo($SUBJ_TEXT[$subj_id-2]); ?>
							    				</div>
											</TD>
										</TR>
										<?php if ($cour_id == 1 && $subj_id==3) {?>
										<TR>
											<TD class=error height=40>
												<DIV align=center>
												<?php 
												$text = "<m>3x^2 - 2x - 5 = 0</m>"; 
												echo(mathfilter($text, 12,"../phpmath/img/"));
												?>
												</DIV>
											</TD>
										</TR>
										<?php } else if ($cour_id == 1 && $subj_id==4) {?>
										<TR>
											<TD class=error height=40>
												<DIV align=center>
												<?php $text = "<m>S(f)(t)=a_{0}+sum{n=1}{+infty}{a_{n} cos(n omega t)+b_{n} sin(n omega t)}</m>"; 
												echo(mathfilter($text, 12,"../phpmath/img/"));
												?>
												</DIV>
											</TD>
										</TR>
										<?php } else if ($cour_id == 1 && $subj_id==6) {?>
										<TR>
											<TD class=error height=40>
												<DIV align=center>
												<?php $text = "<m>delim{|}{{1/N} sum{n=1}{N}{gamma(u_n)} - 1/{2 pi} int{0}{2 pi}{gamma(t) dt}}{|} <= epsilon/3</m>";
												echo(mathfilter($text, 12,"../phpmath/img/"));
												?>
												</DIV>
											</TD>
										</TR>
										<?php } else if ($cour_id == 1 && $subj_id==8) {?>
										<TR>
											<TD class=error height=40>
												<DIV align=center>
												<?php $text = "<m>delim{lbrace}{matrix{3}{1}{{3x-5y+z=0} {sqrt{2}x-7y+8z=0} {x-8y+9z=0}}}{ }</m>"; 
												echo(mathfilter($text, 12,"../phpmath/img/"));
												?>
												</DIV>
											</TD>
										</TR>
										<?php } ?>
										</TABLE>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>

				
				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
<?php 
include "../php/footer.php"; 
?>
