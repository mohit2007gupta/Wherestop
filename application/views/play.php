<?php
date_default_timezone_set('Asia/Kolkata');
$this->load->helper('date');
echo $dbtime = "2014-04-26 13:07:02";
echo "<hr />";
$str = (strtotime($dbtime));
echo "DB: ".strtotime($dbtime);
echo "<hr />";
echo $str;
echo "<hr />";
/* ;
$y = localtime(strtotime($dbtime), true);
print_r($y);
echo "<hr />";
$x = localtime(time(), true);
print_r($x);
echo "<hr />"; */

$today = getdate();
echo $today[0];
echo "<br />";
print_r($today);

echo "<hr />";
echo "<h3>Diff</h3>";
echo ($today[0]-strtotime($dbtime));
echo "<br />";
echo (($today[0]-$str)/60)." Mins";
/* echo "<br />";
//echo $gmt = local_to_gmt($dbtime);
echo "<br />";
echo now();
echo "<br />";
echo "Now: ";
echo date("Y-m-d H:i:s", now());
echo "<br />";
echo "DB: ";
echo date("Y-m-d H:i:s", strtotime($dbtime));
echo "<br />";
echo unix_to_human(time(), TRUE, 'us');
echo "<br />";
echo unix_to_human(strtotime($dbtime), TRUE, 'us');
echo "<br />";
echo timezone_menu('UM8'); */
?>