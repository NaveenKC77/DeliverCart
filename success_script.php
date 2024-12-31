<?php
require("includes/common.php");
$user_id = $_SESSION['user'];
$item_ids_string = $_GET['itemsid'];
$items_id_arr = explode(",",$item_ids_string);

//We will change the status of the items purchased by the user to 'Confirmed'
foreach ($items_id_arr as $item_id) {
    $supplier = array();
    $stmt = "Select category_id as cat_id from items where id=".$item_id;
    $result = mysqli_query($con, $stmt) or die (mysqli_error($con));
    $cat_id=mysqli_fetch_array($result)['cat_id'];
    $stmt = "Select id as supplier_id from supplier where cat_id=".$cat_id;
    $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result)){
        array_push($supplier,$row['supplier_id']);
    }
    $random_supplier = array_rand($supplier);
    $stmt = "Insert Into supplier_items(user_id, supplier_id, item_id) values('" . $user_id . "','" . $supplier[$random_supplier] . "','" . $item_id . "')";
    mysqli_query($con, $stmt) or die(mysqli_error($con));
    $query = "UPDATE users_items SET status='Confirmed' WHERE user_id=" . $user_id . " AND item_id = ".$item_id." and status='Added to cart'";
    mysqli_query($con, $query) or die(mysqli_error($con));
}
header('location: success.php');
?>