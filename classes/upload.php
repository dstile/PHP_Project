<?php


/*  Some things to consider here 
Source: http://mj7.co.uk/ampp

1.  Define target folder locations at start of PHP file as PUBLIC
2.  Probably want a rename function to ensure no duplicate names exist for files ->  system should control the naming
3.  Put together an array for all of the errors at the start of the file
4.  Consider capability of being able to resize images



*/
session_start();

class Upload{

	function __construct(){
	}

	function picverify($picfile)
	{
		$error = "";
		if ((($picfile["profpic"]["type"] == "image/gif")
		|| ($picfile["profpic"]["type"] == "image/jpeg")
		|| ($picfile["profpic"]["type"] == "image/pjpeg")
		|| ($picfile["profpic"]["type"] == "image/jpg"))
		&& ($picfile["profpic"]["size"] < 1000000))
			{
			if ($picfile["profpic"]["error"] > 0)
				{
				$error = "Error: " . $picfile["profpic"]["error"] . "<br />";
				}
			else
				{			
				if (file_exists($targetpath.basename($picfile["profpic"]["name"])))
					{
					$error = $picfile["productpic"]["name"]." already exists.";
					}
				}
			}	
		else
			{
			$error = "Invalid file:  The file you uploaded is either too big or is an incompatible image type";
			}
	return	$error;	
	}
	
	
	
	
	function picupload($picfile)
	{
		$pic = "";
		$target_path = "uploads/artistpics/";
		$target_path = $target_path . basename( $picfile['profpic']['name']); 
	
		if(move_uploaded_file($picfile["profpic"]["tmp_name"], $target_path))
			{
			$pic=$target_path;
			}
		return $pic;	
	}
}	
?>