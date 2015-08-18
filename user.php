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
            <a href="log_in.php">
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
			$user_id =$_POST['user'];
			$project_code =$_POST['project_code'];
 			$username =$_POST['user_name'];
			$user_type =$_POST['user_type'];
			$password = $_POST['pass'];
		
	$sql = "INSERT INTO `user_table` ".
       "(user_id,project_code,username,user_type,password) ".
       "VALUES('$user_id','$project_code','$username','$user_type','$password')";
		$retval = mysql_query( $sql, $cnn );
	if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
			echo "INSERT Data Successful";
		}
		mysql_close($cnn);
		echo "<center>Your Created successfully<br/>";
		echo "<a href='user.php'>Back to user page</a></center>";
	}
	else
	{
?>
	<form method="post" name="orderinfo" action="<?php echo $_SERVER['PHP_SELF'];?>" ENCTYPE="text/html" >
            <div style="margin-top:50px; margin-left:80px;"> 
                User ID <input type="text" name="user" tabindex="1" style="width:160px; margin-left:5px;margin-right:50px;"/>
                User Name <input type="text" name="user_name" tabindex="2" style="width:160px; margin-left:5px;margin-right:50px;"/>
                Password <input type="text" name="pass" tabindex="3" style="width:160px; margin-left:5px;margin-right:50px;"/>
                Project Name
					<?php 
                                     include('conn.php');
                                    $result = mysql_query("SELECT * FROM `project_table`");
                                        echo '<select name="project_code" style="width:160px; height:29px; margin-left:5px;" required tabindex="4">';
                                        echo '<option value="">Select</option>';
                                    while($row = mysql_fetch_assoc($result)) {
                                        echo "<option value='".$row['project_code']."'>".$row['project_name']." </option>";
                                }
                                        echo "</select>";
                    ?> <BR/><BR/>
                User Type
                <select name="user_type" style="width:160px; margin-left:5px;margin-right:50px;" required tabindex="5">
                    <option value="">Select</option>
                    <option value="Admin">Admin</option>
                    <option value="User Type 1">User Type 1</option>
                    <option value="User Type 2">User Type 2</option>
                </select>
              <center><input type="submit" value="Submit" name="submit" tabindex="6"/></center>
             </div>
</form>
<?php
	}
?>
    </div>
</body>
</html>