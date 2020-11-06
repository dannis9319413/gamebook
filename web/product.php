<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    $query = $db->query('SELECT * FROM products WHERE product_id  = ' . $_GET['product']);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    ?>

    <style>
        #content img {
            width: 100%;
        }
    </style>
</head>

<body>

    <?php require_once('layouts/navbar.php'); ?>

    <!-- content -->
    <div class="container my-3">
        <div class="row">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item"><a href="store.php">商店</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></li>
                    </ol>

                </nav>
            </div>


            <div class="mb-3 col-md-12 col-lg-2">
                <div class="list-group " style="font-size: 18px;text-align: center;">
                    <a href="store.php" class="list-group-item list-group-item-action bg-dark text-light">
                        全部
                    </a>
                    <a href="store.php?category=discount" class="list-group-item list-group-item-action">特惠</a>
                    <?php foreach ($all_categories as $category) { ?>
                        <a href="store.php?category=<?php echo $category['category_id']; ?>" class="list-group-item list-group-item-action"><?php echo $category['category']; ?></a>
                    <?php } ?>

                </div>
            </div>

            <div class="col-lg-10">
                <div class="row">
                    <img class="col-md-12" src="../uploads/products/<?php echo $product['folder']; ?>/<?php echo $product['header']; ?>" alt="">
                </div>
                <div class="row">
                    <div class="main col-md-12" data-flickity='{ "wrapAround": true ,"autoPlay":true, "pageDots": false, "prevNextButtons": false}'>
                        <?php for ($i = 1; $i <= 4; $i++) { ?>
                            <div class="cell bg-light">
                                <img src="../uploads/products/<?php echo $product['folder']; ?>/<?php echo $product['picture_' . $i]; ?>" alt="" style="max-width:22rem;">

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-12">
            <div class="row justify-content-end">
                <div class="col-lg-10">
                    <form class="alert alert-secondary row justify-content-end" role="alert" method="post" action="cart/add_cart.php">
                        <div class="row justify-content-end">

                            <input class="form-control col-3 col-lg-2" type="number" name="quantity" min=1 value="1">
                            <h6 class="px-3 col-4 col-lg-4 align-self-center">NT$ <?php echo $product['price']; ?></h6>

                            <?php if (isset($_GET['Existed']) && $_GET['Existed'] != null) { ?>
                                <a href="basket.php" class="btn btn-dark">於購物車內</a>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-dark">加入購物車</button>
                            <?php } ?>
                            <!-- 隱藏取得資訊input -->
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="header" value="../uploads/products/<?php echo $product['folder']; ?>/<?php echo $product['header']; ?>">
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">

                        </div>
                    </form>
                </div>

                <div id="content" class="col-lg-10 bg-light">
                    <div class="row p-3">
                        <h2><?php echo $product['name']; ?></h2>
                        <p><?php echo $product['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <?php require_once('layouts/footer.php'); ?>

    <script>
        $(window).on("load", function() {
            // init flickity
            $(".main").flickity();

        });
    </script>
</body>

</html>