<?php
session_start();
require_once 'classes/membership.php';
$membership = new Membership();
	
	//If the user clicks the "Log Out" link on the index page.
	if(isset($_GET['status']) && $_GET['status'] == 'logout')
		{
		$membership->user_log_out();
		}
	if(isset($_GET['m']) && $_GET['m'] == 'success')	
		{
		$message = "You have successfully created a new account";	
		}
	
	//Did the user enter a user name password and click submit?  May want to make this a separate membership check
	if(isset($_POST['submit']))
		{
		$validation = $membership->login_field_validation($_POST);
		if($validation=="") 
			{
			$message = $membership->validate_user($_POST);
			}
		else
			{
			$message = $validation;
			}
		}
		
?>


<!DOCTYPE html>
	
<html lang="en">
<head>
    <title>StileLog Home</title>
	<meta charset="utf-8">
    <style type="text/css" media="all">@import "css/master.css";</style>  
	<script src="jquery.js"></script> 
</head>

<body>
 <div id="page-container">

	<div id="sidebar">
		<div id="logo">
			<img src="images/pics/stilelog_logo.png" alt="StileLog Logo" class="center"/>
		</div>				
	</div>
     <div id="main-content">	
		
		<div id="title" class="padding">
				<p><font size="8" COLOR="#000000" face="segoe print">StileLog</font></p>
				<p><font size="4" COLOR="#000000" face="segoe print">Take the first step and get lost in it!</font></p>
				<p><font size="2" COLOR="#000000" face="segoe print"><i>“Commitment leads to action. Action brings your dream closer.” -Marcia Wieder</i></font></p>
		</div>
	

		<!--I may want to consider creating a Java function to randomly position each of the topic text boxes below--> 
		<div id="login"> 
			<form method="post" action="">
				<h2>Login<small> enter your user name and password</small></h2>
					<div class = "row">
						<span class = "formwidth"><input type="text" size="30" name="username" id="username"/></span>
						<span class = "label">Username:</span>	
					</div>
						
					<div class = "row">
						<span class = "formwidth"><input type="password" size="30" name="password" id="password"/></span>
						<span class = "label">Password:</span>	
					</div>
					
				</p></br>
				
				<p>
				<input type = "submit" id = "submit" name="submit" value="Login" >
				</p>
			</form>
			<?php if(isset($message)) echo $message;?>
			<br />
		</div><!--End Login-->

		<div id = "register">
			<form name="register" method="post" action="register.php">
				<h3>  Need to create an account? </h3>
				<p>
				<input type="submit" name="register" id="register" value="Register Now!">
				</p>
			</form><br />
		</div>

		
	</div>
	
		 
	<div id="footer">
		<div id="altnav">
			<a href="CreateProj">About</a> - 
			<a href="#">Contact Us</a> - 
			<a href="#">Terms and Conditions (Legal)</a>
		</div>
		Copyright © StileLog
	</div>
</div>		
</body>
</html>
