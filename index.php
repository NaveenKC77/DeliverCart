<?php
require("includes/common.php");
if (isset($_SESSION["supplier"])) {
    header('location: supplier/home.php');
}


// Redirects the user to products page if he/she is logged in.
#if (isset($_SESSION['email'])) {
#  header('location: products.php?cat=all-products');
#}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .item__img{
            width: 80%;
        }
        
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | DevlierCart</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Header styling -->
    <link rel="stylesheet" href="css/header.css">
</head>

<body style="padding-top: 50px;">
    <!-- Header -->
    <?php
    include 'includes/header.php';
    include 'includes/backdrop.php';
    ?>
    <!--Header end-->
    <div id="content">
        <!--Main banner image-->
        <div id="banner_image">
            <div class="container">
                <center>
                    <div id="banner_content">
                        <h1 class="section__title">WE GROW REAL VEGETABLES</h1>
                        <p class="section__subtitle">Best quality farm-grown products, We deliver to every global family or store.
                        </p>
                        <br />
                        <a href="products.php?cat=all-products&sort=none" class="shop-now-btn">SHOP</a>
                    </div>
                </center>
            </div>
        </div>
        <!--Main banner image end-->

        <!--Item categories listing-->
        <div class="products__container" id=item-list>
            <?php
            $stmt = "Select * from `category`";
            $result = mysqli_query($con, $stmt) or die($mysqli_error($con));
            $num_items = mysqli_num_rows($result);
            $global_count = 0;
            $flag = ($num_items % 3) ? TRUE : FALSE;

            $count = 3;
            while ($row = mysqli_fetch_array($result)) {
                $global_count += 1;
                $count = ($count == 3) ? 1 : $count + 1;
                if ($count == 1) {
                    echo "<div class='products__div'>";
                }
                echo "
                       <div class='one__product'>
                            <img class='item__img' src=" . $row["image"] . " alt=''>
                            <h3 class='one__product-name'>" . $row["name"] . "</h3>
                            <a  href=" . 'products.php?cat=' . $row["cat_slug"] . '&sort=none' . " class='one__product-link'>View Products</a>
                        </div>
                            ";
                if ($count == 3) {
                    echo "</div>";
                }
                if ($flag && $global_count == $num_items) {
                    echo "</div>";
                }
            }
            ?>
        </div>
        <!--Footer-->
        <?php
        include 'includes/footer.php';
        ?>
        <!--Footer end-->

</body>

</html>