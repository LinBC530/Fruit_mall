<?php 
session_start(); 
if (empty($_SESSION["userID"])) 
{
    echo "<meta http-equiv=\"refresh\" content=\"0;url=../html/login.php\">";
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>購物商城</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../css/all_Web.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/order.css"> -->
</head>

<body>
    <div id="wrapper">
    <nav class="navbar navbar-dark navbar-expand-lg sticky-top">
        <div class="container">
            <a style="font-size: 20pt" class="navbar-brand" href="../html/home.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-cart-fill" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1
                            .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5
                            0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61
                            2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0
                            0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1
                            0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1
                            0-2z"></path>
                </svg>
                水果商城
            </a>
            <button style="margin-bottom: auto;" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form style="width:450px" class="input-group mx-auto" id="Search" role="search" method="get" action="Inquire.php">
                    <input name="search" class="form-control me-2" type="search" placeholder="搜尋">
                    <button class="btn btn-success" type="submit">搜尋</button>
                </form>

                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../html/shopping_cart.php">
                            購物車
<?php
                        if(!empty($_SESSION['userID']))
                        {
                            //查詢用戶購物車資料筆數
                            require_once("dbtools.inc.php");
                            $link=create_connection();
                            $sql="call select_shappingCarNum(" . $_SESSION['userID'] . ")";
                            $result=execute_sql("shoppingdb", $sql, $link);
                            $car_num = mysql_fetch_row($result)[0];
                            
                            //顯示用戶購物車資料筆數
                            if($car_num > 0)
                                echo "<span class=\"badge bg-danger\">$car_num</span>";
                            else
                                echo "<span class=\"badge bg-secondary\">0</span>";
                            
                            //關閉資料庫連線
                            mysql_close($link);
                        }
                        else
                            echo "<span class=\"badge bg-secondary\">0</span>";
?>
                            <!-- </span> -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../html/order.php">我的訂單</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active" href="../html/account.php">帳號設定</a>
                    </li>
<?php 
                    if(!empty($_SESSION['userName']) && !empty($_SESSION['userID']))
                    {
                        //顯示用戶名稱
                        echo
                        "<li style=\"width: 80pt;overflow: hidden;text-overflow: ellipsis;white-space:nowrap;\" class=\"nav-item\">
                            <a class=\"nav-link disabled\">HI!" . $_SESSION['userName'] . "</a>
                        </li>";
                    }
?>
                    <li class="nav-item">
<?php
                    //判定顯示登入登出按鈕
                    if(!empty($_SESSION['userName']) && !empty($_SESSION['userID']))
                    {
                        echo "
                        <form method=\"post\">
                            <button name=\"distory\" value=\"distory\" type=\"submit\" class=\"btn btn-success\">登出</button>
                            
                        </from>";

                        if(!empty($_POST['distory'])) {
                            session_destroy();
                            echo "<script> location.replace(\"home.php\"); </script>";
                        }
                    }
                    else
                    {
                        echo "<a class=\"nav-link\" href=\"../html/login.php\"><button type=\"button\"
                                class=\"btn btn-success\">登入</button></a>";
                    }
?>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <header>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="../html/Inquire.php?search=melon">瓜果類</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../html/Inquire.php?search=drupe">核果類</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../html/Inquire.php?search=pome_fruit">仁果類</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../html/Inquire.php?search=tangerine">柑橘類</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../html/Inquire.php?search=berry">漿果類</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../html/Inquire.php?search=other">其他類</a>
            </li>
        </ul>
    </header>

    <main>
        <div style="margin-top: 20pt;" class="container">
            <h3>所有訂單</h3>
<?php

if(!empty($_POST['order_ID']))
{
    require_once("dbtools.inc.php");
    $link=create_connection();
    $sql="call update_order_Cancel(" . $_POST['order_ID'] . ")";
    execute_sql("shoppingdb", $sql, $link);
    mysql_close($link);
}

if(!empty($_SESSION['userID']))
{
    require_once("dbtools.inc.php");
    $link=create_connection();
    
    $sql="call select_order(" . $_SESSION['userID'] . ")";
    $result_order=execute_sql("shoppingdb", $sql, $link);

    //取得購物車商品資料筆數
    $order_num = mysql_num_rows($result_order);
    
    //取得欄位數
    $total_fields = mysql_num_fields($result_order);

    //印出用戶加入購物車的所有商品資訊
    $j = 1;
    $class_ID = 1;

    mysql_close($link);
    while ($row = mysql_fetch_row($result_order) and $j <= $order_num)
    {
        //echo "hi";
        // echo "<tr>";
        // for($i = 0; $i < $total_fields; $i+=7)
        // {
        echo"<div style=\"margin-top: 10pt;\" class=\"accordion\" id=\"accordionExample\">
                <div class=\"accordion-item\">
                  <h2 class=\"accordion-header\" id=\"heading" . $class_ID . "\">
                    <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapse" . $class_ID . "\" aria-expanded=\"false\" aria-controls=\"collapse" . $class_ID . "\">
                      <p style=\"margin:0pt;\">訂單編號：" . $row[0] . "&nbsp&nbsp<p class=\"text-danger\" style=\"margin: 0pt;\">" . $row[7] . "</p></p>
                    </button>
                  </h2>
                  <div id=\"collapse" . $class_ID . "\" class=\"accordion-collapse collapse\" aria-labelledby=\"heading" . $class_ID . "\" data-bs-parent=\"#accordionExample\">
                    <div class=\"accordion-body\">
                        <h5>訂單內容</h5>
                        <table class=\"table\">
                            <thead class=\"table-dark\">
                              <tr>
                                <th scope=\"col\">項次</th>
                                <th scope=\"col\">商品名稱</th>
                                <th scope=\"col\">購買數量</th>
                                <th scope=\"col\">單價</th>
                                <th scope=\"col\">小計</th>
                              </tr>
                            </thead>
                            <tbody>";
                        
                        $link=create_connection();
                        $sql="call select_orders_item(" . $row[0] . ")";
                        $result=execute_sql("shoppingdb", $sql, $link);
                        
                        //取得購物車商品資料筆數
                        $order_item_num = mysql_num_rows($result);
                        
                        //取得欄位數
                        $total_fields = mysql_num_fields($result);

                        //取得資料陣列
                        //$row_item = mysql_fetch_row($result);
                        mysql_close($link);
                        //echo $row_item[10];
                        
                        $k=1;
                        while ($row_item = mysql_fetch_row($result) and $k <= $order_item_num)
                        {
                            for($n = 0,$i = 0; $i < $total_fields; $i+=4,$n++)
                            {
                                echo"
                                    <tr>
                                        <th scope=\"row\">$k</th>
                                        <td>" . $row_item[$i] . "</td>
                                        <td>" . $row_item[$i+1] . "</td>
                                        <td>" . $row_item[$i+2] . "</td>
                                        <td>" , $row_item[$i+3] . "</td>
                                    </tr>";
                            }
                            $k++;
                        }
                        $link=create_connection();
                        $sql="call select_order_priceSum(" . $row[0] . ")";
                        $result_priceSum=execute_sql("shoppingdb", $sql, $link);
                        
                        //取得資料陣列
                        $price_sum = mysql_fetch_row($result_priceSum)[0];
                        mysql_close($link);
                        echo"</tbody>
                        </table>
                          <h3 id=\"total\" style=\"margin-top: 10pt;\" class=\"text-danger\">總金額：$" . $price_sum . "</h3><br>
                          <!-- <div style=\"text-align: right;\"><button type=\"submit\" class=\"btn btn-success\">取消訂單</button></div> -->
                          <h3 id=\"total\" style=\"margin-top: 10pt;\">付款方式</h3>
                          <p>貨到付款</p><br>
                          <h3 id=\"total\" style=\"margin-top: 10pt;\">收件人資訊</h3>
                          <p>姓名：" . $row[2] . "</p>
                          <p>電話：" . $row[3] . "</p>
                          <p style=\"word-wrap:break-word\">收件地址：" . $row[4] . $row[5] . $row[6] . "</p>";
                        if ($row[7] == "待處理") {
                            echo"<div style=\"text-align: right;\">
                                    <form method=\"post\">
                                        <button value=\"" . $row[0] . "\" name=\"order_ID\" type=\"submit\" class=\"btn btn-success\">取消訂單</button>
                                    </from>
                                </div>";
                        }
                          else
                          {
                            echo "<div style=\"text-align: right;\"><button type=\"submit\" class=\"btn btn-success\" disabled>取消訂單</button></div>";
                          }
                echo"</div>
                  </div>
                </div>
            </div>";
            $j++;
            $class_ID++;
    }
    if($order_num == 0)
    {
        echo"
        <div style=\"font-size: 30pt;text-align: center;border: 1pt solid black;background-color: rgb(255, 255, 255);\">無訂單</div>
        ";
    }
}
else
{
    echo"
    <div style=\"font-size: 15pt;\">無訂單</div>
    ";
}
?>

    </main>
    </div>


    <div id="footer" class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between
                align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span style="margin-left: 20pt;" class="mb-3 mb-md-0 text-muted">&copy; 2022
                    Company, Inc</span>
            </div>
        </footer>
    </div>
</body>

</html>