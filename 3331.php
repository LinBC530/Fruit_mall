<?php
	
	require_once("dbtools.inc.php");
	
	$card=$_POST["card"];
	$name=$_POST["name"];
	$math=$_POST["math"];
	$chi=$_POST["chi"];
	$nat=$_POST["nat"];
	
	$link=create_connection();
	
	$sql="SELECT * FROM grade";
	$result=execute_sql("students", $sql, $link);
	
	//執行 UPDATE 陳述式來更新使用者資料
    $sql = "UPDATE grade SET name = '$name', 
            math = '$math', chinese = '$chi',
            nature = '$nat' WHERE no = '$card'";
	
	$result=execute_sql("students", $sql, $link);
	
	mysql_close($link);
?>
<?php	
	/*
	require_once("dbtools.inc.php");
	
//指定每頁顯示幾筆記錄
      $records_per_page = 20;
	
	$link=create_connection();
	//取得欄位數
      $total_fields = mysql_num_fields($result);
	
	//顯示欄位名稱
      echo "<table border='0' align='center' width='300'>";
      echo "<tr align='center'>";         
      for ($i = 0; $i < $total_fields; $i++)
        echo "<td>" . mysql_field_name($result, $i) . "</td>";                  
      //echo "</tr>";
      
      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_row($result) and $j <= $records_per_page)
      {
        echo "<tr>";      
        for($i = 0; $i < $total_fields; $i++)
          
          echo "<td>$row[$i]</td>"; 
                     
        $j++;
        echo "</tr>";     
      }
      echo "</table>" ;
	
	//釋放記憶體空間
	mysql_free_result($result);
	mysql_close($link); */
?>
