<?php
	$con = mysql_connect("localhost","root","jagan");
	if (!$con)
	{
	die('Mysql Connection Failed: ' . mysql_error());
	}
	$db=mysql_select_db("edu2", $con);
	if (!$db) {
		die("Database Connection failed: " . mysql_error());
	} 
	
?>