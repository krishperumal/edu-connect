<html>
<head>
	<title>EDU-CONNECT</title>
	<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
	<!-- <meta HTTP-EQUIV="REFRESH" content="0; url=index.php"> -->
</head>
<body>
		
		<h1>EDU-CONNECT</h1>
        <h2>Welcome to Edu-Connect</h2>
        <div id="signin">
			<div id="indexmsg">
				Already have an Account
			</div>
			<br />
			<fieldset id="c"><legend><p id="k1"><b>Sign In</b></p></legend><br />
				<?php include("javascript/validate.php"); ?>	
					<form action="ldap.php" method="post" onsubmit="return validate()" >
						<div align="center">
							USERNAME: <input type="text" name="username" value="" id="username" /><br /><br />
							PASSWORD:<input type="password" name="password" value=""  id="password"/><br /><br />
						</div>
						<div align="center">
							<input type="submit" name="login" value="LOGIN" id="login" />&nbsp;&nbsp;&nbsp;
							<input type="reset" value="RESET" name="reset">&nbsp;&nbsp;&nbsp;
							<a href="index.php"><input type="button" value="CANCEL"></a>
						</div>
					</form>
			</fieldset>
		</div>
	
	
		<div id="signup">
			<div id="indexmsg">Not yet Registered!!</div><br />
			<fieldset id="c"><legend><p id="k1"><b>Sign Up</b></p></legend>
			<p align="center"><a href="regprof.php"> Register </a>as a Professor</p>
			<p align="center"><a href="regstudent.php"> Register </a>as a Student</p><br />	
			</fieldset>
		</div>
        <?php include("footer.php"); ?>
</body>
</html>
