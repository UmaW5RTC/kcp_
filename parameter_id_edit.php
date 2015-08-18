<link href="css/main.css" type="text/css" rel="stylesheet"/>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','ospcbin_kumar','2crn#robin1','ospcbin_KCP');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ospcbin_KCP");
$sql="SELECT * FROM parameter_table WHERE s_no= '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table class='imagetable'>
<tr>
	<th>Parameter ID</th>
	<th>Parameter Name</th>
	<th>Range Mininum</th>
	<th>Range Maximum</th>
	<th>Multiplication Factor</th>
	<TH>Threshold</th>
	<th></th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['parameter_id'] . "</td>";
  echo "<td>" . $row['parameter_name'] . "</td>";
  echo "<td>" . $row['range_mininum'] . "</td>";
  echo "<td>" . $row['range_maximum'] . "</td>";
  echo "<td>" . $row['multiplication_factor'] . "</td>";
  echo "<td>" . $row['threshold'] . "</td>";
  echo "<td><a href='parameter_edit_id.php?edit=$row[s_no]'><input type='button' value='Edit' /></td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
