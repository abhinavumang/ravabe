<?php
require_once 'dbConnect.php';
session_start();
 	class dbFunction {
		  
		function __construct() {
			
			// connecting to database
			$db = new dbConnect();
			 
		}
		// destructor
		function __destruct() {
			
		}
		public function UserRegister($username, $emailid, $password){
            
            $password = md5($password);
				 $qr = mysql_query("INSERT INTO users(username, emailid, password) values('".$username."','".$emailid."','".$password."')") or die(mysql_error());
                 //$qr=mysql_query("call sp_register('".$username."','".$emailid."','".$password."')");
				return $qr;
			 
		}
		public function Login($emailid, $password){
			//$res = mysql_query("SELECT * FROM users WHERE emailid = '".$emailid."' AND password = '".md5($password)."'");
            //$res = mysql_query("SELECT * FROM users WHERE emailid = '".$emailid."' AND password = '".$password."'");
            $res=mysql_query("call sp_login('".$emailid."','".md5($password)."')");
			$user_data = mysql_fetch_array($res);
			//print_r($user_data);
			$no_rows = mysql_num_rows($res);
			
			if ($no_rows == 1) 
			{
		 
				$_SESSION['login'] = true;
				$_SESSION['uid'] = $user_data['id'];
				$_SESSION['username'] = $user_data['username'];
				$_SESSION['email'] = $user_data['emailid'];
				return true;
			}
			else
			{
				return FALSE;
			}
			 
				 
		}
		public function isUserExist($emailid){
			//$qr = mysql_query("SELECT * FROM users WHERE emailid = '".$emailid."'");
			$qr=mysql_query("call sp_checkuser('".$emailid."')");
            $row = mysql_num_rows($qr);
			if($row > 0){
				return true;
			} else {
				return false;
			}
		}
	}
?>