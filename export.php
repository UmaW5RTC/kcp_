<?php
// Inialize session
	ob_start();
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
		<center><script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.js">            </script>
<script type="text/javascript">
$(function(){
    $('button').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#tableWrap').html()) 
        location.href=url
        return false
    })
})
</script>

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
                    <a href="user_type_2.php" title="Back to Graphics & Tabular & Historical Data & Export View">
                    Back to Graphics & Tabular & Historical Data & Export View
                    </a>
                </li>
        </ul>
     </div><br/>
     <center><b>User Type 2</b></center>
        <div id="body"><br/>
           	<button> Get as Excel</button>
         <div id="tableWrap">
			        <div class="display">
         <table class="imagetable" border="1" hidden="">
         <tr>
                <th>Site Code</th>
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
            </tr>
<?php
			include('conn.php');
			/* Get total number of records */			
			$sql = "select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,b.channel_1_value, 
					 b.channel_2_id,b.channel_2_value,b.channel_3_id,b.channel_3_value,b.channel_4_id,b.channel_4_value,
					 b.channel_5_id,b.channel_5_value,b.channel_6_id,b.channel_6_value,a.project_code 
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where project_code='".$_SESSION["project_code"]."' ORDER BY s_no DESC ";			
			$retval = mysql_query( $sql);
			if(! $retval )
			{
			  die('Could not get data: ' . mysql_error());
			}
      while ($row=mysql_fetch_array($retval, MYSQL_ASSOC))
	  {
		$site = $row['site_code'];
		 include ('conn.php');
				$result1 = mysql_query("SELECT * FROM `site_table` where site_code = '".$site."' ");
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
</font>
         </div>
        </div>

    </div>
</body>
</html>