<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once('layouts/head.php');
    require_once('functions/check_login.php');

    $query = $db->query("SELECT * FROM users WHERE user_id = " . $_SESSION['user']['user_id']);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    ?>

</head>

<style>
    .list-group>a {
        padding: 15px 0;
    }
</style>

<body>

    <?php require_once('layouts/navbar.php'); ?>


    <!-- content -->
    <div class="container">

        <div class="row">


            <div class="my-3 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">會員資料</li>
                    </ol>
                </nav>
            </div>


            <div class="mb-4 col-md-12 col-lg-2 text-center" style="font-size:18px;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action disabled bg-light">
                        <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i>會員專區
                    </a>
                    <a href="customer_orders.php" class="list-group-item list-group-item-action"><i class="fa fa-list mr-1" aria-hidden="true"></i>我的訂單</a>
                    <a href="customer_account.php" class="list-group-item list-group-item-action bg-dark text-light"><i class="fa fa-user mr-1" aria-hidden="true"></i>會員資料</a>
                    <a href="functions/logout.php" class="list-group-item list-group-item-action"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>登出</a>
                </div>
            </div>

            <div class="col-lg-10" style="font-size: 20px;">

                <h4>會員資本資料</h4>
                <small>編輯您的會員資料</small>
                <br>
                <small>此資料提供我們寄送商品資訊，請務必填寫真實資料</small>
                <p></p>
                <h5>變更密碼</h5>
                <?php if (isset($_GET['msg'])) { ?>
                    <?php if ($_GET['msg'] == 'success' && $_GET['msg'] != null) { ?>
                        <div class="alert alert-success">
                            <strong>密碼更新成功</strong>
                        </div>
                    <?php } else if ($_GET['msg'] == 'error' && $_GET['msg'] != null) { ?>
                        <div class="alert alert-danger">
                            <strong>舊密碼或新密碼錯誤</strong>
                        </div>

                    <?php } ?>
                <?php } ?>

                <form method="post" action="functions/change_password.php">

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="old_password">舊密碼</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="new_password">新密碼</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="confirm_password">再次輸入新密碼</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">更改密碼</button>

                </form>

                <h5 class="my-4">個人資料</h5>
                <?php if (isset($_GET['change_info'])) { ?>
                    <div class="alert alert-success">
                        <strong>個人資料更新成功!</strong>
                    </div>
                <?php } ?>
                <form method="post" action="functions/change_info.php">

                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="name">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                        </div>
                        <div class="form-group ml-3 col-md-4">
                            <label>性別</label>
                            <div>
                                <label><input id="man" type="radio" name="gender" name="1" value="1" checked>男</label>
                                <label><input id="woman" type="radio" name="gender" name="0" value="0">女</label>
                            </div>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="phone">家用電話</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile">行動電話</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>">
                        </div>
                    </div>


                    <div id="twzipcode" class="form-row">
                        
                        <div class="form-group col-md-2">
                            <label for="zipcode">郵遞區號</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="county">縣市</label>
                            <select id="county" class="form-control" name="county">
                                <option selected></option>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="district">區域</label>
                            <select type="text" class="form-control" id="district" name="district"></select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">更新資料</button>


                </form>



            </div>

        </div>

    </div>

    <?php require_once('layouts/footer.php') ?>

    <!-- twzipcode -->
    <script src="../js/jquery.twzipcode.min.js"></script>
    <script>
        $(function() {
            $("#twzipcode").twzipcode({
                'zipcodeSel': '<?php echo $user['zip']; ?>',
                'countySel': '<?php echo $user['county']; ?>',
                'districtSel': '<?php echo $user['district']; ?>'
            });

            $('#twzipcode').find('select[name="county"]').eq(1).remove();
            $('#twzipcode').find('select[name="district"]').eq(1).remove();
            $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();

            var gender = <?php echo $user['gender']; ?>;
            if (gender == 1) {
                $("#man").attr('checked', 'cheacked');
            } else {
                $("#woman").attr('checked', 'cheacked');
            }

        })
    </script>


</body>

</html>