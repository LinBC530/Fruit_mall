<?php
 
    require_once("dbtools.inc.php");
		
    $card=$_POST["card"];
		
    //建立資料連接
    $link = create_connection();
				
    //刪除帳號
    $sql = "DELETE FROM grade Where no = '$card'";
    $result = execute_sql("students", $sql, $link);
		
    //關閉資料連接
    mysql_close($link);
?>