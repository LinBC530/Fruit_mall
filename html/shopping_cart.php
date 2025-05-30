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
    <script src="../jquery-3.6.1.min.js"></script>
    <script src="../tw-city-selector.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/all_Web.css">
</head>

<?php
//刪除庫存不足商品
if(!empty($_POST["Modal_del"]) && !empty($_POST["Modal_pID"])){
    $del_num = count($_POST["Modal_pID"]);
    require_once("dbtools.inc.php");
    for($del_N=0;$del_N<$del_num;$del_N++)
    {
        $link=create_connection();
        $sql="call delete_shappingCarItem('" . $_SESSION['userID'] . "','" . $_POST["Modal_pID"][$del_N] . "')";
        $result=execute_sql("shoppingdb", $sql, $link);
        mysql_close($link);
    }
}
else if(!empty($_POST["item_del"]) && !empty($_POST["item_pID"])){
    $del_N = $_POST["item_del"]-1;
    require_once("dbtools.inc.php");
    $link=create_connection();
    $sql="call delete_shappingCarItem('" . $_SESSION['userID'] . "','" . $_POST["item_pID"][$del_N] . "')";
    $result=execute_sql("shoppingdb", $sql, $link);
    mysql_close($link);
}
else if(!empty($_POST["send_out"]))
{
    require_once("dbtools.inc.php");
	$link=create_connection();
    $sql="call insert_orders('" . $_SESSION['userID'] . "','" . $_POST["pName"] . "','" . $_POST["pPhone"] . "','" . $_POST["county"] . "','" . $_POST["district"] . "','" . $_POST["house_number"] . "')";
    $result=execute_sql("shoppingdb", $sql, $link);
    $row = mysql_fetch_row($result);
    
    mysql_close($link);
    $link=create_connection();
    for($T=0;$T<count($_POST["item_pID"]);$T++)
    {
	    $sql="call insert_orders_item('" . $row[0] . "','" . $_SESSION['userID'] . "','" . $_POST["item_pID"][$T] . "','" . $_POST["pNumber"][$T] . "','" . $_POST["pPrice"][$T] . "')";
	    $result=execute_sql("shoppingdb", $sql, $link);
    }
    mysql_close($link);
    echo "<meta http-equiv=\"refresh\" content=\"0;url=../html/order.php\">";
}
?>

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
        <form method="post">
            <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">項次</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">購買數量</th>
                    <th scope="col">單價</th>
                    <th scope="col">小計</th>
                    <th scope="col">貨量</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
<?php
            //初始總金額
            $price_sum = 0;

            //儲存數量不足的商品ID
            $deleteData = array();

            if(!empty($_SESSION['userID']))
            {
                require_once("dbtools.inc.php");
                $link=create_connection();
                
                $sql="call select_shappingCar(" . $_SESSION['userID'] . ")";
                $result=execute_sql("shoppingdb", $sql, $link);

                //取得購物車商品資料筆數
                $car_num = mysql_num_rows($result);

                //取得欄位數
                $total_fields = mysql_num_fields($result);

                
                if($car_num>0)
                {
                    //印出用戶加入購物車的所有商品資訊
                    $j = 1;
                    while ($row = mysql_fetch_row($result) and $j <= $car_num)
                    {
                        echo "<tr>";
                        for($i = 0; $i < $total_fields; $i+=8)
                        {
                            echo"
                            
                                <th scope=\"row\">" . $j . "</th>
                                <td>" . $row[$i] . "</td>
                                <td>" . $row[$i+1] . "</td>
                                <td>" . $row[$i+2] . "</td>
                                <td>" . $row[$i+3] . "</td>
                                <td>" . $row[$i+4] . "</td>
                                <input type=\"hidden\" name=\"item_pID[]\" value=\"" . $row[$i+5] . "\">
                                <input type=\"hidden\" name=\"pNumber[]\" value=\"" . $row[$i+1] . "\">
                                <input type=\"hidden\" name=\"pPrice[]\" value=\"" . $row[$i+2] . "\">
                                <td><button name=\"item_del\" value=\"$j\" type=\"submit\" class=\"btn btn-danger\">刪除</button></td>
                            
                            ";
                            if ($row[$i+1]>$row[$i+4])
                            {
                                $deleteData[] = $row[$i+5];
                            }
                        }
                        $price_sum = $row[6];
                        $j++;
                        echo "</tr>";     
                    }
                }
                else
                {
                    echo"
                    <tr>
                        <td style=\"font-size: 30pt;text-align: center\" colspan=\"7\" class=\"text-danger\">購物車是空的！</td>
                    </tr>";
                }
                mysql_close($link);
            }
            else
            {
                echo"
                    <tr>
                        <td style=\"font-size: 30pt;text-align: center\" colspan=\"7\" class=\"text-danger\">購物車是空的！</td>
                    </tr>";    
            }
?>
                </tbody>
            </table>
            </div>

            <h3 id="total" style="margin-top: 10pt;" class="text-danger">總金額 $<?php echo $price_sum; ?></h3>
            <br>
            
            <h4>付款方式</h4>
            <p>目前僅提供貨到付款</p>
            <br>
            <h4>收件人</h4>

            <div class="row g-3 city-selector-set">
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">姓名</label>
                  <input name="pName" type="text" class="form-control" id="inputName" maxlength="10">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">連絡電話</label>
                  <input name="pPhone" type="text" class="form-control" id="inputPhone" maxlength="10" pattern="09\d{8}" title="請輸入手機號碼 EX:09XXXXXXXX">
                </div>
                <div class="col-md-3">
                  <label for="inputCity" class="form-label">縣市</label>
                  <!-- <select class="county form-select"></select> -->
                  <select class="county form-select" id="inputCounty"></select>
                </div>
                <div class="col-md-3">
                  <label for="inputState" class="form-label">區域</label>
                  <select class="district form-select" id="inputDistrict"></select>
                </div>
                <div class="col-md-6">
                  <label for="inputZip" class="form-label">鄉鎮及門牌號</label>
                  <input name="house_number" type="text" class="form-control" id="inputHouseNumber" maxlength="20">
                </div>
            </div>
            
            <br>
            <button id="send_out" name="send_out" value="send_out" type="submit" class="btn btn-success">結帳</button>

        </div>
        </from>
    </main>
    </div>
<?php
if (!empty($deleteData))
{
    echo"
        <!-- Modal -->
        <form method=\"post\">
        <div class=\"modal fade\" id=\"staticBackdrop\" data-bs-backdrop=\"static\" data-bs-keyboard=\"false\" tabindex=\"-1\" aria-labelledby=\"staticBackdropLabel\" aria-hidden=\"true\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title text-danger\" id=\"staticBackdropLabel\">商品數量不足</h5>
            </div>
            <div class=\"modal-body\">
                購物車內含有庫存不足購買量之商品，將自動從購物車刪除數量不足商品。
            </div>
            <div class=\"modal-footer\">";
            for ($d=0;$d<count($deleteData);$d++)
            echo"<input type=\"hidden\" name=\"Modal_pID[]\" value=\"" . $deleteData[$d] . "\">";
            echo"<button value=\"Modal_del\" name=\"Modal_del\" type=\"submit\" class=\"btn btn-primary\">確定</button>
            </div>
            </div>
        </div>
        </div>
        </from>";
}
?>

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
<script>
    new TwCitySelector({
            el: '.city-selector-set',
            elCounty: '.county',
            elDistrict: '.district',
            countyFiledName: 'county',
            districtFieldName: 'district'
    });

    $('#send_out').click(function() {
        var car_num = <?=$car_num?>;
        if (car_num > 0){
            if ($('#inputName').val().length === 0 || 
            $('#inputPhone').val().length === 0 || 
            $('#inputCounty').val().length === 0 || 
            $('#inputDistrict').val().length === 0 || 
            $('#inputHouseNumber').val().length === 0) {
                alert('收件人區域欄位未填寫完成');
                event.preventDefault();
            }
        }
        else
        {
            alert('請先選購商品');
            event.preventDefault();
        }
    });

    $(window).ready(() => {
	    $('#staticBackdrop').modal('show');
    })

</script>
</html>