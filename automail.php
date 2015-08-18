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
                </li>
        </ul>
     </div>
        <div id="body">

<?php
include('conn.php');
$date= date("Y-m-d")  . "<br>";
$site_value = mysql_query("SELECT  distinct site_code from `log_database` where date_stamp = '".$date."'");
while($site_value_id = mysql_fetch_assoc($site_value)){
	$value = $site_value_id['site_code'];

//$values =implode(',',$value);
foreach(array($value) as $site_code_1)
{
}
	      $site_code_1 .'<br/>';
	if (!empty($site_code_1)){
  $sql1="SELECT b.date_stamp,b.time_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id,b.channel_5_id, b.channel_5_value, 
b.channel_6_id, b.channel_6_value,c.site_code, c.site_name, c.address, c.mobile, c.mobile2, c.email, 
c.email2, a.threshold, a.parameter_name
FROM log_database b
INNER JOIN 
parameter_table a 
ON 
a.parameter_id = b.channel_1_id AND a.threshold < b.channel_1_value OR 
a.parameter_id = b.channel_2_id AND a.threshold < b.channel_2_value OR
a.parameter_id = b.channel_3_id AND a.threshold < b.channel_3_value OR
a.parameter_id = b.channel_4_id AND a.threshold < b.channel_4_value OR
a.parameter_id = b.channel_5_id AND a.threshold < b.channel_5_value OR
a.parameter_id = b.channel_6_id AND a.threshold < b.channel_6_value 
JOIN 
site_table c 
ON
c.site_code = b.site_code
WHERE 

b.date_stamp = '".$date."' AND b.site_code  ='".$site_code_1."' group by b.time_stamp"; 
			//echo $sql1;
	$sql = mysql_query($sql1);
	/*$result = mysql_query($sql_2);
	/*$sql= mysql_query("SELECT * from log_database where date_stamp ='".$date."'  AND site_code in ('2','10') GROUP BY channel_1_id,channel_2_id,channel_3_id,channel_4_id,channel_5_id,channel_6_id");*/
	
	
/*select b.site_code,b.address,b.mobile,b.mobile2,b.channel_1,a.threshold from site_table b inner join parameter_table a on b.channel_1=a.parameter_id join log_database c on c.site_code=b.site_code where threshold > 9
*/
		$msg = '';
		$total = 0;
	  '<br/><center><table class="imagetable" id="forumtable" width="99%">';
			while($row_value = mysql_fetch_assoc($sql)){
				$site_test=$row_value['site_code'];
				$channel_1_value=$row_value['channel_1_value'];

				  $results = mysql_query("SELECT distinct parameter_name,threshold,parameter_id FROM `parameter_table` where parameter_id ='".$row_value['channel_1_id']."'");
					while($rows = mysql_fetch_assoc($results)) {
		        $parameter_1=$rows["parameter_name"];
				$channel_1=$rows['threshold'] ;
				
					}
	$results = mysql_query("SELECT distinct parameter_name,threshold,parameter_id FROM `parameter_table` where parameter_id ='".$row_value['channel_2_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_2=$rows["parameter_name"];
				$channel_2=$rows['threshold'];
		}                           
	$results = mysql_query("SELECT distinct parameter_name,threshold,parameter_id FROM `parameter_table` where parameter_id ='".$row_value['channel_3_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_3=$rows["parameter_name"];
				$channel_3=$rows['threshold'];
		}
	$results = mysql_query("SELECT distinct parameter_name,threshold,parameter_id FROM `parameter_table` where parameter_id ='".$row_value['channel_4_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_4=$rows["parameter_name"];
				$channel_4=$rows['threshold'];
		}                         
	$results = mysql_query("SELECT distinct parameter_name,threshold,parameter_id FROM `parameter_table` where parameter_id ='".$row_value['channel_5_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_5=$rows["parameter_name"];
				$channel_5=$rows['threshold'];
		}
	$results = mysql_query("SELECT distinct parameter_name,threshold,parameter_id FROM `parameter_table` where parameter_id ='".$row_value['channel_6_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        $parameter_6=$rows["parameter_name"];
				$channel_6=$rows['threshold'];
		}						   		
								$site= $row_value['site_name'];
								 $address= $row_value['address'];
								 $mobile=$row_value['mobile'];
								 $mobile2=$row_value['mobile2'];
								 $email=$row_value['email'];
								  $email2=$row_value['email2'];	
 '<tr><th colspan="2">Threshold Value</th>
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
							<th>'.$parameter_6.'</th>
							</tr>';
							 ("<tr><td>$row_value[date_stamp]</td>");
							 ("<td>$row_value[time_stamp]</td>");
						$date_stamp=$row_value['date_stamp'];
						 $time_stamp=$row_value['time_stamp'];	
						$channel_1_value=$row_value['channel_1_value'];
						 $channel_2_value=$row_value['channel_2_value'];
						 $channel_3_value=$row_value['channel_3_value'];
						 $channel_4_value=$row_value['channel_4_value'];
						 $channel_5_value=$row_value['channel_5_value'];
						 $channel_6_value=$row_value['channel_6_value'];

							 "<td>";
							if($channel_1>$channel_1_value && $channel_1>=$channel_1_value)
							  '<p style=color:black;>'.$channel_1_value.'</p>';
							else if($channel_1<=$channel_1_value && $channel_1<= $channel_1_value)
							  '<p style=color:red;>'.$channel_1_value.'</p>';
							  
							"</td>";
						 "<td>";
						if($channel_2>$channel_2_value && $channel_2>=$channel_2_value)
							 '<p style=color:black;>';
							else if($channel_2<=$channel_2_value && $channel_2<= $channel_2_value)
							 '<p style=color:red;>';
							 $channel_2_value; 
							"</td>";
						 "<td>";
						if($channel_3>$channel_3_value && $channel_3>=$channel_3_value)
							 '<p style=color:black;>';
							else if($channel_3<=$channel_3_value && $channel_3<= $channel_3_value)
							 '<p style=color:red;>';
							 $channel_3_value; 
							"</td>";
							 "<td>";
						if($channel_4>$channel_4_value && $channel_4>=$channel_4_value)
							 '<p style=color:black;>';
							else if($channel_4<=$channel_4_value && $channel_4<= $channel_4_value)
							 '<p style=color:red;>';
							 $channel_4_value; 
							"</td>";
							 "<td>";
						if($channel_5>$channel_5_value && $channel_5>=$channel_5_value)
							 '<p style=color:black;>';
							else if($channel_5<=$channel_5_value && $channel_5<= $channel_5_value)
							 '<p style=color:red;>';
							 $channel_5_value; 
							"</td>";
							 "<td>";
						if($channel_6>$channel_6_value && $channel_6>=$channel_6_value)
							 '<p style=color:black;>';
							else if($channel_6<=$channel_6_value && $channel_6<= $channel_6_value)
							 '<p style=color:red;>';
							 $channel_6_value; 
							"</td></tr></table></center>";	
										
			
						/* "<td>";
						if($channel_1>$channel_1_value && $channel_1 >= $channel_1_value)
							echo '<p style=color:black;>'. $channel_1_value .'</p>';
							else if($channel_1<=$channel_1_value && $channel_1<= $channel_1_value)
							echo '<p style=color:red;>'. $channel_1_value .'</p>'; 
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
							"</td></tr><br/></table></center>";	
							
							/*echo "SELECT * FROM `log_database` where site_code IN ('".$site_code."')";
							$results_1_1 = mysql_query("SELECT *  FROM `log_database` where site_code IN ('".$site_code."') and date_stamp = '".$date."'");
							while($rows= mysql_fetch_assoc($results_1_1)){					
							echo ("<tr><td>".$date=$rows['date_stamp']."</td>");
							echo ("<td>".$time_stamp=$rows['time_stamp']."</td>");
								$dates[]=$rows['date_stamp'];
								$times[]=$rows['time_stamp'];
								$channel_1_value=$rows['channel_1_value'];
								$channel_1_values[]=$rows['channel_1_value'];
								 $channel_2_value=$rows['channel_2_value'];
								$channel_2_values[]=$rows['channel_2_value'];
								 $channel_3_value=$rows['channel_3_value'];
								 $channel_3_values[]=$rows['channel_3_value'];
								 $channel_4_value=$rows['channel_4_value'];
								 $channel_4_values[]=$rows['channel_4_value'];
								 $channel_5_value=$rows['channel_5_value'];
								 $channel_5_values[]=$rows['channel_5_value'];
								 $channel_6_value=$rows['channel_6_value'];
								 $channel_6_values[]=$rows['channel_6_value'];
								 
						echo "<td>";
						if($channel_1>$channel_1_value && $channel_1 >= $channel_1_value)
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
							"</td></tr><br/></table></center>";	
							}*/
							if($channel_1>$channel_1_value){
							 $channel_1_msg =$channel_1_value;
					 }
							else if($channel_1 < $channel_1_value){
							 $channel_1_msg ='<p style="background:red;color:white;">'.$channel_1_value.'</p>';
							}

			
//2_va
					if($channel_2>$channel_2_value){
							 $channel_2_msg =$channel_2_value;
					 }
							else if($channel_2 < $channel_2_value){
							 $channel_2_msg ='<p style="background:red;color:white;">'.$channel_2_value.'</p>';
							}
//3
				if($channel_3>$channel_3_value){
							 $channel_3_msg =$channel_3_value;
					 }
							else if($channel_3 < $channel_3_value){
							 $channel_3_msg ='<p style="background:red;color:white;">' .$channel_3_value.'</p>';
							}
//4
					if($channel_4 > $channel_4_value){
							 $channel_4_msg =$channel_4_value;
					 }
							else if($channel_4 < $channel_4_value){
							 $channel_4_msg ='<p style="background:red;color:white;">' .$channel_4_value.'</p>';
							}
//5
				if($channel_5>$channel_5_value){
							 $channel_5_msg =$channel_5_value;
					 }
							else if($channel_5 < $channel_5_value){
							 $channel_5_msg ='<p style="background:red;color:white;">' .$channel_5_value.'</p>';
							}
//6
					if($channel_6 > $channel_6_value){
							 $channel_6_msg =$channel_6_value;
					 }
							else if($channel_6 < $channel_6_value){
							 $channel_6_msg ='<p style="background:red;color:white;">' .$channel_6_value.'</p>';
							}
							else{
								$channel_6_msg =$channel_6_value;
							}

								 									
		$msg .=  		
	"<h4><b>Threshold Value</b></h4>
	<table width='80%' border='1' style='font-family: verdana,arial,sans-serif;font-size:11px;
	color:#333333;border-width: 1px;border-color: #999999;border-collapse: collapse;margin-left:5px;margin-right:5px;
	margin-bottom:12px;'>
			<tr style='border:1px solid #333;'>
			<th colspan='2' style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>Threshold Value</th>
			<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_1."</td>
			<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_2."</td>
			<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_3."</td>
			<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_4."</td>
			<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_5."</td>
			<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_6."</td>
			</tr>	
			<tr>
			<th colspan='2' style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>Site Name</th>
			<td colspan='6' style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$site."</td>
			</tr>
			<tr>
			<th colspan='2' style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>Address</th>
			<td colspan='6' style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$address."</td>
			<tr>
			<tr>
			<th colspan='2' style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>Mobile</th>
			<td colspan='3' style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$mobile."</td>
			<td colspan='3' style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$mobile2."</td>
			</tr>						 
			
			<tr style='#b5cfd2'>
                            <th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>Date</th>
                            <th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>Time</th>
							<th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$parameter_1."</th>
							<th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$parameter_2."</th>
							<th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$parameter_3."</th>
							<th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$parameter_4."</th>
							<th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$parameter_5."</th>
							<th style='background:#b5cfd2;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$parameter_6."</th>
							</tr>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$date_stamp."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$time_stamp."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_1_msg."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_2_msg."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_3_msg."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_4_msg."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_5_msg."</td>
							<td style='background:#dcddc0;border-width: 1px;padding: 8px;border-style: solid;border-color: #999999;'>".$channel_6_msg."</td>
							</tr>
					</table>";	
				 $total = $total + 1; 
	// Make sure to escape quotes
			}
	 echo $to =$email;
	$subject = 'Threshold Value';
	$msg .= "Total: ".$total."\n";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: '.$email.'' . "\r\n";
	 $headers .= 'From: '.$email2.'' . "\r\n";	
	 mail($to, $subject, $msg, $headers);
	echo $msg;
	}
}
?>
                

    </body>
</html>