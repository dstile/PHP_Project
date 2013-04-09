<?php
require_once 'classes/membership.php';
$membership = new Membership();
$membership->confirm_member();
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

			<h2><strong>CREATE A PROJECT</strong> </h2>
			<form action="insertproject.php" name= "insertproject" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Project Details</legend>
					
					<ol>
						<li>
							<div class = "row">
							<span class = "formwidth" ><input type="text" size="30" name = "title"/></span>
							<span class = "label">Title:</span>
							</div>
						</li>
						<li>
							<div class = "row">
								<span class = "formwidth"><input type="text" size="30" name="description"/></span>
								<span class = "label">Description:</span>
						
							</div>
						</li>
						<li>
							<div class = "row">
							<span class = "formwidth">
							<select name="topicselect">
									<option value='null'></option>
									<?php
										$mysql = new Mysql();
										$mysql->topic_list();
									?> 
									
									
							</select>
							</span>
							<span class = "label">Topic Tag:</span>
							</div>
							
						</li>	
						<li>		
							<div class = "row">
							<span class = "formwidth" ><input type="text" size="30" name="custom_tag"/></span>
							<span class = "label">Custom Tag:</span>
							</div>
						</li>	
						<li>	
							<div class = "row">
							<span class = "formwidth" ><input type="text" size="30" name="link"/></span>
							<span class = "label">Link:</span>
							</div>
						</li>
						<li>						
							<div class = "row">
							<span class = "formwidth" ><input type="text" size="30" name="link_description"/></span>
							<span class = "label">Link Description:</span>
							</div>
						
						</li>	
						
						<li>	
							<div class = "row">
							<span class = "formwidth" ><input type="text" size="30" name="other_media"/></span>
							<span class = "label">Other Media:</span>
							</div>
						</li>
						<li>	
							<div class = "row">
								<span class = "formwidth" >
								<select name="statusselect">
									<option value='null'></option>
									<option value='In Progress'>In Progress</option>
									<option value='Complete'>Complete</option>
								</select>
								</span>	
								<span class = "label">Status:</span>
							</div>
						</li>
						<li>
							<div class = "row">
								<span class = "formwidth" >
									<input type="hidden" name="MAX_FILE_SIZE" value="100000" /> <!--(100kb is the max set in this example-->
									<input type="file" name="productpic"/></span>
									<span class = "label"><label for="productpic">Product Picture:</label></span>
							</div>
						</li>
					</ol>
				
				
				</fieldset>	
				<input type="Submit">
				
			</form>
			<form name="Back" method="post" action="index.php">
			<input type="submit" name="back" id="back" value="Back to Home">
			</form>
			
		</div>
			
	</div>
	
	<div id="sidebar">
		<div id="logo">
			<img src="images/pics/stilelog_logo.png" alt="StileLog Logo" class="center"/>
		</div>
	</div>
	 
	<div id="footer">
		<div id="altnav">
			<a href="#">About</a> - 
			<a href="#">Contact Us</a> - 
			<a href="#">Terms and Conditions (Legal)</a>
		</div>
		Copyright © StileLog
	</div>
 
</div>
</body>
</html>
