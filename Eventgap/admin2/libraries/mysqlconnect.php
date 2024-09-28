

<?php
$dbhost = '192.168.0.82';
$dbuser = '';
$dbpass = '';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');

$dbname = 'pablok';
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");
?>

