

<?php
$dbhost = 'localhost';
$dbuser = 'root';
//$dbpass = '';
ini_set('mssql.charset', 'UTF-8');
$conn = mysql_connect($dbhost, $dbuser, '') or die('Error connecting to mysql');

$dbname = 'eventgap';
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");
?>
