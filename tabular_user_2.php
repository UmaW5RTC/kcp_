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
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","tabular_user_2_view.php?q="+str,true);
  xmlhttp.send();
}
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
                 <li >
                    <a href="user_type_2.php" title="Back to Graphics & Tabular & Historical Data & Export View">
                    Back to Graphics & Tabular & Historical Data & Export View
                    </a>
                 </li>
        </ul>
     </div>
        <div id="body"><br/>
        <div class="tabular">
        <center><?php
			include ('conn.php');
			$result = mysql_query("SELECT * FROM `site_table` where project_code=".$_SESSION["project_code"]."");
					echo '<font color="#039">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;Site Name</font>
					<select style="width:160px; height:29px; margin-left:5px;"  name="users" onchange="showUser(this.value)">';
					echo '<option value="">Select</option>';
				while($row = mysql_fetch_assoc($result)) {
					echo "<option value='".$row['site_code']."'>".$row['site_name']." </option>";
			}
					echo "</select>";
		?>
        </center>
<div id="txtHint">
         <table class="imagetable">
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
			$dbhost = 'localhost';
			$dbuser = 'ospcbin_kumar';
			$dbpass = '2crn#robin1';
			$rec_limit = 5;
			
			$conn = mysql_connect($dbhost, $dbuser, $dbpass);
			if(! $conn )
			{
			  die('Could not connect: ' . mysql_error());
			}
			mysql_select_db('ospcbin_KCP');
			/* Get total number of records */
			$sql = "SELECT count(s_no) FROM log_database ";
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
			  die('Could not get data: ' . mysql_error());
			}
			$row = mysql_fetch_array($retval, MYSQL_NUM );
			$rec_count = $row[0];
			
			if( isset($_GET{'page'} ) )
			{
			   $page = $_GET{'page'} + 1;
			   $offset = $rec_limit * $page ;
			}
			else
			{
			   $page = 0;
			   $offset = 0;
			}
			$left_rec = $rec_count - ($page * $rec_limit);
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
		where project_code='".$_SESSION["project_code"]."'
			 ORDER BY s_no 
	   DESC "."LIMIT $offset, $rec_limit";
			
			$retval = mysql_query( $sql, $conn );
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
			if( $page > 0 )
		{
		   $last = $page - 2;
		   echo "<a href=\"?page=$last\"><font style='text-align:end;'>Last 5 Records</font></a> |";
		   echo "<a href=\"?page=$page\"><font style='text-align:end;'>Next 5 Records</font></a>";
		}
		else if( $page == 0 )
		{
		   echo "<a href=\"?page=$page\"><font style='text-align:end;'>Next 5 Records</font></a>";
		}
		else if( $left_rec < $rec_limit )
		{
		   $last = $page - 2;
		   echo "<a href=\"$_PHP_SELF?page=$last\"><font style='text-align:end;'>Last 5 Records</font></a>";
		}
		mysql_close($conn);
?>
</font>
           </table>
           </div>
            </div>
        </div>
</div>    </div>
</body>
</html>
