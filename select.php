<html>
<head>
	<title></title>
</head>
<body>
<?php
	include("header.php");
	include("sql.php");
	$query="SELECT username,password,name,phone,email FROM profs";
	if($check=mysql_query($query,$con))
	{
		echo '<div id="s">';
		echo '<form action="disptable.php" method="post">';
		echo 'SELECT THE CONCERNED PROFESSOR<br/><br/>';
		echo '<select name="profname">';
		while($arr=mysql_fetch_array($check))
		{
			echo '<option value="'.$arr[0].'">'.$arr[2]."</option>";
			
		}
		echo "</select>";
		echo '<br/><br/><input type="submit" value="SUBMIT"/>';
		echo '</div></form>';
	}
	else
	{
		echo "Problem with SQL connection";
	}
?>
</body>
</html>