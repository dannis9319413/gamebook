<!-- navbar -->
<?php

//categories
$query = $db->query('SELECT * FROM categories ORDER BY category_id ASC');
$all_categories = $query->fetchALL(PDO::FETCH_ASSOC);

?>

<nav class="navbar navbar-expand-xl navbar-light bg-light ">
    <div class="container">

        <a class="navbar-brand" href="../index.php">
            <img src="../img/logo.png" alt="GAMEBOOK" style="max-width: 10rem; position:relative; top: 7px;">
        </a>

        <button class="navbar-toggler navbar-toggler-right " data-toggle="collapse" data-target="#collapse1">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapse1">

            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item"> <a class="nav-link" href="about.php">關於我們</a> </li>
                <li class="nav-item"> <a class="nav-link" href="../web/news_list.php">最新消息</a> </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">遊戲商店</a>
                    <div class="dropdown-menu">
                        <?php foreach ($all_categories as $category) { ?>
                            <a class="dropdown-item" href="store.php?category=<?php echo $category['category_id']; ?>" style="font-size: 16px;"><?php echo $category['category']; ?></a>
                        <?php } ?>
                    </div>
                </li>
                <li class="nav-item"> <a class="nav-link" href="contact.php">聯絡我們</a> </li>
            </ul>

            <ul class="navbar-nav ">
                <?php if (isset($_SESSION['user']) && $_SESSION != null && $_SESSION['user'] != 'none') { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="w" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;"><?php echo $_SESSION['user']['email'] ?>您好</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="customer_orders.php" style="font-size: 16px;">會員專區</a>
                            <a class="dropdown-item" href="functions/logout.php" style="font-size: 16px;">登出</a>
                        </div>
                    </li>

                <?php } else { ?>

                    <li class="nav-item"> <a class="nav-link" href="login.php"><i class="fa fa-user mr-1 fa-lg"></i>登入/註冊</a>
                    </li>

                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="basket.php">
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
<!-- navbar end-->