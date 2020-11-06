<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    $is_existed = false;

    // 確認資料是否重複
    if (isset($_SESSION['cart_info']) &&  $_SESSION['cart_info'] != null) {
        $is_existed = true;
    }

    //接收收件者資料放入陣列
    if ($is_existed == false) {
        $temp['name']     = $_POST['name'];
        $temp['mobile']   = $_POST['mobile'];
        $temp['email']    = $_POST['email'];
        $temp['zip']      = $_POST['zipcode'];
        $temp['county']   = $_POST['county'];
        $temp['district'] = $_POST['district'];
        $temp['address']  = $_POST['address'];
        //陣列資料放入Session Cart中
        $_SESSION['cart_info'][] = $temp;
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
                        <li class="breadcrumb-item" aria-current="page"><a href="checkout1.php">結帳 - 填寫收件者資料</a></li>
                        <li class="breadcrumb-item active" aria-current="page">結帳 - 選擇運送方式</li>
                    </ol>

                </nav>
            </div>


            <form class="my-3 col-lg-12" method="post" action="checkout3.php">
                <div class="row">

                    <h4 class="text-center mb-4 col-lg-8"><i class="fa fa-truck mr-2" aria-hidden="true"></i>選擇運送方式</h4>

                    <div class="col-lg-8">
                        <div class="row justify-content-center">

                            <?php if (isset($_SESSION['Cart']) && $_SESSION['Cart'] != null) { ?>
                                <?php if ($_SESSION['total'] >= 3000) { ?>

                                    <div class="card col-10 col-md-8 col-lg-5" style="width: 15rem;">
                                        <img src="../img/payment/shop.jpg" class="card-img-top my-4" alt="">
                                        <div class="card-body">
                                            <br>

                                            <input id="shop" type="radio" name="shipping" value="0" checked>超商取貨付款 NT$80</input>
                                        </div>
                                    </div>

                                    <div class="card col-10 col-md-8 col-lg-6" style="width: 15rem;">
                                        <div class="row justify-content-center">
                                            <img src="../img/payment/black_cat.jpg" class="card-img-top" alt="" style="max-width: 15rem;">
                                            <div class="card-body">
                                                <input id="cat" type="radio" name="shipping" value="0">貨到付款 NT$150</input>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 p-3 col-md-12">
                                        <p>*購物滿3000免運費，只限台灣本島，離島需加上稅金與運費</p>
                                    </div>

                                <?php } else { ?>

                                    <div class="card col-10 col-md-8 col-lg-5" style="width: 15rem;">
                                        <img src="../img/payment/shop.jpg" class="card-img-top my-4" alt="">
                                        <div class="card-body">
                                            <input id="shop" type="radio" name="shipping" value="80" checked>超商取貨付款 NT$80</input>
                                        </div>
                                    </div>

                                    <div class="card col-10 col-md-8 col-lg-5" style="width: 15rem;">
                                        <div class="row justify-content-center">
                                            <img src="../img/payment/black_cat.jpg" class="card-img-top" alt="" style="max-width: 15rem;">
                                            <div class="card-body">
                                                <input id="cat" type="radio" name="shipping" value="150">貨到付款 NT$150</input>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <p>*購物滿3000免運費，只限台灣本島，離島需加上稅金與運費</p>
                                    </div>
                                <?php } ?>
                            <?php } ?>

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
                                <?php if ($_SESSION['total'] >= 3000) { ?>
                                    <td id="shipping">NT$ 0</td>
                                <?php } else { ?>
                                    <td id="shipping">NT$ 80</td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>總金額</td>
                                <?php if ($_SESSION['total'] >= 3000) { ?>
                                    <td id="final_total">NT$ <?php echo $_SESSION['total'] ?></td>
                                <?php } else { ?>
                                    <td id="final_total">NT$ <?php echo $_SESSION['total'] + 80; ?></td>
                                <?php } ?>

                            </tr>
                        </table>
                    </div>

                    <div class="px-4 col-md-12">
                        <div class="row justify-content-between">
                            <a href="checkout1.php" class="btn btn-light col-4 col-md-3 col-lg-2"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>上一頁</a>
                            <button type="submit" class="btn btn-dark col-4 col-md-3 col-lg-2">下一步<i class="fa fa-chevron-right ml-1" aria-hidden="true"></i></button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <?php require_once('layouts/footer.php') ?>

    <script>
        $(function() {

            var total = parseInt(<?php echo $_SESSION['total']; ?>)

            $('input[name="shipping"]').change(function() {

                var shipping = parseInt($(this).val());
                $('#shipping').html('NT$ ' + shipping);
                var final_total = total + shipping;
                $('#final_total').html('NT$ ' + final_total);

            });

        })
    </script>
</body>

</html>