
<?php
require_once("../../connection/connection.php");
$sql = "DELETE FROM news WHERE news_id =" . $_GET['news_id'];
$sth = $db->prepare($sql);
$sth->execute();

header('Location: list.php?');


?>