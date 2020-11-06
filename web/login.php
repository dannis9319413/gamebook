<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once('layouts/head.php');

    ?>

</head>

<body>

    <?php require_once('layouts/navbar.php'); ?>

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


            <form class="row m-4 p-4 col-md-6 col-lg-5 justify-content-center bg-light" method="post" action="functions/check_user.php">

                <div class="form-row justify-content-center mb-3">

                    <h3 class="mb-4">會員登入</h3>

                    <div class="form-group col-12 ">
                        <input type="email" class="form-control" name="email" placeholder="請輸入Eamil">
                    </div>

                    <div class="form-group col-12">
                        <input type="password" class="form-control" name="password" placeholder="請輸入密碼">
                    </div>

                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'none') { ?>
                        <div class="alert alert-danger col-12" role="alert">
                            帳號或密碼錯誤 !
                        </div>

                    <?php
                        unset($_SESSION['user']);
                    } ?>
                    <button type="submit" class="btn btn-dark col-12">登入</button>

                </div>

                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div><a class="text-info col-md-12" href="register.php">還沒註冊嗎?</a>
                        </div>

                        <div><a class="text-info col-md-12" href="../admin/login.php">管理員登入</a>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>

    <?php require_once('layouts/footer.php') ?>

</body>

</html>