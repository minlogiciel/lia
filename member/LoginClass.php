<?php
include_once ("../email/sendemail.php");

class LoginClass 
{
	var $error = '';
	function getError() {
		return $this->error;
	}
	
	function setCookie($log_name, $log_passwd, $rememberme) {
	    $expires = time() + 30*3600*24*$rememberme ; /* 30 days */
 		setcookie("liastudentname", $log_name, $expires);
		setcookie("liastudentpassword", $log_passwd, $expires);
	}
	
	function getLogin() {
		if (isset($_POST['log_name']))
			$log_name = $_POST['log_name'];
		if (isset($_POST['log_passwd']))
			$log_passwd = $_POST['log_passwd'];

		$student = new StudentClass();
		
		$isOK = $student->getRegistedUser($log_name, $log_passwd);
		if ($isOK) {
			$this->error = '';
			//$this->setCookie($log_name, $log_passwd, $rememberme);
		}
		else {
			$this->error = "Loginname and password are wrong.";
			$this->error .= $student->getTrace();
			$student = '';
		}
		return $student;
	}
	function changeInfo() {
		$student = '';
		$street = "";
		$email = "";
		$city = "";
		$postcode = "";
		$department = "";
		$country = "";
		$phone = "";
		$mobile = "";
		$studentid = 0;
		$isOK = 0;
		if (isset($_POST['street']))
			$street = $_POST['street'];
		if (isset($_POST['email']))
			$email = $_POST['email'];
		if (isset($_POST['city']))
			$city = $_POST['city'];
		if (isset($_POST['postcode']))
			$postcode = $_POST['postcode'];
		if (isset($_POST['department']))
			$provence = $_POST['department'];
		if (isset($_POST['country']))
			$country = $_POST['country'];
		if (isset($_POST['phone']))
			$phone = $_POST['phone'];
		if (isset($_POST['mobile']))
			$mobile = $_POST['mobile'];
			
		if (isset($_POST['studentid']))
			$studentid = $_POST['studentid'];
		if ($studentid) {
			$student = new StudentClass();
			if ($student->getUserByID($studentid)) {
				$student->setEmail($email);
				$student->setStreet1($street);
				$student->setStreet2("");
				$student->setCity($city);
				$student->setPostCode($postcode);
				$student->setProvence($provence);
				$student->setCountry($country);
				$student->setPhone($phone);
				$student->setMobile($mobile);
				
				if ($student->updateAddress()) {
					$isOK = 1;
				}
				else {
					$this->error = "Modify Information Error : ";
					$this->error .= $student->getTrace();
					$student = '';
				}
			}
			else {
				$student = '';
			}
		}
		return $student;
	}
	
	function getpassclass($youremail, $username, $userpass) {
		$this->youname = $username;
		$this->youemail = $youremail;
		$this->youpass = $userpass;
		$this->setText();
	}
	function setText(){
	}

	function getForgotPassword() {
		$youremail = "";
		if (isset($_POST['your_email']))
			$youremail = $_POST['your_email'];
		$student = new StudentClass();
		if ($student->isEmailValide($youremail)) {
			if ($student->getUserByEmail($youremail)) {
				$name = $student->getPseudo();
				$pass = $student->getPassword();
			
				$texte = "Your Login : " . $name . "\r\n Your Password : " . $pass . "\r\n";
				$sendemail 					= new sendemail; 			
				$sendemail->title 			= "Forgot Your Password";
				$sendemail->email 			= $youremail;
				$sendemail->name 			= $name;
				$sendemail->texte			= $texte;
				
				$sendemail->sendpassword();

				$msg = "Your password will be sent to your email address " .$youremail. ".";
			}
			else {
				$msg = "! Your email address is not found!";
			}
		}
		else {
			$msg = "! Your email is not valide!";
		}
		return $msg;
	}
	
	function changePassword() {
		$passwd = "";
		$new_pass = "";
		$new_pass1 = "";
		$studentid = 0;
		$isOK = 0;
		if (isset($_POST['passwd']))
			$passwd = $_POST['passwd'];
		if (isset($_POST['new_pass']))
			$new_pass = $_POST['new_pass'];
		if (isset($_POST['new_pass1']))
			$new_pass1 = $_POST['new_pass1'];
		if (isset($_POST['studentid']))
			$studentid = $_POST['studentid'];
			
		if ($studentid && $passwd && $new_pass && $new_pass1) {
			$student = new StudentClass();
			if ($student->getUserByID($studentid)) {
				$ps = $student->getPassword();
				if ($ps == $passwd) {
					if ($student->updatePassword($new_pass, $new_pass1)) {
						$isOK = 1;
					}
					else {
						$this->error = "Modify Password Error : ";
						$this->error .= $student->getTrace();
					}
				}
				else {
					$this->error = "Old Password is not correct!";
				}
			}
		}
		return $isOK;
	}
}
?>
