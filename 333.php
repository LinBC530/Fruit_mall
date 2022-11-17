<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>瀏覽</title>
  </head>
  <body>

<?php
	require_once("dbtools.inc.php");
	
	//指定每頁顯示幾筆記錄
      $records_per_page = 20;
	
	$link=create_connection();
	
	
	$sql="SELECT * FROM grade";
	$result=execute_sql("students", $sql, $link);
	
	echo "總共: ".mysql_num_rows($result). " 筆";  //取得記錄數
	
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
	mysql_close($link);
	
?>

<form method="post" action="3331.php">
	請輸入學生證號：<input type="text" name="card" size="10"><br>
	請輸入學生姓名：<input type="text" name="name" size="10"><br>
	請輸入數學分數：<input type="text" name="math" size="10"><br>
	請輸入國文分數：<input type="text" name="chi" size="10"><br>
	請輸入自然分數：<input type="text" name="nat" size="10"><br>
	<input type="submit" value="更改資料">
	</form>
  </body>
</html>