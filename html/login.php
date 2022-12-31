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
        <form method="post" action="login.php">
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
                水果商城
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
            require_once("dbtools.inc.php");
            $link=create_connection();

            //判斷是否有註冊或登入資料傳入
            if(!empty($_POST["rName"]) && !empty($_POST["rPhone"]) && !empty($_POST["rPass1"]) && !empty($_POST["rPass2"]))
            {
                $rName = $_POST["rName"];
                $rPhone = $_POST["rPhone"];
                $rPass1 = $_POST["rPass1"];
                $rPass2 = $_POST["rPass2"];
                
                //查詢是否有相同註冊資料
                $sql="call select_user_phone('$rPhone')";
                $result=execute_sql("shoppingdb", $sql, $link);

                if(mysql_num_rows($result)==0)
                {
                    mysql_free_result($result);
            	    mysql_close($link);
                    $link=create_connection();

                    $sql="call insert_user('$rName','$rPhone','$rPass1','$rPass2')";
                    $result=execute_sql("shoppingdb", $sql, $link);
                    echo"
                    <script>
                        alert(\"註冊成功\");
                    </script>";
                }
                else if (mysql_num_rows($result)!=0)
                {
                    echo"
                    <script>
                        alert(\"此號碼已被註冊\");
                    </script>";
                }
            }
            else if (!empty($_POST["lPhone"]) && !empty($_POST["lPass"]))
            {
                $lPhone = $_POST["lPhone"];
                $lPass1 = $_POST["lPass"];

                $sql="call select_user('$lPhone','$lPass1')";
                $result=execute_sql("shoppingdb", $sql, $link);
                $data_num = mysql_num_rows($result);
                $data = mysql_fetch_row($result);

                // echo $lPhone;
                // echo $lPass1;

                if ($data_num!=0)
                {
                    // session_save_path('../tmp');
                    session_start();
                    $_SESSION['userID'] = $data[0];
                    $_SESSION['userName'] = $data[1];
                    header('refresh:0;url=home.php');
                }
                else
                {
                    echo
                    "<script>
                        alert(\"請確認帳號及密碼是否正確\");
                    </script>";
                }
                
            }


            $Type = "login";
            if(!empty($_GET["type"]))
                $Type = $_GET["type"];

            if($Type == "register")
            {
                

                echo"
                <div class=\"form-floating\">
                    <input name=\"rName\" type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"text\" maxlength=\"10\" required>
                    <label for=\"floatingInput\">姓名</label>
                </div>
                <div class=\"form-floating\">
                    <input name=\"rPhone\" type=\"tel\" class=\"form-control\" id=\"phoneNB\" placeholder=\"text\" maxlength=\"10\" required=\"\d+\">
                    <label for=\"floatingInput\">電話</label>
                </div>
                <div class=\"form-floating\">
                    <input name=\"rPass1\" type=\"password\" class=\"form-control\" id=\"PW1\" placeholder=\"Password\" maxlength=\"10\" required>
                    <label for=\"floatingPassword\">密碼</label>
                </div>
                <div class=\"form-floating\">
                    <input name=\"rPass2\" type=\"password\" class=\"form-control\" id=\"PW2\" placeholder=\"Password\" maxlength=\"10\"required>
                    <label for=\"floatingPassword\">再次輸入密碼</label>
                </div>
                <button onClick=\"check()\" style=\"margin-top: 20pt;\" class=\"w-100 btn btn-lg btn-primary\" type=\"submit\">註冊</button>";
                
                echo"
                <script>
                function check(){
                    if(PW1.value!=\"\" && PW2.value!=\"\" && phoneNB.value!=\"\" && name.value!=\"\" )
                    {
                        if(PW1.value != PW2.value)
                        {
                            alert(\"密碼不相符\");
                            event.preventDefault();
                        }
                    }
                }
                </script>";
            
            
            }
            else if($Type == "login")
            {
                echo"
                <div class=\"form-floating\">
                    <input name=\"lPhone\" type=\"tel\" class=\"form-control\" id=\"Phone\" placeholder=\"text\" maxlength=\"10\" required>
                    <label for=\"floatingInput\">帳號</label>
                </div>
                <div class=\"form-floating\">
                    <input name=\"lPass\" type=\"password\" class=\"form-control\" id=\"PW1\" placeholder=\"Password\" maxlength=\"10\" required=\"\d+\">
                    <label for=\"floatingPassword\">密碼</label>
                </div>
                <button id=\"btn\" style=\"margin-top: 20pt;\" class=\"w-100 btn btn-lg btn-primary\" type=\"submit\">登入</button>";
            }
        ?>
            <p class="mt-5 mb-3 text-muted">&copy; 20XX–2022</p>
        </form>
        
    </main>



</body>

</html>