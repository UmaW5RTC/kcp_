<?php
//ob_start();
//session_start();
$host="localhost"; // Host name 
$username="ospcbin_kumar"; // Mysql username 
$password="2crn#robin1"; // Mysql password 
$db_name="ospcbin_KCP"; // Database name 
$tbl_name="user_table"; // Table name 
// Connect to server and select databse.
mysql_connect("$host","$username","$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$_SESSION['username'] = $_POST['myusername'];
$_SESSION['project_code'];
$result=mysql_query($sql);
// Mysql_num_row is counting table row
//echo $count=mysql_num_rows($result);
while($row = mysql_fetch_assoc($result)){
	  echo $luser_type = $row['user_type'];
	  echo $_SESSION['project_code'] = $row['project_code'];
	  echo $row['username'];

}

// If result matched $myusername and $mypassword, table row must be 1 row
if($luser_type=='Admin'){

// Register $myusername, $mypassword and redirect to file "login_success.php"
header("location:../admin.php");
}
if($luser_type=='User Type 1'){

// Register $myusername, $mypassword and redirect to file "login_success.php"
header("location:../user_type_1.php");
}
if($luser_type=='User Type 2'){

// Register $myusername, $mypassword and redirect to file "login_success.php"
header("location:../user_type_2.php");
}
else {
echo "Wrong Username or Password";
}
?>
