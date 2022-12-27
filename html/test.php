<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
        <script src="../jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tw-city-selector@2.1.1/dist/tw-city-selector.min.js"></script>
    </head>
    <body>
        <form method="post" action="">
        <div class="city-selector-set">
        <select class="county form-select"></select>
        <select class="district form-select"></select>
            <button type="submit">go</button>
        </form>
</div>
        <?php
            if(!empty($_POST["county"]) and !empty($_POST["district"]))
            {
                echo $_POST["county"];
                echo $_POST["district"];
                require_once("dbtools.inc.php");
	
                //指定每頁顯示幾筆記錄
                //$records_per_page = 20;
                
                $link=create_connection();
                
                
                //$sql="SELECT * FROM orders";
                $sql="call insert_orders('','','','','','')";
                $result=execute_sql("shoppingdb", $sql, $link);
                
                echo "總共: ".mysql_num_rows($result). " 筆";  //取得記錄數
                
                mysql_close($link);
            }
            
        ?>

        <script>
            new TwCitySelector({
                el: '.city-selector-set',
                elCounty: '.county',
                elDistrict: '.district',
                countyFiledName: 'county',
                districtFieldName: 'district'
            });
        </script>
    </body>
</html>