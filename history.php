<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart | DevlierCart</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<?php include 'includes/header.php';
             include 'includes/backdrop.php'; 
        ?>
    <div class="container-fluid" id="content">
        
        <div class="row decor_bg">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-striped">
      
                    <!--show table only if there are items added in the cart-->
                    <?php
                        $id_arr = array();
                        $sum = 0;
                        $user_id = $_SESSION['user'];
                        $query = "SELECT items.price AS Price, items.id AS id, users_items.quantity AS Quantity, items.name AS Name FROM users_items JOIN items ON users_items.item_id = items.id WHERE users_items.user_id='$user_id' and status='confirmed'";
                        $result = mysqli_query($con, $query)or die(mysqli_error($con));
                        if (mysqli_num_rows($result) >= 1) {
                            ?>
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $count=0;
                                while ($row = mysqli_fetch_array($result)) {
                                   
                                    $count+=1;
                                    
                                    $id = $row['id'];
                                    $quan = $row['Quantity'];
                                    $sum+= $quan*$row["Price"];
                                    array_push($id_arr,$id);
                                    echo "<tr><td>" . "#" . $count . "</td><td>" . $row["Name"] . "</td><td>$ " . $row["Price"] . "</td><td>".$quan. "</td><td>$".$quan*$row["Price"]."</td></tr>";

                                #$id = rtrim($id, ", ");
                            }

                        
                                echo "<tr><td></td><td></td><td></td><td>Total sales</td><td>$ " . $sum . "</td><td></td>";
                              
                                ?>
        <?php
            } else {
                echo "Nothing In History to show !!!";
            }?>
        </tbody>
                </table>
    </div>
    </div>
  
        </div>
        </div>
    <?php include("includes/footer.php"); ?>
</body>

</html>