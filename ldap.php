<?php
	session_start();
	if(!isset($_POST[username]))
	{
		header("Location: index.php");
		exit;
	}
?>

<html>
<head>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	include("sql.php");
	$q="SELECT username,password,name,phone,email FROM profs";
	$q1=mysql_query($q,$con);
	$validuser=false;
	while($q2=mysql_fetch_array($q1))
	{
		if($q2[0]==$_POST[username] && $q2[1]==$_POST[password])
		{
			$validuser=true;
		}
	}
	if($validuser==true)
	{
		include("headerprof.php");
		$_SESSION[username]=$_POST[username];
		$_SESSION[usertype]="prof";
	}

	else
	{
		$q="SELECT username,password,name,phone,email FROM students";
		$q1=mysql_query($q,$con);
		$validuser=false;
		while($q2=mysql_fetch_array($q1))
		{
			if($q2[0]==$_POST[username] && $q2[1]==$_POST[password])
			{
				$validuser=true;
			}
		}
		if($validuser==true)
		{
			include("header.php");
			$_SESSION[username]=$_POST[username];
			$_SESSION[usertype]="student";
		}
		else
		{
			echo '<div align="center">';
			echo "<h2><b>Incorrect Username/Password</b></h2>";
			echo '<h3>Click <a href="index.php">Here</a> for HomePage</h3>';
			echo "</div>";
			
			/*		
			$domain = 'mailserver'; //172.24.2.80
			$conn = ldap_connect($domain, 389) or die("Could not connect to server");  	
			if (!$conn) 
			{
				echo "Unable to Connect to Zimbra Server...<br />Please Try Again..";
			}

			if (!ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3)) 
			{
				echo "LDAP Server protocol error <br/>";
			}

			$dn = 'uid='.$user.',ou=people,dc=bits-pilani,dc=ac,dc=in';
 
			$LDAPbind = @ldap_bind($conn, $dn, $password);   

			if($LDAPbind)
			{	
				include("header.php");
				echo "Welcome {$user}";
			}
			else
			{
				echo "Wrong username/password<br/>";
				echo '<a href="index.php">Try logging in again? </a>';
			}
			ldap_close($conn);
			*/

		}
		

		
	}


?>
</body>
</html>