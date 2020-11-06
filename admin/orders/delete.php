
<?php
require_once("../../connection/connection.php");
$sql = "DELETE FROM customer_orders WHERE customer_orders_id  =" . $_GET['order_id'];
$sth = $db->prepare($sql);
$sth->execute();

header('location: list.php');


?>