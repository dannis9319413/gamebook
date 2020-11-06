<!-- footer -->
<div class="row mx-0 mt-5 bg-light">

    <div class="col-md-12 ">
        <div class="row justify-content-center">

            <div class="col-10 col-md-4 mx-0 pt-3 pl-5">
                <a href="../index.php"><img class="mb-2" src="../img/logo.png" alt="GAMEBOOK" style="max-width: 10rem; position:relative; top: 7px;"></a>
                <br>
                <small>GAMEBOOK 提供整合遊戲平台，包括購買、販售、行銷、社群等等遊戲整合服務。</small>
            </div>

            <div class="col-10 col-md-3 pt-4 pl-5">
                <h5>商品分類</h5>
                <div class="d-flex flex-wrap" style="height: 140px; flex-direction:column;">
                    <a href="store.php" class="text-dark" style="list-style-type:none;">
                        <li><small>全部</small></li>
                    </a>
                    <a href="store.php?category=discount" class="text-dark" style="list-style-type:none;">
                        <li><small>特惠</small></li>
                    </a>
                    <?php foreach ($all_categories as $category) { ?>
                        <a href="store.php?category=<?php echo $category['category_id']; ?>" class="text-dark" style="list-style-type:none;">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!-- flickity -->
<script src="../js/flickity.pkgd.min.js"></script>

<!-- flickity-fullscreen -->
<script src="https://unpkg.com/flickity-fullscreen@1/fullscreen.js"></script>

<!-- footer end-->

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