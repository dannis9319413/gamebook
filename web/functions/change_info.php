<?php
session_start();
require_once("../../connection/connection.php");


$sql = "UPDATE users SET name = :name, gender = :gender, phone = :phone, mobile = :mobile, zip = :zip, county = :county, district = :district, address = :address  WHERE user_id = " . $_SESSION['user']['user_id'];

$sth = $db->prepare($sql);
$sth->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
$sth->bindParam(":gender", $_POST['gender'], PDO::PARAM_STR);
$sth->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
$sth->bindParam(":mobile", $_POST['mobile'], PDO::PARAM_STR);
$sth->bindParam(":zip", $_POST['zipcode'], PDO::PARAM_STR);
$sth->bindParam(":county", $_POST['county'], PDO::PARAM_STR);
$sth->bindParam(":district", $_POST['district'], PDO::PARAM_STR);
$sth->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
$sth->execute();

//重新取得資料至SESSION
$query = $db->query("SELECT * FROM users WHERE user_id = " . $_SESSION['user']['user_id']);
$user = $query->fetch(PDO::FETCH_ASSOC);
$_SESSION['user'] = $user;

header('location: ../customer_account.php?change_info=success');
