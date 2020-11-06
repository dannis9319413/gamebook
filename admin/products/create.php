<!DOCTYPE html>
<html>

<?php

require_once("../layouts/head.php");

//判斷是否送出表格
if (
  isset($_POST['folder']) && $_POST['folder'] != null && isset($_POST['product_category_id']) && $_POST['product_category_id'] != null && isset($_POST['name']) && $_POST['name'] != null && isset($_POST['description']) && $_POST['description'] != null && isset($_POST['price'])
  && $_POST['price'] != null
) {
  //判斷是否有資料夾
  if (!file_exists("../../uploads/products/" . $_POST['folder'])) {
    mkdir("../../uploads/products/" . $_POST['folder'], 0755, true);
  }

  //圖片上傳程式碼

  if (isset($_FILES['header']['name'])) {
    $header = $_FILES['header']['name'];
    $file_path = "../../uploads/products/" . $_POST['folder'] . "/" . $_FILES['header']['name'];
    move_uploaded_file($_FILES['header']['tmp_name'], $file_path);
  }
  if (isset($_FILES['picture_1']['name'])) {
    $picture_1 = $_FILES['picture_1']['name'];
    $file_path = "../../uploads/products/"  . $_POST['folder'] . "/" . $_FILES['picture_1']['name'];
    move_uploaded_file($_FILES['picture_1']['tmp_name'], $file_path);
  }
  if (isset($_FILES['picture_2']['name'])) {
    $picture_2 = $_FILES['picture_2']['name'];
    $file_path = "../../uploads/products/"  . $_POST['folder'] . "/" . $_FILES['picture_2']['name'];
    move_uploaded_file($_FILES['picture_2']['tmp_name'], $file_path);
  }
  if (isset($_FILES['picture_3']['name'])) {
    $picture_3 = $_FILES['picture_3']['name'];
    $file_path = "../../uploads/products/"  . $_POST['folder'] . "/" . $_FILES['picture_3']['name'];
    move_uploaded_file($_FILES['picture_3']['tmp_name'], $file_path);
  }
  if (isset($_FILES['picture_4']['name'])) {
    $picture_4 = $_FILES['picture_4']['name'];
    $file_path = "../../uploads/products/"  . $_POST['folder'] . "/" . $_FILES['picture_4']['name'];
    move_uploaded_file($_FILES['picture_4']['tmp_name'], $file_path);
  }

  //End圖片上傳程式碼
  $sql = "INSERT INTO products (folder, product_category_id, header, picture_1, picture_2, picture_3, picture_4, name, description, price, pre, new, special, created_at) VALUES ( :folder, :product_category_id, :header, :picture_1, :picture_2, :picture_3, :picture_4, :name, :description, :price, :pre, :new, :special, :created_at)";
  $sth = $db->prepare($sql);
  $sth->bindParam(":folder", $_POST['folder'], PDO::PARAM_STR);
  $sth->bindParam(":product_category_id", $_POST['product_category_id'], PDO::PARAM_INT);
  $sth->bindParam(":header", $header, PDO::PARAM_STR);
  $sth->bindParam(":picture_1", $picture_1, PDO::PARAM_STR);
  $sth->bindParam(":picture_2", $picture_2, PDO::PARAM_STR);
  $sth->bindParam(":picture_3", $picture_3, PDO::PARAM_STR);
  $sth->bindParam(":picture_4", $picture_4, PDO::PARAM_STR);
  $sth->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth->bindParam(":pre", $_POST['pre'], PDO::PARAM_STR);
  $sth->bindParam(":new", $_POST['new'], PDO::PARAM_STR);
  $sth->bindParam(":special", $_POST['special'], PDO::PARAM_STR);
  $sth->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth->execute();

  header('location: list.php');
} else {

  $query = $db->query("SELECT * FROM categories ORDER BY category_id ASC");
  $all_categories = $query->fetchALL(PDO::FETCH_ASSOC);
}

?>

<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container my-5">
    <div class="row">

      <div class="col-md-12">

        <div class="card">

          <ul class="breadcrumb">
            
            <li class="breadcrumb-item"> <a href="list.php">商品管理</a></li>
            <li class="breadcrumb-item active">新增商品</li>
          </ul>
          <?php if (isset($_GET['error']) && $_GET['error'] == 'true') { ?>
            <div class="alert alert-danger" role="alert">
              需填入 商品類別、遊戲名稱、遊戲描述、價格
            </div>
          <?php } ?>
          <form id="AddForm" class="mt-4" method="post" action="create.php" enctype="multipart/form-data">

            <div class="form-group row">
              <label for="folder" class="col-2 col-form-label text-right">*資料夾名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="folder" name="folder" placeholder="*請勿輸入英數以外和特殊字元">
              </div>
            </div>

            <div class="form-group row">
              <label for="product_category_id" class="col-2 col-form-label text-right">*商品類別</label>
              <div class="col-10">


                <label for="product_category_id"></label>
                <select class="form-control" id="product_category_id" name="product_category_id">
                  <?php foreach ($all_categories as $category) { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row"> <label for="header" class="col-2 col-form-label text-right">圖片</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="header" name="header" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_1" class="col-2 col-form-label text-right">圖片1</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_1" name="picture_1" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_2" class="col-2 col-form-label text-right">圖片2</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_2" name="picture_2" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_3" class="col-2 col-form-label text-right">圖片3</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_3" name="picture_3" autocomplete="off">
              </div>
            </div>

            <div class="form-group row"> <label for="picture_4" class="col-2 col-form-label text-right">圖片4</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture_4" name="picture_4" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-2 col-form-label text-right">*遊戲名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name"> </div>
            </div>

            <div class="form-group row"> <label for="description" class="col-2 col-form-label text-right">*遊戲描述</label>
              <div class="col-10">
                <textarea id="description" rows="5" class="form-control" name="description"></textarea>
              </div>
            </div>

            <div class="form-group row"> <label for="price" class="col-2 col-form-label text-right">*價格</label>
              <div class="col-10">
                <input type="text" class="form-control" id="price" name="price"></div>
            </div>


            <div class="form-group row"> <label for="pre" class="col-2 col-form-label text-right">預購</label>
              <div class="col-10">
                <select class="form-control" id="pre" name="pre">
                  <option>否</option>
                  <option value="1">是</option>
                </select>
              </div>
            </div>

            <div class="form-group row"> <label for="new" class="col-2 col-form-label text-right">新品</label>
              <div class="col-10">
                <select class="form-control" id="new" name="new">
                  <option>否</option>
                  <option value="1">是</option>
                </select>
              </div>
            </div>

            <div class="form-group row"> <label for="special" class="col-2 col-form-label text-right">特惠</label>
              <div class="col-10">
                <select class="form-control" id="special" name="special">
                  <option>否</option>
                  <option value="1">是</option>
                </select>
              </div>
            </div>

            <div class="row p-3 justify-content-between">

              <a class="btn btn-dark col-4 col-md-2" href="list.php?">返回</a>

              <button type="submit" class="btn btn-dark col-4 col-md-2">確定送出</button>

            </div>

            <!-- 產生時間 -->
            <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>"></input>
            <!-- 產生欄位判斷是否送出 -->
            <input type="hidden" name="AddForm" value="INSERT">

          </form>

        </div>
      </div>
    </div>
  </div>


  <?php require_once("../layouts/footer.php") ?>

  <script>
    $('#picture').change(function() {
      var file = $('#picture')[0].files[0];
      var reader = new FileReader;
      reader.onload = function(e) {
        $('#pic').attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
    });

    CKEDITOR.replace('description');
  </script>

</body>

</html>