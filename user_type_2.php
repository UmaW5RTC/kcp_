<?php

// Inialize session
ob_start();
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KCP</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","user_display.php?q="+str,true);
  xmlhttp.send();
}
</script>
<style>
#body .left
{
	width:40%;
	float:left;
	background:#FFF;
	border-bottom-left-radius:25px;
}
#body .center
{
	width:30%;
	float:left;
	background:#FFF;
}
#body .right
{
	width:30%;
	float:right;
	background:#FFF;
	border-bottom-right-radius:25px;
	border-left-color:#FFF;
}
#container1
{
	width:899px;
	height:100%;
	min-height:500px;
	margin:16px auto 20px auto;
	border-right:2px solid #827B7B;
	border-left:2px solid #827B7B;
	border-top-left-radius: 20px;
	border-top-right-radius: 20px;
	border-bottom-left-radius: 20px;
	border-bottom-right-radius: 20px;
	border:1px solid  #fff;	
	-moz-box-shadow: 0 0 12px #FDB5B5  ;
  	-webkit-box-shadow: 0 0 12px #FDB5B5 ;
	background:#fff;
}

</style>
</head>
<body>
        <p style="text-align:center;margin:auto;margin-left:750px; margin-top:5px;">
            <a href="log_out.php">
                <button style="width:90px; height:40px;font-size:14px;">Log Out</button> 
            </a>
        </p>

    <div id="container">
    	<div id="header">
            <div id="header_left">
                <img src="images/kcp.jpg" width="100"/>
            </div>
            <div id="header_center">
                <center>KCP Connect<sup>+</sup></center>
            </div>
        </div>
  <div id="body">
            <div class="left">
            <p style="font-size:25px; color:#039; text-align:center;">KCP Connect<sup>+</sup></p>
            <?PHP
				$dbhost = 'localhost';
				$dbuser = 'ospcbin_kumar';
				$dbpass = '2crn#robin1';
				$conn = mysql_connect($dbhost, $dbuser, $dbpass);
				if(! $conn )
				{
				  die('Could not connect: ' . mysql_error());
				}
				$sql = 'SELECT * FROM `project_table` where project_code='.$_SESSION["project_code"].'';
				mysql_select_db('ospcbin_KCP');
				$retval = mysql_query( $sql, $conn );
				if(! $retval )
				{
				  die('Could not get data: ' . mysql_error());
				}
				while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
				{
					echo "<p style='color:#039; text-align:left;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;Project Name :
					<font color='#F00'>".$row['project_name']."</font></p>";
					echo "<p style='color:#039; text-align:left;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;District :
					<font color='#F00'>".$row['district']."</font></p>";
					echo "<p style='color:#039; text-align:left;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;Address :
					<font color='#F00'>".$row['address']."</font></p>";
					echo "<p style='color:#039; text-align:left;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;User Name :
					<font color='#F00'>".$_SESSION['username']."</font></p>";
				}
			//////////////////
				$result = mysql_query("SELECT * FROM `site_table` where project_code=".$_SESSION["project_code"]."");
					echo '<font color="#039">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;Site Code</font>
					<select style="width:160px; height:29px; margin-left:5px;"  name="users" onchange="showUser(this.value)">';
					echo '<option value="">Select</option>';
				while($row = mysql_fetch_assoc($result)) {
					echo "<option value='".$row['site_code']."'>".$row['site_name']." </option>";
			}
					echo "</select>";

		?>    
  </div>
     <div class="center">
     <br/><br/><br/>
            <img src="images/location.png" width="300" height="250"/>
    </div>
    <div class="right"><br/>
                 Select the parameter you want to monitor<br/>
             <center><div id="txtHint" style="width:250px; height:145px; border:1px solid #FFFF00;">
             <center><p style="margin-top:50px;"><b>Select particular Site Name For view the Graphics View.</b></p></div></center>
             <table  border="1" bordercolor="#FFFF00" width="250" height="100" style="margin-left:70px;">
                <tr>
                     <td>
                         &nbsp;&nbsp;&nbsp;<font color='#F00'>Tabular Display
                         <a href="tabular_user_2.php"><input type="button" /></a></font><br/>
                          &nbsp;&nbsp;&nbsp;<font color='#F00'>Historical Data&nbsp; 
                         <a href="historical.php" title="Historical Data Analysis"><input type="button" /></a></font><br/>
                   			 &nbsp;&nbsp;&nbsp;<font color='#F00'>Export View&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <a href="export.php" title="Export"><input type="button" /></a></font><br/>
                         <font color='#039'>(All the parameter with Time Stamp Will be displayed in realtime)</font>
                     </td>
             </tr>
        </table><br/>
        </div>
    </div>
</body>
</html>
