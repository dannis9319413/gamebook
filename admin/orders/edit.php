<!DOCTYPE html>
<html>
<?php

require_once("../layouts/head.php");

if (isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT") {

  $sql = "UPDATE customer_orders SET total = :total, shipping = :shipping, status = :status, name = :name, mobile = :mobile, zip = :zip, county = :county, district = :district, address = :address , updated_at= :updated_at WHERE customer_orders_id  = " . $_GET['order_id'];

  $sth = $db->prepare($sql);
  $sth->bindParam(":total", $_POST['total'], PDO::PARAM_STR);
  $sth->bindParam(":shipping", $_POST['shipping'], PDO::PARAM_STR);
  $sth->bindParam(":status", $_POST['status'], PDO::PARAM_STR);
  $sth->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth->bindParam(":mobile", $_POST['mobile'], PDO::PARAM_STR);
  $sth->bindParam(":zip", $_POST['zipcode'], PDO::PARAM_STR);
  $sth->bindParam(":county", $_POST['county'], PDO::PARAM_STR);
  $sth->bindParam(":district", $_POST['district'], PDO::PARAM_STR);
  $sth->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth->execute();

  //重新取得資料
  $query = $db->query("SELECT * FROM customer_orders WHERE customer_orders_id  =" . $_GET['order_id']);
  $order = $query->fetch(PDO::FETCH_ASSOC);
  header('location: edit.php?order_id=' . $_GET['order_id'] . '&msg=success');
} else {
  $query = $db->query("SELECT * FROM customer_orders WHERE customer_orders_id  =" . $_GET['order_id']);
  $order = $query->fetch(PDO::FETCH_ASSOC);
}


?>


<body>

  <?php require_once("../layouts/navbar.php") ?>


  <div class="container py-5">
    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <ul class="breadcrumb">
            
            <li class="breadcrumb-item"> <a href="list.php">訂單管理</a></li>
            <li class="breadcrumb-item active">訂單編輯</li>
          </ul>


          <form class="mt-4" method="post" action="edit.php?order_id=<?php echo $order['customer_orders_id']; ?>">

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
              <div class="alert alert-success" role="alert">
                資料更新成功 !
              </div>
            <?php } ?>

            <div class="form-group row">
              <label for="order_no" class="col-3 col-form-label text-right">訂單號碼</label>
              <div class="col-8 col-md-5">
                <input type="text" class="form-control" id="order_no" name="order_no" value="<?php echo $order['order_no']; ?>" disabled>
              </div>
            </div>

            <div class="form-group row"> <label for="total" class="col-3 col-form-label text-right">商品總額</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="total" name="total" value="<?php echo $order['total']; ?>">
              </div>
            </div>

            <div class="form-group row"> <label for="shipping" class="col-3 col-form-label text-right">運費</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="shipping" name="shipping" value="<?php echo $order['shipping']; ?>">
              </div>
            </div>

            <div class="form-group row"> <label for="status" class="col-3 col-form-label text-right">訂單狀態</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $order['status']; ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-3 col-form-label text-right">姓名</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $order['name']; ?>"> </div>
            </div>

            <div class="form-group row"> <label for="mobile" class="col-3 col-form-label text-right">手機</label>
              <div class="col-8 col-md-4">
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $order['mobile']; ?>"></div>
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
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $order['address']; ?>">
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
        'zipcodeSel': '<?php echo $order['zip']; ?>',
        'countySel': '<?php echo $order['county']; ?>',
        'districtSel': '<?php echo $order['district']; ?>'
      });

      $('#twzipcode').find('select[name="county"]').eq(1).remove();
      $('#twzipcode').find('select[name="district"]').eq(1).remove();
      $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();

    });
  </script>

</body>

</html>