<?php
session_start();

if (isset($_SESSION['log_user_id'])) {
	unset($_SESSION['log_user_id']);
}

header("Location: ../home/"); 

?>

