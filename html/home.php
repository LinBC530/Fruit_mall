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
    <link rel="stylesheet" type="text/css" href="../css/all_Web.css">
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
        <div class="container">
            <div class="col-md-auto">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../images/P1.jpg" class="d-block w-100" alt="...">
                            <!-- <div class="carousel-caption .d-block">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div> -->
                        </div>
                        <div class="carousel-item">
                            <img src="../images/P2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/P3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div style="margin-top: 10px;" class="container">
            <h1>熱銷商品</h1>
            <div style="border-radius:10pt; background:rgb(255, 255, 255); box-shadow: 12px 12px 7px rgba(0, 0, 0, 0.7);" id="display_area" class="row justify-content-md-center">
                <div class="col">
                    <div class="row">

                    <?php
                            // 查詢熱銷商品
                            require_once("dbtools.inc.php");
                            $link=create_connection();
                            $sql="call sales_ranking";
                            $result=execute_sql("shoppingdb", $sql, $link);
                            $data_num = 10;

                            //取得欄位數
                            $total_fields = mysql_num_fields($result);

                            //最多顯示前10項熱銷商品
                            $j = 1;
                            while ($row = mysql_fetch_row($result) and $j <= $data_num)
                            {
                                for($i = 0; $i < $total_fields; $i+=4)
                                {
                                echo "<div class=\"card\" style=\"width: 12rem; margin: 20px;\"  onclick=\"location.href='../html/register.php?num=" . $row[$i] . "'\">";
                                // echo "<a class=\"navbar-brand\" href=\"#\">";      
                                
                                    echo "<img style=\"margin-top: 5pt;margin-left:auto;margin-right:auto;width: 120pt;height:120pt\" src=\"" . $row[$i+1] . " \" class=\"card-img-top\" alt=\"...\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title;\">" . $row[$i+2] . "</h5><br>
                                        <h3 style=\"font-weight:bold;\" class=\"card-title text-danger\">$" . $row[$i+3] . "</h3>
                                    </div>";
                                }
                                $j++;
                                echo "</div>";
                            }
                            mysql_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>
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