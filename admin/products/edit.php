<!DOCTYPE html>
<html>
<?php

require_once("../layouts/head.php");

$query = $db->query("SELECT * FROM products WHERE product_id = " . $_GET['product_id']);
$product = $query->fetch(PDO::FETCH_ASSOC);

//判斷是否送出表格
if (isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT") {

  //判斷是否有資料夾
  if (!file_exists("../../uploads/products/" . $product['folder'])) {
    mkdir("../../uploads/products/"  . $product['folder'], 0755, true);
  }

  //header上傳程式碼
  if (isset($_FILES['header']['name']) && $_FILES['header']['name'] != null) {

    echo '<script>alert("hi")</script>';
    $header = $_FILES['header']['name'];
    $file_path = "../../uploads/products/" . $product['folder'] . "/" . $_FILES['header']['name'];
    unlink("../../uploads/products/" . $product['folder'] . "/" . $_POST['old_header']);
    move_uploaded_file($_FILES['header']['tmp_name'], $file_path);


    $sql = "UPDATE products SET header = :header WHERE product_id =" . $_GET['product_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":header", $header, PDO::PARAM_STR);
    $sth->execute();
  }

  //picture_1上傳程式碼
  if (isset($_FILES['picture_1']['name']) && $_FILES['picture_1']['name'] != null) {

    $picture_1 = $_FILES['picture_1']['name'];
    $file_path = "../../uploads/products/" . $product['folder'] . "/" . $_FILES['picture_1']['name'];
    unlink("../../uploads/products/" . $product['folder'] . "/" . $_POST['old_picture_1']);
    move_uploaded_file($_FILES['picture_1']['tmp_name'], $file_path);


    $sql = "UPDATE products SET picture_1 = :picture_1 WHERE product_id =" . $_GET['product_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":picture_1", $picture_1, PDO::PARAM_STR);
    $sth->execute();
  }

  //picture_2上傳程式碼
  if (isset($_FILES['picture_2']['name']) && $_FILES['picture_2']['name'] != null) {

    $picture_2 = $_FILES['picture_2']['name'];
    $file_path = "../../uploads/products/" . $product['folder'] . "/" . $_FILES['picture_2']['name'];
    unlink("../../uploads/products/" . $product['folder'] . "/" . $_POST['old_picture_2']);
    move_uploaded_file($_FILES['picture_2']['tmp_name'], $file_path);


    $sql = "UPDATE products SET picture_2 = :picture_2 WHERE product_id =" . $_GET['product_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":picture_2", $picture_2, PDO::PARAM_STR);
    $sth->execute();
  }

  //picture_3上傳程式碼
  if (isset($_FILES['picture_3']['name']) && $_FILES['picture_3']['name'] != null) {
    echo '<script>alert("hi")</script>';
    $picture_3 = $_FILES['picture_3']['name'];
    $file_path = "../../uploads/products/" . $product['folder'] . "/" . $_FILES['picture_3']['name'];
    unlink("../../uploads/products/" . $product['folder'] . "/" . $_POST['old_picture_3']);
    move_uploaded_file($_FILES['picture_3']['tmp_name'], $file_path);


    $sql = "UPDATE products SET picture_3 = :picture_3 WHERE product_id =" . $_GET['product_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":picture_3", $picture_3, PDO::PARAM_STR);
    $sth->execute();
  }

  //picture_4上傳程式碼
  if (isset($_FILES['picture_4']['name']) && $_FILES['picture_4']['name'] != null) {

    $picture_4 = $_FILES['picture_4']['name'];
    $file_path = "../../uploads/products/" . $product['folder'] . "/" . $_FILES['picture_4']['name'];
    unlink("../../uploads/products/" . $product['folder'] . "/" . $_POST['old_picture_4']);
    move_uploaded_file($_FILES['picture_4']['tmp_name'], $file_path);


    $sql = "UPDATE products SET picture_4 = :picture_4 WHERE product_id =" . $_GET['product_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":picture_4", $picture_4, PDO::PARAM_STR);
    $sth->execute();
  }


  $sql = "UPDATE products SET product_category_id = :product_category_id,  name = :name, description = :description, price = :price, pre = :pre, new = :new, special = :special, updated_at = :updated_at WHERE product_id =" . $_GET['product_id'];
  $sth = $db->prepare($sql);
  $sth->bindParam(":product_category_id", $_POST['product_category_id'], PDO::PARAM_INT);
  $sth->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth->bindParam(":pre", $_POST['pre'], PDO::PARAM_STR);
  $sth->bindParam(":new", $_POST['new'], PDO::PARAM_STR);
  $sth->bindParam(":special", $_POST['special'], PDO::PARAM_STR);
  $sth->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth->execute();

  //重新取得資料
  $query = $db->query("SELECT * FROM products WHERE product_id =" . $_GET['product_id']);
  $product = $query->fetch(PDO::FETCH_ASSOC);

  header('location: edit.php?product_id=' . $_GET['product_id'] . '&msg=success');
} else {
  $query = $db->query("SELECT * FROM products WHERE product_id =" . $_GET['product_id']);
  $product = $query->fetch(PDO::FETCH_ASSOC);
}


?>


<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container py-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <ul class="breadcrumb">
            
            <li class="breadcrumb-item"> <a href="list.php">商品管理</a></li>
            <li class="breadcrumb-item active">商品編輯</li>
          </ul>

          <form id="EditForm" class="mt-4" method="post" action="edit.php?product_id=<?php echo $_GET['product_id'] ?>" enctype="multipart/form-data">

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
              <div class="alert alert-success" role="alert">
                更新資料成功 !
              </div>
            <?php } ?>

            <div class="form-group row">
              <label for="product_category_id" class="col-2 col-form-label text-right">商品類別</label>
              <div class="col-10">
                <input type="text" class="form-control" id="product_category_id" name="product_category_id" value="<?php echo $product['product_category_id']; ?>">
              </div>
            </div>

            <div class="form-group row"> <label for="header" class="col-2 col-form-label text-right">圖片</label>
              <div class="col-10">
                <img id="pic" src="../../uploads/products/<?php echo $product['folder']; ?>/<?php echo $product['header']; ?>" alt="" style="max-width: 15rem;">
                <input type="file" class="form-control-file" id="header" name="header">
              </div>
            </div>

            <?php for ($i = 1; $i <= 4; $i++) { ?>
              <div class="form-group row"> <label for="picture_<?php echo $i; ?>" class="col-2 col-form-label text-right">圖片<?php echo $i; ?></label>
                <div class="col-10">
                  <img id="pic" src="../../uploads/products/<?php echo $product['folder']; ?>/<?php echo $product['picture_' . $i]; ?>" alt="" style="max-width:15rem;">
                  <input type="file" class="form-control-file" id="picture_<?php echo $i; ?>" name="picture_<?php echo $i; ?>" autocomplete="off">
                </div>
              </div>
            <?php } ?>


            <div class="form-group row">
              <label for="name" class="col-2 col-form-label text-right">遊戲名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>"> </div>
            </div>

            <div class="form-group row"> <label for="description" class="col-2 col-form-label text-right">遊戲描述</label>
              <div class="col-10">
                <textarea id="description" rows="5" class="form-control" name="description"><?php echo $product['description']; ?></textarea>
              </div>
            </div>

            <div class="form-group row"> <label for="price" class="col-2 col-form-label text-right">價格</label>
              <div class="col-10">
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>"></div>
            </div>


            <div class="form-group row"> <label for="pre" class="col-2 col-form-label text-right">預購</label>
              <div class="col-10">
                <input type="text" class="form-control" id="pre" name="pre" placeholder="0 or 1" value="<?php echo $product['pre']; ?>"></div>
            </div>

            <div class="form-group row"> <label for="new" class="col-2 col-form-label text-right">新品</label>
              <div class="col-10">
                <input type="text" class="form-control" id="new" name="new" placeholder="0 or 1" value="<?php echo $product['new']; ?>"></div>
            </div>

            <div class="form-group row"> <label for="special" class="col-2 col-form-label text-right">特惠</label>
              <div class="col-10">
                <input type="text" class="form-control" id="special" name="special" placeholder="0 or 1" value="<?php echo $product['special']; ?>"></div>
            </div>

            <!-- 產生時間 -->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>"></input>
            <!-- 產生欄位判斷是否送出 -->
            <input type="hidden" name="EditForm" value="EDIT">
            <input type="hidden" name="old_header" value="<?php echo $product['header']; ?>">
            <input type="hidden" name="old_picture_1" value="<?php echo $product['picture_1']; ?>">
            <input type="hidden" name="old_picture_2" value="<?php echo $product['picture_2']; ?>">
            <input type="hidden" name="old_picture_3" value="<?php echo $product['picture_3']; ?>">
            <input type="hidden" name="old_picture_4" value="<?php echo $product['picture_4']; ?>">

            <div class="row p-3 justify-content-between">
              <a class="btn btn-dark col-4 col-md-2" href="list.php">返回</a>
              <button type="submit" class="btn btn-dark col-4 col-md-2">確定送出</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>



  <?php require_once("../layouts/footer.php") ?>
  <script>
    $(function() {
      $(function() {
        $("#created_at").datepicker({
          dateFormat: "yy-mm-dd"
        });
      });


    })
    CKEDITOR.replace('description');
  </script>

</body>

</html>