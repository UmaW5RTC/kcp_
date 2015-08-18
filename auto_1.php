<?php
include('conn.php');
 $a= date("Y-m-d") . "<br>";
$sa="SELECT * FROM `log_database` WHERE date_stamp='".$a."'";
$result=mysql_query($sa);
while($row0 = mysql_fetch_array($result, MYSQL_ASSOC))
	{
echo $row0['date_stamp']."<br/>";
	}
$sql="select b.date_stamp,b.site_code,b.channel_1_id,c.site_code,c.address,c.mobile,c.mobile2,c.email,c.email2,a.threshold 
		from log_database b 
		inner join 
		parameter_table a 
			on 
		b.channel_1_id=a.parameter_id 
		join 
		site_table c
			on
		c.site_code=b.site_code
		where threshold > 100";
/*select b.site_code,b.address,b.mobile,b.mobile2,b.channel_1,a.threshold from site_table b inner join parameter_table a on b.channel_1=a.parameter_id join log_database c on c.site_code=b.site_code where threshold > 9
*/
 $retval = mysql_query( $sql);
	while($rows = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo  $rows['site_code'] ."<br/>";
		echo $rows['address']."<br/>";
		echo  $rows['mobile']."<br/>";
		echo $rows['mobile2']."<br/>";
		echo $rows['date_stamp'];
		echo $rows['email'];
		echo $rows['email2'];
	

	// multiple recipients
	$to  = $rows['email'];// note the comma
   $subject = "This is subject";
   $message = "This is simple text message.";
	}
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
	$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
	
	// Mail it
	$ssk=mail($to, $subject, $message, $headers);
	echo $ssk;
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