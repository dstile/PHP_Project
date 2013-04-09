<?php
session_start();
require_once 'mysql.php';


class Membership{

	//Function to make sure fields are filled in correctly
	function login_field_validation($forms)
	{
		$error = "";
		if(empty($forms['username'])) 
			{
			$error = "Please complete the username field";
			}
		if(empty($forms['password'])) 
			{
			if($error!=="") 
				{
				$error = $error."<br /> Please complete the password field";
				}
			else 
				{
				$error = "Please complete the password field";
				}
			}		
		return $error;	
		
	}
	//Function to validate username and password

	function validate_user($forms)
	{
		$mysql = new Mysql();
		$check_credentials = $mysql->verify_Username_and_Password($forms);
	
		if($check_credentials)
			{
			$_SESSION['status'] = 'authorized';	
			header("location: index.php");
			} else return "Please enter a correct  username and password";
	}
	
	
	
	function confirm_member()
	{
		session_start();
		if($_SESSION['status'] !='authorized')
		{	
		header("location: login.php");
		}
	}
	
	function user_log_out()
	{
		if(isset($_SESSION['status'])){
			unset($_SESSION['status']);
			
			if(isset($_COOKIE[session_name()])){ 
				setcookie(session_name(), "", time() - 1000);
				session_destroy();
			}
		}
	}

	function validate_new_user_fields($forms, $profpic)
	{
		$error = "";
		
		//Did the user complete all of the required fields and click submit
		if($forms && isset($forms['username']) && isset($forms['password']) && isset($forms['artist_alias']) 
		&& isset($forms['email'])  && isset($forms['fname'])&& 
		isset($forms['lname'])&& isset($forms['addr']) && isset($forms['city']) && 
		isset($forms['state']) && isset($forms['country']) && isset($forms['zipcode']) && 
		isset($forms['phone']) && isset($profpic)) 
			{
			if( strlen(trim($forms['username'])) < 4 )
				{
				$error = "Username Must Be More Than 4 Characters.";
				}
			if( strlen(trim($forms['password'])) < 6 )
				{
				$message = "Password Must Be More Than 6 Characters.";
				if(isset($error))
					{
					$error = $error."<br />".$message;
					}
				else
					{
					$error = $message;
					}	
				}
			if( trim($forms['password']) == trim($forms['username']))
				{
				$message = "Username And Password Can Not Be The Same.";
				if(isset($error))
					{
					$error = $error."<br />".$message;
					}
					else
					{
					$error = $message;
					}	
				}
			}
		else
			{
			$error = "You Could Not Be Registered Because Of Missing Data.";
			}		
		return $error;
	}
}	
?>


