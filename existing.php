<?php
	session_start();
	if(!isset($_SESSION[username]))
	{
		header("Location: index.php");
		exit;
	}
	$user=$_SESSION['username'];
?>
<?php
include("sql.php");
if($_SESSION[usertype]=="student")
{
	include("header.php");
	$qq="SELECT prof,student,day,hour,request,status,details,date FROM profdata WHERE student='"."{$_SESSION[username]}"."'";
	$checkq=mysql_query($qq,$con);
    $check=@mysql_fetch_array($checkq);
    if(!$check)
    {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No new requests to display</b>";
	}
	else 
	{	
		//Old Code
		/*echo "<div>";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb2"'.">";
		echo "<tr>";
		echo "<th width=".'"150"'.">PROFESSOR</th>";
		echo "<th>DATE</th>";
		echo "<th>DAY</th>";
		echo "<th>TIME</th>";
		echo "<th width=".'"380"'.">REQUEST</th>"; 
		echo "<th>STATUS</th>";
		echo "<th width=".'"150"'.">DETAILS</th>";
		echo "</tr>";
		$result= mysql_query("SELECT prof,day,hour,request,status,details,date FROM profdata WHERE student='"."{$_SESSION[username]}"."'",$con);
		while($f=mysql_fetch_array($result))
		{
			$d1=$f[1];
			$t1=$f[2];
			include("convert.php");
			echo "<tr>";
			$name=mysql_query("SELECT name FROM profs WHERE username='"."{$f[0]}"."'");
			$n=mysql_fetch_array($name);
			echo "<td width=".'"150"'.">{$n[0]}</td>";
			echo "<td>".$f[6]."</td>";
			echo "<td>{$day}</td>";
			echo "<td>{$time}</td>";
			echo "<td width=".'"380"'.">{$f[3]}</td>";
			echo "<td>";
			if($f[4]==1) echo "ACCEPTED";
			if($f[4]==2) echo "REJECTED";
			if($f[4]==3||$f[4]==0) echo "WAITING";
			echo "</td>";
			echo "<td width=".'"150"'.">".$f[5]."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<div>";*/
		
		//New Code
		echo "<div"."id=".'"tb23"'.">";
		echo "<table>";
		echo "<div id=".'"heading"'.">";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb3"'.">";
		echo "<tr>"; // id=".'"heading"'."
		echo "<th width=".'"100"'.">PROFESSOR</th>";
		echo "<th width=".'"65"'.">DATE</th>";
		echo "<th width=".'"50"'.">DAY</th>";
		echo "<th width=".'"85"'.">TIME</th>";
		echo "<th width=".'"380"'.">REQUEST</th>"; 
		echo "<th width=".'"100"'.">STATUS</th>";
		echo "<th width=".'"179"'.">DETAILS</th>";
		echo "</tr></table></div>";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<p>&nbsp;</p>";
		echo "<div id=".'"tablecontent"'.">";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb2"'.">";
		$result= mysql_query("SELECT prof,day,hour,request,status,details,date FROM profdata WHERE student='"."{$_SESSION[username]}"."'",$con);
		while($f=mysql_fetch_array($result))
		{
			$d1=$f[1];
			$t1=$f[2];
			include("convert.php");
			echo "<tr>";
			$name=mysql_query("SELECT name FROM profs WHERE username='"."{$f[0]}"."'");
			$n=mysql_fetch_array($name);
			echo "<td width=".'"100"'.">{$n[0]}</td>";
			echo "<td width=".'"65"'.">{$f[6]}</td>";
			echo "<td width=".'"50"'.">{$day}</td>";
			echo "<td width=".'"85"'.">{$time}</td>";
			echo "<td width=".'"380"'.">{$f[3]}</td>";
			echo "<td width=".'"100"'.">";
			if($f[4]==1) echo "ACCEPTED";
			if($f[4]==2) echo "REJECTED";
			if($f[4]==3||$f[4]==0) echo "WAITING";
			echo "</td>";
			echo "<td width=".'"179"'.">".$f[5]."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		echo "</table>";
		echo "</div>";
	}
}
else
{
	include("headerprof.php");
	
	$checkq=mysql_query("SELECT prof,student,day,hour,request,status,details,date FROM profdata WHERE prof="."'{$_SESSION[username]}'",$con);
    $check=@mysql_fetch_array($checkq);
    if(!$check)
    {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No new requests to display</b>";
	}
	else 
	{	
		if(!isset($_GET[c]))
		{
		//echo "<img src=".'"stylesheets/curvybrickwallbg3.jpg"'."/>";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<div"."id=".'"tb23"'.">";
		echo "<table>";
		echo "<div id=".'"heading"'.">";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb3"'.">";
		echo "<tr>"; // id=".'"heading"'."
		echo "<th width=".'"100"'.">STUDENT</th>";
		echo "<th width=".'"65"'.">DATE</th>";
		echo "<th width=".'"50"'.">DAY</th>";
		echo "<th width=".'"85"'.">TIME</th>";
		echo "<th width=".'"380"'.">REQUEST</th>"; 
		echo "<th width=".'"100"'.">STATUS</th>";
		echo "<th width=".'"179"'.">DETAILS</th>";
		echo "</tr></table></div>";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<p>&nbsp;</p>";
		echo "<div id=".'"tablecontent"'.">";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb2"'.">";
		$result= mysql_query("SELECT student,day,hour,request,status,details,date,timestamp FROM profdata WHERE prof='"."{$_SESSION[username]}"."'",$con);
		while($f=mysql_fetch_array($result))
		{
			$d1=$f[1];
			$t1=$f[2];
			include("convert.php");
			echo "<tr>";
			$name=mysql_query("SELECT name FROM students WHERE username='"."{$f[0]}"."'");
			$n=mysql_fetch_array($name);
			echo "<td width=".'"100"'.">{$n[0]}</td>";
			echo "<td width=".'"65"'.">{$f[6]}</td>";
			echo "<td width=".'"50"'.">{$day}</td>";
			echo "<td width=".'"85"'.">{$time}</td>";
			echo "<td width=".'"380"'.">{$f[3]}</td>";
			echo "<td width=".'"100"'.">";
			if($f[4]==1) echo "ACCEPTED";
			if($f[4]==2) echo "REJECTED";
			if($f[4]==3||$f[4]==0) echo "WAITING";
			echo "</td>";
			echo "<td width=".'"125"'.">".$f[5]."</td>";
			$a=rawurlencode("existing.php");
			$a .="?day=".urlencode($f[1]);
			$a .="&hr=".urlencode($f[2]);
			$a .="&user=".urlencode($f[0]);
			$a .="&timestamp=".urlencode($f[7]);
			echo '<td><form action="'.htmlspecialchars($a).'" method='.'"post">';
			echo '<input type='.'"submit"'." value=".'"EDIT"'.'/>'."</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		echo "</table>";
		echo "</div>";
		}
	}
	if(isset($_GET[day]))			//If Prof wants to edit request
	{
		//echo "<br /><br /><br /><br /><br /><br /><br />";
		echo "<div id=".'"radio">';
		$b=rawurlencode("existing.php");
		$b .="?c=".urlencode($_GET[day]);
		$b .="&d=".urlencode($_GET[hr]);
		$b .="&u=".urlencode($_GET[user]);
		$b .="&t=".urlencode($_GET[timestamp]);
		include("javascript/radiovalidate.php");
		echo '<td><form id="register" action="'.htmlspecialchars($b).'" method='.'"post" onsubmit="return radio_validate()" >';
		echo '<br /><div align="center"><b>STATUS</b></div>';
		echo "&nbsp;&nbsp;&nbsp;<input type=".'"radio"'.' name="status" value="accept"/>ACCEPT<br />';
		echo "&nbsp;&nbsp;&nbsp;<input type=".'"radio"'.' name="status" value="reject"/>REJECT<br />';
		echo "&nbsp;&nbsp;&nbsp;<input type=".'"radio"'.' name="status" value="waiting"/>WAITING<br /><br />';
		echo '<div align="center"><b>DETAILS</b></div>';
		echo '&nbsp;&nbsp;&nbsp;<textarea id="detailsmsg" name="detailsmsg" rows="5" cols="24"></textarea><br /><br />';
		echo '&nbsp;&nbsp;&nbsp;<input type="checkbox" name="sms" id="sms" value="YES"/><b>SEND SMS</b><br /><br />';
		echo '<div align="center">';
		echo '<input type="submit" value="UPDATE">';
		echo '&nbsp;&nbsp;<input type="reset" value="RESET">';
		echo '&nbsp;&nbsp;<a href="existing.php"><input type="button" value="CANCEL"></a>';
		echo '</div>';
		echo "</form>";
		echo "</div>";
	}
	
	if(isset($_GET[c]))					//Prof has edited details of request
	{
		include("sql.php");
		if($_POST[status]=="accept")
		{
			$query="UPDATE profdata SET status=1 WHERE day="."{$_GET[c]}"." AND hour='"."{$_GET[d]}"."' AND student='"."{$_GET[u]}"."' AND timestamp='"."{$_GET[t]}"."'";
			$checkquery=mysql_query($query,$con); 
			if($checkquery)
			{
				/* $fromName = $_SESSION[user];
				$fromEmail = "krishperumal11@gmail.com";
				$toEmail = "jagan387@gmail.com";
				$subject = "Test Mail";
				$message = "Hello! This is a simple email message.";
				$headers = "From: $fromName <$fromEmail>" . "\r\n";
				$headers .= "Reply-To: $fromEmail" . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
				if(mail($toEmail, $subject, $message,$headers))
				echo "Mail sent."; 
				echo '<a href='."target="."http://mobile.samplephpcodes.com/sendsms.php?uid=9602214007&pwd=jagan&phone=9602214521&msg=your%20appointment%20has%20been%20accepted".'"> SEND SMS </a>'; */
			}
			else
			{
				echo "Problem with database updation";
			}
		}
		else if($_POST[status]=="reject")
		{
			$query="UPDATE profdata SET status=2 WHERE day="."{$_GET[c]}"." AND hour='"."{$_GET[d]}"."' AND student='"."{$_GET[u]}"."' AND timestamp='"."{$_GET[t]}"."'";
			$checkquery=mysql_query($query,$con);
		}
		else if($_POST[status]=="waiting")
		{
			$query="UPDATE profdata SET status=3 WHERE day="."{$_GET[c]}"." AND hour='"."{$_GET[d]}"."' AND student='"."{$_GET[u]}"."' AND timestamp='"."{$_GET[t]}"."'";
			$checkquery=mysql_query($query,$con);
		}
		
		if(!empty($_POST[detailsmsg])) 
		{
			$query1="UPDATE profdata SET details='"."{$_POST[detailsmsg]}"."' WHERE day="."{$_GET[c]}"." AND hour='"."{$_GET[d]}"."' AND student='"."{$_GET[u]}"."' AND timestamp='"."{$_GET[t]}"."'";
			mysql_query($query1,$con);
		}
		if(!empty($_POST[sms]))
		{
			$c="http://www.mobile.samplephpcodes.com/";
			$c .=rawurlencode("sendsms.php");
			$c .="?uid=".urlencode("9602214007");
			$c .="&pwd=".urlencode("jagan");
			$c .="&phone=".urlencode("9602214007");
			$c .="&msg=".urlencode("your appointment has been accepted");
			echo '<form name="f1" method="post" action="'."{$c}".'" onsubmit="'.'this.form.target='."'_blank'".'"'.";return true;".'">';
			//echo "<input type='submit' value='SEND SMS' onclick=".'"this.form.target='."'_blank'".';return true;">';
			echo "</form>";
			echo "<script language='javascript' type='text/javascript'> document.f1.submit();</script>";
		}

        //Old Code        
        /*echo "<div>";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb2"'.">";
		echo "<tr>";
		echo "<th  width=".'"100"'.">STUDENT</th>";
		echo "<th>DATE</th>";
		echo "<th>DAY</th>";
		echo "<th>TIME</th>";
		echo "<th width=".'"380"'.">REQUEST</th>"; 
		echo "<th>STATUS</th>";
		echo "<th width=".'"125"'.">DETAILS</th>";
		echo "</tr>";
		$q="SELECT student,day,hour,request,status,details,date,timestamp FROM profdata WHERE prof='"."{$_SESSION[username]}"."'";
		$result= mysql_query($q,$con);
		while($f=mysql_fetch_array($result))
		{
			$d1=$f[1];
			$t1=$f[2];
			include("convert.php");
			echo "<tr>";
			$name=mysql_query("SELECT name FROM students WHERE username='"."{$f[0]}"."'");
			$n=mysql_fetch_array($name);
			echo "<td  width=".'"100"'.">{$n[0]}</td>";
			echo "<td>{$f[6]}</td>";
			echo "<td>{$day}</td>";
			echo "<td>{$time}</td>";
			echo "<td width=".'"380"'.">{$f[3]}</td>";
			echo "<td>";
			if($f[4]==1) echo "ACCEPTED";
			if($f[4]==2) echo "REJECTED";
			if($f[4]==3||$f[4]==0) echo "WAITING";
			echo "</td>";
			echo "<td width=".'"125"'.">".$f[5]."</td>";
			
			$a=rawurlencode("existing.php");
			$a .="?day=".urlencode($f[1]);
			$a .="&hr=".urlencode($f[2]);
			$a .="&user=".urlencode($f[0]);
			$a .="&timestamp=".urlencode($f[7]);
			echo '<td><form action="'.htmlspecialchars($a).'" method='.'"post">';
			echo '<input type='.'"submit"'." value=".'"EDIT"'.'/>'."</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<div>";*/
		
		//New Code
				echo "<div>";
		echo "<table>";
		echo "<div id=".'"heading"'.">";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb3"'.">";
		echo "<tr>"; // id=".'"heading"'."
		echo "<th width=".'"100"'.">STUDENT</th>";
		echo "<th width=".'"65"'.">DATE</th>";
		echo "<th width=".'"50"'.">DAY</th>";
		echo "<th width=".'"85"'.">TIME</th>";
		echo "<th width=".'"380"'.">REQUEST</th>"; 
		echo "<th width=".'"100"'.">STATUS</th>";
		echo "<th width=".'"179"'.">DETAILS</th>";
		echo "</tr></table></div>";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<p>&nbsp;</p>";
		echo "<div id=".'"tablecontent"'.">";
		echo "<table border=".'"1"'."bacwidth=".'"1126"'."id=".'"tb2"'.">";
		$result= mysql_query("SELECT student,day,hour,request,status,details,date,timestamp FROM profdata WHERE prof='"."{$_SESSION[username]}"."'",$con);
		while($f=mysql_fetch_array($result))
		{
			$d1=$f[1];
			$t1=$f[2];
			include("convert.php");
			echo "<tr>";
			$name=mysql_query("SELECT name FROM students WHERE username='"."{$f[0]}"."'");
			$n=mysql_fetch_array($name);
			echo "<td width=".'"100"'.">{$n[0]}</td>";
			echo "<td width=".'"65"'.">{$f[6]}</td>";
			echo "<td width=".'"50"'.">{$day}</td>";
			echo "<td width=".'"85"'.">{$time}</td>";
			echo "<td width=".'"380"'.">{$f[3]}</td>";
			echo "<td width=".'"100"'.">";
			if($f[4]==1) echo "ACCEPTED";
			if($f[4]==2) echo "REJECTED";
			if($f[4]==3||$f[4]==0) echo "WAITING";
			echo "</td>";
			echo "<td width=".'"125"'.">".$f[5]."</td>";
			$a=rawurlencode("existing.php");
			$a .="?day=".urlencode($f[1]);
			$a .="&hr=".urlencode($f[2]);
			$a .="&user=".urlencode($f[0]);
			$a .="&timestamp=".urlencode($f[7]);
			echo '<td><form action="'.htmlspecialchars($a).'" method='.'"post">';
			echo '<input type='.'"submit"'." value=".'"EDIT"'.'/>'."</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		echo "</table>";
		echo "</div>";
		
	}
	
	
}
mysql_close($con);
?>
<html>
<head>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
</body>
</html>