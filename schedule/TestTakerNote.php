<?php  

$testtakerscore = array(
"TESTAKERS NOTICE",
"<font color=Navy><em>Score Choice</em></font> allows the test-taker to decide which SAT scores by test date to release to prospective colleges. In
the past, colleges would automatically receive all of your scores. <font color=Navy><em>Score Choice</em></font> is a free option that you choose
when you register for the test. If you do not choose it, your prospective colleges will continue to receive all of your scores.",

"<font color=Navy><em>Supper Score</em></font> is the combination of the best score for each SAT section (Math, Critical Reading & Writing) from multiple tests, 
rather than just the total score of each SAT section from one single test. Super Score is required in Common Application for college admission.",

"College applicants should take their SAT as early as they can and as often as they can, based on the fact that more and more  colleges honor Score Choice and accept Common Application."
);

$whytesttaker = array(
"REASONS WHY TESTAKERS IS BEST",
"Excellent results",
"Proven record of success",
"Experts in test preparation",
"A variety of test-taking techniques",
"Classes are small - 12 students on average",
"Four diagnostic SATs",
"Sophisticated computer analysis",
"The Testtakers SAT Vocab Box",
"Bright, dedicated, and personable staff",
"The Benefits Can Last A Lifetime."
);

?>

<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td valign=top>
		<TABLE cellSpacing=0 cellPadding=10 width=100% border=0>
		<TR vAlign=top>
			<TD  class=MEET_DATE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=MEET_DATE>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
						<TR>
							<TD class=ITEMS_LINE_TITLE>
								<TABLE cellSpacing=2 cellPadding=0 width=100% border=0>
								<TR>
									<TD class=TABLE_COL1 width=50% valign=top>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<TD class=TABLE_COL1 height=30>	
												<div align=center>								
												<font color=Navy size=3><?php echo($testtakerscore[0]); ?></font>
												</div>
											</TD>
										</TR>
										<?php for ($i = 1; $i < count($testtakerscore); $i++) { ?>
										<TR>
											<TD class=TABLE_COL2>									
												<div align=justify>
												<?php echo($testtakerscore[$i]); ?>
												</div>
											</TD>
										</TR>
										<TR>
											<TD class=TABLE_COL1 height=5></TD>
										</TR>
										<?php } ?>
										</TABLE>
									</TD>
									<TD class=TABLE_COL1 width=50% valign=top>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
										<TR>
											<TD class=TABLE_COL1 height=30>	
												<div align=center>								
												<font color=Navy size=3><?php echo($whytesttaker[0]); ?></font>
												</div>
											</TD>
										</TR>
										<?php for ($i = 1; $i < count($whytesttaker)-1; $i++) { ?>
										<TR>
											<TD class=TABLE_COL2>									
												<div align=center>
												<?php echo($whytesttaker[$i]); ?>
												</div>
											</TD>
										</TR>
										<?php } ?>
										<TR>
											<TD class=TABLE_COL1 height=40>									
												<div align=center>
												<font color=black size=3><em><?php echo($whytesttaker[count($whytesttaker)-1]); ?></em></font>
												</div>
											</TD>
										</TR>
										</TABLE>
									</TD>
								</TR>
							
								</TABLE>
							</TD>
						</TR>
						<TR><TD height=10> </TD></TR>
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
