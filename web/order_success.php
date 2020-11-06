<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');


    $sql = "INSERT INTO customer_orders (order_no, order_date, user_id, total, shipping, name, mobile, zip, county, district, address, created_at) VALUES (  :order_no, :order_date, :user_id, :total, :shipping, :name, :mobile, :zip, :county, :district, :address, :created_at)";
    $sth = $db->prepare($sql);

    $sth->bindParam(":order_no", $_POST['order_no'], PDO::PARAM_STR);
    $sth->bindParam(":order_date", $_POST['order_date'], PDO::PARAM_STR);
    $sth->bindParam(":user_id", $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $sth->bindParam(":total", $_SESSION['total'], PDO::PARAM_STR);
    $sth->bindParam(":shipping", $_SESSION['shipping'], PDO::PARAM_STR);
    $sth->bindParam(":name", $_SESSION['cart_info'][0]['name'], PDO::PARAM_STR);
    $sth->bindParam(":mobile", $_SESSION['cart_info'][0]['mobile'], PDO::PARAM_STR);
    $sth->bindParam(":zip", $_SESSION['cart_info'][0]['zip'], PDO::PARAM_STR);
    $sth->bindParam(":county", $_SESSION['cart_info'][0]['county'], PDO::PARAM_STR);
    $sth->bindParam(":district", $_SESSION['cart_info'][0]['district'], PDO::PARAM_STR);
    $sth->bindParam(":address", $_SESSION['cart_info'][0]['address'], PDO::PARAM_STR);
    $sth->bindParam(":created_at", $_POST['order_date'], PDO::PARAM_STR);
    $sth->execute();

    //刪除資料避免重新整理重複寫入資料庫
    unset($_POST['order_no']);
    unset($_POST['order_date']);
    unset($_SESSION['total']);
    unset($_SESSION['shipping']);
    unset($_SESSION['cart_info']);


    //取出最新訂單
    $query = $db->query("SELECT * FROM customer_orders ORDER BY created_at DESC");
    $customer_order = $query->fetch(PDO::FETCH_ASSOC);

    //寫入訂單明細
    for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
        $sql2 = "INSERT INTO order_details (customer_orders_id, product_id, header, name, price, quantity, created_at) VALUES ( :customer_orders_id, :product_id, :header, :name, :price, :quantity, :created_at)";
        $sth2 = $db->prepare($sql2);
        $sth2->bindParam(":customer_orders_id", $customer_order['customer_orders_id'], PDO::PARAM_INT);
        $sth2->bindParam(":product_id", $_SESSION['Cart'][$i]['product_id'], PDO::PARAM_STR);
        $sth2->bindParam(":header", $_SESSION['Cart'][$i]['header'], PDO::PARAM_STR);
        $sth2->bindParam(":name", $_SESSION['Cart'][$i]['name'], PDO::PARAM_STR);
        $sth2->bindParam(":price", $_SESSION['Cart'][$i]['price'], PDO::PARAM_STR);
        $sth2->bindParam(":quantity", $_SESSION['Cart'][$i]['quantity'], PDO::PARAM_STR);
        $sth2->bindParam(":created_at", $_POST['order_date'], PDO::PARAM_STR);
        $sth2->execute();
    }

    unset($_SESSION['Cart']);

    ?>

</head>

<body>

    <?php require_once('layouts/navbar.php') ?>

    <!-- content -->
    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">我的購物車</li>
                    </ol>

                </nav>
            </div>


            <div class="my-4 col-md-10 col-lg-6">
                <div class="card text-center">
                    <div class="card-body row justify-content-center">
                        <img class="col-md-6" src="../img/gamebook.png" alt="">

                        <small class="card-text my-3 col-md-8">您已成功完成購物，您可前往我的<a href="customer_orders.php">訂單查詢</a>出貨進度或<a href="store.php"> 繼續購物</a></small>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('layouts/footer.php') ?>

</body>

</html>