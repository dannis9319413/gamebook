<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    //限制顯示筆數
    $limit = 9;
    //判斷第幾頁
    if (isset($_GET['page']) && $_GET['page'] != null) {
        $page = $_GET['page'];
    } else {
        //預設為第一頁
        $page = 1;
    }

    //設定開始編號
    $start_from = ($page - 1) * $limit;

    if (isset($_GET['category']) && $_GET['category'] != null) {
        //判斷是否優惠
        if ($_GET['category'] == 'discount') {
            $query = $db->query('SELECT * FROM products WHERE special = 1 ORDER BY product_id ASC LIMIT ' . $start_from . ',' . $limit);
            $all_products = $query->fetchALL(PDO::FETCH_ASSOC);
        } else {
            //透過category抓特定遊戲
            $query = $db->query('SELECT * FROM products WHERE product_category_id = ' . $_GET['category'] . ' ORDER BY product_id ASC LIMIT ' . $start_from . ',' . $limit);
            $all_products = $query->fetchALL(PDO::FETCH_ASSOC);
        }
    } else {
        //沒category抓全部遊戲
        $query = $db->query('SELECT * FROM products ORDER BY product_id ASC LIMIT ' . $start_from . ',' . $limit);
        $all_products = $query->fetchALL(PDO::FETCH_ASSOC);
    }

    //categories
    $query = $db->query('SELECT * FROM categories ORDER BY category_id ASC');
    $all_categories = $query->fetchALL(PDO::FETCH_ASSOC);


    ?>


</head>

<body>

    <?php

    require_once('layouts/navbar.php') ?>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <nav class="my-3" aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">商店</li>
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
                <div class="row justify-content-center ">

                    <?php foreach ($all_products as $products) { ?>
                        <div class="card m-1 p-1 col-10 col-md-5 col-lg-5 col-xl-3" style="max-width: 18rem;">
                            <a href="product.php?product=<?php echo $products['product_id']; ?>"><img class="card-img-top" src="../uploads/products/<?php echo $products['folder']; ?>/<?php echo $products['header'] ?>" alt="" style="max-height: 7rem"></a>
                            <div class="row card-body justify-content-center">
                                <h6 class="card-text my-3 col-md-12"><?php echo $products['name']; ?></h6>
                                <p class="text-right col-md-12">NT$ <?php echo $products['price']; ?></p>
                                <a href="product.php?product=<?php echo $products['product_id']; ?>"><button class="btn btn-dark btn-sm col-12 align-self-end">立即購買</button></a>
                            </div>
                        </div>
                    <?php } ?>



                    <?php
                    if (isset($_GET['category']) && $_GET['category'] != null) {
                        if ($_GET['category'] == 'discount') {
                            $query2 = $db->query('SELECT * FROM products WHERE special = 1 ORDER BY product_id ASC LIMIT ' . $start_from . ',' . $limit);
                            $data = $query2->fetchALL(PDO::FETCH_ASSOC);
                            $total_pages = ceil(count($data) / $limit);
                        } else {
                            $query2 = $db->query('SELECT * FROM products WHERE product_category_id = ' . $_GET['category'] . ' ORDER BY product_id ASC LIMIT ' . $start_from . ',' . $limit);
                            $data = $query2->fetchALL(PDO::FETCH_ASSOC);
                            $total_pages = ceil(count($data) / $limit);
                        }
                    } else {
                        $query2 = $db->query("SELECT * FROM products"); //產生query
                        $data = $query2->fetchAll(PDO::FETCH_ASSOC); //query抓資料
                        $total_pages = ceil(count($data) / $limit); //算出總頁數

                    };

                    ?>


                    <?php if ($total_pages > 1) { ?>
                        <div class="mt-5 col-md-12 d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item"> <a class="page-link text-dark" href="store.php?page=<?php if ($page == 1) {
                                                                                                                echo $page;
                                                                                                            } else {
                                                                                                                echo $page - 1;
                                                                                                            } //判斷是否小於1
                                                                                                            ?>"> <span>«</span></a> </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <?php if ($page == $i) {  //判斷是否在本頁
                                    ?>
                                        <li class="page-item active">
                                        <?php } else { ?>
                                        <li class="page-item">
                                        <?php } ?>
                                        <a class="page-link text-dark" href="store.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> </li>
                                    <?php } ?>
                                    <li class="page-item"> <a class="page-link text-dark" href="store.php?page=<?php if ($page == $total_pages) {
                                                                                                                    echo $page;
                                                                                                                } else {
                                                                                                                    echo $page + 1;
                                                                                                                }  ?>"> <span>»</span></a> </li>
                            </ul>
                        </div>
                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

    <?php require_once('layouts/footer.php'); ?>

</body>

</html>