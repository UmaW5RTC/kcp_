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
    <div id="container">
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
                    <a href="#">Project Master</a>
                        <ul>                    
                            <li>                   
                                <a href="project.php" title="Project Master">Project Master</a>
                            </li>
                            <li>
                                <a href="project_edit.php" title="Project Edit">Project Edit</a>
                            </li>
                            <li>
                                <a href="project_delete.php" title="Project Delete">Project Delete</a>
                            <li>
                        </ul>
                </li>
                 <li>
                     <a href="#">Site Master</a>
                        <ul>
                            <li>
                                <a href="site.php" title="Site Master">Site Maste</a>
                            </li>
                             <li>
                                <a href="site_edit.php" title="Site Edit">Site Edit</a>
                            </li>
                             <li>
                                <a href="site_delete.php" title="Site Delete">Site Delete</a>
                            </li>
                      </ul>
                </li>
                 <li>
                     <a href="#">Parameter Master</a>
                         <ul>
                             <li>
                                <a href="parameter.php" title="Parameter Master">Parameter Master</a>
                            </li>
                             <li>
                                <a href="parameter_edit.php" title="Parameter Edit">Parameter Edit</a>
                            </li>
                             <li>
                                <a href="parameter_delete.php" title="Parameter Delete">Parameter Delete</a>
                            </li>
                         </ul>
                </li>
                <li>
                    <a href="#">User Master</a>
                        <ul>
                            <li>
                                <a href="user.php" title="Add User">Add User</a>
                            </li>
                            <li>
                                <a href="user_edit.php" title="Edit User">Edit User</a>
                            </li>
                            <li>
                                <a href="user_delete.php" title="Delete User">Delete User</a>
                            </li>
                      </ul>
                </li>
                 <li >
                    <a href="tabular.php" title="Tabular View">Tabular View</a>
                </li>
                 <li >
                    <a href="graphics.php" title="Graphics View">Graphics View</a>
                </li>
        </ul>
     </div>
        <div id="body">
<?php
	if(isset($_POST['submit']))
		{
			include('conn.php');
			$site_name=$_POST['site_name'];
			$project_code =$_POST['project'];
			$address =$_POST['address'];
			$channel_1 = $_POST['channel_1'];
			$channel_2 = $_POST['channel_2'];
			$channel_3 = $_POST['channel_3'];
			$channel_4 = $_POST['channel_4'];
			$channel_5 = $_POST['channel_5'];
			$channel_6 = $_POST['channel_6'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			$email2 = $_POST['email2'];
			$mobile2 = $_POST['mobile2'];
	$sql = "INSERT INTO `site_table` ".
       "(site_name,project_code,address,channel_1,channel_2,channel_3,channel_4,channel_5,channel_6,email,mobile,
	   email2,mobile2) ".
       "VALUES('$site_name','$project_code','$address','$channel_1','$channel_2','$channel_3','$channel_4','$channel_5','$channel_6','$email','$mobile','$email2','$mobile2')";
		$retval = mysql_query( $sql, $cnn );
	if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
			echo "INSERT Data Successful";
		}
		mysql_close($cnn);
		echo "<center>Your Created successfully<br/>";
		echo "<a href='site.php'>Back to Site page</a></center>";
	}
	else
	{
?>
<form method="post" name="orderinfo"  action="<?php echo $_SERVER['PHP_SELF'];?>"  ENCTYPE="text/html" >
        <div style="margin-top:50px; margin-left:80px;"> 
                Site Code 
		 <?php
				include('conn.php');
				$sel_task_id = "SELECT site_code FROM `site_table` ORDER BY site_code DESC;";
				$next_sl = mysql_query($sel_task_id);
				$next = mysql_fetch_array($next_sl);
				$next_final = $next[0] + 1;
          ?>                                
                <input type="text" name="site" tabindex="1" value="<?php echo $next_final ?>" style="width:160px; margin-left:5px;margin-right:50px;" readonly="readonly"  />
                Site Name <input type="text" name="site_name" tabindex="2" style="width:160px; margin-left:5px;margin-right:50px;" required="required"/>
                Project Name
		 <?php 
				$result = mysql_query("SELECT * FROM `project_table`");
				echo '<select name="project" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" required tabindex="3">';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
					echo "<option value='".$row['project_code']."'>".$row['project_name']." </option>";
			}
					echo "</select>";
		?> 
               Address <input type="text" name="address" tabindex="4" style="width:160px; margin-left:5px;margin-right:50px;" required="required"/><br/><br/>
<?php
// Channel-1
				echo '<label for="Channel-1">Channel-1</label>';
				$result = mysql_query("SELECT * FROM `parameter_table`");
				echo '<select name="channel_1" style="width:160px; margin-left:5px; margin-right:60px; height:29px;" tabindex="5" required>';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
					}
				echo "</select>";
// Channel-2
				echo '<label for="Channel-2">Channel-2</label>';
				$result = mysql_query("SELECT * FROM `parameter_table`");
				echo '<select name="channel_2" style="width:160px; margin-left:5px; margin-right:60px; height:29px;" tabindex="6" required>';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
					}
				echo "</select>";
// Channel-3
				echo '<label for=" Channel-3">Channel-3</label>';
				$result = mysql_query("SELECT * FROM `parameter_table`");
				echo '<select name="channel_3" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" tabindex="7" required>';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
					}
				echo "</select>";
// Channel-4
				echo '<label for="Channel-4">Channel-4</label>';
				$result = mysql_query("SELECT * FROM `parameter_table`");
				echo '<select name="channel_4" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" required tabindex="8">';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
					}
				echo "</select><br/><br/>";
// Channel-5

				echo '<label for="Channel-5">Channel-5</label>';
				$result = mysql_query("SELECT * FROM `parameter_table`");
				echo '<select name="channel_5" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" required tabindex="9">';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
					}
				echo "</select>";
// Channel-6

				echo '<label for="Channel-6">Channel-6</label>';
				$result = mysql_query("SELECT * FROM `parameter_table`");
				
				echo '<select name="channel_6" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" required tabindex="10">';
				echo '<option value="">Select</option>';
				echo "<option value='NA'>NA</option>";
				while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
					}
				echo "</select>";
?>    
              Manager Email <input type="email" name="email2" tabindex="11" placeholder="Manager Email" style="width:160px; margin-left:5px;margin-right:40px;" required="required"/>  
              Manager Mobile <input type="text" name="mobile2" tabindex="12" placeholder="Manager Mobile" style="width:150px; margin-left:5px;margin-right:0px;" required="required"/><br/><br/>
              Authority Email <input type="email" name="email" tabindex="13" placeholder="Authority Email" style="width:160px; margin-left:5px;margin-right:50px;" required="required"/>
              Authority Mobile <input type="text" name="mobile" tabindex="14" placeholder="Authority Mobile" style="width:160px; margin-left:5px;margin-right:50px;" required="required"/><br/><br/>
            <center><input type="submit" value="Submit" tabindex="15" name="submit"/></center>             
     </div>
 </form>
<?php
	}
?>
</body>
</html>