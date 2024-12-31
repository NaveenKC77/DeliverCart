<?php
    require('includes/common.php');
    $user_id = $_SESSION['user'];
    $item_id = $_GET["id"];
    $comment = $_POST["comment"];
    $stmt = "Insert into `review`(`comment`,`user_id`,`item_id`) values('$comment','$user_id','$item_id')";
    mysqli_query($con, $stmt) or die(mysqli_error($con));
    header('location:'.'product_details.php?id='.$item_id);
?>