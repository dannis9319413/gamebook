<?php
session_start();
require_once("../../connection/connection.php");
$query = $db->query("SELECT * FROM users WHERE email= '" . $_POST['email'] . "' AND password='" . $_POST['password'] . "'");
$has_user = $query->fetch(PDO::FETCH_ASSOC);
if ($has_user > 0) {
    print_r($_SESSION['has_user'] = $has_user);
    $_SESSION['user'] = $has_user;
    header('location: ../../index.php?msg=login_success');
} else {
    $_SESSION['user'] = 'none';
    header('location: ../login.php');
}
