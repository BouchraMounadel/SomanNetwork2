<?php


	session_start();

	if (isset($_SESSION['SomanNetwork_IdUser'])) {
		$_SESSION['SomanNetwork_IdUser']='';
		unset($_SESSION['SomanNetwork_IdUser']);
	}
	
	header("Location: login.php");
	die;







  ?>