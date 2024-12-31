<?php 
require "../includes/common.php";
$option = $_GET["option"];
$id = $_GET["id"];
$stmt = "UPDATE supplier SET status = '$option' where id = '$id'";
mysqli_query($con, $stmt) or die(mysqli_error($con));
header('location: home.php');
?>