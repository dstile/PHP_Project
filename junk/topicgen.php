<?php
	require 'classes/mysql.php';
	$mysql = new Mysql();
	$t=$_POST['t'];	//topic index
	$myrow = $mysql->return_topic($t);
	echo $myrow;																															
?>