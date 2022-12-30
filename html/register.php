<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>查詢商品</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../css/home.css">
</head>

<?php
                if(!empty($_SESSION['userID']) && !empty($_POST["pNum"]) && !empty($_GET["num"]))
                {
                    $pNum = $_POST["pNum"];
                    $pID = $_GET["num"];

                    require_once("dbtools.inc.php");

                    $link=create_connection();

                    $sql="call insert_shappingCar('" . $_SESSION['userID'] . "','$pID','$pNum')";
                    $result=execute_sql("shoppingdb", $sql, $link);

                    //釋放記憶體空間
                    //mysql_free_result($result);
                    mysql_close($link);
                }
                else if(empty($_SESSION['userID']) && !empty($_POST["pNum"]))
                {
                    echo "<meta http-equiv=\"refresh\" content=\"0;url=../html/login.php\">";
                }
            ?>

<body>
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

    <div style="margin-top: 30pt;" class="container">
        <div class="row justify-content-md-center">
            <?php
            if(!empty($_GET["num"]))
            {
                $ID = $_GET["num"];

                require_once("dbtools.inc.php");
	
                //指定顯示幾筆資料
                $records_per_page = 1;
                        
                $link=create_connection();
                        
                        
                $sql="call browse_products($ID)";
                $result=execute_sql("shoppingdb", $sql, $link);

                $row = mysql_fetch_row($result);

                //取得商品庫存量
                $q_num = number_format($row[4]);

                //限制購買量最多為10單位
                if($q_num>10)
                {
                    $q_num = 10;
                }

                //顯示熱銷商品
                echo "<div style=\"border: 1pt solid red;\" class=\"col-md-4\">
                    <img style=\"width: 300px;\" src=\"" . $row[0] . "\" class=\"rounded mx-auto d-block\" alt=\"...\">
                    </div>
                    <div style=\"border: 1pt solid red;\" class=\"col-md-5\">
                    <h1 style=\"word-wrap:break-word\">" . $row[1] . "</h1>
                    <br>
                    <p style=\"word-wrap:break-word;\" class=\"col-md\">
                        " . $row[2] . "
                    </p>
                    <h3 class=\"text-danger\">$" . $row[3] . "</h3>
                    <br>
                    <form method=\"post\" action=\"\">
                    <div class=\"row\">
                    
                        <div style=\"border: 1pt solid red;\" class=\"col-auto\">
                            <select name=\"pNum\" class=\"form-select\" aria-label=\"Default select example\">";
                            
                                for($v=1;$v<=$q_num;$v++)
                                {
                                    echo "<option value=\"$v\">" . $v . "</option>";
                                }
                            echo "</select>
                        </div>
                        <div style=\"border: 1pt solid red; margin-left: 3pt;\" class=\"col-auto\">";
                        if($row[4]>=1)
                            echo"<button id=\"Add\" type=\"submit\" class=\"btn btn-danger\">加入購物車</button>";
                        else
                            echo"<button type=\"submit\" class=\"btn btn-danger\" disabled>加入購物車</button>";
                        echo"</div>
                    
                    </div>
                    </from>
                </div>";
                //釋放記憶體空間
                //mysql_free_result($result);
                mysql_close($link);
            }
            ?>
            
        </div>
</body>
<!-- <script>
    $('#Add').click(function() {
        var q_num = <?=$row[4]?>;
        if(q_num <= 0)
        {
            alert("");
        }
    });
</script> -->
</html>