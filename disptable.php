<?php
	session_start();
	if(!isset($_SESSION[username]))
	{
		header("Location: index.php");
		exit;
	}
	if($_SESSION[usertype]=="prof")
	{
		include("headerprof.php");
	}
	else
	{
		include("header.php");
	}

	
?>

<html>
<head>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

include("sql.php");

if(!empty($_POST[profname]))
{
	$_SESSION[profname]=$_POST[profname];
}

if($_SESSION[usertype]=="student")
{
	if(isset($_GET[c]))
	{
		$sql="INSERT INTO profdata (prof,student,day,hour,request,status,details,date) VALUES('$_SESSION[profname]','$_SESSION[username]','$_GET[c]','$_GET[d]','$_POST[reqtext]',0,'NONE','$_GET[dte]')";
		if (!mysql_query($sql,$con))
		{
			die('Error in updating: ' . mysql_error());
		}
	}
}


if($_SESSION[usertype]=="prof")
{
if(isset($_GET[c]))
{
	$query="SELECT prof,day,hour,date,status FROM future WHERE prof='".$_SESSION[username]."' AND day=".$_GET[c]." AND hour='".$_GET[d]."' AND date='".$_GET[date]."'"; 
	$queryres=mysql_query($query,$con);
	$arr2=@mysql_fetch_array($queryres);
	if(!empty($arr2))//Row already present
	{
		if($_POST[status]=="free")
		{
			$sql="UPDATE future SET status='FREE' WHERE prof='".$_SESSION[username]."' AND day=".$_GET[c]." AND hour='".$_GET[d]."' AND date='".$_GET[date]."'";
		}
		else if($_POST[status]=="busy")
		{
			$sql="UPDATE future SET status='BUSY' WHERE prof='".$_SESSION[username]."' AND day=".$_GET[c]." AND hour='".$_GET[d]."' AND date='".$_GET[date]."'";
		}
	}
	else//new row to be inserted
	{
		if($_POST['status']=="free")
		{
			$sql="INSERT INTO future(prof,day,hour,date,status) VALUES('$_SESSION[username]','$_GET[c]','$_GET[d]','$_GET[date]','FREE')";
			//$sql="UPDATE "."{$_SESSION[username]}"." SET "."{$_GET[d]}"."='FREE'"." WHERE DAY="."{$_GET[c]}";
		}
		if($_POST['status']=="busy")
		{
			$sql="INSERT INTO future(prof,day,hour,date,status) VALUES('$_SESSION[username]','$_GET[c]','$_GET[d]','$_GET[date]','BUSY')";
			//$sql="UPDATE "."{$_SESSION[username]}"." SET "."{$_GET[d]}"."='BUSY'"." WHERE DAY="."{$_GET[c]}";
		}
	}
	if (!mysql_query($sql,$con))
	{
		die('Error in updating: ' . mysql_error());
	}
}
}

	

?>

<table id="t" bacwidth="1126" height="520" border="1">
 <tr> <!--ACTUAL WIDTH="101"-->
    <th width="95" scope="col"><p>DAY/HOUR</p></th>
    <th width="85" scope="col">8:00-8:50</th>
    <th width="85" scope="col">9:00-9:50</th>
    <th width="89" scope="col">10:00-10:50</th>
    <th width="89" scope="col">11:00-11:50</th>
    <th width="89" scope="col">12:00-12:50</th>
    <th width="85" scope="col">1:00-1:50</th>
    <th width="85" scope="col">2:00-2:50</th>
    <th width="85" scope="col">3:00-3:50</th>
    <th width="85" scope="col">4:00-4:50</th>
    <th width="85" scope="col">5:00-5:50</th>
  </tr>
<?php

$q="SELECT * FROM timetable";
$q1=mysql_query($q,$con) or die("problem");
$d2=date("l");
include("revconvert.php");
$d=$day;
$x=$day;
if(isset($_GET[dt]))
{
	$z=$_GET[dt];
	if($z<0) $z=0;
}
else
$z=0;

while($d<=7)
{	
	$d1=$d;
	include("convert.php");
	$arr=mysql_fetch_array($q1);
	$timestamp=time()+24*3600*$z;
	$date=strftime("%d/%m/%y", $timestamp);
	echo "<tr><td>{$day}"."<br />".$date."</td>";
	$i=1;
	$e='A';
	while($i<=10)
	{
		if($_SESSION[usertype]=="prof")
		{
			$query="SELECT prof,day,hour,date,status FROM future WHERE prof='".$_SESSION[username]."' AND day=".$d." AND hour='".$e."' AND date='".$date."'"; 
		}
		else
		{
			$query="SELECT prof,day,hour,date,status FROM future WHERE prof='".$_SESSION[profname]."' AND day=".$d." AND hour='".$e."' AND date='".$date."'";  
		}
		$queryres=mysql_query($query,$con);
		$arr2=@mysql_fetch_array($queryres);
		if(!empty($arr2))
		{
			if($arr2[4]=="BUSY")
			{
				if($_SESSION[usertype]=="prof")
				{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
					$a=rawurlencode("disptable.php");
					$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".$date."&busy=".urlencode(1)."&dt=".urlencode($val);
					echo '<td id="z"><a href="'.htmlspecialchars($a).'">BUSY</a></td>';
				}
				else
				{
					echo '<td id="z">BUSY</td>';
				}
			}
			else if($arr2[4]=="FREE")
			{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
				$a=rawurlencode("disptable.php");
				$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".urlencode($date)."&dt=".urlencode($val);
				echo '<td><a href="'.htmlspecialchars($a).'">FREE</a></td>';
			}
		}
		else
		{
			if($arr[$i]=="BUSY")
			{
				if($_SESSION[usertype]=="prof")
				{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
					$a=rawurlencode("disptable.php");
					$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".$date."&busy=".urlencode(1)."&dt=".urlencode($val);
					echo '<td id="z"><a href="'.htmlspecialchars($a).'">BUSY</a></td>';
				}
				else
				{
					echo '<td id="z">BUSY</td>';
				}
			}
			else if($arr[$i]=="FREE")
			{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
				$a=rawurlencode("disptable.php");
				$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".urlencode($date)."&dt=".urlencode($val);
				echo '<td><a href="'.htmlspecialchars($a).'">FREE</a></td>';
			}
		
		}
		$e++;
		$i++;
	}
	echo "</tr>";
	$d++;
	//if($day=="SAT") $z+=2;
	//else	$z++;
	$z++;
}
$d=1;$d3=$x;
while($d<=($d3-1))
{	
	$d1=$d;
	include("convert.php");
	$arr=mysql_fetch_array($q1);
	$timestamp=time()+24*3600*$z;
	$date=strftime("%d/%m/%y", $timestamp);
	echo "<tr><td>{$day}"."<br />".$date."</td>";
	$i=1;
	$e='A';
	while($i<=10)
	{
		if($_SESSION[usertype]=="prof")
		{
			$query="SELECT prof,day,hour,date,status FROM future WHERE prof='".$_SESSION[username]."' AND day=".$d." AND hour='".$e."' AND date='".$date."'";  
		}
		else
		{
			$query="SELECT prof,day,hour,date,status FROM future WHERE prof='".$_SESSION[profname]."' AND day=".$d." AND hour='".$e."' AND date='".$date."'"; 
		}
		$queryres=mysql_query($query,$con);
		$arr2=@mysql_fetch_array($queryres);
		if($arr2)
		{
			if($arr2[4]=="BUSY")
			{
				if($_SESSION[usertype]=="prof")
				{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
					$a=rawurlencode("disptable.php");
					$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".$date."&busy=".urlencode(1)."&dt=".urlencode($val);
					echo '<td id="z"><a href="'.htmlspecialchars($a).'">BUSY</a></td>';
				}
				else
				{
					echo '<td id="z">BUSY</td>';
				}
			}
			else if($arr2[4]=="FREE")
			{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
				$a=rawurlencode("disptable.php");
				$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".urlencode($date)."&dt=".urlencode($val);
				echo '<td><a href="'.htmlspecialchars($a).'">FREE</a></td>';
			}
		}
		else
		{
			if($arr[$i]=="BUSY")
			{
				if($_SESSION[usertype]=="prof")
				{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
					$a=rawurlencode("disptable.php");
					$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".$date."&busy=".urlencode(1)."&dt=".urlencode($val);
					echo '<td id="z"><a href="'.htmlspecialchars($a).'">BUSY</a></td>';
				}
				else
				{
					echo '<td id="z">BUSY</td>';
				}
			}
			else if($arr[$i]=="FREE")
			{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
				$a=rawurlencode("disptable.php");
				$a .="?day=".urlencode($d)."&hr=".urlencode($e)."&date=".urlencode($date)."&dt=".urlencode($val);
				echo '<td><a href="'.htmlspecialchars($a).'">FREE</a></td>';
			}
		}
		$e++;
		$i++;
	}
	echo "</tr>";
	$d++;
	//if($day=="SAT") $z+=2;
	//else	$z++;
	$z++;
}
?>
</table>



<br /><br /><br /><br /><br /><br /><br />
<?php
$y=rawurlencode("disptable.php");
$y .="?dt=".urlencode($z);
echo '<div id="j">';
echo '<form id="j2" action="'.$y.'" method="post">';
echo '<input type="submit" value="NEXT WEEK"/>';
echo '</form>';
$y1=rawurlencode("disptable.php");
if(($z-14)<0) $y1 .="?dt=".urlencode(0);
else $y1 .="?dt=".urlencode($z-14);
//echo '<br />';
echo '<form id="j1" action="'.$y1.'" method="post">';
echo '<input type="submit" value="LAST WEEK"/>';
echo '</form>';
echo '</div>';



if($_SESSION[usertype]=="prof")
{
if(isset($_GET[day]))
{
echo "<br />";
$d1=$_GET[day];
$t1=$_GET[hr];
include("convert.php");
$timestamp1=time()+24*3600*$_GET[dt];
$date1=strftime("%d/%m/%y", $timestamp1);
echo "<div id=".'"helptext"'."><pre><b><strong>       {$day} {$time} {$_GET[date]}</strong></b></pre></div>";
echo '<div id="radio">';
if(isset($_GET[dt]))	$val=$_GET[dt];
else if(isset($z))
{
	$val=$z-($z%7);
}
else $val=0;
$b=rawurlencode("disptable.php");
$b .="?c=".urlencode($_GET[day]);
$b .="&d=".urlencode($_GET[hr]);
$b .="&date=".urlencode($_GET[date]);
$b .="&dt=".urlencode($val);
include("javascript/statusvalidate.php");
echo '<form action="'.htmlspecialchars($b).'" method='.'"post" id="chkstatus" name="chkstatus" onsubmit="return status_validate()">';
echo "<pre>     <b>Change the status to</b></pre><br />";
if(isset($_GET[busy])) 
echo '&nbsp;&nbsp;&nbsp;<input type="checkbox" id="status" name="status" value="free">FREE<br /><br />';
else
echo '&nbsp;&nbsp;&nbsp;<input type="checkbox" id="status" name="status" value="busy">BUSY<br /><br />';
echo '<div align="center">';
echo '<input type="submit" value="SUBMIT">';
echo '&nbsp;&nbsp;<input type="reset" value="RESET">';
echo '&nbsp;&nbsp;<a href="disptable.php"><input type="button" value="CANCEL"></a>';
echo '</div>';
echo "</form>";
echo "</div>";

}
}
else
{
	if(isset($_GET[day]))
	{
					if(isset($_GET[dt]))	$val=$_GET[dt];
					else if(isset($z))
					{
						$val=$z-($z%7);
					}
					else $val=0;
	$a=rawurlencode("disptable.php");
	$a .="?c=".urlencode($_GET[day])."&&d=".urlencode($_GET[hr])."&&dte=".urlencode($_GET[date])."&&dt=".urlencode($val);
	include("javascript/cvalidate.php"); 
	echo '<form action="'.$a.'" method="post" onsubmit="return validate()" id="textarea">';
	$d1=$_GET[day];
	$t1=$_GET[hr];
	include("convert.php");
	
	echo '<br />';
	echo "<pre><b><strong>     {$day} {$time} {$_GET[date]}</strong></b></pre>";
	
	echo '<textarea name="reqtext" cols="30" rows="11"></textarea><br />';
	echo '<div align="center">';
	echo '<input type="submit" value="SUBMIT">';
	echo '<input type="reset" value="RESET">';
	echo '<a href="disptable.php"><input type="button" value="CANCEL"></a>';
	echo '</div>';
	echo '</form>';
	}
}	
if(isset($_GET[c]) && $_SESSION[usertype]=="student")
{
	echo "<div id=".'"successmsg"'."><b>Request successfully sent </b><br/></div>";
}

?>


</body>
</html>