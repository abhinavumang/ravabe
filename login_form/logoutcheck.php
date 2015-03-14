<?php 
	include_once('dbFunction.php');
	if($_POST['welcome']){
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy();
	}
	if(!($_SESSION)){
		header("Location:index.php");
	}
?>