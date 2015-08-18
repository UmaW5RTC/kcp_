<link href="css/main.css" type="text/css" rel="stylesheet"/>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','ospcbin_kumar','2crn#robin1','ospcbin_KCP');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ospcbin_KCP");
$sql="SELECT * FROM project_table WHERE s_no= '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table class='imagetable'>
<tr>
	<th>Project Code</th>
	<th>Project Name</th>
	<th>District</th>
	<th>Address</th>
	<th>Type</th>
	<th></th>
</tr>";
while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['project_code'] . "</td>";
	  echo "<td>" . $row['project_name'] . "</td>";
	  echo "<td>" . $row['district'] . "</td>";
	  echo "<td>" . $row['address'] . "</td>";	
	  $luser_type = $row['type'];

		echo "<td>";
	if($luser_type=='0'){
		echo "Mine";
	}
	if($luser_type=='1'){
		echo "Plant";
	}
	   echo "</td>";
  echo "<td><a href='project_edit_id.php?edit=".$row['s_no']."'><input type='button' value='Edit' /></td>";
  echo "</tr>";
echo "</table>";
}
mysqli_close($con);
?>
