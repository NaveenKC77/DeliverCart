<?php
require("includes/common.php");
if (isset($_SESSION['admin'])) {
    header('location:admin/home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | DeliverCart</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .heading__section {
            text-align: center;
        }

        .section__subtitle {
            color: #666;
        }

        .product__headings {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 2px solid #666;
        }

        .product__headings span {
            font-size: 2.5rem;
        }

        .tapped a {
            background: #000;
        }

        .product__headings ul {
            display: flex;
            list-style: none;
            column-gap: 0.4rem;
        }

        .product__box {
            border: none;
            box-shadow: 15px 15px 40px #5e707c48;
            background: #eeeeee;
            text-align: left;
            padding-bottom: 1rem;
        }
        
        .product__box .product__img{
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: center;
        }

        .product__name{
            margin-bottom: 1rem;
        }

        .product__price{
            margin-bottom: 2rem;
        }
        .details__btn{
            padding: 8px 15px;
            background: #006EFD;
            border-radius: 4px;
            color: #fff;
            font-weight: 400;
        }
        .details__btn:hover{
            color: #fff;
            text-decoration: none;
            background: #0966DF;
        }

        .line{
            opacity: 0;
        }

        @media screen and (max-width: 991px) {
            .product__box{
                text-align: center;
            }
        }

    </style>

</head>

<body>
    <?php
    include 'includes/header.php';
    include 'includes/backdrop.php';
    include 'includes/check-if-added.php';
    ?>
    <div class="container" id="content">

        <div class="heading__section" id="products-jumbotron">
            <?php
            $cat = $_GET["cat"];
            if ($cat == 'all-products') {
                echo "<h1 class='section__title'>Welcome to DeliverCart</h1>
                    <p class='section__subtitle'>All kinds of daily necessary things like milk, eggs, bread, oil, sugar, salt, cool-drinks etc are found in a grocery stores.</p>
                    ";
            } else {
                $stmt = "Select * from `category` where `cat_slug`='$cat'";
                $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
                $row = mysqli_fetch_array($result);
                if (mysqli_num_rows($result)) {
                    echo "<h1 class='section__title'>Welcome to " . strtolower($row["name"]) . " section. </h1>
                        <p class='section__subtitle'>" . $row["desc"] . "</p>";
                }
                #else{
                #    http_response_code(404);
                #    header('location:404.php');
                #    exit;
                #}
            }
            ?>
        </div>
        <div class='product__headings'>
            <span>Products</span>
            <?php
            if ($_GET['sort'] == 'asc') {
                echo '
                    <div class="sorting-options">
                        <ul>
                        <li class="right btn btn-primary">Sort</li>
                            <li class="right"><a href=' . "products.php?cat=" . $cat . "&sort=desc" . '  class="btn btn-primary">↑</a></li>
                            <li class="right tapped"><a href=' . "products.php?cat=" . $cat . "&sort=asc" . ' class="btn btn-primary">↓</a></li>
                        </ul>
                    </div>';
            } else {
                echo '
                    <div class="sorting-options">
                        <ul>
                        <li class="right btn btn-primary">Sort</li>
                            <li class="right tapped"><a href=' . "products.php?cat=" . $cat . "&sort=desc" . '  class="btn btn-primary">↑</a></li>
                            <li class="right"><a href=' . "products.php?cat=" . $cat . "&sort=asc" . ' class="btn btn-primary">↓</a></li>
                        </ul>
                    </div>';
            }
            ?>
        </div>
        <hr class="line">

        <?php
        $sort = $_GET["sort"];
        $count = 4;
        $global_count = 0;
        $flag = False;
        if ($cat == 'all-products') {
            if ($sort == 'asc') {
                $stmt = "Select *, id as item_id from items order by price";
            } else if ($sort == 'desc') {
                $stmt = "Select *, id as item_id from items order by price desc";
            } else {
                $stmt = "Select *, id as item_id from items";
            }
        } else {
            if ($sort == 'asc') {
                $stmt = "SELECT items.id as item_id, items.name as name, items.price as price, items.photo as photo from category INNER join items on items.category_id = category.id where category.cat_slug = '$cat' order by price";
            } else if ($sort == 'desc') {
                $stmt = "SELECT items.id as item_id, items.name as name, items.price as price, items.photo as photo from category INNER join items on items.category_id = category.id where category.cat_slug = '$cat' order by price desc";
            } else {
                $stmt = "SELECT items.id as item_id, items.name as name, items.price as price, items.photo as photo from category INNER join items on items.category_id = category.id where category.cat_slug = '$cat'";
            }
        }
        $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
        $num_rows = mysqli_num_rows($result);
        if ($num_rows % 4) {
            $flag = TRUE;
        }
        if ($num_rows) {
            while ($row = mysqli_fetch_array($result)) {
                $global_count += 1;
                $count = ($count == 4) ? 1 : $count + 1;
                if ($count == 1) {
                    echo "<div class='row text-center'>";
                }
                echo "<div class='col-md-3 col-sm-6'>
                        <div class='thumbnail product__box'>
                            <img src= " . $row['photo'] . " class='product__img' alt=''>
                            <div class='caption'>
                                <h3 class='product__name'>" . substr($row['name'], 0, 13) . "..." . "</h3>
                                <p class='product__price'>Price: $" . $row["price"] . "</p>";
                echo '<a href=' . "product_details.php?id=" . $row["item_id"] . ' name="add" value="add" class="details__btn">Product Details</a>';

                echo "</div>
                        </div>
                    </div>
                        ";
                if ($count == 4) {
                    echo "</div>";
                }
                if ($flag && $global_count == $num_rows) {
                    echo "</div>";
                }
            }
        } else {
            echo "</hr>
                        <h3>Currently no product found in this category</h3>
                        <p>Please visit again after sometime</p>
                        </hr>
                    ";
        }
        ?>

    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>


