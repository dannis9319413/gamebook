<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once('layouts/head.php') ?>

</head>

<body>

    <?php require_once('layouts/navbar.php') ?>


    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav class="my-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">登入&註冊</li>
                    </ol>
                </nav>
            </div>


            <form class="row m-4 p-4 col-md-6 col-lg-5 justify-content-center bg-light" method="post" action="register_success.php">

                <div class="form-row justify-content-center mb-4">

                    <h3 class="mb-4">會員註冊</h3>

                    <div class="form-group col-12 ">
                        <input type="email" class="form-control" name="email" placeholder="請輸入Eamil">
                    </div>

                    <div class="form-group col-12">
                        <input type="password" class="form-control" name="password" placeholder="請輸入密碼">
                    </div>

                    <div class="form-group col-12">
                        <input type="password" class="form-control" name="confirm_password" placeholder="再次輸入密碼">
                    </div>

                    <!-- 產生時間 -->
                    <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>"></input>

                    <button type="submit" class="btn btn-dark col-12">註冊</button>

                </div>

                <p><a class="text-info" href="login.php">已經註冊了?</a></p>

            </form>

        </div>

    </div>


    <?php require_once('layouts/footer.php') ?>


</body>

</html>