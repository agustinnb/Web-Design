<?php 
session_start();
if (isset($_SESSION['username'])){
	
	if (isset($_GET['id'])){
		include "libraries/mysqlconnect.php";
		$query="DELETE from categories WHERE id=" . $_GET['id'];
		mysql_query($query) or die ("Error");
		include "libraries/closecon.php";
	echo "<meta http-equiv=refresh content=0;URL=cat_list.php>";
	}
}else{
	header("Location:login.php");
}