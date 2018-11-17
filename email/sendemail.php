<?php
class sendemail {

	var $titre = "New Message";			## Titre par défaut du email
	
	var $texte = '';	 				## Texte par défaut du email
	var $email = '';					## Email à qui on envois
	var $name  = '';	 				## Nom à qui on envois

//	var $lia_email = "liacademy@aol.com";	## Adresse email de l'auteur du email
	var $lia_email = "lia@longislandacademy.net";	## Adresse email de l'auteur du email
	
	var $type = 'html';					## Type de email envoyé     **|html|text|none|**
	
	var $priority = 1;					## Priorité du message      **|1|2|3|4|5|**


	function sendemail(){
		if($this->email != '' && $this->texte != ''){
			
			$to = 'LIA <' .$this->lia_email. '>';

			if($this->name != ''){
				$de = $this->name." <".$this->email.">";
			}
			else{
				$de = $this->email;
			}

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' .$de ."\r\n";
			$headers .= 'Reply-To: ' .$de ."\r\n";
			$headers .= "X-Priority: 1";
						
			 
			$texte  = $this->body($this->texte);
			
			$this->titre = "Message from : " .$de;
			mail($to, $this->titre, $texte, $headers);
		}
	}

	function sendpassword(){
		if($this->email != '' && $this->texte != ''){
			
			if($this->name != ''){
				$to = $this->name." <".$this->email.">";
			}
			else{
				$to = $this->email;
			}
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: LIA <' .$this->lia_email. '>' ."\r\n";
			$headers .= 'Reply-To: LIA <' .$this->lia_email. '>' ."\r\n";
			$headers .= "X-Priority: 1";
			
			 
			$texte = $this->body($this->texte);
			
			mail($to, $this->titre, $texte, $headers);
		}
	}
	
	
	function body($texte){
		//$body="$texte";
		$body = '<html><head><title>'.$this->titre.'</title></head>
				<body text="#000000" link="#640c0b" vlink="#640c0b" alink="#640c0b"
				leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">'
				.$texte. '</body></html>';
		return $body;
	}
}

?>
