<?php
require_once("../connection/connection.php");
if (isset($_POST['email']) && $_POST['email'] != null && isset($_POST['password']) && $_POST['password'] != null && isset($_POST['confirm_password']) && $_POST['confirm_password'] != null && $_POST['password'] == $_POST['confirm_password']) {
    $sql = "INSERT INTO users (email, password, created_at) VALUES (:email, :password, :created_at)";
    $sth = $db->prepare($sql);
    $sth->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
    $sth->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
    $sth->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
    $sth->execute();
    $status = "success";
} else {
    $status = "fail";
}

?>

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


            <div class="row m-4 p-4 col-md-6 col-lg-5 justify-content-center bg-light">

                <div class="form-row justify-content-center mb-4">
                    <?php if ($status == 'success') { ?>

                        <h3 class="mb-4">註冊成功!</h3>
                        <p class="text-center">您可前往產品頁面瀏覽商品。</p>
                        <p><a href="store.php">前往購物</a></p>

                    <?php } else { ?>

                        <h3 class="mb-4">註冊失敗</h3>
                        <p class="text-center">Email或密碼錯誤<br>請聯繫客服或前往註冊頁面重新註冊</p>
                        <p><a href="register.php">回註冊頁面</a></p>

                    <?php } ?>
                </div>

            </div>

        </div>

    </div>

    <?php require_once('layouts/footer.php') ?>

</body>

</html>