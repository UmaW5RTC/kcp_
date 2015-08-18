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
  xmlhttp.open("GET","search1.php?q="+str,true);
  xmlhttp.send();
}
</script>
<style>
#body .display_12
{
	width:28%;
	float:left;
	border:1px solid #fff;
}
#body .display_122
{
	width:42%;
	float:left;
	border:1px solid #fff;
	margin-top:72px;
}
#body .display_123
{
	width:26%;
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
        <div class="display_12">
       <b> KCP Connect<sup><font color="#FF0000">+</font></sup><b><br/><br/>
        Option for Historical Data Analysis<br/><br/>
       <form action="search1.php" method="post">
        a. From <input type="text" size="10" id="datepicker" name="date">
        To  <input type="text" size="10" id="datepicker1" name="date1">
            <input type="submit" name="submit" value="submit"/></form></div>
            <div class="display_122">
            <form action="search.php" method="post">
       b.<?php 
			include ('conn.php');
			$result = mysql_query("SELECT * FROM `parameter_table`");
				echo 'Paramater Names<select name="parameter_name" style="width:130px; height:29px;
				 margin-left:5px;" tabindex="2">';
				echo '<option value="">Select</option>';
			while($row = mysql_fetch_assoc($result)) {
				echo "<option value='".$row['parameter_id']."'>".$row['parameter_name']." </option>";
				}
			echo "</select>";
		?>
       <select name="equal" style="width:100px; height:29px; margin-left:5px;">
           <option value="=">=</option>
           <option value=">">></option>
           <option value=">=">>=</option>
           <option value="<"> < </option>
           <option value="<="><=</option>
           <option value="!=">!=</option>
       </select>
            <input type="text" name="value" placeholder="Value" size="8"/>
            <input type="submit" name="submit" value="submit" />
</form>
        </div>
  <div class="display_123">
  <form action="threshold.php" method="post">
         <?php 
			include ('conn.php');
					$result = mysql_query("SELECT * FROM `site_table` where project_code=".$_SESSION["project_code"]."");
					echo '<font color="#039">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;Site Name</font>
					<select name="q" style="width:100px; height:29px; margin-left:5px;">';
					echo '<option value="">Select</option>';
				while($row = mysql_fetch_assoc($result)) {
					echo "<option value='".$row['site_code']."'>".$row['site_name']." </option>";
			}
					echo "</select>";

		?>
      <input type="submit" value="submit"/>
      </form>
</div>        	<div class="display_22">
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
			include('conn.php');
					$sql = "select b.site_code,b.date_stamp,b.time_stamp, b.channel_1_id,b.channel_1_value, 
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
		where project_code='".$_SESSION["project_code"]."'  ORDER BY s_no DESC";
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
				</div>
                </div>
                
            </div>   
        </div>
    </body>
</html>