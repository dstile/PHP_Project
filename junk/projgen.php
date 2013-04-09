	<?php
		require_once 'classes/mysql.php';
		
		$t = $_POST['t'];
		$x = $_POST['x'];
		$y = $_POST['y'];
		$a = $_POST['a'];
		$b = $_POST['b'];
		
		$indmin = 0;
		$indmax = 0;
		date_default_timezone_set('UTC');
		$currdate = strtotime(date("Y-m-d H:i:s"));
		$mindate = strtotime(date("Y-m-d H:i:s"). " -30 days"); //Need to change this date after testing back to 7 days
		$relprojects = array();
		$mysql = new Mysql();
		
		
		$relprojects = $mysql->return_project_info($t, $x, $y, $a, $b, $mindate, $currdate);
		$indmax = count($relprojects)-1;//counts the number of rows and subtracts one since we will need indexes starting at zero
		$randindex = rand($indmin, $indmax); //returns a random index for the new array the holds the query results
		echo '<b>Title: </b>'.$relprojects[$randindex]["title"].'<br />
		 <b>Artist: </b>'.$relprojects[$randindex]["artist_alias"].'</br>
		<img src= "'.$relprojects[$randindex]["productpic"].'" class="project-pic" alt="Project Picture"/></br>
		<b>Description: </b> '.$relprojects[$randindex]["description"];
	?>
	
