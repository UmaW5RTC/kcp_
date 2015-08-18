<?php

// Inialize session
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
                    <a href="historical.php" title="Back to Historical View">Back to Historical View</a>
                </li>
        </ul>
     </div>
        <div id="body">

<?php
include ('conn.php');
$q  = mysql_real_escape_string(trim($_POST['q']));
$result_1 = mysql_query("select * from log_database where site_code='".$q."'");
$result = mysql_query("select * from log_database where site_code='".$q."'");
				
	/*include ('conn.php');
	$result_value = mysql_query("SELECT `parameter_id`,`threshold` FROM `parameter_table`");

			   while($row_value = mysql_fetch_assoc($result_value)){
							$parameter=''.$row_value['parameter_id'].'';
							$threshold=$row_value['threshold'];
						echo "<div style='border:1px solid #fff; width:5%;float:left; padding-top:5px; background:#CCC;'>
			   ".$threshold.
			   "</div>";*/
			   $row_value = mysql_fetch_assoc($result_1);
		$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row_value['channel_1_id']."'");
					while($rows = mysql_fetch_assoc($results)) {
		        $parameter_1=$rows["parameter_name"];
				$channel_1=$rows['threshold'];
					}
	$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row_value['channel_2_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_2=$rows["parameter_name"];
				$channel_2=$rows['threshold'];
		}                           
	$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row_value['channel_3_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_3=$rows["parameter_name"];
				$channel_3=$rows['threshold'];
		}
	$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row_value['channel_4_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_4=$rows["parameter_name"];
				$channel_4=$rows['threshold'];
		}                         
	$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row_value['channel_5_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_5=$rows["parameter_name"];
				$channel_5=$rows['threshold'];
		}
	$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row_value['channel_6_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_6=$rows["parameter_name"];
				$channel_6=$rows['threshold'];
		}	
			include ('conn.php');
				$result1 = mysql_query("SELECT * FROM `site_table` where site_code = '".$q."' ");
				while($rows = mysql_fetch_assoc($result1)) {
					 $site=$rows['site_name'];
						}						
			echo '<br/><center><table class="imagetable" id="forumtable" width="99%">
			<tr><th colspan="2">Threshold Value</th>
			<td>'.$channel_1.'</td>
			<td>'.$channel_2.'</td>
			<td>'.$channel_3.'</td>
			<td>'.$channel_4.'</td>
			<td>'.$channel_5.'</td>
			<td>'.$channel_6.'</td>
			</tr>		
			<tr><th colspan="2">Site Name</th>
			<td colspan="6">'.$site.'</td>
			</tr>
						 <tr>
                            <th>Date</th>
                            <th>Time</th>
							<th>'.$parameter_1.'</th>
							<th>'.$parameter_2.'</th>
							<th>'.$parameter_3.'</th>
							<th>'.$parameter_4.'</th>
							<th>'.$parameter_5.'</th>
							<th>'.$parameter_6.'</th></tr>';
		
			while($row = mysql_fetch_assoc($result)) {
							echo ("<tr><td>$row[date_stamp]</td>");
							echo ("<td>$row[time_stamp]</td>");
						$channel_1_value=$row['channel_1_value'];
						 $channel_2_value=$row['channel_2_value'];
						 $channel_3_value=$row['channel_3_value'];
						 $channel_4_value=$row['channel_4_value'];
						 $channel_5_value=$row['channel_5_value'];
						 $channel_6_value=$row['channel_6_value'];

							echo "<td>";
						if($channel_1>$channel_1_value && $channel_1>=$channel_1_value)
							echo '<p style=color:black;>';
							else if($channel_1<=$channel_1_value && $channel_1<= $channel_1_value)
							echo '<p style=color:red;>';
							echo $channel_1_value; 
							"</td>";
						echo "<td>";
						if($channel_2>$channel_2_value && $channel_2>=$channel_2_value)
							echo '<p style=color:black;>';
							else if($channel_2<=$channel_2_value && $channel_2<= $channel_2_value)
							echo '<p style=color:red;>';
							echo $channel_2_value; 
							"</td>";
							echo "<td>";
						if($channel_3>$channel_3_value && $channel_3>=$channel_3_value)
							echo '<p style=color:black;>';
							else if($channel_3<=$channel_3_value && $channel_3<= $channel_3_value)
							echo '<p style=color:red;>';
							echo $channel_3_value; 
							"</td>";
							echo "<td>";
						if($channel_4>$channel_4_value && $channel_4>=$channel_4_value)
							echo '<p style=color:black;>';
							else if($channel_4<=$channel_4_value && $channel_4<= $channel_4_value)
							echo '<p style=color:red;>';
							echo $channel_4_value; 
							"</td>";
							echo "<td>";
						if($channel_5>$channel_5_value && $channel_5>=$channel_5_value)
							echo '<p style=color:black;>';
							else if($channel_5<=$channel_5_value && $channel_5<= $channel_5_value)
							echo '<p style=color:red;>';
							echo $channel_5_value; 
							"</td>";
							echo "<td>";
						if($channel_6>$channel_6_value && $channel_6>=$channel_6_value)
							echo '<p style=color:black;>';
							else if($channel_6<=$channel_6_value && $channel_6<= $channel_6_value)
							echo '<p style=color:red;>';
							echo $channel_6_value; 
							"</td></tr></table></center>";	
										
			}
							/*
						if($var2>=$channel_2_value && $parameter=$row['channel_2_id'])
							echo '<p style=color:black;>';
							else if($var2<=$channel_2_value && $parameter=$row['channel_2_id'])
							echo '<p style=color:red;>';
							echo $channel_2_value; 
							"</td>";
							 $channel_3_value=$row['channel_3_value'];
							echo "<td>";
						if($var3>=$channel_3_value && $var_3=$row['channel_3_id'])
							echo '<p style=color:black;>';
							else if($var3<=$channel_3_value && $var_3=$row['channel_3_id'])
							echo '<p style=color:red;>';
							echo $channel_3_value; 
							"</td>";
							 $channel_4_value=$row['channel_4_value'];
							echo "<td>";
						if($var4>=$channel_4_value && $var_4=$row['channel_4_id'])
							echo '<p style=color:black;>';
							else if($var4<=$channel_4_value && $var_4= $row['channel_4_id'])
							echo '<p style=color:red;>';
							echo $channel_4_value; 
							"</td>";							
						     $channel_5_value=$row['channel_5_value'];
							echo "<td>";
						if($var5>=$channel_5_value && $var_5=$row['channel_5_id'])
							echo '<p style=color:black;>';
							else if($var5<=$channel_5_value && $var_5= $row['channel_5_id'])
							echo '<p style=color:red;>';
							echo $channel_5_value; 
							"</td>";							
							 $channel_6_value=$row['channel_6_value'];
							echo "<td>";
							if($var6>=$channel_6_value && $var_6=$row['channel_6_id'])
							echo '<p style=color:black;>';
							else if($var6<=$channel_6_value && $var_6= $row['channel_6_id'])
							echo '<p style=color:red;>';
							echo $channel_6_value; 
							"</td>";
							echo ("<td></td>");*/
			   
    
		
?>

    </body>
</html>