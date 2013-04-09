<?php

require_once 'includes/constants.php';
session_start();

class Mysql{
	
	private $conn;
	
	function __construct(){
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('Issue connecting to the DB.');    //when referring to a property we do not need the '$'
	}

	function verify_Username_and_Password($forms){	
	
		$query = "SELECT uid FROM users_priv WHERE username = ? AND password = ? LIMIT 1";
		if($stmt = $this->conn->prepare($query)){
			$stmt->bind_param('ss', $forms['username'], $forms['password']);// ss means both inputs are strings.  This prepares the values for the ?'s
			$stmt->execute();
			$stmt->bind_result($uid);
			if($stmt->fetch())
				{
				$_SESSION['user']=$uid;
				$stmt->close();
				return true;
				}
			else false;
	
		}
	}
	
	function return_topics_names(){
		$topics = array();
		$query = 'SELECT topic FROM topics_tbl';
		if($result = $this->conn->query($query))
			{
			while($myrow = $result->fetch_array(MYSQLI_BOTH))
				{
				
				$topics[] = $myrow["topic"];
				}
			$result->close();
			return $topics;
			}
	}		
	function topic_list(){
		$query = "SELECT tid, topic FROM topics_tbl";
		if($result = $this->conn->query($query)){
			while($myrow = $result->fetch_array()){
				unset($tid, $topic);
				$tid = $myrow['tid'];
				$topic = $myrow['topic']; 
				echo "<option value='".$tid."'>".$topic."</option>";
			}
			$result->close();
		}		
	}
//will need to update variables for locallongmin, etc once it is fed in from a map program
	function return_project_info($t, $locallongmin, $locallongmax, $locallatmin, $locallatmax, $mindate, $currdate){
		/*Preparing selection statement*/
		
		$query = "SELECT users_pub.artist_alias, users_pub.profpic, projects.title, projects.productpic, projects.description 
		FROM userproj_tbl 
		LEFT JOIN users_pub ON (users_pub.uid=userproj_tbl.uid)
		LEFT JOIN projects ON (projects.pid=userproj_tbl.pid)
		LEFT JOIN projmod_tbl ON (projmod_tbl.pid=userproj_tbl.pid)
		WHERE projects.tid = ".$t." AND projects.locallong >=".$locallongmin." AND projects.locallong <=".$locallongmax." 
		AND projects.locallat>=".$locallatmin." AND projects.locallat<=".$locallatmax.
		" AND projmod_tbl.mod_date>= FROM_UNIXTIME(".$mindate.") AND projmod_tbl.mod_date<= FROM_UNIXTIME(".$currdate.")";
		
		if($result = $this->conn->query($query))
			{
			while($myrow = $result->fetch_array())
				{
				$relprojects[] = $myrow;
				}
			/*close statement*/
			$result->close();		
			return $relprojects;
			}
	}
	
	function add_user($forms, $profpic)
	{
		$message = "";
		$query = "SELECT username FROM users_priv WHERE username = '". $forms['username'] ."'"; //check for duplicate
		if (mysqli_num_rows($this->conn->query($query)) == 0){
			$stmt = "INSERT INTO users_priv(username, password) VALUES('".$forms['username']."','".$forms['password'] ."')";
			//Must update fields that get pulled in HERE!
			if($stmt = $this->conn->prepare($stmt))
			{
				$stmt->execute();
				$uid = $this->conn->insert_id;//This value must be obtained so it can be used as a foreign key in the users_pub
				$stmt->close();
				
				//If the first statement executed and a uid was created then we can continue to the users_pub table and enter information there.
				$stmt = "INSERT INTO users_pub(uid, artist_alias, profpic, email, fname, lname, addr, city, state, country, zipcode, phone) VALUES ('".$uid."','".$forms['artist_alias']
				."','".$profpic."','".$forms['email']."','".$forms['fname']."','".$forms['lname']."','".$forms['addr']."','".$forms['city']."','".$forms['state']
				."','".$forms['country']."','".$forms['zipcode']."','".$forms['phone']."')";

				if($stmt = $this->conn->prepare($stmt))
				{
					$stmt->execute();
					$stmt->close();
					$this->conn->close();
					return $message;
					
				}
				else
				{	
					$message = "You Could Not Register Because Of An Unexpected Error.  Failed on INSERT users_pub";
				}
					
			}
			else
			{
				$message = "You Could Not Register Because Of An Unexpected Error.  Failed on INSERT users_priv";
			}
		}	
		else
		{
			$message = "The Username You Have Chosen Is Already Being Used By Another User. Please Try Another One.";
		}
		$this->conn->close();
		return $message;
			
	}
	//This function creates a new project line, retrieves the pid, adds a row to userprojtable, and adds the first date for a project to projmod_tbl
	function add_new_project($uid, $title, $description, $tid, $custom_tag, $link, $link_description, $prodpic, $locallat, $locallong, $status, $other_media){
		/* check connection */	
		if ($this->conn->connect_errno) 
		{
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}	
		//creates the new project in the projects table
		
		$query = "INSERT INTO projects (title, description, status, tid, custom_tag, link, link_description, productpic, other_media, locallat, locallong) 
				VALUES ('".$title."','".$description."','".$status."','".$tid."','".$custom_tag."','".$link."','".$link_description."','".$prodpic."','"
				.$othermedia."','".$locallat."','".$locallong."')";
		if($stmt = $this->conn->prepare($query))
			{
			$stmt->execute();
			$projid = $this->conn->insert_id;//This value must be obtained so it can be used as a foreign key in the userproj_tbl
			$stmt->close();
			
			}		
		else
			{
			echo "There was an issue inserting this project into the dB";
			}
					
		//Next add an entry into the userproj table
		$query = "INSERT INTO userproj_tbl (uid, pid) VALUES ('".$uid."','".$projid."')";//may want to check first to make sure the uid and projid combination does not exist in the table ...currently the two coupled act as the primary key
		
		if($stmt = $this->conn->prepare($query))
			{
			$stmt->execute();
			$stmt->close();
			}
		else
			{
			echo "There was an issue linking the project to the user.";//If this fails I may need to consider removing the previously created project row
			}
		//Add date into projmod_tbl table
		$query = "INSERT INTO projmod_tbl (pid) VALUES ('".$projid."')";
		if($stmt = $this->conn->prepare($query))
			{
			$stmt->execute();
			$stmt->close();
			$this->conn->close();
			return TRUE;
			}
		else
			{
			echo "Error linking posting date to the project id.";//If this fails I may need to consider removing the previously created project row
			}
		$this->conn->close();
	}		
}
	
?>