<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    //如更改數量 取代成新的數量
    if (isset($_POST['quantity']) && $_POST['quantity'] != null) {
        for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
            $_SESSION['Cart'][$i]['quantity'] = $_POST['quantity'][$i];
        }
        //回傳true跑出modal
        $update = "true";
    }
    ?>

</head>

<body>

    <?php require_once('layouts/navbar.php') ?>

    <!-- content -->
    <div class="container my-4">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">我的購物車</li>
                    </ol>

                </nav>
            </div>

            <?php if (isset($_SESSION['Cart']) && $_SESSION['Cart'] != null) { ?>
                <form class="col-md-12" method="post" action="basket.php">
                    <div class="row">

                        <div class="my-3 col-md-12 col-lg-12">

                            <h4>我的購物車</h4>
                            <p>目前有<?php echo count($_SESSION['Cart']); ?>個未結帳商品</p>
                            <p>*更新數量後請點擊"更新購物車"</p>
                            <div class="table-responsive">
                                <table class="table bg-light table-sm" style="font-size: 18px;">

                                    <thead>
                                        <tr>
                                            <td>圖片</td>
                                            <td>商品名稱</td>
                                            <td colspan="2">數量</td>
                                            <td>單價</td>
                                            <td colspan="2">金額</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        $total = 0;
                                        for ($i = 0; $i < count($_SESSION['Cart']); $i++) { ?>
                                            <tr>
                                                <td>
                                                    <a href="product.php?product=<?php echo $_SESSION['Cart'][$i]['product_id']; ?>"> <img src="<?php echo $_SESSION['Cart'][$i]['header']; ?>" style="max-width: 8rem;"></a>
                                                </td>
                                                <td style="vertical-align: middle;"><?php echo $_SESSION['Cart'][$i]['name'] ?></td>
                                                <td style="vertical-align: middle;">
                                                    <input type="number" name="quantity[]" value="<?php echo $_SESSION['Cart'][$i]['quantity']; ?>" class="form-control " min="1" style="width:75px;">
                                                </td style="vertical-align: middle;">
                                                <td style="vertical-align: middle;"><a href="cart/cart_delete.php?product_id=<?php echo $i; ?>"><i class="fa fa-trash-o fa-2x text-danger" aria-hidden="true"></i></a></td>
                                                <td style="vertical-align: middle;">NT$ <?php echo $_SESSION['Cart'][$i]['price']; ?></td>
                                                <td style="vertical-align: middle;" colspan="2"><?php echo $subtotal = $_SESSION['Cart'][$i]['quantity'] * $_SESSION['Cart'][$i]['price']; ?></td>
                                            </tr>


                                        <?php
                                            $total += $subtotal;
                                        };
                                        $_SESSION['total'] = $total;
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="7">

                                                <h5 class="text-right">商品總額</h5>
                                                <h6 class="text-right total">NT$ <?php echo $total ?></h6>

                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="my-3 col-md-12 col-lg-12">
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-dark col-5 col-md-4 col-lg-3"><i class="fa fa-repeat mr-1" aria-hidden="true"></i>更新購物車</button>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div class="row justify-content-between">

                            <a href="store.php" class="btn btn-light mr-auto col-5 col-md-4 col-lg-3"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>繼續購物</a>


                            <?php if (isset($_SESSION['user']) && $_SESSION['user'] != null) { ?>

                                <a href="checkout1.php" class="btn btn-dark  col-5 col-md-4 col-lg-3">我要結帳<i class="fa fa-chevron-right ml-1" aria-hidden="true"></i></a>

                            <?php } else { ?>

                                <a href="login.php" type="button" class="btn btn-dark col-5 col-md-3 col-lg-3"><i class="fa fa-sign-in mr-1" aria-hidden="true"></i>登入後結帳</a>

                            <?php } ?>



                        </div>
                    </div>

                </form>
            <?php } else { ?>

                <div class="my-5 py-5 col-md-10 col-lg-8">
                    <div class="card my-5 text-center">
                        <div class="card-body">

                            <h5>目前購物車沒有商品，請至<a href="store.php">商品專區</a>進行購物。</h5>

                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

    <?php require_once('layouts/footer.php') ?>

    <!-- 訊息視窗 -->
    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ">訊息</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="text-center text-muted">成功更新數量!</p>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">確定</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 更新訊息 -->
    <?php if (isset($update) && $update != null) { ?>
        <?php if ($update == "true") { ?>
            <script>
                $(function() {
                    $('#info-modal').modal();
                });
            </script>
        <?php } ?>
    <?php } ?>

    <!-- 刪除訊息 -->
    <?php if (isset($_GET['Del']) && $_GET['Del'] != null) { ?>
        <?php if ($_GET['Del'] == "true") { ?>
            <script>
                $(function() {
                    $('.modal-body>p').html('成功移除一個商品!');
                    $('#info-modal').modal();
                    setTimeout(function() {
                        $('#info-modal').modal('hide');
                    }, 2000);
                });
            </script>
        <?php } ?>
    <?php } ?>

    <script>
        $(function() {
            $('input[type="number"]').change(function() {
                $('.total').html($(this).val() * price);


            });

        });
    </script>
</body>

</html>