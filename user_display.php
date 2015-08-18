<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','ospcbin_kumar','2crn#robin1','ospcbin_KCP');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ospcbin_KCP");
$sql="SELECT * FROM `site_table` WHERE site_code= '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
?>       
<FORM action="graphics_user_2.php" method="post">          
		<table border="1" bordercolor="#FFFF00" width="250" height="100%">
                 <tr>
                     <td>
                         &nbsp;&nbsp;&nbsp;<font color='#F00'>Graphical Display <?php echo $row['site_name'];?></font><br/>
                         <font color='#039'>&nbsp;&nbsp;&nbsp;Channel 1 Code (BOD)&nbsp;
                             <input type="radio" name='channel' value="<?php echo $row['channel_1']  ?>"
                              onclick="this.form.submit();">
                         &nbsp;&nbsp;&nbsp;Channel 2 Code (pH)&nbsp;&nbsp;&nbsp;&nbsp;
                             <input type='radio' name='channel'  value="<?php echo $row['channel_2'] ?>" 
                             onclick="this.form.submit();">
                         &nbsp;&nbsp;&nbsp;Channel 3 Code (TSS)&nbsp;&nbsp;
                             <input type='radio' name='channel'  value="<?php echo $row['channel_3'] ?>"
                             onclick="this.form.submit();">
                         &nbsp;&nbsp;&nbsp;Channel 4 Code (TSS)&nbsp;&nbsp;
                             <input type='radio' name='channel'  value="<?php echo $row['channel_4'] ?>"
                             onclick="this.form.submit();">
                         &nbsp;&nbsp;&nbsp;Channel 5 Code (TSS)&nbsp;&nbsp;
                             <input type='radio' name='channel'  value="<?php echo $row['channel_5'] ?>"
                             onclick="this.form.submit();">
                         &nbsp;&nbsp;&nbsp;Channel 6 Code (TSS)&nbsp;&nbsp;
                             <input type='radio' name='channel'  value="<?php echo $row['channel_6'] ?>"
                             onclick="this.form.submit();">
                         <?php
}
?>
                     </td>
             </tr>

        </table>

