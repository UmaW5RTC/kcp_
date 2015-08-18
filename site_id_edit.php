<link href="css/main.css" type="text/css" rel="stylesheet"/>
<div style="height:150px;overflow:scroll;">
<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','ospcbin_kumar','2crn#robin1','ospcbin_KCP');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ospcbin_KCP");
$sql="SELECT * FROM site_table WHERE site_code = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table class='imagetable'>
<tr>
	<th>Project Code</th>
	<th>Site Code</th>
	<th>Site Name</th>
	<th>Address</th>
	<th>Channel 1</th>
	<th>Channel 2</th>
	<th>Channel 3</th>
	<th>Channel 4</th>
	<th>Channel 5</th>
	<th>Channel 6</th>
	<th>Authority Email</th>
	<th>Authority Mobile</th>
	<th>Manager Email</th>
	<th>Manager Mobile</th>
	<th></th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['project_code']."</td>";
  echo "<td>" .$row['site_code'] . "</td>";
  echo "<td>" . $row['site_name'] . "</td>";
  echo "<td>" . $row['address'] . "</td>";
  echo "<td>" . $row['channel_1'] . "</td>";
  echo "<td>" . $row['channel_2'] . "</td>";
  echo "<td>" . $row['channel_3'] . "</td>";
  echo "<td>" . $row['channel_4'] . "</td>";
  echo "<td>" . $row['channel_5'] . "</td>";
  echo "<td>" . $row['channel_6'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['mobile'] . "</td>";
  echo "<td>" . $row['email2'] . "</td>";
  echo "<td>" . $row['mobile2'] . "</td>";  
  echo "<td><a href='site_edit_id.php?edit=$row[site_code]'><input type='button' value='Edit' /></td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
