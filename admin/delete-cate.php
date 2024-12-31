<?php
require("../includes/common.php");
if (!isset($_SESSION['admin'])) {
  header('location: ../index.php');
}
?>
<?php 

$id = $_GET['id'];

$insertquery = "delete from category where id = '$id'";
            $iquery = mysqli_query($con, $insertquery);

            if($insertquery){
              header("location: all-category.php");
            }
?>