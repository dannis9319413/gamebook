
<?php
require_once("../../connection/connection.php");
$sql = "DELETE FROM users WHERE user_id =" . $_GET['user_id'];
$sth = $db->prepare($sql);
$sth->execute();

header('Location: list.php?');


?>