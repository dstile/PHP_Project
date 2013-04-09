<?php
//1.  
//2.  

require_once 'classes/mysql.php';
require_once 'classes/membership.php';
$membership = new Membership();
$membership->confirm_member();
$mysql = new Mysql();


?>