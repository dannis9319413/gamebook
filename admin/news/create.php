<!DOCTYPE html>
<html>

<?php

require_once("../layouts/head.php");

$error = null;

//判斷表格是否有值

if (
  isset($_POST['title']) && $_POST['title'] != null && isset($_POST['content']) && $_POST['content'] != null
) {
  //判斷是否有資料夾
  if (!file_exists("../../uploads/news")) {
    mkdir("../../uploads/news", 0755, true);
  }

  //圖片上傳程式碼

  if (isset($_FILES['picture']['name'])) {
    $picture = $_FILES['picture']['name'];
    $file_path = "../../uploads/news/" . $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  } else {
    //設定空值以免寫不進資料庫
    $filename = null;
  }
  //End圖片上傳程式碼
  $sql = "INSERT INTO news ( picture, title, content, created_at) VALUES ( :picture, :title, :content,  :created_at)";
  $sth = $db->prepare($sql);

  $sth->bindParam(":picture", $picture, PDO::PARAM_STR);
  $sth->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth->execute();


  header('location: list.php');
} else {
}

?>



<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container my-5">
    <div class="row">

      <div class="col-md-12">

        <div class="card">

          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="list.php">最新消息管理</a></li>
            <li class="breadcrumb-item active">新增最新消息</li>
          </ul>
          <?php if (isset($error) && $error == true && $error != null) { ?>
            <div class="alert alert-danger" role="alert">
              需填入 標題、內容
            </div>
          <?php } ?>
          <form id="AddForm" class="mt-4" method="post" action="create.php" enctype="multipart/form-data">

            <div class="form-group row"> <label for="picture" class="col-2 col-form-label text-right">圖片</label>
              <div class="col-10">
                <img id="pic" src="" alt="">
                <input type="file" class="form-control-file" id="picture" name="picture" autocomplete="off">
              </div>
            </div>



            <div class="form-group row">
              <label for="title" class="col-2 col-form-label text-right">*標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title"> </div>
            </div>

            <div class="form-group row"> <label for="content" class="col-2 col-form-label text-right">*內容</label>
              <div class="col-10">
                <textarea id="content" rows="5" class="form-control" name="content"></textarea>
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

    CKEDITOR.replace('content');
  </script>

</body>

</html>