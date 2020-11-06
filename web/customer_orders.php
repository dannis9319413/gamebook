<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');
    require_once('functions/check_login.php');

    $query = $db->query("SELECT * FROM customer_orders WHERE user_id =" . $_SESSION['user']['user_id'] . " ORDER BY created_at DESC");
    $all_order = $query->fetchall(PDO::FETCH_ASSOC);


    ?>

    <style>
        .list-group>a {
            padding: 15px 0;
        }
    </style>

</head>

<body>

    <?php require_once('layouts/navbar.php') ?>

    <!-- content -->
    <div class="container">

        <div class="row">


            <div class="my-3 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">我的訂單</li>
                    </ol>
                </nav>
            </div>


            <div class="mb-4 col-md-12 col-lg-2 text-center" style="font-size: 18px;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action disabled bg-light">
                        <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i>會員專區
                    </a>
                    <a href="customer_orders.php" class="list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-list mr-1" aria-hidden="true"></i>我的訂單</a>
                    <a href="customer_account.php" class="list-group-item list-group-item-action"><i class="fa fa-user mr-1" aria-hidden="true"></i>會員資料</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>登出</a>
                </div>
            </div>

            <?php if (count($all_order) >= 1) { ?>
                <div class="table-resposive col-md-12 col-lg-10" style="font-size: 16px;">
                    <table class="table bg-light">

                        <h5>以下是您的訂單</h5>
                        <p>如有任何問題請至<a href="contact.php">聯絡我們</a>聯繫我們</p>

                        <tr>
                            <td>訂單編號</td>
                            <td>購買日期</td>
                            <td>總金額</td>
                            <td>訂單狀態</td>
                            <td>訂單明細</td>
                        </tr>


                        <?php foreach ($all_order as $order) { ?>
                            <tr class="my-3">
                                <td><?php echo $order['order_no'] ?></td>
                                <td><?php echo $order['order_date'] ?></td>
                                <td>NT$ <?php echo $order['total'] + $order['shipping']; ?></td>

                                <td>
                                    <?php if ($order['status'] == 1) { ?>
                                        <span class="badge badge-success" style="font-size: 17px;">
                                        <?php } else { ?>
                                            <span class="badge badge-primary" style="font-size: 17px;">
                                            <?php } ?>
                                            <?php switch ($order['status']) {
                                                case 0:
                                                    echo '未付款';
                                                    break;
                                                case 1:
                                                    echo '已付款';
                                                    break;
                                                case 2:
                                                    echo '已出貨';
                                                    break;
                                                case 3:
                                                    echo '交易完成';
                                                    break;
                                                case 99:
                                                    echo '取消訂單	';
                                                    break;
                                            } ?>

                                            </span></td>
                                <td><a href="customer_order.php?order_id=<?php echo $order['customer_orders_id'] ?>" class="badge badge-info" style="font-size: 17px;">查看明細</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } else { ?>
                <div class="col-md-12 col-lg-9">
                    <h5>目前沒有任何訂單，請至<a href="store.php">遊戲商店</a>選購您的商品。</h5>
                </div>
            <?php } ?>

        </div>

    </div>

    <?php require_once('layouts/footer.php') ?>

</body>

</html>