<?php
class MailToParent {

	var $titre = "Message";							## Title
	var $email = '';								## Email text
	var $lia_email = "betty@longislandacademy.net";	## LIA email address
	var $min_email = "mdai@sefas.com";		## Backup Email
	var $priority = 1;								## Priorité du message      **|1|2|3|4|5|**
	var $MAIL_OK = 1;
	
	function EmailHeader(){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: LIA <' .$this->lia_email. '>' ."\r\n";
		$headers .= 'Reply-To: LIA <' .$this->lia_email . '>' ."\r\n";
		$headers .= "\r\n\r\n";
		return $headers;
	}
	
	function SendToLIA($title, $text, $classesname, $student=''){
		$texte = '';
		if ($text && $title) {
			$headers  = $this->EmailHeader($title);
			$ttitle = $title. " " .$classesname;
			$texte = getEmailText($text, $student);
			$ttexte = $this->body($texte);
			$this->writeEmail($headers, $this->min_email, $ttexte);
			
			if ($this->MAIL_OK) {
				if (mail($this->min_email, $ttitle, $ttexte, $headers)) {
					return 1;
				}
			}
			return 0;
		}
	}

	function getDestEmailAddress($eaddress){
		if ($this->MAIL_OK) {
			return $eaddress;
		}
		else {
			return $this->min_email;
		}
	}
	
	function getStudentEmail($student){
		$stemail = "";
		$email = $student->getEmail();
		if ($email) {
			if (strstr($email, ";")) {
				$listemail  = explode(";", $email);
				for ($i = 0; $i < count($listemail); $i++) {
					if ($i > 0)
						$stemail .= ", ";
					$stemail .= $listemail[$i];
				}
			}
			else {
				$stemail = $email;
			}
		}
		return $stemail;
	}
	
	function createReportCard($student){
	
		$pdf = new CreateReport();
		$semester = getSemester();
		$annee = getAnnee();
		
		/* should call first */
		$pdf->init($semester, $annee);
						
		$pdf->createStudentClassReport($student);
	
	}
	
	function SendMixedEmailText($title, $text, $student){
		
		$random_hash = '000123456789000';
		
		$this->createReportCard($student);

		$stemail = $this->getStudentEmail($student);
		
		$texte = getEmailText($text, $student);
		$this->titre = getEmailText($title, $student);
		$to = changeEmailTag($stemail);	
		
		$headers  = 'MIME-Version: 1.0 '. "\r\n";
		$headers .= 'Content-Type: multipart/mixed; boundary="PHP-mixed-' .$random_hash. '"'. "\r\n";
		$headers .= 'From: LIA <' .$this->lia_email. '>' . "\r\n";
		$headers .= 'Reply-To: LIA <' .$this->lia_email. '>' . "\r\n";
		$headers .= "\r\n\r\n";
				
		
		$mtext  = '--PHP-mixed-' .$random_hash. "\r\n";
		$mtext .= 'Content-Type: multipart/alternative; boundary="PHP-alt-' .$random_hash. '"' . "\r\n\r\n";
/*
		$mtext .= '--PHP-alt-' .$random_hash. "\r\n";
		$mtext .= 'Content-Type: text/plain; charset="iso-8859-1"'. "\r\n";
		$mtext .= 'Content-Transfer-Encoding: 7bit'. "\r\n\r\n";
		$mtext .=  $texte. "\n\n";
*/		
		$mtext .= '--PHP-alt-' .$random_hash. "\r\n";;
		$mtext .= 'Content-type: text/html; charset="iso-8859-1"'. "\r\n";
		$mtext .= 'Content-Transfer-Encoding: 7bit'. "\r\n\r\n";
		$mtext .=  $this->bodyattached($texte, $student). "\n\n";
		$mtext .= '--PHP-alt-' .$random_hash. '--'. "\r\n\r\n";

		$classname = $student->getClasses();
		$class_nb = getClassNumber($classname);
		$pdf = new CreateReport();
		$semester = getSemester();
		$annee = getAnnee();
		/* should call first */
		$pdf->init($semester, $annee);
		for ($nc = 1; $nc <= $class_nb; $nc++) {
			$classes = getClassElementName($classname, $nc);
			$pdf->setClassReportFileNameClass($classes);
			$filename = $pdf->ReportFileName("", 1);
			$reportfile = $classes."_report.pdf";
			$attachment = chunk_split(base64_encode(file_get_contents($filename))); 
			$mtext .= "\r\n\r\n";
			$mtext .= '--PHP-mixed-' .$random_hash. "\r\n";
			$mtext .= 'Content-Type: application/x-pdf; name="' .$reportfile.'"' . "\r\n";
			$mtext .= 'Content-Transfer-Encoding: base64 '. "\r\n";
			$mtext .= 'Content-Disposition: attachment;'. "\r\n\r\n";
			$mtext .= $attachment;
		}
		$mtext .= "\r\n\r\n";
		$mtext .= '--PHP-mixed-' .$random_hash. '--'. "\r\n\r\n";
		
		$to = $this->getDestEmailAddress($to);
		if (mail($to, $this->titre, $mtext, $headers)) {
			return 1;
		}
		return 0;
		
	}
	
	function SendToParent($title, $text, $student, $reportcard){
		$this->titre = $title;
		
		$stemail = $this->getStudentEmail($student);
		if ($stemail) {
			if ($reportcard) {
				return $this->SendMixedEmailText($title, $text, $student);
			}
			else {
				$texte = getEmailText($text, $student);
				$this->titre = getEmailText($title, $student);
				$to = changeEmailTag($stemail);
				
				$headers  = $this->EmailHeader();
				
				$texte = $this->getEmailParagraphText($texte);
				$texte = $this->body($texte);
				$to = $this->getDestEmailAddress($to);
				if (mail($to, $this->titre, $texte, $headers)) {
					return 1;
				}
				return 0;
			}
		}
		return 0;
	}
	
	function SendToPlacement($title, $text, $student){
		$this->titre = $title;
		
		$stemail = $this->getStudentEmail($student);
		if ($stemail) {
			$texte = getEmailTextSimple($text, $student);
			$this->titre = getEmailTextSimple($title, $student);
			$to = changeEmailTag($stemail);

			$headers  = $this->EmailHeader();
			
			$texte = $this->body($texte);
			
			$to = $this->getDestEmailAddress($to);
			if (mail($to, $this->titre, $texte, $headers)) {
				return "Send Email to " .$stemail. " Success.";
			}
			return "Send Email to " .$stemail. " Faild.";
		}
		return "";
	}

	function getEmailParagraphText($text){
		$texte = "";
		if ($text) {
			$texte = str_replace("<br>", "&nbsp;</p>\n<p>", $text);
			$texte = "<p>" . $texte. "</p>";
		}
		return $texte;
	}
	
	function SendToGroupParent($title, $text, $emaillist){
		
		$to = changeEmailTag($emaillist);
		$this->titre = $title;

		$texte = getEmailText($text, '');
		
		$texte = $this->getEmailParagraphText($texte);
		
		$texte = $this->body($texte);
				
		$headers  = $this->EmailHeader();
		
		//$this->writeEmail($headers, $to, $texte);

		$to = $this->getDestEmailAddress($to);
		if (mail($to, $this->titre, $texte, $headers)) {
			return 1;
		}
		return 0;
	}
	
	function getEmailText($title, $text, $student, $reportcard=0){
		$texte = '';
		if ($student && $text && $title) {
			$texte = getEmailText($text, $student);
			$tt = getEmailText($title, $student);
			$texte = strtoupper($tt). "<br><br>" .$texte;
			if ($reportcard)  {
				$texte = $texte. "<br><br>" .getAttachedReportText($student);
			}
		}
		return $texte;
	}
	function getEmailTextSimple($title, $text, $student){
		$texte = '';
		if ($student && $title) {
			$tt = getEmailTextSimple($title, $student);
			if ($text) {
				$texte = getEmailTextSimple($text, $student);
			}
			else {
				$texte = "";
			}
			$texte = strtoupper($tt). "<br><br>" .$texte;
		}
		return $texte;
	}
	
	function body($texte){
		$body = "<html><head><title>".$this->titre."</title></head><body>\n".$texte."\n</body></html>";
		return $body;
	}
	function bodyattached($texte, $student) {
		$body = '<html><head><title>'.$this->titre.'</title></head>  ' ."\n";
		$body .= '<body text="#000000" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">' ."\n";
		$body .= $texte. '<br>' ."\n";
		$body .= getAttachedReportText($student). '<br>' ."\n";;
		$body .= '</body></html>' ."\n";
		return $body;
	}
	function writeEmail($header, $addr, $texte){
		$filename = "../email/exampleemail.eml";
		$fp = fopen($filename, "w");
		$contents = $header. $texte;
		fwrite($fp, $contents);
		fclose($fp);
	}
	
}

?>
