<!DOCTYPE html>
<html>
<?php

require_once("../layouts/head.php");


//判斷是否送出表格
if (isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT") {

  //判斷是否有資料夾
  if (!file_exists("../../uploads/news")) {
    mkdir("../../uploads/news", 0755, true);
  }

  //圖片上傳程式碼
  if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null) {

    echo '<script>alert("hi")</script>';

    $picture = $_FILES['picture']['name'];
    $file_path = "../../uploads/news/" . $_FILES['picture']['name'];
    unlink("../../uploads/news/" . $_POST['old_picture']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);

    $sql = "UPDATE news SET picture = :picture WHERE news_id =" . $_GET['news_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":picture", $picture, PDO::PARAM_STR);
    $sth->execute();
  }

  $sql = "UPDATE news SET  title = :title, content = :content, updated_at = :updated_at WHERE news_id =" . $_GET['news_id'];
  $sth = $db->prepare($sql);
  $sth->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth->execute();

  //重新取得資料
  $query = $db->query("SELECT * FROM news WHERE news_id =" . $_GET['news_id']);
  $news = $query->fetch(PDO::FETCH_ASSOC);

  header('location: edit.php?news_id=' . $_GET['news_id'] . '&msg=success');
} else {
  $query = $db->query("SELECT * FROM news WHERE news_id =" . $_GET['news_id']);
  $news = $query->fetch(PDO::FETCH_ASSOC);
}
?>


<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container py-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="list.php">最新消息管理</a></li>
            <li class="breadcrumb-item active">最新消息編輯</li>
          </ul>

          <form id="EditForm" class="mt-4" method="post" action="edit.php?news_id=<?php echo $_GET['news_id'] ?>" enctype="multipart/form-data">

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
              <div class="alert alert-success" role="alert">
                更新資料成功 !
              </div>
            <?php } ?>

            <div class="form-group row"> <label for="picture" class="col-2 col-form-label text-right">圖片</label>
              <div class="col-10">
                <img id="pic" src="../../uploads/news/<?php echo $news['picture']; ?>" alt="" style="max-width: 10rem;">
                <input type="file" class="form-control-file" id="picture" name="picture" autocomplete="off">
              </div>
            </div>


            <div class="form-group row">
              <label for="title" class="col-2 col-form-label text-right">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $news['title']; ?>"> </div>
            </div>

            <div class="form-group row"> <label for="content" class="col-2 col-form-label text-right">遊戲描述</label>
              <div class="col-10">
                <textarea id="content" rows="5" class="form-control" name="content"><?php echo $news['content']; ?></textarea>
              </div>
            </div>

            <!-- 產生時間 -->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>"></input>
            <!-- 產生欄位判斷是否送出 -->
            <input type="hidden" name="EditForm" value="EDIT">
            <input type="hidden" name="old_picture" value="<?php echo $news['picture']; ?>">

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
    CKEDITOR.replace('content');
  </script>

</body>

</html>