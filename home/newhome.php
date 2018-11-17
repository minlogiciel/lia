<?php
include "../php/allinclude.php";
session_start();
include ("../public/newslists.php");
include ("../public/registerlists.php");
include ("../public/educationlists.php");
include ("homeinclude.php");


include ("../php/title1.php");
$aa = $TOPPHOTOS[0];
$bb = $TOPPHOTOS[1];
$cc = $TOPPHOTOS[2];
?>

<BODY>

<?php include "../php/maintitle.php"; ?>
<div class="content">
<div class="left">
	<div class="left_pic">		
		<ul id="YSlide">
      		<li style="display: block;" class="YSample">
				<a href='<?php echo($aa[1]); ?>'><IMG style="opacity: 1;" SRC="../images/<?php echo($aa[0]); ?>" border=0 height="278" width="490"></a>
				<div class=title1>
					<h2><font color=red><?php echo($aa[2]); ?></font></h2>
					<p>
					<?php 
						for ($i= 2; $i < count($ADMI2013); $i+=2) {
							echo("&bull;&nbsp;&nbsp;" .$ADMI2013[$i]. " : &nbsp;&nbsp;" .$ADMI2013[$i+1]."<br>");
						} 
					?>
					</p>
				</div>
			</li>
      		<li style="display: none;" class="YSample">
 				<a href='<?php echo($bb[1]); ?>'><IMG style="opacity: 1;" SRC="../images/<?php echo($bb[0]); ?>" border=0 height="278" width="490"></a>
				<div class=title1>
					<h2><font color=red><?php echo($bb[2]); ?></font></h2>
					<p>
					<?php 
						for ($i= 2; $i < count($ADMI2012); $i+=2) {
							echo("&bull;&nbsp;&nbsp;" .$ADMI2012[$i]. " : &nbsp;&nbsp;" .$ADMI2012[$i+1]."<br>");
						} 
					?>
					</p>
				</div>
			</li>
			<li style="display: none;" class="YSample">
				<a href='<?php echo($cc[1]); ?>'><IMG style="opacity: 1;" SRC="../images/<?php echo($cc[0]); ?>" border=0 height="278" width="490"></a>
				<div class=title1>
					<h2><font color=red><?php echo($cc[2]); ?></font></h2>
					<p>
					<?php 
						for ($i= 2; $i < count($SATIHIGHSCORE); $i+=2) {
							echo("&bull;&nbsp;&nbsp;" .$SATIHIGHSCORE[$i]. " : &nbsp;&nbsp;" .$SATIHIGHSCORE[$i+1]."<br>");
						} 
					?>
					</p>
				</div>
			</li>
		</ul>
		
		<div id="YSIndex">
	        <ul>
		        <li class="li_01  current"><a><img src="../images/<?php echo($aa[0]); ?>" border="0" height="70" width="126"></a></li>
		        <li class="li_02 "><a><img src="../images/<?php echo($bb[0]); ?>" border="0" height="70" width="126"></a></li>
		        <li class="li_03 "><a><img src="../images/<?php echo($cc[0]); ?>" border="0" height="70" width="126"></a></li>
	        </ul>
      	</div>
	</div>
	<div><img src="../images/box_bg.gif"></div>
	
	<!-- start wen hua -->
	<div class="left_box">
      <div class="box_tit">
        <div align=center><h2><a href="../schedule/index.php?scheduletype=4"><font color=red>Open House Test / Summer Placement Test</font></a></h2></div>
      </div>
      <div class="box_txt">
      	
        <div class="tit_img">
        	<p><a  href="../schedule/OpenTestResult.php?annee=2013"><font color=red>2013 Summer Placement Test Report</font></a></p>
           <a  href="../schedule/OpenTestResult.php?annee=2013"><img src="../images/trophy.jpg" border="0" height=160 ></a>
           <p><a  href="../schedule/OpenTestResult.php?annee=2012"><font color=red>2012 Summer Placement Test Report</font></a></p>
        </div>
        
   <?php

include "summertop.php"
?>
        <div class="text2">
            <TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">			
			<TR>
				<TD class=OPEN_HOUSE_TITLE>
					<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
					<TR>
						<TD class=OPEN_HOUSE_TITLE height=40>
							Congratulations :
						</TD>
					</TR>
					
					</TABLE>
				</TD>
			</TR>
			<TR>
				<TD class=OPEN_HOUSE_LINE>
						<MARQUEE onmouseover=this.stop() onmouseout=this.start() trueSpeed scrollAmount=1 scrollDelay=25 direction=up>
						<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align="center">
						
					<TR><TD colspan=2 height=5 class=OPEN_HOUSE_LINE></TD></TR>
						
					<?php for ($i = 0; $i < count($_SUMTOP2013); $i+=2) { ?>
					<TR>
						<TD class=OPEN_HOUSE_LINE height=20 width=70% valign="top">
							<div align=left> <?php echo($_SUMTOP2013[$i]); ?></div>
						</TD>
						<TD  class=OPEN_HOUSE_LINE width=30%>
							<div align=left><?php echo($_SUMTOP2013[$i+1]); ?></div>
						</TD>
					</TR>
					<?php } ?>
					
					<TR><TD colspan=2 height=5 class=OPEN_HOUSE_LINE></TD></TR>
					
					</TABLE>
					</MARQUEE>
				</TD>
			</TR>
			</TABLE>         
         </div>
      </div>
    </div>
	<!--  end wenhua -->
	<!-- start register -->
	<div class="left_box">
      <div class="box_tit">
        <h2><a href="<?php echo($HOME_HD[1]); ?>"><?php echo($HOME_HD[0]); ?></a></h2>
      </div>
      <div class="box_txt">
        <div class="tit_img">
          <a href="<?php echo($HOME_HD[1]); ?>"><img src="../images/Picture_020-758x300.jpg" border="0" height="140" width="290"></a>

        </div>
        <div class="text2">
          <ul> 
      	<?php 
//$SCHEDULE_MENU = array("Summer School", "TestTakers SAT/PSAT", "AP/SAT II", "ACT", "Regents", "NYS ELA & Math Test");
$SCHEDULE_MENU = array("TestTakers SAT/PSAT",  "ACT", "PSAT", "Fall Saturday School");

      		for ($n = 0; $n < count($SCHEDULE_MENU); $n++) {
         ?>
         	<li><a href="../schedule/?scheduletype=<?php echo($n); ?>"><?php echo($SCHEDULE_MENU[$n]); ?></a></li> 
 		<?php } ?>
           </ul>
        </div>
      </div>
    </div>
	<!--  end register -->
</div>

<script language="javascript" type="text/javascript" src="../scripts/yao.js"></script>
<script language="javascript" type="text/javascript">
        <!--
        YAO.YTabs({
                tabs: YAO.getEl('YSIndex').getElementsByTagName('li'),
                contents: YAO.getElByClassName('YSample', 'li', 'YSlide'),
                defaultIndex: 0,
                auto: true,
                fadeUp: true
        });
        //-->
</script>

<?php 
$aa = $HOMERIGHT[0];
?>

<div class="right">

 	<div class="right_box right_box3">
      <br>
      <div align=center><h3><font color=Navy>LIA ANNOUNCEMENT</font></h3></div>
      <div class="img">
		<br>
		<div align=center><b><font color=red><?php echo($ANNOUNCEMENT); ?></font></b></div>
 		<br><br>
       </div>
     <div><img src="../images/box_bg2.gif"></div>
     </div>
 
<?php
$SCHEDULELIST = array(
"Saturday School",
"09/21/2013", "9:30am-12:30pm", "Session 1", 
"09/28/2013", "9:30am-12:30pm", "Session 2", 
"10/05/2013", "9:30am-12:30pm", "Session 3", 
"10/12/2013", "9:30am-12:30pm", "No Class (Columbus Day)", 
"10/19/2013", "9:30am-12:30pm", "Session 4", 
"10/26/2013", "9:30am-12:30pm", "Session 5", 
"11/02/2013", "9:30am-12:30pm", "Session 6", 
"11/09/2013", "9:30am-12:30pm", "Session 7", 
"11/16/2013", "9:30am-12:30pm", "Session 8", 
"11/23/2013", "9:30am-12:30pm", "Session 9", 
"11/30/2013", "9:30am-12:30pm", "No Class (Thanksgiving Day)", 
"12/07/2013", "9:30am-12:30pm", "Session 10", 
"12/14/2013", "9:30am-12:30pm", "Session 11", 
"12/21/2013", "9:30am-12:30pm", "Final Exam", 
);
?>
	 
<div class="right_box right_box3">
	<div class=item_tit><?php echo($SCHEDULELIST[0]); ?></div>
 	<div class=item_schdule>  
 	<?php 
		for ($i = 1; $i < count($SCHEDULELIST); $i+=3) {
			$dates = $SCHEDULELIST[$i];
			$dates = getFullDateSimple($dates);						
			$times = $SCHEDULELIST[$i+1];
			$title = $SCHEDULELIST[$i+2];
		?>								
 			<div class=list_tit><?php echo($dates. "&nbsp;&nbsp;&nbsp;&nbsp;" .$times); ?></div>
			<div class=list_text><?php echo($title); ?></div>
	<?php } ?>
 
 	</div>
</div>
<div><img src="../images/box_bg2.gif"></div>
 
 	<div class="right_box right_box3">
 		<br>
      <div align=center><h3>ACT For October Test</h3></div>
      <div class="img">

 	<?php
$ACTLIST = array(
array("9/07/2013", "9:00pm-12:00pm", "English & Writing"), 
array("9/14/2013", "9:00pm-12:00pm", "Math"), 
array("9/21/2013", "9:00pm-12:00pm", "Full-length Test"), 
array("9/28/2013",	"9:00pm-12:00pm", "Reading & Writing"), 
array("10/05/2013", "9:00pm-1:00pm", "Full-length Test"), 
array("10/12/2013", "9:00pm-1:00pm", "Science"), 
array("10/19/2013", "9:00pm-1:00pm", "Full-length Test"), 
);
 	
		for ($i = 0; $i < count($ACTLIST); $i++) {
			$elem = $ACTLIST[$i];
			$dates = $elem[0];
			$dates = getFullDateSimple($dates);						
			$nn = count($elem)/2;
		
			for ($j = 0; $j < $nn; $j+=2) {
			$times = $elem[$j+1];
			$title = $elem[$j+2];
		?>								
			<div align=left>&nbsp;&nbsp;<font color=Navy><b><?php echo($dates. "&nbsp;&nbsp;&nbsp;&nbsp;" .$times); ?></b></font></div>
			
			<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($title); ?></div>
			<br>
	<?php }} ?>
 
       </div>
     <div><img src="../images/box_bg2.gif"></div>
     </div>

  
 <?php 
$aa = $HOMERIGHT[0];
?>
     
	<div class="right_box right_box_top">
      <h3><?php echo($aa[2]); ?></h3>
      <h6><?php echo($aa[3]); ?></h6>
      <div class="img">
        <a target="_blank" href="<?php echo($aa[1]); ?>"><img src="../images/<?php echo($aa[0]); ?>" border="0" height="80px" width="240px"></a>
      </div>
      <div><img src="../images/box_bg2.gif"></div>
    </div>
 </div>
 	
</div>
<?php 
//include "../php/foot1.php"; 
?>

</body>
</html>
