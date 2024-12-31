<?php
    require("includes/common.php");
    if (!isset($_SESSION['email'])) {
        header('location: login.php');
        exit();
    }
    $user_id=$_SESSION["user"];
    #session_start();
    session_destroy();
    $stmt = "Delete From users where id=".$user_id;
    mysqli_query($con, $stmt);
    header('location: index.php');
?>