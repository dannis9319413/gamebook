<?php
session_start();
require_once("../../connection/connection.php");


if ($_SESSION['user']['password'] == $_POST['old_password'] && $_POST['new_password'] == $_POST['confirm_password']) {

    $sql = "UPDATE users SET password = :password WHERE user_id = " . $_SESSION['user']['user_id'];
    $sth = $db->prepare($sql);
    $sth->bindParam(":password", $_POST['new_password'], PDO::PARAM_STR);
    $sth->execute();

    //更新資料表後重新取得資料表到SESSION
    $query = $db->query("SELECT * FROM users WHERE user_id =" . $_SESSION['user']['user_id']);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $user;
    header('location: ../customer_account.php?msg=success');
} else {
    header('location: ../customer_account.php?msg=error');
}
