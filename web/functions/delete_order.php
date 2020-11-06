<?php
require_once('../../connection/connection.php');

//刪除訂單
$sql = "DELETE FROM customer_orders WHERE customer_orders_id =" . $_GET['order_id'];
$sth = $db->prepare($sql);
$sth->execute();

//刪除訂單項目
$sql2 = "DELETE FROM order_details WHERE customer_orders_id =" . $_GET['order_id'];
$sth2 = $db->prepare($sql2);
$sth2->execute();



header('Location: ../customer_orders.php?del=true');
