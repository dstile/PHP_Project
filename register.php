<?php
require_once 'classes/membership.php';
require_once 'classes/upload.php';
require_once 'classes/mysql.php';
$membership = new Membership();
$upload = new Upload();
$mysql = new Mysql();
if((isset($_FILES['profpic']))&&(isset($_POST['reg'])))
	{
	$error = $upload->picverify($_FILES);
	if ($error =="")
		{
		$profpic = $upload->picupload($_FILES);	
		if($profpic == "")
			{
			$message = "There was an issue uploading the picture.  Please try again.";
			}
		else
			{					
			$message = $membership->validate_new_user_fields($_POST, $profpic);
			if($message == "")
				{
				$message = $mysql->add_user($_POST, $profpic);
				header("location: login.php?m=success");
				}
			}
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
	
		<div id="options"> 
			<a href="login.php?status=logout">Log Out</a>
		</div>
		
		<div id="title">
			<div class="padding">
				<p><font size="8" COLOR="#000000" face="segoe print">StileLog</font></p>
				<p><font size="4" COLOR="#000000" face="segoe print">Denver's Cultural Portfolio</font></p>
			</div>
		</div>
	
		<div id="city-header">
			<!--<p> DENVER BANNER HERE </p>
			<h1><!<img src="images/general/logo_enlighten.gif" 
			width="236" height="36" alt="StileLog" border="0" /></h1>-->
		</div>
	
		<div id="project_form">
			<h2><strong>Register</strong></h2>

			<form name="register" method="post" action="" enctype="multipart/form-data">
				<fieldset>
					<legend>User Details</legend>
					<ol>
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="username" id="username"/></span>
										<span class = "label">Username:</span>	
							</div>
						</li>
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="password" size="30" name="password" id="password"/></span>
										<span class = "label">Password:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="artist_alias" id="artist_alias"/></span>
										<span class = "label">Artist Alias:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth">
											<!--<input type="hidden" name="MAX_FILE_SIZE" value="100000" /> <!--(100kb is the max set in this example-->
											<input type="file" name="profpic" id="profpic"/></span>
											<span class = "label"><label for="profpic">Profile Picture:</label></span>
							</div>
						</li>
						
						<li><!--Need to add a function to email user to confirm account-->
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="email" id="email"/></span>
										<span class = "label">Email:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="fname" id="fname"/></span>
										<span class = "label">First Name:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="lname" id="lname"/></span>
										<span class = "label">Last Name:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="addr" id="addr"/></span>
										<span class = "label">Address:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="city" id="city"/></span>
										<span class = "label">City:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="state" id="state"/></span>
										<span class = "label">State:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="country" id="country"/></span>
										<span class = "label">Country:</span>	
							</div>
						</li>
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="zipcode" id="zipcode"/></span>
										<span class = "label">Zip Code:</span>	
							</div>
						</li>
						
						<li>
							<div class = "row">
										<span class = "formwidth"><input type="text" size="30" name="phone" id="phone"/></span>
										<span class = "label">Phone:</span>	
							</div>
						</li>
					</ol>
				</fieldset>
				<input type="submit" name = "reg" id= "reg" value="Register">
			</form>
		
			<?php if(isset($message)) echo $message;?>
			<br />
			
			
			<form name="Back" method="post" action="Login.php">
			<input type="submit" name="back" id="back" value="Back to Home">
			</form>
			
		</div>
			
	</div>
	
	
	 
	<div id="footer">
		<div id="altnav">
			<a href="#">About</a> - 
			<a href="#">Contact Us</a> - 
			<a href="#">Terms and Conditions (Legal)</a>
		</div>
		Copyright � StileLog
	</div>
 
</div>

</body>
</html>
