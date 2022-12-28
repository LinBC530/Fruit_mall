<?php session_start(); ?>
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

    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/order.css">
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
                購物商城
            </a>
            <button style="margin-bottom: auto;" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form style="width:450px" class="input-group mx-auto" id="Search" role="search">
                    <input class="form-control me-2" type="search" placeholder="搜尋">
                    <button class="btn btn-success" type="submit">搜尋</button>
                </form>

                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/html/home.html">最近看過</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/html/home.html">購物車 <span
                                class="badge bg-secondary">0</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">我的訂單</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            顧客中心
                        </a>
                        <ul style="line-height: 30px;" class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">追蹤清單</a></li>
                            <li><a class="dropdown-item" href="#">訂單</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">帳號設定</a></li>
                        </ul>

                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link active" href="#">button</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/html/login.html"><button type="button"
                                class="btn btn-success">登入</button></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <header>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="#">3C</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">美妝</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">日常</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">食品</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">生活</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">戶外</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
    </header>

    <main style="border: 1pt solid red;">
        <div style="margin-top: 20pt; border: 1pt solid red;" class="container">
            <h3>所有訂單</h3>
<?php
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
                            echo "<div style=\"text-align: right;\"><button type=\"submit\" class=\"btn btn-success\">取消訂單</button></div>";
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
        <div style=\"font-size: 30pt;text-align: center;\">無訂單</div>
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


    <div id="footer" style="border: 1pt solid red;" class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between
                align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <!-- <a href="/" class="mb-3 me-2 mb-md-0 text-muted
                        text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a> -->
                <span style="margin-left: 20pt;" class="mb-3 mb-md-0 text-muted">&copy; 2022
                    Company, Inc</span>
            </div>
<!-- 
            <ul class="nav col-md-4 justify-content-end
                        list-unstyled d-flex">
                <li class="ms-3">
                    <a class="text-muted" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter"></use>
                        </svg>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="text-muted" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram"></use>
                        </svg>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="text-muted" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"></use>
                        </svg>
                    </a>
                </li>
            </ul> -->
        </footer>
    </div>
</body>

</html>