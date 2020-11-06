<!DOCTYPE html>
<html>

<?php

require_once("../layouts/head.php");


//限制顯示筆數
$limit = 5;
//判斷第幾頁
if (isset($_GET['page']) && $_GET['page'] != null) {
  $page = $_GET['page'];
} else {
  //預設為第一頁
  $page = 1;
}

//開始編號
$start_from = ($page - 1) * $limit;

if (isset($_GET['categoryID']) && $_GET['categoryID'] != null) {
  $query = $db->query("SELECT * FROM products WHERE product_id = " . $_GET['categoryID'] . " ORDER BY product_id DESC LIMIT " . $start_from . "," . $limit);
  $all_products = $query->fetchALL(PDO::FETCH_ASSOC);
} else {
  $start_from = ($page - 1) * $limit;
  $query = $db->query("SELECT * FROM products ORDER BY product_id DESC LIMIT " . $start_from . "," . $limit);
  $all_products = $query->fetchALL(PDO::FETCH_ASSOC);
}

?>

<body>

  <?php require_once("../layouts/navbar.php"); ?>

  <div class="container py-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <ul class="breadcrumb">
            
            <li class="breadcrumb-item active">商品管理</li>
          </ul>
          <div class="row">
            <div class="col-md-7"><a class="btn btn-dark w-25 ml-3" href="create.php">新增一筆</a></div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th>上架日期</th>
                    <th>圖片</th>
                    <th>遊戲名稱</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($all_products as $product) { ?>
                    <tr>
                      <th><small><?php echo $product['created_at'] ?></small></th>
                      <th><img src="../../uploads/products/<?php echo $product['folder']; ?>/<?php echo $product['header'] ?>" alt="" style="max-width:8rem;"></th>
                      <td><?php echo $product['name'] ?></td>
                      <td><a class="btn btn-dark btn-sm " href="edit.php?product_id=<?php echo $product['product_id'] ?>"><i class="fa fa-fw fa-pencil-square-o"></i>&nbsp;編輯</a><a class="btn btn-dark btn-sm" href="delete.php?product_id=<?php echo $product['product_id'] ?>" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};"><i class="fa fa-fw fa-trash"></i>&nbsp;刪除</a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  $query2 = $db->query("SELECT * FROM products"); //產生query
  $data = $query2->fetchAll(PDO::FETCH_ASSOC); //query抓資料
  $total_pages = ceil(count($data) / $limit); //算出總頁數
  ?>

  <?php if ($total_pages > 1) { ?>
    <div class="container py-4">
      <div class="row">

        <div class="col-md-12 d-flex justify-content-center">

          <ul class="pagination">
            <li class="page-item"> <a class="page-link text-dark" href="list.php?page=<?php if ($page == 1) {
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
                <a class="page-link text-dark" href="list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> </li>
              <?php } ?>
              <li class="page-item"> <a class="page-link text-dark" href="list.php?&page=<?php if ($page = $total_pages) {
                                                                                            echo $page;
                                                                                          } else {
                                                                                            echo $page + 1;
                                                                                          }  ?>"> <span>»</span></a> </li>
          </ul>
        </div>

      </div>
    </div>
  <?php } ?>
  <?php require_once("../layouts/footer.php") ?>

</body>

</html>