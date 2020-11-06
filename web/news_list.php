<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    require_once('layouts/head.php');

    $query = $db->query('SELECT * FROM news ORDER BY news_id DESC');
    $All_news = $query->fetchALL(PDO::FETCH_ASSOC);

    ?>


</head>

<body>

    <?php require_once('layouts/navbar.php') ?>

    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">新聞列表</li>
                    </ol>

                </nav>
            </div>


            <div class="col-md-12 col-lg-12 p-4">

                <?php foreach ($All_news as $news) { ?>
                    <div class="row justify-content-between shadow">

                        <div class="col-sm-12 col-md-12 col-lg-3 pt-2">
                            <div class="row justify-content-center">
                                <a href="news.php?news_id=<?php echo $news['news_id']; ?>" class="m-3"><img class="img-fluid mx-auto " src="../uploads/news/<?php echo $news['picture']; ?>" style="width: 200px;"></a>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-9">
                            <div class="row justify-content-center px-3">
                                <h5 class="mt-4"><?php echo $news['title']; ?></h5>
                                <small class="col-md-12"><?php echo substr($news['content'], 0, 140); ?></small>

                            </div>
                            <div class="col-lg-12">
                                <div class="row justify-content-end m-3">
                                    <a href="news.php?news_id=<?php echo $news['news_id']; ?>" class="btn btn-sm btn-dark" style="font-size: 14px;">繼續閱讀</a>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>



        </div>

    </div>


    <?php require_once('layouts/footer.php') ?>

</body>

</html>