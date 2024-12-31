<?php

require("../includes/common.php");

  // Getting the values from the signup page using $_POST[] and cleaning the data submitted by the user.
  $name = $_POST['name'];
  $name = mysqli_real_escape_string($con, $name);

  $contact = $_POST['contact'];
  $contact = mysqli_real_escape_string($con, $contact);

  $address = $_POST['address'];
  $address = mysqli_real_escape_string($con, $address);

  $regex_num = '/^\d{10}$/';


  if (!preg_match($regex_num, $contact)) {
    $m = "<span class='red'>Not a valid phone number</span>";
    header('location: update_info.php?m2=' . $m);
  } else {
    $id = $_SESSION['supplier'];

    $query = "UPDATE supplier SET name = '$name' , contact = '$contact', address = '$address' where id = '$id'";
    mysqli_query($con, $query) or die(mysqli_error($con));
    $m = "<h4 class ='red'> Updated Successfully </h4>";
    header('location: update_info.php?m3='. $m);
  }
?>
