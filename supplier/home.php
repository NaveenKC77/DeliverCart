<?php require('../includes/common.php');
if(!isset($_SESSION["supplier"])){
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier | Homepage</title>
    <?php include 'includes/styles_js_links.php'; ?>
    <script type="text/JavaScript">
        const myfunc = (id) =>{
            const cell=document.getElementById(id)
            //cell.style.backgroundColor = "green"
            //cell.innerHTML = "delivered"
            window.location.href="status_update.php?id="+id

        }
    </script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container" id="content">
    <?php
        $error = isset($_GET['error']) ? $_GET["error"] : "";
        echo "".$error;
        $id = $_SESSION['supplier']; 
        $stmt = "Select * from supplier_items where supplier_id=".$id;
        $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
        $num = mysqli_num_rows($result);
        if (!$num){
            echo "There is no Order for you.";
        }
        else{
    ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Product Name</td>
                    <td>Customer Name</td>
                    <td>Customer Address</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $index=0;
                    while($row = mysqli_fetch_array($result)){
                        $customer_query = "Select name, address from users where id=".$row["user_id"];
                        $customer_result = mysqli_query($con, $customer_query) or die(mysqli_error($con));
                        $num_rows = mysqli_num_rows($customer_result);
                        $customer_name = "Not available";
                        $customer_address = "Not available";
                        if($num_rows){
                            $customer_row = mysqli_fetch_array($customer_result);
                            $customer_name = $customer_row["name"];
                            $customer_address = $customer_row["address"];
                        }
                        $item_query = "Select name from items where id=".$row["item_id"];
                        $item_result = mysqli_query($con, $item_query) or die (mysqli_error($con));
                        $item_name = "Not available";
                        $num_rows = mysqli_num_rows($item_result);
                        if ($num_rows){
                            $item_row = mysqli_fetch_array($item_result);
                            $item_name = $item_row["name"];
                        }
                        $index+=1;
                ?>
                <tr>
                    <td><?=$index?></td>
                    <td><?=$item_name?></td>
                    <td><?=$customer_name?></td>
                    <td><?=$customer_address?></td>
                    <?php if($row["status"]=="not delivered"){?>
                        <td id=<?=$row["id"]?> style="background-color: red; color:white; pointer:cursor;" onclick="myfunc(<?=$row['id']?>)">
                        <?=$row["status"]?></td>
                    <?php }
                    else{ ?>
                        <td id=<?=$row["id"]?> style="background-color: green; color:white; pointer:cursor;" onclick="myfunc(<?=$row['id']?>)">
                        <?=$row["status"]?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>