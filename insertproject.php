<?php
//1.  Need to get uid from account validation
//2.  Need to add new project line in project table
//3.  Need to link project to user(s) in the userproj_tbl

require_once 'classes/mysql.php';
require_once 'classes/membership.php';
$membership = new Membership();
$membership->confirm_member();
$mysql = new Mysql();

$uid=$_SESSION['user'];
$title=$_POST['title'];
$description=$_POST['description'];
$tid=$_POST['topicselect'];
$custom_tag=$_POST['custom_tag'];
$link=$_POST['link'];
$link_description=$_POST['link_description'];
//$product_picture=$_POST['productpic'];  This is pulled in below as a part of the FILES system param
$locallat = 39.763345;   //$_POST['locallat'];This needs to be driven by a location selection on a map --> Dependent on selection above
$locallong = -105.045578;  //$_POST['locallong'];This needs to be driven by a location selection on a map --> Dependent on selection above
$status=$_POST['statusselect'];
$other_media=$_POST['other_media'];
$target_path = "uploads/";
$target_path = $target_path . basename( $_FILES['productpic']['name']); 

if ((($_FILES["productpic"]["type"] == "image/gif")
|| ($_FILES["productpic"]["type"] == "image/jpeg")
|| ($_FILES["productpic"]["type"] == "image/pjpeg"))
|| ($_FILES["productpic"]["type"] == "image/jpg")
&& ($_FILES["productpic"]["size"] < 1000000))
	{
	if ($_FILES["productpic"]["error"] > 0)
		{
	//	echo "Error: " . $_FILES["productpic"]["error"] . "<br />";
		}
	else
		{
		//echo "Upload: " . $_FILES["productpic"]["name"] . "<br />";
		//echo "Type: " . $_FILES["productpic"]["type"] . "<br />";
		//echo "Size: " . ($_FILES["productpic"]["size"] / 1024) . " Kb<br />";
		//echo "Stored in: " . $_FILES["productpic"]["tmp_name"];
		
		if (file_exists("upload/" . $_FILES["productpic"]["name"]))
			{
			//echo $_FILES["productpic"]["name"]." already exists. ";
			}
		else
			{
				if(move_uploaded_file($_FILES["productpic"]["tmp_name"], $target_path))
					{
					  $prodpic=$target_path;
					 // echo "The file ".  basename( $_FILES['productpic']['name'])." has been uploaded";
					}
				else
					{
					  echo "There was an error uploading the file, please try again!";
					}
				
			}
		}
	}	
else
	{
	echo "Invalid file";
	}
//Creates a new project line
if($mysql->add_new_project($uid, $title, $description, $tid, $custom_tag, $link, $link_description, $prodpic, $locallat, $locallong, $status, $other_media))
	{
	header('location: index.php');
	}
else
	{
	echo 'There was an issue creating a project';//Need to update this with clear instructions and allow user to return to form memory to make corrections to their form	
	}
	
?>