<?php
include('conn.php');
 $sql = mysql_query("select email from site_table where site_code='10'");
    while($row=mysql_fetch_array($sql))
    {
            $email=$row['email'];
            echo $to = $email;
            $subject = "E-mail subject";
            $body = "E-mail body";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: "santosh.s@easyarm.com"' . "\r\n";
			$headers .= 'From: "santosh.s@easyarm.com"' . "\r\n";
            mail($to, $subject, $body, $headers);
    }
    ?>