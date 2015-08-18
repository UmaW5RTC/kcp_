<?PHP

$received_value = $_GET["lval"];

//Add data base connectivity
$server_name = "localhost";
$user_name = "ospcbin_kumar";         //User Name
$passwd = "2crn#robin1";			 //Password
$database_name = "ospcbin_KCP";   //Database Name

$dbhandle = mysql_connect($server_name, $user_name, $passwd)
  or die("Couldn't connect to SQL Server on $server_name");


$selected = mysql_select_db($database_name, $dbhandle)
  or die("Couldn't open database $myDB"); 
	list($aut,$site_id, $date, $time_0,$time_1,$time_2,
	 $channel_1_id,$channel_1_value,
	 $channel_2_id,$channel_2_value,
	 $channel_3_id,$channel_3_value, 
	 $channel_4_id,$channel_4_value,
	$channel_5_id,$channel_5_value,
	$channel_6_id,$channel_6_value) = explode(":",$received_value);
		
	$time_3 =($time_0.$time_1.$time_2);
	echo $time_0 . '<br/>';
	echo $time_1 . '<br/>';
	echo $time_2 . '<br/>';
	echo $time_3;
	$aut;
	if($aut=='9GeRYldBoLrfAIOU'){
	$sql_insert = "INSERT INTO `log_database` (site_code,date_stamp,time_stamp,
											 channel_1_id,channel_1_value,
											channel_2_id,channel_2_value,
											channel_3_id,channel_3_value,
											channel_4_id,channel_4_value,
											channel_5_id,channel_5_value,
											channel_6_id,channel_6_value)
 VALUES ('$site_id', '$date', '$time_3', 
		 '$channel_1_id', '$channel_1_value',
		  '$channel_2_id', '$channel_2_value',
		  '$channel_3_id','$channel_3_value',
		 '$channel_4_id','$channel_4_value',
		  '$channel_5_id','$channel_5_value',
			  '$channel_6_id','$channel_6_value')";
  $result_sql_insert = mysql_query($sql_insert);

echo $sql_insert;
	}
	else{
		echo "sorry";
	}
//Site Table
	/*$sql = 'SELECT * FROM `site_table` where site_code="'.$site_id.'"';
	$retval = mysql_query( $sql);
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo $channel_1_id = $row['channel_1'];
		$channel_2_id = $row['channel_2'];
		$channel_3_id = $row['channel_3'];
		$channel_4_id = $row['channel_4'];
		$channel_5_id = $row['channel_5'];
		$channel_6_id = $row['channel_6'];
	}
//////////////////
//Parmater Table CHANEEL 1
	$sql1 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_1_id.'"';
	
	$sql1;
	$retval1 = mysql_query( $sql1);
	while($rows = mysql_fetch_array($retval1, MYSQL_ASSOC))
	{
		$range_mininum_1= $rows['range_mininum'];
		$range_maximum_1= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 2
	$sql2 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_2_id.'"';
	
	$sql2;
	$retval2 = mysql_query( $sql2);
	while($rows = mysql_fetch_array($retval2, MYSQL_ASSOC))
	{
		$range_mininum_2= $rows['range_mininum'];
		$range_maximum_2= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 3
	$sql3 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_3_id.'"';
	
	$sql3;
	$retval3 = mysql_query( $sql3);
	while($rows = mysql_fetch_array($retval3, MYSQL_ASSOC))
	{
		$range_mininum_3= $rows['range_mininum'];
		$range_maximum_3= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 4
	$sql4 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_4_id.'"';
	$sql4;
	$retval4 = mysql_query( $sql4);
	while($rows = mysql_fetch_array($retval4, MYSQL_ASSOC))
	{
		 $range_mininum_4= $rows['range_mininum'];
		 $range_maximum_4= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 5
	$sql5 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_5_id.'"';
	$sql5;
	$retval5 = mysql_query( $sql5);
	while($rows = mysql_fetch_array($retval5, MYSQL_ASSOC))
	{
		 $range_mininum_5= $rows['range_mininum'];
		 $range_maximum_5= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 6
	$sql6 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_6_id.'"';
	
 	$sql6;
	$retval6 = mysql_query( $sql6);
	while($rows = mysql_fetch_array($retval6, MYSQL_ASSOC))
	{
		$range_mininum_6= $rows['range_mininum'];
		$range_maximum_6= $rows['range_maximum'];
	
	}
//////////////////////////////

/////Channel Output
	$time_3 =($time.$time_1.$time_2);
	/*$channel_1_output_2 =($channel_1_value*(($range_mininum_1-$range_maximum_1)/(-16)))-4*(($range_mininum_1-$range_maximum_1)
	/(-16));
	$channel_2_output_2 =($channel_2_value*(($range_mininum_2-$range_maximum_2)/(-16)))-4*(($range_mininum_2-$range_maximum_2)/(-16));
	$channel_3_output_2 =($channel_3_value*(($range_mininum_3-$range_maximum_3)/(-16)))-4*(($range_mininum_3-$range_maximum_3)/(-16));
	$channel_4_output_2 =($channel_4_value*(($range_mininum_4-$range_maximum_4)/(-16)))-4*(($range_mininum_4-$range_maximum_4)/(-16));
	$channel_5_output_2 =($channel_5_value*(($range_mininum_5-$range_maximum_5)/(-16)))-4*(($range_mininum_5-$range_maximum_5)/(-16));
	$channel_6_output_2 =($channel_6_value*(($range_mininum_6-$range_maximum_6)/(-16)))-4*(($range_mininum_6-$range_maximum_6)/(-16));
///////////////
		echo $site_id;
		echo $date;

		echo $time_3;
		echo $time_1;
		echo $time_2;
		echo $channel_1_id;
		echo $channel_1_value;
		echo $channel_1_output_2;
		echo $channel_2_id;
		echo $channel_2_value;
		echo $channel_2_output_2;
		echo $channel_3_id;
		echo $channel_3_value;
		echo $channel_3_output_2;
		echo $channel_4_id;
		echo $channel_4_value;
		echo $channel_4_output_2;
		echo $channel_5_id;
		echo $channel_5_value;
		echo $channel_5_output_2;
		echo $channel_6_id;
		echo $channel_6_value;
		echo $channel_6_output_2;
		*/










/*$received_value = $_GET["lval"];

//Add data base connectivity
$server_name = "localhost";
$user_name = "root";         //User Name
$passwd = "";			 //Password
$database_name = "kcp";   //Database Name

$dbhandle = mysql_connect($server_name, $user_name, $passwd)
  or die("Couldn't connect to SQL Server on $server_name");


$selected = mysql_select_db($database_name, $dbhandle)
  or die("Couldn't open database $myDB"); 
	list($site_id, $date, $time,$time_1,$time_2,
	 $channel_1_value,$channel_2_value,$channel_3_value, $channel_4_value,
	$channel_5_value,
	$channel_6_value) = explode(":",$received_value);
//Site Table
	$sql = 'SELECT * FROM `site_table` where site_code="'.$site_id.'"';
	$retval = mysql_query( $sql);
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo $channel_1_id = $row['channel_1'];
		$channel_2_id = $row['channel_2'];
		$channel_3_id = $row['channel_3'];
		$channel_4_id = $row['channel_4'];
		$channel_5_id = $row['channel_5'];
		$channel_6_id = $row['channel_6'];
}
		echo "<td>";
//////////////////
//Parmater Table CHANEEL 1
	$sql1 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_1_id.'"';
	
	$sql1;
	$retval1 = mysql_query( $sql1);
	while($rows = mysql_fetch_array($retval1, MYSQL_ASSOC))
	{
		$range_mininum_1= $rows['range_mininum'];
		$range_maximum_1= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 2
	$sql2 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_2_id.'"';
	
	$sql2;
	$retval2 = mysql_query( $sql2);
	while($rows = mysql_fetch_array($retval2, MYSQL_ASSOC))
	{
		$range_mininum_2= $rows['range_mininum'];
		$range_maximum_2= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 3
	$sql3 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_3_id.'"';
	
	$sql3;
	$retval3 = mysql_query( $sql3);
	while($rows = mysql_fetch_array($retval3, MYSQL_ASSOC))
	{
		$range_mininum_3= $rows['range_mininum'];
		$range_maximum_3= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 4
	$sql4 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_4_id.'"';
	$sql4;
	$retval4 = mysql_query( $sql4);
	while($rows = mysql_fetch_array($retval4, MYSQL_ASSOC))
	{
		 $range_mininum_4= $rows['range_mininum'];
		 $range_maximum_4= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 5
	$sql5 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_5_id.'"';
	$sql5;
	$retval5 = mysql_query( $sql5);
	while($rows = mysql_fetch_array($retval5, MYSQL_ASSOC))
	{
		 $range_mininum_5= $rows['range_mininum'];
		 $range_maximum_5= $rows['range_maximum'];
	
	}
//////////////////////////////
//Parmater Table CHANEEL 6
	$sql6 = 'SELECT * FROM `parameter_table` where parameter_id="'.$channel_6_id.'"';
	
 	$sql6;
	$retval6 = mysql_query( $sql6);
	while($rows = mysql_fetch_array($retval6, MYSQL_ASSOC))
	{
		$range_mininum_6= $rows['range_mininum'];
		$range_maximum_6= $rows['range_maximum'];
	
	}
//////////////////////////////

/////Channel Output
	$time_3 =($time.$time_1.$time_2);
	$channel_1_output_2 =($channel_1_value*(($range_mininum_1-$range_maximum_1)/(-16)))-4*(($range_mininum_1-$range_maximum_1)
	/(-16));
	$channel_2_output_2 =($channel_2_value*(($range_mininum_2-$range_maximum_2)/(-16)))-4*(($range_mininum_2-$range_maximum_2)/(-16));
	$channel_3_output_2 =($channel_3_value*(($range_mininum_3-$range_maximum_3)/(-16)))-4*(($range_mininum_3-$range_maximum_3)/(-16));
	$channel_4_output_2 =($channel_4_value*(($range_mininum_4-$range_maximum_4)/(-16)))-4*(($range_mininum_4-$range_maximum_4)/(-16));
	$channel_5_output_2 =($channel_5_value*(($range_mininum_5-$range_maximum_5)/(-16)))-4*(($range_mininum_5-$range_maximum_5)/(-16));
	$channel_6_output_2 =($channel_6_value*(($range_mininum_6-$range_maximum_6)/(-16)))-4*(($range_mininum_6-$range_maximum_6)/(-16));
///////////////
		echo $site_id;
		echo $date;
		echo $time_3;
		echo $time_1;
		echo $time_2;
		echo $channel_1_id;
		echo $channel_1_value;
		echo $channel_1_output_2;
		echo $channel_2_id;
		echo $channel_2_value;
		echo $channel_2_output_2;
		echo $channel_3_id;
		echo $channel_3_value;
		echo $channel_3_output_2;
		echo $channel_4_id;
		echo $channel_4_value;
		echo $channel_4_output_2;
		echo $channel_5_id;
		echo $channel_5_value;
		echo $channel_5_output_2;
		echo $channel_6_id;
		echo $channel_6_value;
		echo $channel_6_output_2;
 $sql_insert = "INSERT INTO `log_database` (s_no,site_code,date_stamp,time_stamp,
											 channel_1_id,channel_1_value,channel_1_output,
											channel_2_id,channel_2_value,channel_2_output,
											channel_3_id,channel_3_value,channel_3_output,
											channel_4_id,channel_4_value,channel_4_output,
											channel_5_id,channel_5_value,channel_5_output,
											channel_6_id,channel_6_value,channel_6_output)
 VALUES ('$site_id', '$date', '$time_3', 
		 '$channel_1_id', '$channel_1_value', '$channel_1_output_2',
		  '$channel_2_id', '$channel_2_value','$channel_2_output_2',
		  '$channel_3_id','$channel_3_value','$channel_3_output_2',
		 '$channel_4_id','$channel_4_value','$channel_4_output_2',
		  '$channel_5_id','$channel_5_value','$channel_5_output_2',
			  '$channel_6_id','$channel_6_value','$channel_6_output_2')";
  $result_sql_insert = mysql_query($sql_insert);

echo $sql_insert;


*/
?>

