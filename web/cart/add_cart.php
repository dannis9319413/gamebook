<?php
session_start();
$is_existed = "false";
// 確認商品是否重複
if (isset($_SESSION['Cart']) && $_SESSION['Cart'] != null) {
    for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
        if ($_SESSION['Cart'][$i]['product_id'] == $_POST['product_id']) {
            $is_existed = "true";
            go_back($is_existed);
        }
    }
}
//如果購物車為空
if ($is_existed == "false") {
    //接收資料放入陣列
    $temp['product_id'] = $_POST['product_id'];
    $temp['name']       = $_POST['name'];
    $temp['header']    = $_POST['header'];;
    $temp['price']      = $_POST['price'];
    $temp['quantity']   = $_POST['quantity'];
    //陣列資料放入Session Cart中
    $_SESSION['Cart'][] = $temp;
    go_back($is_existed);
}

//返回前頁面並帶上參數
function go_back($is_existed)
{
    $location = $_SERVER['HTTP_REFERER'] . "&Existed=" . $is_existed;
    header(sprintf("location: %s", $location));
}
