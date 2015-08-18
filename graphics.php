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
<meta http-equiv="refresh" content="">
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
                    <a href="log_out.php" title="Home">Home</a>
                </li>
                 <li>
                    <a href="#">Project Master</a>
                        <ul>                    
                            <li>                   
                                <a href="project.php" title="Project Master">Project Master</a>
                            </li>
                            <li>
                                <a href="project_edit.php" title="Project Edit">Project Edit</a>
                            </li>
                            <li>
                                <a href="project_delete.php" title="Project Delete">Project Delete</a>
                            <li>
                        </ul>
                </li>
                 <li>
                     <a href="#">Site Master</a>
                        <ul>
                            <li>
                                <a href="site.php" title="Site Master">Site Maste</a>
                            </li>
                             <li>
                                <a href="site_edit.php" title="Site Edit">Site Edit</a>
                            </li>
                             <li>
                                <a href="site_delete.php" title="Site Delete">Site Delete</a>
                            </li>
                      </ul>
                </li>
                 <li>
                     <a href="#">Parameter Master</a>
                         <ul>
                             <li>
                                <a href="parameter.php" title="Parameter Master">Parameter Master</a>
                            </li>
                             <li>
                                <a href="parameter_edit.php" title="Parameter Edit">Parameter Edit</a>
                            </li>
                             <li>
                                <a href="parameter_delete.php" title="Parameter Delete">Parameter Delete</a>
                            </li>
                         </ul>
                </li>
                <li>
                    <a href="#">User Master</a>
                        <ul>
                            <li>
                                <a href="user.php" title="Add User">Add User</a>
                            </li>
                            <li>
                                <a href="user_edit.php" title="Edit User">Edit User</a>
                            </li>
                            <li>
                                <a href="user_delete.php" title="Delete User">Delete User</a>
                            </li>
                      </ul>
                </li>
                 <li >
                    <a href="tabular.php" title="Tabular View">Tabular View</a>
                </li>
                 <li >
                    <a href="graphics.php" title="Graphics View">Graphics View</a>
                </li>
        </ul>
     </div>
      <center>
        <br/> <form action="graphics_display.php" method="post">
            <?php 
				include ('conn.php');
						$result = mysql_query("SELECT DISTINCT site_code FROM `log_database`");
						echo 'Site Name<select name="site"  style="width:160px; height:29px; margin-left:5px;" required tabindex="1">';
						echo '<option value="">Select</option>';
				while($row = mysql_fetch_assoc($result)) {
						$site = $row['site_code'];
						$results = mysql_query("SELECT * FROM `site_table` where site_code ='".$site."'");
				while($rows = mysql_fetch_assoc($results)) {
						echo "<option value='".$rows['site_code']."'>".$rows['site_name']." </option>";
				}
			}
					echo "</select>&nbsp;&nbsp;&nbsp;";
			//paramater
				$result = mysql_query("SELECT * FROM `parameter_table`");
					echo 'Parameter Name<select name="channel" onchange="showUser(this.value)" style="width:160px; height:29px; margin-left:5px;" required tabindex="1">';
					echo '<option value="">Select</option>';
				while($row = mysql_fetch_assoc($result)) {
					echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
			}
					echo "</select>&nbsp;&nbsp;&nbsp;";
					echo '<input type="submit" value="submit">';
			?>
</form>

<?php
	
	/*		$dis="select * from `site_table` where channel_1='$user_id' or channel_2='$user_id' 
			or channel_3='$user_id' or channel_4='$user_id' or channel_5='$user_id' or channel_6='$user_id'";
			$retval = mysql_query($dis);
			echo $user_id ."<BR/>";
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		   echo $value=$row['site_code']."<BR/>";
	}
/*		   $result_1="select * from `log_database` where site_code=".$value."";
		   $retval1 = mysql_query($result_1);
		   echo $result_1;
			while($sq = mysql_fetch_array($retval1, MYSQL_ASSOC))
	{
		   echo $sq['channel_1_output'];
	}	

	 $con = mysql_connect("localhost","onl12769","diet%A4B5");
		if (!$con) {
				die('Could not connect: ' . mysql_error());
				}
				mysql_select_db("onl12769_KCP", $con);
			$sth = mysql_query("select * from log_database");

		/*
		---------------------------
		example data: Table (Chart)
		-------------------------
		
		$rows = array();
		//flag is not needed
		$flag = true;
		$table = array();
		$table['cols'] = array(
		
			// Labels for your chart, these represent the column titles
			// Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
			array('label' => 'time_stamp', 'type' => 'string'),
				array('label' => 'channel output 1', 'type' => 'number'),
				array('label' => 'channel output 2', 'type' => 'number'),
				array('label' => 'channel output 3', 'type' => 'number'),
				array('label' => 'channel output 4', 'type' => 'number'),
				array('label' => 'channel output 5', 'type' => 'number'),
				array('label' => 'channel output 6', 'type' => 'number'),
			

		);

		$rows = array();
		$data_array = array();
		while($r = mysql_fetch_assoc($sth)) {
			 $time_stamp=$r['time_stamp'];
			$temp = array();
			// the following line will be used to slice the Pie chart
			$temp[] = array('v' => (string)  $time_stamp); 
		
			// Values of each slice
			$temp[] = array('v'  => (real) $r['channel_1_output']);
			$temp[] = array('v'  => (real) $r['channel_2_output']);
			$temp[] = array('v'  => (real) $r['channel_3_output']);
			$temp[] = array('v'  => (real) $r['channel_4_output']);
			$temp[] = array('v'  => (real) $r['channel_5_output']);
			$temp[] = array('v'  => (real) $r['channel_6_output']);
			$rows[] = array('c' => $temp);
						// Values of each slice
			$temp[] = array('v'  => (real) $r['channel_1_value']);
			$temp[] = array('v'  => (real) $r['channel_2_value']);
			$temp[] = array('v'  => (real) $r['channel_3_value']);
			$temp[] = array('v'  => (real) $r['channel_4_value']);
			$temp[] = array('v'  => (real) $r['channel_5_value']);
			$temp[] = array('v'  => (real) $r['channel_6_value']);
			$rows[] = array('c' => $temp);

			
				// Values of each slice
		}
		
		$table['rows'] = $rows;
		$jsonTable = json_encode($table);
		//echo $jsonTable;
?>

    <!--Load the Ajax API-->
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">


    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);


    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?php echo $jsonTable?>);
      var options = {
           title: 'KCP Connect+',
          is3D: 'true',
          width: -0,
          height: -0
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
        </script>
    <!--this is the div that will hold the pie chart-->
    <div id="chart_div"></div>
 </div>
 */
 ?>
</div>
</body>
</html>
