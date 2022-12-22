
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>查詢</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/Inquire.css">
</head>

<!-- <?php
    if(!empty($_SESSION['userID']) && !empty($_POST["pNum"]) && !empty($_POST["pID"]))
    {
        $pNum = $_POST["pNum"];
        $pID = $_POST["pID"];

        echo $pID;
        // require_once("dbtools.inc.php");

        // $link=create_connection();

        // $sql="call insert_shappingCar('" . $_SESSION['userID'] . "','$pID','$pNum')";
        // $result=execute_sql("shoppingdb", $sql, $link);
    }
?> -->


<body>
    <nav class="navbar navbar-dark navbar-expand-lg">
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
                        <a class="nav-link active" aria-current="page" href="../html/shopping_cart.html">購物車 <span
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
                            <li><a class="dropdown-item" href="../html/order.html">訂單</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">帳號設定</a></li>
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/login.html"><button type="button"
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
<?php
    //被點選
    if(!empty($_GET["search"]))
        $search = $_GET["search"];

    //搜尋列
    if(!empty($_POST["search"]))
        $search = $_POST["search"];

    //判斷查詢的回傳值是否為空
    if(!empty($search))
    {

        require_once("dbtools.inc.php");

        $link=create_connection();

        $sql="call search('$search')";
        $result=execute_sql("shoppingdb", $sql, $link);
        

        //判斷查詢條件是否有回傳值
        if(!empty($result))
        {
            //判斷取得資料筆數是否大於等於10
            //if(mysql_num_rows($result)>10)
                $data_num = mysql_num_rows($result);
            //else
            //    $data_num = 10;

            //取得欄位數
            $total_fields = mysql_num_fields($result);
        }
        else
            //將資料筆數設為0
            $data_num = 0;
        
    }
    else
    {
        ////將資料筆數設為0
        $data_num = 0;
    }

    echo"
    <main>
        <div style=\"margin-top: 30pt;\" class=\"container\">";
    //判斷是否有資料
    if($data_num != 0)
    {
        //印出每筆資料
        $j = 1;
        while ($row = mysql_fetch_row($result) and $j <= $data_num)
        {
            for($i = 0; $i < $total_fields; $i+=6)
            {
                echo"
                <div id=\"commodity\" style=\"padding: 3pt;border-radius: 15pt;background-color: rgb(255, 255, 255);box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.7);margin-bottom: 10pt;\" class=\"row justify-content-md-center\">
                    <div class=\"col-auto\">
                        <img id=\"commodity_image\" style=\"width:110pt;height:110pt\" src=\"" . $row[$i] . "\" class=\"rounded mx-autod-block\" alt=\"...\" onclick=\"location.href='../html/register.php?num=" . $row[$i+5] . "'\">
                    </div>
                    <div style=\"overflow: hidden;\" class=\"col\">
                        <h3 id=\"commodity_title\" style=\" height: 25pt;overflow: hidden;text-overflow: ellipsis;\"  onclick=\"location.href='../html/register.php?num=" . $row[$i+5] . "'\">
                                " . $row[$i+1] . "
                        </h3>
                        <p style=\"height: 35pt;overflow: hidden;text-overflow: ellipsis;\">
                            " . $row[$i+2] . "
                        </p>

                        <div class=\"row justify-content-md-start\">
                            <div class=\"col-auto\">
                                <h3 style=\"color: red;\">$" . $row[$i+3] . "</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>";
            }
            $j++;
            // echo "</div>";
            
        }
        
    }
    else if($data_num == 0)
    {
        echo"
        <div id=\"commodity\"
            <div style=\"padding: 3pt;\" class=\"row
                    justify-content-md-center\">
                <div style=\"border: 1pt solid red;\" class=\"col\">
                    <h1 style=\"text-align: center;\">";
                    if(empty($_POST["search"]))
                        echo "未輸入查詢商品名稱";
                    else
                        echo "查無此商品";
        echo       "</h1>
                </div>
            </div>
        </div>";
    }
    echo"
        </div>
    </main>";
?>
</body>

</html>