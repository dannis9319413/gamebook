<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

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
                        <li class="breadcrumb-item active" aria-current="page">結帳 - 填寫收件者資料</li>
                    </ol>

                </nav>
            </div>


            <form class="col-lg-8" method="post" action="checkout2.php">

                <h5 class="my-4">填寫收件者資料</h5>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['user']['name']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mobile">行動電話</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $_SESSION['user']['mobile']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
                </div>



                <div id="twzipcode" class="form-row">
                    <div class="form-group col-md-2">
                        <label for="zipcode">郵遞區號</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="county">縣市</label>
                        <select id="county" class="form-control" name="county">
                            <option selected></option>

                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="district">區域</label>
                        <select type="text" class="form-control" id="district" name="district"></select>
                    </div>

                </div>

                <div class="form-group">
                    <label for="address">地址</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $_SESSION['user']['address']; ?>">
                </div>

                <div class="col-md-12">
                    <div class="row justify-content-between">
                        <a href="basket.php" class="btn btn-light col-5 col-md-3 col-lg-3"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>上一頁</a>
                        <button type="submit" class="btn btn-dark col-5 col-md-3 col-lg-3">下一步<i class="fa fa-chevron-right ml-2" aria-hidden="true"></i></button>
                    </div>
                </div>

            </form>

        </div>

    </div>


    <?php require_once('layouts/footer.php') ?>

    <!-- twzipcode -->
    <script src="../js/jquery.twzipcode.min.js"></script>
    <script>
        $(function() {
            $("#twzipcode").twzipcode({
                'zipcodeSel': '<?php echo $_SESSION['user']['zip']; ?>',
                'countySel': '<?php echo $_SESSION['user']['county']; ?>',
                'districtSel': '<?php echo $_SESSION['user']['district']; ?>'
            });

            $('#twzipcode').find('select[name="county"]').eq(1).remove();
            $('#twzipcode').find('select[name="district"]').eq(1).remove();
            $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();
        })
    </script>
</body>

</html>