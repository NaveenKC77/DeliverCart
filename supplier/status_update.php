<?php require "../includes/common.php";

$id = $_GET["id"];

$stmt = "Update supplier_items set status = 'delivered' where id =".$id;
mysqli_query($con, $stmt) or die(mysqli_error($con));

header("location: home.php");
?>