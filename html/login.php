<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登入/註冊</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body class="text-center">

    <main class="form-signin">
        <!-- <form> -->
            <a style="font-size: 35pt;" class="navbar-brand" href="../html/home.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
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
            <h1 style="margin-top: 10pt;" class="h3 mb-3 fw-normal">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php?type=login">登入</a>
                    </li>
                    <p>|</p>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php?type=register">註冊</a>
                        <!-- <button type="button" class="btn" value="123"><h3>註冊</h3></button> -->
                    </li>
                </ul>
            </h1>
        <?php
            $Type = "login";
            if(!empty($_GET["type"]))
                $Type = $_GET["type"];

            if($Type == "register")
            {
            echo"
            <div class=\"form-floating\">
                <input type=\"text\" class=\"form-control\" id=\"floatingInput\" placeholder=\"text\" required>
                <label for=\"floatingInput\">電話</label>
            </div>
            <div class=\"form-floating\">
                <input type=\"password\" class=\"form-control\" id=\"Password1\" placeholder=\"Password\" required>
                <label for=\"floatingPassword\">密碼</label>
            </div>
            <div class=\"form-floating\">
                <input type=\"password\" class=\"form-control\" id=\"Password2\" placeholder=\"Password\"required>
                <label for=\"floatingPassword\">再次輸入密碼</label>
            </div>
            <button style=\"margin-top: 20pt;\" class=\"w-100 btn btn-lg btn-primary\" type=\"submit\">註冊</button>";
            }
            else if($Type == "login")
            {
            echo"
            <div class=\"form-floating\">
                <input type=\"phone\" class=\"form-control\" id=\"PW1\" placeholder=\"phone\" required>
                <label for=\"floatingInput\">帳號</label>
            </div>
            <div class=\"form-floating\">
                <input type=\"password\" class=\"form-control\" id=\"PW2\" placeholder=\"Password\" required>
                <label for=\"floatingPassword\">密碼</label>
            </div>
            <button id=\"btn\" style=\"margin-top: 20pt;\" class=\"w-100 btn btn-lg btn-primary\" type=\"submit\">登入</button>";
            }
        ?>
            <p class="mt-5 mb-3 text-muted">&copy; 20XX–2022</p>
        <!-- </form> -->
        <!-- <script>
            function test(){
                if(PW1.value != PW2.value)
                {
                    alert("error");
                }
            }
        </script> -->
    </main>



</body>

</html>