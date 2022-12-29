<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>修改密碼</title>
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
                修改密碼
            </h1>
        <form method="post">
            <div class="form-floating">
                <input name="oldPass" type="password" class="form-control" id="OPW" placeholder="Password" required>
                <label for="floatingPassword">舊密碼</label>
            </div>
            <div class="form-floating">
                <input name="newPass1" type="password" class="form-control" id="PW1" placeholder="Password" required>
                <label for="floatingPassword">新密碼</label>
            </div>
            <div class="form-floating">
                <input name="newPass2" type="password" class="form-control" id="PW2" placeholder="Password" required>
                <label for="floatingPassword">再次輸入新密碼</label>
            </div>
            <button onClick="check()" style="margin-top: 20pt;" class="w-100 btn btn-lg btn-primary" type="submit">確認修改密碼</button>
        </form>
        <p class="mt-5 mb-3 text-muted">&copy; 20XX–2022</p>
        
    </main>
<?php
if(!empty($_SESSION['userID']) && !empty($_POST['oldPass']) && !empty($_POST['newPass1']))
{
    require_once("dbtools.inc.php");
    $link=create_connection();
    
    $sql="call update_userAccount(" . $_SESSION['userID'] . "," . $_POST['oldPass'] . "," . $_POST['newPass1'] . ")";
    $result=execute_sql("shoppingdb", $sql, $link);
    if($result==1)
    {
        echo"<script> alert(\"密碼已變更，請重新登入\"); </script>";
    }
    else
    {
        echo"<script> alert(\"舊密碼不正確\"); </script>";
    }
}
?>


</body>
<script>
    function check(){
        if(PW1.value!="" && PW2.value!="" && OPW.value!="")
        {
            if(PW1.value != PW2.value)
            {
                alert("新密碼與再次輸入新密碼不相符");
                event.preventDefault();
            }
        }
    }
</script>
</html>