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
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
      $(function(){
            var pickerOpts = {
                dateFormat:"yy-mm-dd"
            };	
            $("#datepicker").datepicker(pickerOpts);
			            $("#datepicker1").datepicker(pickerOpts);

        });

  </script>
  <style>
#body .display_12
{
	width:39%;
	float:left;
	border:1px solid #fff;
}
#body .display_122
{
	width:60%;
	float:left;
	border:1px solid #fff;
	margin-top:72px;
}
#body .display_22
{
	width:100%;
	height:250px;
	border:1px solid #333;
	background:#FFF;
	overflow: auto;
	float:left;

}
</style>
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
     </div>
        <div id="body"><br/>
        <div class="display_123">
       <b> KCP Connect<sup><font color="#FF0000">+</font></sup><b><br/><br/>
        Option for Historical Data Analysis<br/><br/>
           &nbsp;&nbsp;&nbsp;&nbsp;
           <a  href="historical.php"> a. Back on Search Data(From-To)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a  href="historical.php"> b. Back on  Parameter(value > or < or = x)</a>
        </div><br/>
<div class="display_22" id="txtHint">
	<?php
		$con = mysql_connect("localhost",'ospcbin_kumar','2crn#robin1');
		if (!$con) {
				die('Could not connect: ' . mysql_error());
				}
				mysql_select_db("ospcbin_KCP", $con);
				//$location = mysql_real_escape_string(trim($_POST['location']));
				$location = mysql_real_escape_string(trim($_POST['parameter_name']));
				$location1 = mysql_real_escape_string(trim($_POST['equal']));
				$location2 = mysql_real_escape_string(trim($_POST['value']));
				$result = mysql_query("select b.site_code,b.date_stamp,b.time_stamp, 
				b.channel_1_id,b.channel_1_value, 
				b.channel_2_id,b.channel_2_value, 
				b.channel_3_id,b.channel_3_value,
				b.channel_4_id, b.channel_4_value,
				b.channel_5_id,b.channel_5_value, 
				b.channel_6_id,b.channel_6_value,a.project_code,
				c.parameter_name,c.parameter_id,c.threshold
				from 
				log_database b 
				inner join 
				site_table a 
				on
			b.site_code=a.site_code 
			Join
			 parameter_table c 
			on
			b.channel_1_id=c.parameter_id
			where
	 project_code='".$_SESSION["project_code"]."' AND parameter_id='".$location."' AND channel_1_value ".$location1." '".$location2."'
	 UNION
	 select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,
				b.channel_1_value, b.channel_2_id,b.channel_2_value, 
				b.channel_3_id,b.channel_3_value,
				b.channel_4_id, b.channel_4_value,b.channel_5_id,b.channel_5_value, 
			    b.channel_6_id,b.channel_6_value,a.project_code,
				c.parameter_name,c.parameter_id,c.threshold
				from 
				log_database b 
				inner join 
				site_table a 
				on
			b.site_code=a.site_code 
			Join parameter_table c 
				on
			b.channel_2_id=c.parameter_id
			where
	 project_code='".$_SESSION["project_code"]."' AND parameter_id='".$location."' AND channel_2_value ".$location1." '".$location2."'
	 	 UNION
	 select b.site_code,b.date_stamp,b.time_stamp, 
			 b.channel_1_id,b.channel_1_value,
			 b.channel_2_id,b.channel_2_value, 
			 b.channel_3_id,b.channel_3_value,
			 b.channel_4_id, b.channel_4_value,
			 b.channel_5_id,b.channel_5_value, 
			 b.channel_6_id,b.channel_6_value,a.project_code,
				c.parameter_name,c.parameter_id,c.threshold
				from 
				log_database b 
				inner join 
				site_table a 
				on
			b.site_code=a.site_code 
			Join parameter_table c 
				on
			b.channel_3_id=c.parameter_id
			where
	 project_code='".$_SESSION["project_code"]."' AND parameter_id='".$location."' AND channel_3_value ".$location1." '".$location2."'
	 	 UNION
	 select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,
				b.channel_1_value, b.channel_2_id,b.channel_2_value, 
				b.channel_3_id,b.channel_3_value,
				b.channel_4_id, b.channel_4_value,b.channel_5_id,b.channel_5_value, 
				b.channel_6_id,b.channel_6_value,a.project_code,
				c.parameter_name,c.parameter_id,c.threshold
				from 
				log_database b 
				inner join 
				site_table a 
				on
			b.site_code=a.site_code 
			Join parameter_table c 
				on
			b.channel_4_id=c.parameter_id
			where
	 project_code='".$_SESSION["project_code"]."' AND parameter_id='".$location."' AND channel_4_value ".$location1." '".$location2."'
	 	 UNION
	 select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,
				b.channel_1_value, b.channel_2_id,b.channel_2_value, 
				b.channel_3_id,b.channel_3_value,
				b.channel_4_id, b.channel_4_value,
				b.channel_5_id,b.channel_5_value, 
				b.channel_6_id,b.channel_6_value,a.project_code,
				c.parameter_name,c.parameter_id,c.threshold
				from 
				log_database b 
				inner join 
				site_table a 
				on
			b.site_code=a.site_code 
			Join parameter_table c 
				on
			b.channel_5_id=c.parameter_id
			where
	 project_code='".$_SESSION["project_code"]."' AND parameter_id='".$location."' AND channel_5_value ".$location1." '".$location2."'
	 	 UNION
	 select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,
				b.channel_1_value, b.channel_2_id,b.channel_2_value, 
				b.channel_3_id,b.channel_3_value,
				b.channel_4_id, b.channel_4_value,
				b.channel_5_id,b.channel_5_value, 
				b.channel_6_id,b.channel_6_value,a.project_code,
				c.parameter_name,c.parameter_id,c.threshold
				from 
				log_database b 
				inner join 
				site_table a 
				on
			b.site_code=a.site_code 
			Join parameter_table c 
				on
			b.channel_6_id=c.parameter_id
			where
	 project_code='".$_SESSION["project_code"]."' AND parameter_id='".$location."' AND channel_6_value ".$location1." '".$location2."'");
				echo '<table class="imagetable" id="forumtable">
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
					</tr>';
while($row = mysql_fetch_assoc($result)) {
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

				</div>
                </div>
         
            </div>   
        </div>
    </body>
</html>
<?php
?>
