<link href="css/main.css" type="text/css" rel="stylesheet"/>

<?php
		include('conn.php');
		$q = intval($_GET['q']);
		$results = mysql_query("SELECT COUNT(*) FROM `log_database` where site_code = '".$q."' ORDER BY s_no DESC ");
		$sql ="select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,b.channel_1_value, 
					  b.channel_2_id,b.channel_2_value, 
					  b.channel_3_id,b.channel_3_value,
					  b.channel_4_id,b.channel_4_value,
					  b.channel_5_id,b.channel_5_value,
					  b.channel_6_id,b.channel_6_value,a.project_code 
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where  b.site_code = '".$q."'  ORDER BY s_no DESC";
			$retval = mysql_query( $sql);
			if(! $retval )
			{
			  die('Could not get data: ' . mysql_error());
			}
				while($row=mysql_fetch_array($results))  
			{  
			echo "<div class='d' align='right'>Total Data:". $row['COUNT(*)'] . "</div>";  
			}  
			
echo '<table class="imagetable">
         <tr>
                <th>Site Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Channel1 ID</th>
                <th>Channel1 Value</th>
                <th>Channel2 ID</th>
                <th>Channel2 Value</th>
                <th>Channel3 ID</th>
                <th>Channel3 Value</th>
                <th>Channel4 ID</th>
                <th>Channel4 Value</th>
                <th>Channel5 ID</th>
                <th>Channel5 Value</th>
                <th>Channel6 ID</th>
                <th>Channel6 Value</th>
</tr>';

      while ($row=mysql_fetch_array($retval, MYSQL_ASSOC))
	  {
		 include ('conn.php');
				$result1 = mysql_query("SELECT * FROM `site_table` where site_code = '".$q."' ");
				while($rows = mysql_fetch_assoc($result1)) {
        echo ("<tr><td>$rows[site_name]</td>");
			}
		echo ("<td>$row[date_stamp]</td>");
        echo ("<td>$row[time_stamp]</td>");
		$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row['channel_1_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        echo ("<td>$rows[parameter_name]</td>");
		}
		echo ("<td>$row[channel_1_value]</td>");
		$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row['channel_2_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        echo ("<td>$rows[parameter_name]</td>");
		}
		echo ("<td>$row[channel_2_value]</td>");
		$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row['channel_3_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
		        echo ("<td>$rows[parameter_name]</td>");
		}
		echo ("<td>$row[channel_3_value]</td>");
				$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row['channel_4_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
				 echo "<td>" .$rows['parameter_name']."</td>";
			}
		echo ("<td>$row[channel_4_value]</td>");
				$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row['channel_5_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
				 echo "<td>" .$rows['parameter_name']."</td>";
			}
		echo ("<td>$row[channel_5_value]</td>");
				$results = mysql_query("SELECT * FROM `parameter_table` where parameter_id ='".$row['channel_6_id']."'");
		while($rows = mysql_fetch_assoc($results)) {
				 echo "<td>" .$rows['parameter_name']."</td>";
			}
		echo ("<td>$row[channel_6_value]</td>");
		echo ("<font style='text-align:end'>");
		    }
?>
