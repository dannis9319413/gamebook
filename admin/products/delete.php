
<?php
require_once("../../connection/connection.php");
$sql = "DELETE FROM products WHERE product_id =" . $_GET['product_id'];
$sth = $db->prepare($sql);
$sth->execute();

header('Location: list.php?');


?>