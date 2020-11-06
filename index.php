<?php
session_start();
require_once('connection/connection.php');

//pre
$query = $db->query('SELECT * FROM products WHERE pre = 1 ORDER BY product_id ASC');
$all_pres = $query->fetchALL(PDO::FETCH_ASSOC);

//new
$query = $db->query('SELECT * FROM products WHERE new = 1 ORDER BY product_id ASC');
$all_news = $query->fetchALL(PDO::FETCH_ASSOC);

//special
$query = $db->query('SELECT * FROM products WHERE special = 1 ORDER BY product_id ASC LIMIT 6');
$all_specials = $query->fetchALL(PDO::FETCH_ASSOC);

//news
$query = $db->query('SELECT * FROM news ORDER BY created_at DESC LIMIT 3');
$All_news = $query->fetchALL(PDO::FETCH_ASSOC);

//categories
$query = $db->query('SELECT * FROM categories ORDER BY category_id ASC');
$all_categories = $query->fetchALL(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GAMEBOOK</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">

    <!-- flickity -->
    <link rel="stylesheet" href="css/flickity.min.css" type="text/css">

    <!-- gamebook.css -->
    <link rel="stylesheet" href="css/gamebook.css" type="text/css">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />

    <style>
        .navbar li {
            font-size: 18px;

        }
    </style>

</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-xl navbar-light bg-light ">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="GAMEBOOK" style="max-width: 10rem; position:relative; top: 7px;">
            </a>
            <button class="navbar-toggler navbar-toggler-right " data-toggle="collapse" data-target="#collapse1">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapse1">

                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item"> <a class="nav-link" href="web/about.php">關於我們</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#news">最新消息</a> </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">遊戲商店</a>
                        <div class="dropdown-menu">
                            <?php foreach ($all_categories as $category) { ?>
                                <a class="dropdown-item" href="web/store.php?category=<?php echo $category['category_id']; ?>" style="font-size: 16px;"><?php echo $category['category']; ?></a>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="web/contact.php">聯絡我們</a> </li>
                </ul>

                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user']) && $_SESSION != null && $_SESSION['user'] != 'none') { ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="w" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;"><?php echo $_SESSION['user']['email'] ?>您好</a>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="web/customer_orders.php" style="font-size: 16px;">會員專區</a>
                                <a class="dropdown-item" href="web/functions/logout.php" style="font-size: 16px;">登出</a>

                            </div>
                        </li>


                    <?php } else { ?>

                        <li class="nav-item"> <a class="nav-link" href="web/login.php"><i class="fa fa-user mr-1 fa-lg"></i>登入/註冊</a>
                        </li>

                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="web/basket.php">
                            <i class="fa fa-shopping-cart fa-lg mr-1"></i>(<?php
                                                                            if (isset($_SESSION['Cart']) && $_SESSION['Cart'] != null) {
                                                                                echo count($_SESSION['Cart']);
                                                                            } else {
                                                                                echo 0;
                                                                            }
                                                                            ?>)
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- banner  -->

    <div id="banner">
        <div class="p-0 container-fluid">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol> -->
                <div class="carousel-inner ">
                    <?php foreach ($all_pres as $pre) { ?>
                        <?php if ($pre['price'] == 1340) { ?>
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="uploads/products/<?php echo $pre['folder']; ?>/<?php echo $pre['header']; ?>" alt="" style="max-height: 93vh;">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="info">

                                        <a class="btn btn-lg" href="web/product.php?product=<?php echo $pre['product_id']; ?>">搶先預購</a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="uploads/products/<?php echo $pre['folder']; ?>/<?php echo $pre['header']; ?>" alt="" style="max-height: 93vh;">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="info">
                                        <a class="btn btn-lg" href="web/product.php?product=<?php echo $pre['product_id']; ?>">搶先預購</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>


                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- banner End -->

            <!-- new flickity -->
            <div class="main mx-auto" data-flickity='{ "wrapAround": true ,"autoPlay": true, "pageDots": false}'>
                <?php foreach ($all_news as $new) { ?>
                    <div class="cell bg-light">
                        <a href="web/product.php?product=<?php echo $new['product_id']; ?>"> <img src="uploads/products/<?php echo $new['folder']; ?>/<?php echo $new['header'] ?>" alt=""></a>
                        <div><?php echo $new['name'] ?></div>
                        <div>NT$ <?php echo $new['price'] ?></div>
                    </div>
                <?php } ?>


            </div>

        </div>
    </div>

    <!-- new flickity end -->
    <!-- hot -->
    <div id="hot">
        <div class="container">
            <div class="row mt-5">

                <div class="col-md-12 text-center">
                    <h3>特惠</h3>
                    <div class="col-md-12 d-flex justify-content-end "><a class="btn btn-sm btn-outline-dark" href="web/store.php?category=discount">More</a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center d-flex flex-wrap">

                <?php foreach ($all_specials as $special) {
                    $original_price = $special['price'] * 1.5;
                ?>

                    <div class="card m-2 p-2 col-10 col-md-5 col-lg-3 col-xl-3">
                        <a href="web/product.php?product=<?php echo $special['product_id']; ?>"><img class="card-img-top" src="uploads/products/<?php echo $special['folder']; ?>/<?php echo $special['header'] ?>" alt="Card image cap"></a>
                        <div class="row card-body justify-content-center">
                            <h5 class="card-text my-3 col-md-12"><?php echo $special['name']; ?></h5>
                            <p class="text-right col-md-12"><del>NT$ <?php echo $original_price; ?></del></p>
                            <p class="text-right col-md-12">NT$ <?php echo $special['price']; ?></p>
                            <a href="web/product.php?product=<?php echo $special['product_id']; ?>"><button class="btn btn-dark btn-sm col-12 align-self-end">立即購買</button></a>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
    <!-- hot End -->

    <!-- news -->
    <div id="news" class="py-3">
        <div class="container">
            <div class="row">

                <div class="col-md-12 my-3 text-center">
                    <h3>最新消息</h3>
                    <div class="col-md-12 d-flex justify-content-end d-inline"><a class="btn btn-sm btn-outline-dark" href="web/news_list.php">More</a>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">

                    <?php foreach ($All_news as $news) { ?>
                        <div class="row justify-content-between shadow my-3">

                            <div class="col-sm-12 col-md-12 col-lg-3 pt-2">
                                <div class="row justify-content-center">
                                    <a href="web/news.php?news_id=<?php echo $news['news_id']; ?>" class="m-3"><img class="img-fluid mx-auto " src="uploads/news/<?php echo $news['picture']; ?>" style="width: 200px;"></a>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-9">
                                <div class="row justify-content-center px-3">
                                    <h5 class="mt-4"><?php echo $news['title']; ?></h5>
                                    <small class="col-md-12"><?php echo substr($news['content'], 0, 140); ?></small>

                                </div>
                                <div class="col-lg-12">
                                    <div class="row justify-content-end m-3">
                                        <a href="web/news.php?news_id=<?php echo $news['news_id']; ?>" class="btn btn-sm btn-dark" style="font-size: 14px;">繼續閱讀</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>

            </div>

        </div>
    </div>

    <!-- news End -->

    <!-- partner -->
    <div id="partner" class="text-center py-3 my-4">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-md-8">
                    <h5 class=""><b>合作夥伴</b></h5>
                    <div class="row text-muted my-4 d-flex align-items-center justify-content-center flex-grow-1">
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-amazon fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-cc-paypal fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-github-alt fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-paypal fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-github fa-2x"></i> </div>
                        <div class="col-md-2 col-4 mb-4"> <i class="d-block fa fa-steam fa-2x"></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partner end -->

    <!-- feature -->
    <div id="feature" class="py-3 my-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5 class="text-center"><b>選擇我們的理由</b></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 p-3 col-6 col-md-6 col-sm-6"> <i class="d-block fa text-muted fa-cc-visa fa-3x"></i>
                    <h5 class="my-3"><b>付款</b></h5>
                    <small>超過10種以上付款方式</small>
                </div>
                <div class="col-lg-3 col-6 p-3 col-sm-6 col-md-6"> <i class="d-block fa fa-3x mb-2 text-muted fa-gamepad"></i>
                    <h5 class="my-3"> <b>遊戲</b></h5>
                    <small>大量遊戲正在等著你</small>
                </div>
                <div class="col-lg-3 col-6 p-3 col-sm-6 col-md-6"> <i class="d-block fa mb-2 text-muted fa-money fa-3x"></i>
                    <h5 class="my-3"> <b>便宜</b></h5>
                    <small>更便宜的價格</small>
                </div>
                <div class="col-lg-3 col-6 p-3 col-sm-6 col-md-6"> <i class="d-block fa fa-3x mb-2 text-muted fa-users"></i>
                    <h5 class="my-3"><b>社群</b></h5>
                    <small>和你一起遊玩的廣大玩家</small>
                </div>
            </div>
        </div>
    </div>
    <!-- feature end -->


    <!-- follow -->
    <div id="follow" class="text-center py-3 my-4">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-md-6">
                    <h5 class="mb-4"><b>追隨我們</b></h5>
                    <div class="row">
                        <div class="d-flex col-md-12 flex-grow-1 justify-content-between col-12 col-sm-12 col-lg-12 icon">
                            <a href="https://twitch.com/" target="blank">
                                <i class="d-block fa fa-twitch text-muted fa-3x"></i>
                            </a>
                            <a href="https://www.youtube.com/" target="blank">
                                <i class="d-block fa fa-youtube-play text-muted fa-3x"></i>
                            </a>
                            <a href="https://www.facebook.com/" target="blank">
                                <i class="d-block fa fa-facebook-official text-muted fa-3x"></i>
                            </a>
                            <a href="https://www.instagram.com/" target="blank">
                                <i class="d-block fa fa-instagram text-muted fa-3x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- follow end -->

    <div id="footer" class="row mx-0 mt-5 bg-light">
        <div class="col-md-12 ">
            <div class="row justify-content-center">

                <div class="col-10 col-md-4 mx-0 pt-3 pl-5">
                    <a href="index.php"><img class="mb-2" src="img/logo.png" alt="GAMEBOOK" style="max-width: 10rem; position:relative; top: 7px;"></a>
                    <br>
                    <small>GAMEBOOK 提供整合遊戲平台，包括購買、販售、行銷、社群等等遊戲整合服務。</small>
                </div>

                <div class="col-10 col-md-3 pt-4 pl-5">
                    <h5>商品分類</h5>
                    <div class="d-flex flex-wrap" style="height: 140px; flex-direction:column;">
                        <a href="web/store.php" class="text-dark" style="list-style-type:none;">
                            <li><small>全部</small></li>
                        </a>
                        <a href="web/store.php?category=discount" class="text-dark" style="list-style-type:none;">
                            <li><small>特惠</small></li>
                        </a>
                        <?php foreach ($all_categories as $category) { ?>
                            <a href="web/store.php?category=<?php echo $category['category_id']; ?>" class="text-dark" style="list-style-type:none;">
                                <li><small><?php echo $category['category']; ?></small></li>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-10 col-md-5 mx-0 pt-4 pl-5">
                    <div class="ml-3">
                        <h5 class="ml-1">聯絡我們</h5>

                        <div class="row my-2">
                            <i class="fa fa-phone mr-2" aria-hidden="true"></i>
                            <small>03-4581196</small>
                        </div>

                        <div class="row my-2">
                            <i class="fa fa-envelope mr-2" aria-hidden="true"></i>
                            <small>gamebook@gmail.com</small>
                        </div>

                        <div class="row my-2">
                            <i class="fa fa-sun-o mr-2" aria-hidden="true"></i>
                            <small>08:50-18:00 (例假日休)</small>
                        </div>

                        <div class="row my-2">
                            <i class="fa fa-home mr-2" aria-hidden="true"></i>
                            <small>320桃園市中壢區健行路229號</small>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="footer py-2 col-md-12 bg-dark text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <small class="mb-0">© 2020 GAMEBOOK. All rights reserved</ㄋ>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 登入視窗 -->
    <div class="modal fade" id="login_info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title ">登入成功!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="text-center text-muted">前往<a href="web/store.php">遊戲商店</a>或<a href="web/customer_orders.php">會員專區</a></p>
                    <button id="login_success_btn" class="btn btn-dark" style="font-size: 18px;">確定</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 登出視窗 -->
    <div class="modal fade" id="logout_info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title ">登出成功!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <button id="logout_success_btn" class="btn btn-dark" style="font-size: 18px;">確定</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- flickity -->
    <script src="js/flickity.pkgd.min.js"></script>
    <!-- jarallax -->
    <script src="js/jarallax-0.2.4b.js"></script>

    <script>
        $(window).load(function() {
            // init flickity
            $(".main").flickity();

            //login_success
            <?php if ($_GET['msg'] == 'login_success' && $_GET['msg'] != null) { ?>
                $('#login_info-modal').modal('show');
            <?php } ?>

            $('#login_success_btn').click(function() {
                $('#login_info-modal').modal('hide');
            });

            <?php if ($_GET['msg'] == 'logout_success' && $_GET['msg'] != null) { ?>
                $('#logout_info-modal').modal('show');
            <?php } ?>

            $('#logout_success_btn').click(function() {
                $('#logout_info-modal').modal('hide');
            });

        });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5eddb1d59e5f694422901745/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>