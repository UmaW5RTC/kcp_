<?php
$con = mysql_connect("localhost","ospcbin_kumar","2crn#robin1");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("ospcbin_KCP", $con);

$sth = mysql_query("SELECT date_stamp FROM log_database");
$rows = array();
$rows['name'] = 'date_stamp';
while($r = mysql_fetch_array($sth)) {
    $rows['data'][] = $r['date_stamp'];
}

$sth = mysql_query("SELECT channel_1_output FROM log_database");
$rows1 = array();
$rows1['name'] = 'channel_1_output';
while($rr = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $rr['channel_1_output'];
}

$result = array();
array_push($result,$rows);
array_push($result,$rows1);

print json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
