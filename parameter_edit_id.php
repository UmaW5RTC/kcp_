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
			$parameter_id=$_GET['edit'];
			$dis=mysql_query("select * from `parameter_table` where s_no='$parameter_id'");
			$row=mysql_fetch_array($dis);
		}
	if(isset($_POST['submit']))
		{
			$parameter_id =$_POST['parameter'];
			$parameter_name =$_POST['parameter_name'];
			$range_mininum =$_POST['range_mini'];
			$range_maximum =$_POST['range_max'];
			$multiplication_factor =$_POST['multiplication'];
			$threshold=$_POST['threshold'];
			$sql="update parameter_table set parameter_id='$parameter_id',parameter_name='$parameter_name',
					range_mininum='$range_mininum',range_maximum='$range_maximum',
					multiplication_factor='$multiplication_factor',threshold='$threshold' where parameter_id='$parameter_id'";
			$row=mysql_query($sql) or die("coudld not update".mysql_error());
			echo "<br/><center>Update successfully<br/><a href='parameter_edit.php'>Back to Parameter Edit page</a></center>";
		}
		else
		{
?>	
	<form method="post" name="orderinfo"  action="<?php echo $_SERVER['PHP_SELF'];?>"  ENCTYPE="text/html" >
        <div style=" margin-top:50px; margin-left:80px;"> 
                Parameter ID <input type="text" name="parameter" readonly="readonly" value="<?php echo $row[1];?>" tabindex="1" style="width:160px; margin-left:5px;margin-right:40px;"/>
                Parameter Name <input type="text" name="parameter_name"  value="<?php echo $row[2];?>" tabindex="2" style="width:160px; margin-left:5px;margin-right:40px;"/>
                Range Mini <input type="text" name="range_mini" value="<?php echo $row[3];?>" tabindex="3" style="width:160px; margin-left:5px;margin-right:40px;"/>
                Range Max <input type="text" name="range_max"  value="<?php echo $row[4];?>" tabindex="4" style="width:150px; margin-left:5px;margin-right:0px;"/><br/><br/>
                Multiplication<input type="text" value="<?php echo $row[5];?>" name="multiplication" tabindex="5" style="width:160px; margin-left:5px;margin-right:50px;"/>
                Threshold <input type="text" value="<?php echo $row[6];?>" name="threshold" tabindex="6" style="width:160px; margin-left:5px;margin-right:50px;"/>
              <center><input type="submit" value="Update" name="submit" tabindex="7"/></center>
        </div>
</form>
<?php
	}
?>
</body>
</html>