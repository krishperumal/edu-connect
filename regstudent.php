<html>
<head>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	if(isset($_POST[name]))
	{
		include("sql.php");
		$q="INSERT INTO students (username,password,name,phone,email) VALUES('$_POST[username]','$_POST[password]','$_POST[name]','$_POST[phno]','$_POST[email]')";
		if(mysql_query($q,$con))
		{
			echo "New Student account created<br/><br/>";
			echo '<a href="index.php">Login</a>';
		}
		else
		{
			echo "Problem with SQL connection";
			echo '<a href="index.php">Try again</a>';
		}
		
	}
	else
	{
	include("javascript/regvalidate.php"); 	
	echo '<div align="center">';
	echo '<fieldset id="new">';
	echo '<legend><p id="k1"><b> REGISTRATION </b></p></legend><br />';
    echo '<form action="regstudent.php" method="post" onsubmit="return validate()" >';
    echo 'Name: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="text" name="name" value="" id="idno1">*<br /><br /><br />';
	echo 'Username: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="text" name="username" value="" id="user">*&nbsp<br /><br /><br />';
	echo 'Password: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="password" name="password" value="" id="pass">*<br /><br /><br />';
	echo 'Phone no:&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="text" name="phno" value="" id="phno">&nbsp <br /> <br /><br />';
	echo 'E-mail address:&nbsp &nbsp <input type="text" name="email" value="" id="email">*<br /><br /><br />';
	echo '<div align="center">';
	echo '<input type="submit" value="REGISTER" name="register">&nbsp;&nbsp;&nbsp;';
	echo '<input type="reset" value="RESET" name="reset">&nbsp;&nbsp;&nbsp;';
	echo '<a href="index.php"><input type="button" value="CANCEL"></a>';
	echo '</div>';
	echo '</form>';
	echo '</fieldset>';
	echo '</div>';
	}
?>
<?php include("footer.php"); ?>
</body>
</html>