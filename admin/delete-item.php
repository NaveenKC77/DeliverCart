<?php
require("../includes/common.php");
if (!isset($_SESSION['admin'])) {
  header('location: ../index.php');
}
?>
<?php 

$id = $_GET['id'];

$insertquery = "delete from items where id = '$id'";
            $iquery = mysqli_query($con, $insertquery);

            if($insertquery){
              header("location: all-item.php");
            }
?>