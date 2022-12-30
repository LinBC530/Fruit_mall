<?php 
session_start(); 
if (empty($_SESSION["userID"])) 
{
    echo "<meta http-equiv=\"refresh\" content=\"0;url=../html/login.php\">";
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<?php
if(!empty($_SESSION['userID']) && !empty($_POST['name']))
{
    require_once("dbtools.inc.php");
    $link=create_connection();
                
    $sql="call update_userName('" . $_POST['name'] . "','" . $_SESSION['userID'] . "')";
    $result=execute_sql("shoppingdb", $sql, $link);
    $_SESSION['userName'] = $_POST['name'];
    mysql_close($link);
    echo"<script> alert(\"已更改姓名\"); </script>";
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>結帳</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <script src="../jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-city-selector@2.1.1/dist/tw-city-selector.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/account.css">
</head>

<body><div id="wrapper">
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
        
        <div style="margin-top: 30pt;" class="container  city-selector-set">
            <form method="post">
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <h3>帳戶資料</h3>
<?php
if(!empty($_SESSION['userID']))
{
    require_once("dbtools.inc.php");
    $link=create_connection();
                
    $sql="call select_user_account(" . $_SESSION['userID'] . ")";
    $result=execute_sql("shoppingdb", $sql, $link);
    $row = mysql_fetch_row($result);
    mysql_close($link);
}
?>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">姓名</label>
                                <input name="name" type="text" class="form-control" id="inputEmail4" placeholder="<?php echo $row[0]; ?>" maxlength="10">
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">手機號碼</label>
                                <input name="phone" type="text" class="form-control" id="inputAddress" placeholder="<?php echo $row[1]; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">密碼</label><br>
                                <a href="../html/changePW.php">修改密碼</a>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">儲存修改</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    

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
<script>
    // new TwCitySelector({
    //         el: '.city-selector-set',
    //         elCounty: '.county',
    //         elDistrict: '.district',
    //         countyFiledName: 'county',
    //         districtFieldName: 'district'
    //     });
</script>
</html>