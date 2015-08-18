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
	include('conn.php');
		if(isset($_GET['edit']))
		{
			$site_code=$_GET['edit'];
			$dis=mysql_query("select * from `site_table` where site_code='$site_code'");
			$row=mysql_fetch_array($dis);
		}
		if(isset($_POST['submit']))
		{
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
			$site_code=$_POST['site_code'];
			$sql="update site_table set site_code='$site_code',site_name='$site_name',project_code='$project_code',
			address='$address',channel_1='$channel_1',channel_2='$channel_2',channel_3='$channel_3',channel_4='$channel_4',
	channel_5='$channel_5',channel_6='$channel_6',email='$email',mobile='$mobile',email2='$email2',mobile2='$mobile2' where site_code='$site_code'";
			$row=mysql_query($sql) or die("coudld not update".mysql_error());
			echo "<br/><center>Update successfully<br/><a href='site_edit.php'>Back to Site Edit page</a></center>";
		}
		else
		{
?>	
<form method="post" name="orderinfo"  action="<?php echo $_SERVER['PHP_SELF'];?>"  ENCTYPE="text/html" >
        <div style="margin-top:50px; margin-left:80px;"> 
                Site Code <input type="text" name="site_code" tabindex="1" value="<?php echo $row[0] ?>" readonly="readonly" style="width:160px; margin-left:5px;margin-right:50px;"/>
                Site Name <input type="text" name="site_name" tabindex="2" value="<?php echo $row[1] ?>" style="width:160px; margin-left:5px;margin-right:50px;"/>
                Project Code
		 <?php 
		 $result = mysql_query("SELECT * FROM `project_table`");
				echo '<select name="project" style="width:160px; margin-left:5px; margin-right:50px; height:29px;"  tabindex="3">';
				echo "<option value=".$row[2].">".$row[2]."</option>";
				while($rows = mysql_fetch_assoc($result)) 
				{
				echo "<option value='".$rows['project_code']."'>".$rows['project_code']."</option>";
				}
				echo "</select>";
				
		?> 
               Address <input type="text" name="address" tabindex="4" value="<?php echo $row[3] ?>" style="width:160px; margin-left:5px;margin-right:50px;"/><br/><br/>
<?php
// Channel-1
				echo '<label for="channel-1">channel-1</label>';
				$result = mysql_query("SELECT * FROM `site_table`");
				echo '<select name="channel_1" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" tabindex="5">';
				echo "<option value=".$row[4].">".$row[4]."</option>";
				while($row1 = mysql_fetch_assoc($result)) 
				{
				echo "<option value='".$row1['channel_1']."'>".$row1['channel_1']."</option>";
				}
				echo "</select>";
	
// Channel-2
				echo '<label for="Channel-2">Channel-2</label>';
				$result = mysql_query("SELECT * FROM `site_table`");
				echo '<select name="channel_2" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" tabindex="6">';
				echo "<option value=".$row[5].">".$row[5]."</option>";
				while($row2 = mysql_fetch_assoc($result)) {
				echo "<option value='".$row2['channel_2']."'>".$row2['channel_2']."</option>";
					}
				echo "</select>";
// Channel-3
				echo '<label for=" Channel-3">Channel-3</label>';
				$result = mysql_query("SELECT * FROM `site_table`");
				echo '<select name="channel_3" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" tabindex="7" >';
				echo "<option value=".$row[6].">".$row[6]."</option>";
				while($row3 = mysql_fetch_assoc($result)) {
				echo "<option value='".$row3['channel_3']."'>".$row3['channel_3']." </option>";
					}
				echo "</select>";
// Channel-4
				echo '<label for="Channel-4">Channel-4</label>';
				$result = mysql_query("SELECT * FROM `site_table`");
				echo '<select name="channel_4" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" tabindex="8">';
				echo "<option value=".$row[7].">".$row[7]."</option>";
				while($row4 = mysql_fetch_assoc($result)) {
				echo "<option value='".$row4['channel_4']."'>".$row4['channel_4']." </option>";
					}
				echo "</select><br/><br/>";
// Channel-5

				echo '<label for="Channel-5">Channel-5</label>';
				$result = mysql_query("SELECT * FROM `site_table`");
				echo '<select name="channel_5" style="width:160px; margin-left:5px; margin-right:50px; height:29px;" tabindex="9">';
				echo "<option value=".$row[8].">".$row[8]."</option>";
				while($row5 = mysql_fetch_assoc($result)) {
				echo "<option value='".$row5['channel_5']."'>".$row5['channel_5']." </option>";
					}
				echo "</select>";
// Channel-6

				echo '<label for="Channel-6">Channel-6</label>';
				$result = mysql_query("SELECT * FROM `site_table`");
				
				echo '<select name="channel_6" style="width:160px; margin-left:5px; margin-right:50px; height:29px;"  tabindex="10">';
				echo "<option value=".$row[9].">".$row[9]."</option>";
				while($row6 = mysql_fetch_assoc($result)) {
				echo "<option value='".$row6['channel_6']."'>".$row6['channel_6']." </option>";
					}
				echo "</select>";
?>    
              Manager Email <input type="email" name="email2" value="<?php echo $row[11] ?>" tabindex="11" placeholder="Manager Email" style="width:160px; margin-left:5px;margin-right:40px;" />  
              Manager Mobile <input type="text" name="mobile2" value="<?php echo $row[13] ?>" tabindex="12" placeholder="Manager Mobile" style="width:150px; margin-left:5px;margin-right:0px;"/><br/><br/>
              Authority Email <input type="email" name="email" value="<?php echo $row[10] ?>" tabindex="13" placeholder="Authority Email" style="width:160px; margin-left:5px;margin-right:50px;" />
              Authority Mobile <input type="text" name="mobile" value="<?php echo $row[12] ?>" tabindex="14" placeholder="Authority Mobile" style="width:160px; margin-left:5px;margin-right:50px;" /><br/><br/>
            <center><input type="submit" value="Update" tabindex="15" name="submit"/></center>
     </div>

 </form>
<?php
	}
?>
</body>
</html>