<?php
	require_once("dbtools.inc.php");
	$card=$_POST["card"];
	$name=$_POST["name"];
	$math=$_POST["math"];
	$chi=$_POST["chi"];
	$nat=$_POST["nat"];
	
	$link=create_connection();
	
	$sql="INSERT INTO grade(no, name, chinese, math, nature) VALUES('$card','$name','$math','$chi','$nat')";
	
	$result=execute_sql("students", $sql, $link);
	
	$sql="SELECT * FROM grade";
	$result=execute_sql("students", $sql, $link);
	
	echo "總共: ".mysql_num_rows($result). " 筆";
	
	
	mysql_close($link);
?>
