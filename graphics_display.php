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
                    <a href="graphics.php" title="Back to Graphics View">Back to Graphics View</a>
                </li>
        </ul>
     </div>
        <div id="body">

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
	}	*/	
	include('conn.php');
	$q = mysql_real_escape_string(trim($_POST['channel']));
	$site_graphic = mysql_real_escape_string(trim($_POST['site']));
	//$q = intval($_GET['q']);
		
		// The Chart table 
			$sth = mysql_query("		
		select b.site_code,b.time_stamp,b.channel_1_id,b.channel_1_value,a.project_code 
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where  b.site_code='".$site_graphic."' AND  channel_1_id='".$q."'
        UNION
	select b.site_code,b.time_stamp,b.channel_2_id,b.channel_2_value,a.project_code  
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where b.site_code='".$site_graphic."' AND    channel_2_id='".$q."'
		  UNION
	select b.site_code,b.time_stamp,b.channel_3_id,b.channel_3_value,a.project_code  
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where b.site_code='".$site_graphic."' AND  channel_3_id='".$q."'
		  UNION
	select b.site_code,b.time_stamp,b.channel_4_id,b.channel_4_value,a.project_code  
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where b.site_code='".$site_graphic."' AND channel_4_id='".$q."'
		  UNION
	select b.site_code,b.time_stamp,b.channel_5_id,b.channel_5_value,a.project_code  
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where b.site_code='".$site_graphic."' AND channel_5_id='".$q."'
		  UNION
	select b.site_code,b.time_stamp,b.channel_6_id,b.channel_6_value,a.project_code  
					  from 
		log_database b 
		           inner join 
	    site_table a 
		           on 
	    b.site_code=a.site_code 
		where b.site_code='".$site_graphic."' AND channel_6_id='".$q."'");

		/*
		---------------------------
		example data: Table (Chart)
		-------------------------
		*/
		$rows = array();
		//flag is not needed
		$flag = true;
		$table = array();
		$table['cols'] = array(
		
			// Labels for your chart, these represent the column titles
			// Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
			array('label' => 'time_stamp', 'type' => 'string'),
				array('label' => 'channel output', 'type' => 'number'),
			

		);

		$rows = array();
		while($r = mysql_fetch_assoc($sth)) {
			 $channel_1_id=$r['channel_1_id'] ."<br/>";
			 $channel_1_value=$r['channel_1_value']."<br/>";
			 //$channel_1_output=$r['channel_1_output']."<br/>";
			 $time_stamp=$r['time_stamp'];
			$temp = array();
			// the following line will be used to slice the Pie chart
			$temp[] = array('v' => (string)  $time_stamp); 
		
			// Values of each slice
			$temp[] = array('v'  => (real) $r['channel_1_value']); 
			$rows[] = array('c' => $temp);
			
				// Values of each slice
		}
		
		$table['rows'] = $rows;
		$jsonTable = json_encode($table);
		 $jsonTable;
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
</div>
</body>
</html>
<?php
/*
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        $.getJSON("t.php", function(json) {
        
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    type: 'line',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: 'Revenue vs. Overhead',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Amount'
						                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: json
            });
        });
    
    });
    
});
        </script>
    </head>
    <body>
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
*/?>
    </body>
</html>