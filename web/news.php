<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    $query = $db->query('SELECT * FROM news WHERE news_id =' . $_GET['news_id']);
    $news = $query->fetch(PDO::FETCH_ASSOC);

    ?>

    <style>
        img {
            width: 100%;
        }
    </style>
</head>

<body>

    <?php require_once('layouts/navbar.php') ?>

    <div class="container my-3">
        <div class="row justify-content-center ">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item"><a href="news_list.php">新聞列表</a></li>
                        <li class="breadcrumb-item active" aria-current="page">新聞</li>
                    </ol>

                </nav>
            </div>

            <div class="m-3 p-3 pt-0 col-md-12 col-lg-12 bg-light" style="max-width:1110px;">
                <div class="row p-3">

                    <small class="mb-3"><i class="fa fa-calendar-check-o mr-1" aria-hidden="true"></i><?php echo $news['created_at']; ?></small>
                    <h5 class="col-lg-10"><?php echo $news['title']; ?></h5>
                    <hr class="col-lg-11">
                    <p class="col-lg-10"><?php echo $news['content']; ?></p>



                </div>

                <div class="row justify-content-start">
                    <a href="../web/news_list.php" class="btn btn-dark btn-sm ml-3">返回</a>
                </div>

                <hr class="col-lg-11">

            </div>

        </div>

    </div>


    <?php require_once('layouts/footer.php') ?>

</body>

</html>