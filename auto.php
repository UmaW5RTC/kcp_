<?php
include('conn.php');
 $date= "2015-03-31" . "<br>";
 
$sql="SELECT b.date_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
		b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id,b.channel_5_id, b.channel_5_value, 
		b.channel_6_id, b.channel_6_value,c.site_code, c.site_name, c.address, c.mobile, c.mobile2, c.email, 
		c.email2, a.threshold, a.parameter_name
	FROM log_database b
	INNER JOIN 
		parameter_table a 
	ON 
		b.channel_1_id = a.parameter_id
	JOIN 
	site_table c 
	ON
		 c.site_code = b.site_code
	WHERE 
		a.threshold < b.channel_1_value
	AND 
		b.date_stamp =  '".$date."'
union
	SELECT b.date_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
	b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id,b.channel_5_value, b.channel_5_id,
	b.channel_6_value, b.channel_6_id, c.site_code, c.site_name, c.address,c.mobile, c.mobile2, c.email, 
	c.email2, a.threshold, a.parameter_name
	FROM 
	log_database b
	INNER JOIN 
	parameter_table a 
	ON
	b.channel_2_id = a.parameter_id
	JOIN 
	site_table c 
	ON 
	c.site_code = b.site_code
	WHERE 
	a.threshold < b.channel_2_value
	AND 
	b.date_stamp =  '".$date."'
union
	SELECT b.date_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
		b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id,b.channel_5_value, b.channel_5_id,
		b.channel_6_value, b.channel_6_id,c.site_code, c.site_name, c.address, c.mobile, c.mobile2, c.email, 
		c.email2, a.threshold, a.parameter_name
	FROM 
		log_database b
	INNER JOIN 
		parameter_table a 
	ON
		b.channel_3_id = a.parameter_id
	JOIN 
		site_table c 
	ON 
		c.site_code = b.site_code
	WHERE
	a.threshold < b.channel_3_value
	AND b.date_stamp =  '".$date."'
union
	SELECT b.date_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
		b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id, b.channel_5_value, b.channel_5_id, 
		b.channel_6_value, b.channel_6_id, c.site_code, c.site_name, c.address, c.mobile, c.mobile2, c.email,
	c.email2, a.threshold, a.parameter_name
	FROM 
	log_database b
	INNER JOIN 
	parameter_table a 
	ON
	b.channel_4_id = a.parameter_id
	JOIN 
	site_table c 
	ON 
	c.site_code = b.site_code
	WHERE
	a.threshold < b.channel_4_value
	AND b.date_stamp ='".$date."'
	union
	SELECT b.date_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
		b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id, b.channel_5_value, b.channel_5_id, 
		b.channel_6_value, b.channel_6_id, c.site_code, c.site_name, c.address, c.mobile, c.mobile2, c.email,
	c.email2, a.threshold, a.parameter_name
	FROM 
	log_database b
	INNER JOIN 
	parameter_table a 
	ON
	b.channel_5_id = a.parameter_id
	JOIN 
	site_table c 
	ON 
	c.site_code = b.site_code
	WHERE
	a.threshold < b.channel_5_value
	AND b.date_stamp ='".$date."'
	union
	SELECT b.date_stamp, b.site_code, b.channel_1_id, b.channel_1_value, b.channel_2_value, b.channel_2_id, 
		b.channel_3_value, b.channel_3_id, b.channel_4_value, b.channel_4_id, b.channel_5_value, b.channel_5_id, 
		b.channel_6_value, b.channel_6_id, c.site_code, c.site_name, c.address, c.mobile, c.mobile2, c.email,
	c.email2, a.threshold, a.parameter_name
	FROM 
	log_database b
	INNER JOIN 
	parameter_table a 
	ON
	b.channel_6_id = a.parameter_id
	JOIN 
	site_table c 
	ON 
	c.site_code = b.site_code
	WHERE
	a.threshold < b.channel_6_value
	AND b.date_stamp ='".$date."' GROUP BY channel_6_id;";
			
/*select b.site_code,b.address,b.mobile,b.mobile2,b.channel_1,a.threshold from site_table b inner join parameter_table a on b.channel_1=a.parameter_id join log_database c on c.site_code=b.site_code where threshold > 9
*/
 $retval = mysql_query($sql);
 $recipients = array();
	while($rows = mysql_fetch_assoc($retval))
	{
		 $recipients[] = $row['email'];
		$site_code= $rows['site_code'] ."<br/>";
		$site_name= $rows['site_name'] ."<br/>";
		$address= $rows['address']."<br/>";
		$mobile=$rows['mobile']."<br/>";
		$mobile2=$rows['mobile2']."<br/>";
		$date_stamp=$rows['date_stamp'];
		$email=$rows['email'];
		$email2=$rows['email2'];
	 	$channel_1_id=$rows['channel_1_id'];
		$channel_2_id=$rows['channel_2_id'];
		$channel_3_id=$rows['channel_3_id'];
		$channel_4_id=$rows['channel_4_id'];
		$channel_5_id=$rows['channel_5_id'];
		$channel_6_id=$rows['channel_6_id'];
		$channel_1_value=$rows['channel_1_value'];
		$parameter_1 = $rows['parameter_name'];
		$parameter_2 = $rows['parameter_name'];
		$parameter_3 = $rows['parameter_name'];
		$parameter_4 = $rows['parameter_name'];
		$parameter_5 = $rows['parameter_name'];
		$parameter_6 = $rows['parameter_name'];
		$channel_2_value=$rows['channel_2_value'];
		$channel_3_value=$rows['channel_3_value'];
		$channel_4_value=$rows['channel_4_value'];
		$channel_5_value=$rows['channel_5_value'];
		$channel_6_value=$rows['channel_6_value'];
		echo $parameter_1;
		echo $parameter_2;
		echo $threshold;
		echo $threshold_2;
	///Send Mail
	echo $rows['site_code'] ."<br/>";
	$to = $email;
	$subject = 'Threshold Value';
			
///email			
		$msg =  
	"<h4><b>Threshold Value".$threshold.$threshold_2."</b></h4>
				
			   <table border='1'>
					<tr>
						<th style='background:beige;'>Site Name</th>
						<th style='background:beige;'>Address</th>
					</tr>
					<tr>
						<td style='border:1px solid #333;'>".$site_name."</td>
						<td>".$address."</td>
					</tr>
					<tr>
						<th style='background:beige;'>Mobile</th>
						<th style='background:beige;'>Mobile2</th>
					</tr>
					<tr>
						<td>".$mobile."</td>
						<td>".$mobile2."</td>
					</tr>
					<tr>
						<th style='background:beige;'>".$channel_1_id."</th>
						<th style='background:beige;'>".$channel_2_id."</th>
					</tr>
					<tr>
							<td>".$channel_1_value."</td>
							<td>".$channel_2_value."</td>
					</tr>
					<tr>
						<th style='background:beige;'>".$channel_3_id."</th>
						<th style='background:beige;'>".$channel_4_id."</th>
					</tr>
					<tr>
							<td>".$channel_3_value."</td>
							<td>".$channel_4_value."</td>
					</tr>
					<tr>
						<th style='background:beige;'>".$channel_5_id."</th>
						<th style='background:beige;'>".$channel_6_id."</th>
					</tr>
					<tr>
							<td>".$channel_5_value."</td>
							<td>".$channel_6_value."</td>
					</tr>
			</table>
		
			".$channel_6_value."";
			
	// Make sure to escape quotes
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'To: '.$email.'' . "\r\n";
	$headers .= 'From: '.$email2.'' . "\r\n";
	$headers .= 'BCC: ' . implode(', ', $recipients) . "\r\n";
mail($to, $subject, $msg, $headers);
}
/*$sql1="select  c.date_stamp,b.site_code,b.address,b.mobile,b.mobile2,b.channel_2,a.threshold 
from site_table b 
inner join 
parameter_table a 
on 
b.channel_2=a.parameter_id 
join log_database c
on
c.site_code=b.site_code
where threshold > 9";
 $retval1 = mysql_query( $sql1);
	while($row = mysql_fetch_array($retval1, MYSQL_ASSOC))
	{
		echo  $row['site_code'] ."<br/>";
		echo $row['address']."<br/>";
		echo  $row['mobile']."<br/>";
		echo $row['mobile2']."<br/>";
		echo $row['channel_2'] ."<br/>";
	}
	$sql3="select b.site_code,b.address,b.mobile,b.mobile2,b.channel_3,c.data_stamp,a.threshold 
from site_table b 
inner join 
parameter_table a 
on 
b.channel_3=a.parameter_id 
join log_database c
on
c.site_code=b.site_code
where threshold > 9";
 $retval3 = mysql_query( $sql3);
	while($row = mysql_fetch_array($retval3, MYSQL_ASSOC))
	{
		echo  $row['site_code'] ."<br/>";
		echo $row['address']."<br/>";
		echo  $row['mobile']."<br/>";
		echo $row['mobile2']."<br/>";
		echo $row['channel_3']."<br/>";
		
	}
$sql4="select b.site_code,b.address,b.mobile,b.mobile2,b.channel_4,c.data_stamp,a.threshold 
from site_table b 
inner join 
parameter_table a 
on 
b.channel_4=a.parameter_id 
join log_database c
on
c.site_code=b.site_code
where threshold > 9";
 $retval4 = mysql_query( $sql4);
	while($row = mysql_fetch_array($retval4, MYSQL_ASSOC))
	{
		echo  $row['site_code'] ."<br/>";
		echo $row['address']."<br/>";
		echo  $row['mobile']."<br/>";
		echo $row['mobile2']."<br/>";
		echo $row['channel_4']."<br/>";
		
	}
$sql5="select b.site_code,b.address,b.mobile,b.mobile2,b.channel_5,c.data_stamp,a.threshold 
from site_table b 
inner join 
parameter_table a 
on 
b.channel_5=a.parameter_id 
join log_database c
on
c.site_code=b.site_code
where threshold > 9";
 $retval5 = mysql_query( $sql5);
	while($row = mysql_fetch_array($retval5, MYSQL_ASSOC))
	{
		echo  $row['site_code'] ."<br/>";
		echo $row['address']."<br/>";
		echo  $row['mobile']."<br/>";
		echo $row['mobile2']."<br/>";
		echo $row['channel_5']."<br/>";
		
	}
$sql="select b.site_code,b.address,b.mobile,b.mobile2,b.channel_6,c.data_stamp,a.threshold 
from site_table b 
inner join 
parameter_table a 
on 
b.channel_6=a.parameter_id 
join log_database c
on
c.site_code=b.site_code
where threshold > 9";
 $retval = mysql_query( $sql);
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo  $row['site_code'] ."<br/>";
		echo $row['address']."<br/>";
		echo  $row['mobile']."<br/>";
		echo $row['mobile2']."<br/>";
		echo $row['channel_6']."<br/>";
	}
*/
	?>
	</body>
    </head>
    </html>