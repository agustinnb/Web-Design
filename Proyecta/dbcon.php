<?php
	$con=mysql_connect("localhost","root","") or die("Database connection failed");
	if($con)
	{
	mysql_selectdb("dbProyecTA",$con);
	}
?>