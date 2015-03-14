<?php
	include_once('dbFunction.php');
	 
	$funObj = new dbFunction();
	if($_POST['login']){
		$emailid = $_POST['emailid'];
		$password = $_POST['password'];
		$user = $funObj->Login($emailid, $password);
		if ($user) {
			// Registration Success
		   header("location:home.php");
		} else {
			// Registration Failed
			echo "<script>alert('Emailid / Password Not Match')</script>";
		}
	}
	if($_POST['register']){
		$username = $_POST['username'];
		$emailid = $_POST['emailid'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirm_password'];
		if($password == $confirmPassword){
			$email = $funObj->isUserExist($emailid);
			if(!$email){
				$register = $funObj->UserRegister($username, $emailid, $password);
				if($register){
					 echo "<script>alert('Registration Successful')</script>";
				}else{
					echo "<script>alert('Registration Not Successful')</script>";
				}
			} else {
				echo "<script>alert('Email Already Exist')</script>";
			}
		} else {
			echo "<script>alert('Password Not Match')</script>";
		
		}
	}
?>
