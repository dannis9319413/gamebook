<!DOCTYPE html>
<html>
<?php

require_once("../layouts/head.php");



//判斷是否更新密碼
if (isset($_POST['new_password']) && $_POST['new_password'] != null && isset($_POST['confirm_password']) && $_POST['confirm_password'] != null && $_POST['new_password'] == $_POST['confirm_password']) {

  echo '<script>alert("hi")</script>';
  $sql = "UPDATE users SET  password = :password WHERE user_id = " . $_GET['user_id'];

  $sth = $db->prepare($sql);
  $sth->bindParam(":password", $_POST['new_password'], PDO::PARAM_STR);
  $sth->execute();

  //重新取得資料
  $query = $db->query("SELECT * FROM users WHERE user_id =" . $_GET['user_id']);
  $user = $query->fetch(PDO::FETCH_ASSOC);

  header('location: edit.php?user_id=' . $_GET['user_id'] . '&msg=password_change_success');
} else if (isset($_POST['new_password']) && $_POST['new_password'] != null && isset($_POST['confirm_password']) && $_POST['confirm_password'] != null && $_POST['new_password'] != $_POST['confirm_password']) {
  header('location: edit.php?user_id=' . $_GET['user_id'] . '&msg=password_change_fail');
}


//沒更新密碼情況下更新資料
if (isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT") {

  $sql = "UPDATE users SET email = :email, name = :name, gender = :gender, phone = :phone, mobile = :mobile, zip = :zip, county = :county, district = :district, address = :address , updated_at= :updated_at WHERE user_id = " . $_GET['user_id'];

  $sth = $db->prepare($sql);
  $sth->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth->bindParam(":gender", $_POST['gender'], PDO::PARAM_STR);
  $sth->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth->bindParam(":mobile", $_POST['mobile'], PDO::PARAM_STR);
  $sth->bindParam(":zip", $_POST['zipcode'], PDO::PARAM_STR);
  $sth->bindParam(":county", $_POST['county'], PDO::PARAM_STR);
  $sth->bindParam(":district", $_POST['district'], PDO::PARAM_STR);
  $sth->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth->execute();

  //重新取得資料
  $query = $db->query("SELECT * FROM users WHERE user_id =" . $_GET['user_id']);
  $user = $query->fetch(PDO::FETCH_ASSOC);
  header('location: edit.php?user_id=' . $_GET['user_id'] . '&msg=success');
} else {
  $query = $db->query("SELECT * FROM users WHERE user_id =" . $_GET['user_id']);
  $user = $query->fetch(PDO::FETCH_ASSOC);
}


?>


<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container py-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <ul class="breadcrumb">
            
            <li class="breadcrumb-item"> <a href="list.php">會員管理</a></li>
            <li class="breadcrumb-item active">會員編輯</li>
          </ul>

          <form class="mt-4" method="post" action="edit.php?user_id=<?php echo $user['user_id']; ?>">

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'password_change_success') { ?>
              <div class="alert alert-success" role="alert">
                密碼更新成功 !
              </div>
            <?php } else if (isset($_GET['msg']) && $_GET['msg'] == 'password_change_fail') { ?>
              <div class="alert alert-danger" role="alert">
                密碼更新失敗 !
              </div>
            <?php } ?>

            <div class="form-group row">
              <label for="password" class="col-3 col-form-label text-right">目前密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>"> </div>
            </div>

            <div class="form-group row">
              <label for="new_password" class="col-3 col-form-label text-right">新密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="new_password" name="new_password"> </div>
            </div>

            <div class="form-group row">
              <label for="confirm_password" class="col-3 col-form-label text-right">確認新密碼</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="confirm_password" name="confirm_password">
              </div>

              <div class="col-md-5">
                <div class="row justify-content-center my-3">
                  <button type="submit" class="btn btn-dark col-6 ">更新密碼</button>
                </div>
              </div>
            </div>

          </form>

          <form class="mt-4" method="post" action="edit.php?user_id=<?php echo $user['user_id']; ?>">

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
              <div class="alert alert-success" role="alert">
                資料更新成功 !
              </div>
            <?php } ?>

            <div class="form-group row">
              <label for="email" class="col-3 col-form-label text-right">Email</label>
              <div class="col-8 col-md-5">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-3 col-form-label text-right">姓名</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>"> </div>
            </div>

            <div class="form-group row"> <label for="gender" class="col-3 col-form-label text-right">性別</label>
              <div class="col-8 col-md-6">
                <label><input id="man" type="radio" name="gender" name="1" value="1">男</label>
                <label><input id="woman" type="radio" name="gender" name="0" value="0">女</label>
              </div>
            </div>

            <div class="form-group row"> <label for="phone" class="col-3 col-form-label text-right">電話</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
              </div>
            </div>


            <div class="form-group row"> <label for="mobile" class="col-3 col-form-label text-right">手機</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>"></div>
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
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>">
              </div>
            </div>

            <div class="row p-3 justify-content-between">

              <a class="btn btn-dark col-4 col-md-2" href="list.php?">返回</a>

              <button type="submit" class="btn btn-dark col-4 col-md-2">確定送出</button>

            </div>

            <!-- 產生時間 -->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>"></input>
            <!-- 產生欄位判斷是否送出 -->
            <input type="hidden" name="EditForm" value="EDIT">

          </form>

        </div>
      </div>

    </div>
  </div>

  <?php require_once("../layouts/footer.php"); ?>

  <script>
    $(function() {
      $("#twzipcode").twzipcode({
        'zipcodeSel': '<?php echo $user['zip'] ?>',
        'countySel': '<?php echo $user['county'] ?>',
        'districtSel': '<?php echo $user['district'] ?>'
      });

      $('#twzipcode').find('select[name="county"]').eq(1).remove();
      $('#twzipcode').find('select[name="district"]').eq(1).remove();
      $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();


      var gender = <?php echo $user['gender']; ?>;
      if (gender == 1) {
        $("#man").attr('checked', 'cheacked');
      } else {
        $("#woman").attr('checked', 'cheacked');
      }
    });
  </script>

</body>

</html>