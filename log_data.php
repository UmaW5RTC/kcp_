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
</head>
<body>
        <p style="text-align:center;margin:auto;margin-left:750px; margin-top:5px;">
            <a href="log_out.php">
                <button style="width:90px; height:40px;font-size:14px;">Log Out</button> 
            </a>
        </p>

    <div id="container1">
    	<div id="header">
            <div id="header_left">
                <img src="images/kcp.jpg" width="100"/>
            </div>
            <div id="header_center">
                <center>KCP Connect<sup>+</sup></center>
            </div>
        </div>
                        <div id="menu">
            <ul>
                <li>
                    <a href="log_out.php" title="Home">Home</a>
                </li>
                 <li>
                    <a href="project.php" title="Project Master">Project Master</a>
                </li>
                 <li >
                    <a href="site.php" title="Site Master">Site Maste</a>
                </li>
                 <li >
                    <a href="parameter.php" title="Parameter Master">Parameter Master</a>
                </li>
                <li >
                    <a href="user.php" title="Add User">Add User</a>
                </li>
                 <li >
                    <a href="log_data.php" title="Login Master">Login Master</a>
                </li>
                 <li >
                    <a href="tabular.php" title="Tabular View">Tabular View</a>
                </li>
                 <li >
                    <a href="graphics.php" title="Graphics View">Graphics View</a>
                </li>
        </ul>
     </div>
     <?php
	if(isset($_POST['submit']))
		{
			$cnn=mysql_connect("localhost","ospcbin_kumar","2crn#robin1");
			mysql_select_db("ospcbin_KCP",$cnn);
	if(! $cnn )
		{
		  die('Could not connect: ' . mysql_error());
		}
	if(! get_magic_quotes_gpc())
		{
			$site_code =$_POST['site'];
			$time_stamp =$_POST['time'];
			$channel_1_id =$_POST['id_1'];
			$channel_1_value =$_POST['channel_1'];
			$channel_1_output =$_POST['output_1'];
			$channel_2_id =$_POST['id_2'];
			$channel_2_value =$_POST['channel_2'];
			$channel_2_output =$_POST['output_2'];
			$channel_3_id =$_POST['id_3'];
			$channel_3_value =$_POST['channel_3'];
			$channel_3_output =$_POST['output_3'];
			$channel_4_id =$_POST['id_4'];
			$channel_4_value =$_POST['channel_4'];
			$channel_4_output =$_POST['output_4'];
			$channel_5_id =$_POST['id_5'];
			$channel_5_value =$_POST['channel_5'];
			$channel_5_output =$_POST['output_5'];
			$channel_6_id =$_POST['id_6'];
			$channel_6_value =$_POST['channel_6'];
os		}
	$sql = "INSERT INTO `log_database` ".
       "(site_code,time_stamp,channel_1_id,channel_1_value,channel_1_output,channel_2_id,channel_2_value,channel_2_output,channel_3_id,channel_3_value,channel_3_output,channel_4_id,channel_4_value,channel_4_output,channel_5_id,channel_5_value,channel_5_output,channel_6_id,channel_6_value,channel_6_output) ".
       "VALUES('$site_code','$time_stamp','$channel_1_id','$channel_1_value','$channel_1_output','$channel_2_id','$channel_2_value','$channel_2_output','$channel_3_id','$channel_3_value','$channel_3_output','$channel_4_id','$channel_4_value','$channel_4_output','$channel_5_id','$channel_5_value','$channel_5_output','$channel_6_id','$channel_6_value','$channel_6_output')";	
		$retval = mysql_query( $sql, $cnn );
	if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
			echo "INSERT Data Successful";
		}
		mysql_close($cnn);
		echo "<center>Your Created successfully<br/>";
		echo "<a href='log_data.php'>Back to Log Data page</a></center>";
	}
	else
	{
?>
	<form method="post" name="orderinfo"  action="<?php echo $_SERVER['PHP_SELF'];?>"  ENCTYPE="text/html" >

        <div id="body">
            <div id="body_container_left">
                    Site Code &nbsp;&nbsp;&nbsp;<input type="text" name="site" tabindex="1"/><br/><br/>
                    Channel-1 Value &nbsp;&nbsp;&nbsp;<input type="text" name="channel_1" tabindex="4"/><br/><br/>
                    Channel-2 Value &nbsp;&nbsp;&nbsp;<input type="text" name="channel_2" tabindex="7"/><br/><br/>
                    Channel-3 Value &nbsp;&nbsp;&nbsp;<input type="text" name="channel_3" tabindex="10"/><br/><br/>
                    Channel-4 Value &nbsp;&nbsp;&nbsp;<input type="text" name="channel_4" tabindex="13"/><br/><br/>
                    Channel-5 Value &nbsp;&nbsp;&nbsp;<input type="text" name="channel_5" tabindex="16"/><br/><br/>
                    Channel-6 Value &nbsp;&nbsp;&nbsp;<input type="text" name="channel_6" tabindex="19"/><br/><br/>

            </div>
            <div id="body_container_center1">
                    Time Stamp &nbsp;&nbsp;&nbsp;<input type="text" name="time" tabindex="2"/><br/><br/>
                    Channel-1 Output &nbsp;&nbsp;&nbsp;<input type="text" name="output_1" tabindex="5"/><br/><br/>
                    Channel-2 Output &nbsp;&nbsp;&nbsp;<input type="text" name="output_2" tabindex="8"/><br/><br/>
                    Channel-3 Output &nbsp;&nbsp;&nbsp;<input type="text" name="output_3" tabindex="11"/><br/><br/>
                    Channel-4 Output &nbsp;&nbsp;&nbsp;<input type="text" name="output_4" tabindex="14"/><br/><br/>
                    Channel-5 Output &nbsp;&nbsp;&nbsp;<input type="text" name="output_5" tabindex="17"/><br/><br/>
                    Channel-6 Output &nbsp;&nbsp;&nbsp;<input type="text" name="output_6" tabindex="20"/><br/><br/>
             </div>
             <div id="body_container_right">
                    Channel-1 ID&nbsp;<input type="text" name="id_1" tabindex="3"><br/><br/>
                    Channel-2 ID&nbsp;&nbsp;&nbsp;<input type="text"  name="id_2" tabindex="6"><br/><br/>
                    Channel-3 ID &nbsp;&nbsp;&nbsp;<input type="text" name="id_3" tabindex="9"/><br/><br/>
                    Channel-4 ID&nbsp;&nbsp;&nbsp;<input type="text" name="id_4" tabindex="12"/><br/><br/>
                    Channel-5 ID&nbsp;&nbsp;&nbsp;<input type="text" name="id_5" tabindex="15"/><br/><br/>
                    Channel-6 ID&nbsp;&nbsp;&nbsp;<input type="text" name="id_6" tabindex="18"/><br/><br/>
                   <center> <input type="submit" value="Submit" name="submit" tabindex="21"/></center>
             </div>
        </div>

    </div>
 <?php
	}
	?>
</body>
</html>
