<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    $_SESSION['shipping'] = $_POST['shipping'];

    ?>


</head>

<body>

    <?php require_once('layouts/navbar.php') ?>


    <!-- content -->
    <div class="container my-4">
        <div class="row">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="checkout1.php">結帳 - 填寫收件者資料</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="checkout2.php">結帳 - 選擇運送方式</a></li>
                        <li class="breadcrumb-item active" aria-current="page">結帳 - 確認訂單</li>
                    </ol>

                </nav>
            </div>


            <form class="my-3 col-md-12" method="post" action="order_success.php">
                <div class="row">

                    <div class="col-md-12 col-lg-12">

                        <h4>確認訂單</h4>

                        <div class="table-responsive">
                            <table class="table bg-light table-sm" style="font-size: 18px;">

                                <thead>
                                    <tr>
                                        <td>圖片</td>
                                        <td>產品名稱</td>
                                        <td>數量</td>
                                        <td>單價</td>
                                        <td>金額</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php for ($i = 0; $i < count($_SESSION['Cart']); $i++) { ?>
                                        <tr>
                                            <td>
                                                <a href="product.php?product=<?php echo $_SESSION['Cart'][$i]['product_id'] ?>">
                                                    <img src="<?php echo $_SESSION['Cart'][$i]['header']; ?>" style="max-width: 8rem;">
                                                </a>
                                            </td>
                                            <td style="vertical-align:middle;"><?php echo $_SESSION['Cart'][$i]['name']; ?></td>
                                            <td style="vertical-align:middle;">
                                                <?php echo $_SESSION['Cart'][$i]['quantity']; ?>
                                            </td>
                                            <td style="vertical-align:middle;">NT$ <?php echo $_SESSION['Cart'][$i]['price']; ?></td>
                                            <td style="vertical-align:middle;">NT$ <?php echo $_SESSION['Cart'][$i]['quantity'] * $_SESSION['Cart'][$i]['price']; ?></td>
                                        </tr>
                                    <?php }; ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-right">商品總額</h5>
                                            <h6 class="text-right">NT$ <?php echo $_SESSION['total']; ?></h6>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                    </div>


                    <div class="col-md-12 col-lg-12">
                        <div class="row">

                            <div class="col-md-12 col-lg-8">
                                <h4>運送方式:</h4>
                                <?php if ($_SESSION['shipping'] == 80) { ?>
                                    <h5>超商取貨付款 NT$ 80</h5>
                                <?php } else { ?>
                                    <h5>黑貓宅配 NT$ 150</h5>
                                <?php } ?>
                                <div class="mt-3">
                                    <p>*購物滿3000免運費，只限台灣本島，離島需加上稅金與運費</p>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <table class="table table-sm text-center bg-light">
                                    <tr>
                                        <td>
                                            商品總額
                                        </td>
                                        <td>
                                            NT$ <?php echo $_SESSION['total']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>運費</td>
                                        <td>NT$ <?php echo $_SESSION['shipping']; ?></td>

                                    </tr>
                                    <tr>
                                        <td>總金額</td>
                                        <td>NT$ <?php echo $_SESSION['total'] + $_SESSION['shipping'] ?></td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                    </div>

                    <div class="px-4 col-md-12">
                        <div class="row justify-content-between">
                            <a href="checkout2.php" class="btn btn-light col-5 col-md-3 col-lg-3"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>上一頁</a>
                            <button type="submit" class="btn btn-dark col-5 col-md-3 col-lg-3">確定結帳<i class="fa fa-chevron-right ml-1" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <!-- 產生訂單編號與日期 -->
                    <input type="hidden" name="order_no" value="<?php echo "GB" . date("YmdHis") ?>">
                    <input type="hidden" name="order_date" value="<?php echo date("Y-m-d H:i:s") ?>">

                </div>
            </form>

        </div>
    </div>

    <?php require_once('layouts/footer.php') ?>

</body>

</html>