<?php

require_once 'includes/constants.php';
require_once 'mysql.php';

class Congen{

	function proj_highlight_box_content()
	{
		$Arrays = array();
		$topicorder = array();
		$topicnameArray = array();
		$relprojects = array();
		$projinfoArray = array();
		$artistpicArray = array();
		
		//generating topic indexes in random order in array
		$topicindex = 0;//Used to make sure all topics have been defined in sequence
		while($topicindex<topicnumber)
			{
			$topicorder[$topicindex] = $topicindex; 
			$topicindex++;
			}	
		shuffle($topicorder);	

			
		//Returning topic names as they are in the database		
		$mysql = new Mysql();
		$topicnameArray = $mysql->return_topics_names();		

		//Generates the project content
		$indmin = 0;
		$indmax = 0;
		date_default_timezone_set('UTC');
		$currdate = strtotime(date("Y-m-d H:i:s"));
		$mindate = strtotime(date("Y-m-d H:i:s"). " -360 days"); //Need to change this date after testing back to 7 days
		$mysql = new Mysql();
		
		$i=0;
		while($i<topicnumber)
		{
			$relprojects = $mysql->return_project_info($i, locallongmin, locallongmax, locallatmin, locallatmax, $mindate, $currdate);
			$indmax = count($relprojects)-1;//counts the number of rows and subtracts one since we will need indexes starting at zero
			$randindex = rand($indmin, $indmax); //returns a random index for the new array the holds the query results;
			$projinfoArray[$i] = '<b>Title: </b>'.$relprojects[$randindex]["title"].'<br />
			 <b>Artist: </b>'.$relprojects[$randindex]["artist_alias"].'<br />
			<img src= "'.$relprojects[$randindex]["productpic"].' "class="project-pic" alt="Project Picture"/></br>
			<b>Description: </b> '.$relprojects[$randindex]["description"];
			$artistpicArray[$i] = '<img src= "'.$relprojects[$randindex]["profpic"].' "class="artist-pic" alt="Artist Picture"/></br>';
			$i++;
		}
		
		//This next portion pulls in the array generated in php and outputs the Javascript code 
		$js_array = json_encode($topicorder);//$topicorder is index 0
		echo "topicorderArrayjs = ".$js_array . ";\n";	
			
		$js_array = json_encode($topicnameArray);//$topicnameArray is index 1
		echo "topicnameArrayjs = ".$js_array . ";\n";
		
		//Converts the project from php database to Javascript variables
				
		$js_array = json_encode($projinfoArray);//$projinfoArray is index 2
		echo "projinfoArrayjs = ".$js_array . ";\n";
				
		$js_array = json_encode($artistpicArray);//$artistpicArray is index 3
		echo "artistpicArrayjs = ".$js_array . ";\n";
	}	

}

?>