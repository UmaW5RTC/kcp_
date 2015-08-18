<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$dbuser = 'ospcbin_kumar';
$dbpass = '2crn#robin1';
$dbname = "ospcbin_KCP";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT s_no, site_code, channel_1_id FROM log_database";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
		 $channel_1_value = $row["channel_1_value"];
          "<br> s_no: ". $row["s_no"]. " - site_code: ". $row["site_code"]. " ".$row["channel_1_value"] . "<br>";
     echo $channel_1_value;

	 }
} else {
     echo "0 results";
}
$conn->close();
?>  

