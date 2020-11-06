<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');
    require_once('functions/check_login.php');

    $query = $db->query("SELECT * FROM customer_orders WHERE customer_orders_id =" . $_GET['order_id']);
    $order = $query->fetch(PDO::FETCH_ASSOC);

    $query = $db->query("SELECT * FROM order_details WHERE customer_orders_id =" . $_GET['order_id']);
    $all_detail = $query->fetchall(PDO::FETCH_ASSOC);


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
                        <li class="breadcrumb-item" aria-current="page"><a href="customer_orders.php">我的訂單</a></li>
                        <li class="breadcrumb-item active" aria-current="page">訂單明細</li>
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


            <div class="table-resposive col-md-12 col-lg-10" style="font-size: 18px;">

                <h5>訂單#<?php echo $order['order_no']; ?></h5>

                <p>如有任何問題請至<a href="contact.php">聯絡我們</a>聯繫我們</p>

                <table class="table bg-light">

                    <tr>
                        <td>圖片</td>
                        <td>商品名稱</td>
                        <td>數量</td>
                        <td>單價</td>
                        <td>商品總額</td>

                    </tr>
                    <?php foreach ($all_detail as $detail) { ?>
                        <tr>
                            <td><img src="<?php echo $detail['header']; ?>" alt="" style="max-width: 6rem;"></td>
                            <td style="vertical-align: middle;"><?php echo $detail['name']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $detail['quantity']; ?></td>
                            <td style="vertical-align: middle;">NT$ <?php echo $detail['price']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $detail['quantity'] * $detail['price']; ?></td>

                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="5" class="text-right pr-5">運費 NT$<?php echo $order['shipping']; ?></td>
                    </tr>

                    <tr>
                        <td colspan="5" class="text-right pl-4 pr-5">
                            <div class="row">
                                <a href="customer_orders.php" class="btn btn-dark" style="font-size: 18px;"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>返回</a>
                                <button id="delete_btn" class="btn btn-danger ml-4" style="font-size: 18px;">取消訂單</button>
                                <div class="ml-auto">
                                    總金額 NT$<?php echo $order['total'] + $order['shipping'] ?>
                                </div>
                            </div>
                        </td>
                    </tr>


                </table>
            </div>

        </div>

    </div>

    <?php require_once('layouts/footer.php') ?>

    <!-- 訊息視窗 -->
    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title ">訊息</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="text-center text-muted">是否要刪除訂單?</p>
                    <a href="functions/delete_order.php?order_id=<?php echo $order['customer_orders_id']; ?>" class="btn btn-dark">確定</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#delete_btn').click(function() {

                $('#info-modal').modal('show');
            });

        });
    </script>
</body>

</html>