<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	session_destroy();
	
	
?> 
<html>
<head>
<meta http-equiv="REFRESH" content="0;url=index.php"></head>
</html>