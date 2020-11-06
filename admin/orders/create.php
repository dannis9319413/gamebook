<!DOCTYPE html>
<html>

<?php

require_once("../layouts/head.php");

//判斷表格是否有值
if (
  isset($_POST['email']) && $_POST['email'] != null && isset($_POST['password']) && $_POST['password'] != null && isset($_POST['confirm_password']) && $_POST['confirm_password'] != null && $_POST['password'] == $_POST['confirm_password']
) {

  $sql = "INSERT INTO users (email, password, name, gender, phone, mobile, zip, county, district, address, created_at) VALUES ( :email, :password, :name, :gender, :phone, :mobile, :zip, :county, :district, :address, :created_at)";
  $sth = $db->prepare($sql);
  $sth->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth->bindParam(":gender", $_POST['gender'], PDO::PARAM_STR);
  $sth->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth->bindParam(":mobile", $_POST['mobile'], PDO::PARAM_STR);
  $sth->bindParam(":zip", $_POST['zipcode'], PDO::PARAM_STR);
  $sth->bindParam(":county", $_POST['county'], PDO::PARAM_STR);
  $sth->bindParam(":district", $_POST['district'], PDO::PARAM_STR);
  $sth->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth->execute();

  header('location: list.php');
}

?>



<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container my-5">
    <div class="row">

      <div class="col-md-12">

        <div class="card">

          <ul class="breadcrumb">
            
            <li class="breadcrumb-item"> <a href="list.php">會員管理</a></li>
            <li class="breadcrumb-item active">新增會員</li>
          </ul>

          <?php if (isset($_GET['error']) && $_GET['error'] == 'true') { ?>
            <div class="alert alert-danger" role="alert">
              Email、密碼、確認密碼 錯誤
            </div>
          <?php } ?>

          <form id="AddForm" class="mt-4" method="post" action="create.php">

            <div class="form-group row">
              <label for="email" class="col-3 col-form-label text-right">*Email</label>
              <div class="col-8 col-md-5">
                <input type="email" class="form-control" id="email" name="email">
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-3 col-form-label text-right">*密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="password" name="password"> </div>
            </div>

            <div class="form-group row">
              <label for="confirm_password" class="col-3 col-form-label text-right">*確認密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="confirm_password" name="confirm_password"> </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-3 col-form-label text-right">姓名</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="name" name="name"> </div>
            </div>

            <div class="form-group row"> <label for="gender" class="col-3 col-form-label text-right">性別</label>
              <div class="col-8 col-md-6">
                <label><input id="man" type="radio" name="gender" name="1" value="1">男</label>
                <label><input id="woman" type="radio" name="gender" name="0" value="0">女</label>
              </div>
            </div>

            <div class="form-group row"> <label for="phone" class="col-3 col-form-label text-right">電話</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="phone" name="phone">
              </div>
            </div>


            <div class="form-group row"> <label for="mobile" class="col-3 col-form-label text-right">手機</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="mobile" name="mobile"></div>
            </div>

            <div id="twzipcode" class="form-group row justify-content-center">
              <div class="form-group col-3 col-md-2">
                <label for="zipcode">郵遞區號</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode">
              </div>
              <div class="form-group col-4 col-md-3">
                <label for="county">縣市</label>
                <select id="county" class="form-control" name="county">
                  <option selected></option>

                </select>
              </div>
              <div class="form-group col-4 col-md-3">
                <label for="district">區域</label>
                <select type="text" class="form-control" id="district" name="district"></select>
              </div>

            </div>

            <div class="form-group row"> <label for="address" class="col-3 col-form-label text-right">地址</label>
              <div class="col-8 col-md-6">
                <input type="text" class="form-control" id="address" name="address">
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


  <?php require_once("../layouts/footer.php"); ?>

  <script>
    $(function() {
      $("#twzipcode").twzipcode({
        'zipcodeSel': '100',
        'countySel': '',
        'districtSel': ''
      });

      $('#twzipcode').find('select[name="county"]').eq(1).remove();
      $('#twzipcode').find('select[name="district"]').eq(1).remove();
      $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();

    });
  </script>

</body>

</html>