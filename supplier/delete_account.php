<?php
    require("../includes/common.php");
    if (!isset($_SESSION['supplier'])) {
        header('location: ../login.php');
        exit();
    }
    $user_id=$_SESSION["supplier"];
    #session_start();
    $stmt = "Select * from supplier_items where status= 'not delivered' and supplier_id=".$user_id;
    $result = mysqli_query($con, $stmt) or die ($mysqli_error($con));
    $num_rows  = mysqli_num_rows($result);
    if($num_rows){
        header('location: home.php?error=<span color="red"> You can delete your account after completing all the deliveries');
        exit();
    }
    $stmt = "Delete From supplier where id=".$user_id;
    mysqli_query($con, $stmt);
    session_destroy();
    header('location: ../index.php');
?>