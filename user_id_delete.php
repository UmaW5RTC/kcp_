<link href="css/main.css" type="text/css" rel="stylesheet"/>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','ospcbin_kumar','2crn#robin1','ospcbin_KCP');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ospcbin_KCP");
$sql="SELECT * FROM user_table WHERE s_no = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table class='imagetable'> 
<tr>
	<th>User ID</th>
	<th>Site Name</th>
	<th>Project Name</th>
	<th>Username</th>
	<th>Password</th>
	<th>User Type</th>
	<th>Delete</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['user_id'] . "</td>";
  echo "<td>";
	include ('conn.php');
	$result_site = mysql_query("SELECT * FROM `site_table` WHERE project_code =" .$row['project_code'].""); 
	while($row_site = mysql_fetch_assoc($result_site)){	
	echo "" .$row_site['site_name']. "<br/>";
	}
	echo "</td>";
	$result1 = mysql_query("SELECT * FROM `project_table` WHERE project_code =" .$row['project_code'].""); 
	$rows = mysql_fetch_assoc($result1);
	echo "<td>". $rows['project_name']. "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['password'] . "</td>";
  echo "<td>" . $row['user_type'] . "</td>";
  ?>
  <td><a href='user_delete_id.php?delete=<?php echo $row['user_id'];?>'><input type='button' value='Delete' /></a></td>
  <?php
  echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
