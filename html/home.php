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
</head>

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
                    <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="/html/home.html">最近看過</a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="../html/shopping_cart.html">購物車 <span
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
                    <!-- <li class="nav-item">
                            <a class="nav-link active" href="#">button</a>
                        </li> -->
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

    <main>
        <div class="container">
            <div style="border: 1pt solid red;" class="col-md-auto">
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
                        </div>
                        <div class="carousel-item">
                            <img src="../images/P2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/P3.png" class="d-block w-100" alt="...">
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
        <div style="border: 1pt solid red; margin-top: 10px;" class="container">
            <h1>熱銷商品</h1>
            <div class="row justify-content-md-center">
                <!-- <div style="border: 1pt solid red;" class="col-2">
                        Menu
                    </div> -->

                <div style="border: 1pt solid red;" class="col">
                    <div style="border: 1pt solid red;" class="row">

                    <?php
                            require_once("dbtools.inc.php");
	
                            //指定顯示幾筆資料
                            $records_per_page = 5;
                        
                            $link=create_connection();
                        
                        
                            $sql="call sales_ranking";
                            $result=execute_sql("shoppingdb", $sql, $link);
                            

                            //取得欄位數
                            $total_fields = mysql_num_fields($result);

                            //顯示熱銷商品
                            $j = 1;
                            while ($row = mysql_fetch_row($result) and $j <= $records_per_page)
                            {
                                echo "<div class=\"card\" style=\"width: 12rem; margin: 20px;\">";
                                // echo "<a class=\"navbar-brand\" href=\"#\">";      
                                for($i = 0; $i < $total_fields; $i+=3)
                                    echo "<img src=\"" . $row[$i] . " \" class=\"card-img-top\" alt=\"...\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title;\">" . $row[$i+1] . "</h5>
                                        <h5 class=\"card-title text-danger\">" . $row[$i+2] . "</h5>
                                        <a href=\"#\" class=\"btn btn-primary\">加入購物車</a>
                                    </div>";
                                $j++;
                                echo "</div>";
                            }
                        ?>


                        <div class="card" style="width: 12rem; margin:
                                20px;">
                            <img src="../images/t1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h5 class="card-title text-danger">500</h5>
                                <a href="#" class="btn btn-primary">加入購物車</a>
                            </div>
                        </div>
                        <div class="card" style="width: 12rem; margin:
                                20px;">
                            <img src="../images/t2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h5 class="card-title">33,000</h5>
                                <a href="#" class="btn btn-primary">加入購物車</a>
                            </div>
                        </div>
                        <div class="card" style="width: 12rem; margin:
                                20px;">
                            <img src="../images/t2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div style="width: 100pt; border: 1pt solid red;"><h5 class="card-title">Card title</h5></div>
                                <h5 class="card-title">33,000</h5>
                                <a href="#" class="btn btn-primary">加入購物車</a>
                            </div>
                        </div>
                        <div class="card" style="width: 12rem; margin:
                                20px;">
                            <img src="../images/t2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h5 class="card-title">33,000</h5>
                                <a href="#" class="btn btn-primary">加入購物車</a>
                            </div>
                        </div>
                        <div class="card" style="width: 12rem; margin:
                                20px;">
                            <img src="../images/t2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h5 class="card-title">33,000</h5>
                                <a href="#" class="btn btn-primary">加入購物車</a>
                            </div>
                        </div>
                        <div class="card" style="width: 12rem; margin:
                                20px;">
                            <img src="../images/t2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h5 class="card-title">33,000</h5>
                                <a href="#" class="btn btn-primary">加入購物車</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between
                align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted
                        text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-muted">&copy; 2022
                    Company, Inc</span>
            </div>

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
            </ul>
        </footer>
    </div>
</body>

</html>