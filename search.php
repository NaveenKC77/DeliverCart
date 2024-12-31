<?php require("includes/common.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .sorting-options ul{
            list-style: none;
        }
        .sorting-options ul li{
            margin: 3px;
        }
        .right{
            float: right;
        }
        .tapped{
            background: #464b6b;
        }

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
        }

        .product__name{
            margin-bottom: 1rem;
            font-size: 2rem;
            text-transform: capitalize;
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

        .section__title{
            border-bottom: 2px solid #666;
            font-size: 3rem;
        }

        @media screen and (max-width: 991px) {
            .product__box{
                text-align: center;
            }
        }


    </style>
</head>
<body>
    <?php include("includes/header.php"); 
    include 'includes/backdrop.php';
        include('includes/check-if-added.php');
    ?>
    <div class="container">
    <?php
        $key = $_GET["keyword"];
        $sort = $_GET["sort"];
        if($sort=='asc'){
            echo '
            <div class="sorting-options">
                <ul>
                    <li class="right"><a href='."search.php?keyword=".$key."&sort=desc". '  class="btn btn-primary">↑</a></li>
                    <li class="right"><a href='."search.php?keyword=".$key."&sort=asc". ' class="btn tapped btn-primary">↓</a></li>
                    <li class="right btn btn-primary">Sort</li>
                </ul>
            </div>';
        }else{
            echo '
            <div class="sorting-options">
                <ul>
                    <li class="right"><a href='."search.php?keyword=".$key."&sort=desc". '  class="btn tapped btn-primary">↑</a></li>
                    <li class="right"><a href='."search.php?keyword=".$key."&sort=asc". ' class="btn btn-primary">↓</a></li>
                    <li class="right btn btn-primary">Sort</li>
                </ul>
            </div>';

        }
        
        ?>
    <h2 class="section__title">Search Results '<?php echo $key; ?>'</h2>
    
        <?php
            
            if ($sort=='asc'){
                $stmt = "Select *, id as item_id from `items` where name like '%".$key."%' order by price";
            }
            else if($sort == 'desc'){
                $stmt = "Select *, id as item_id from `items` where name like '%".$key."%' order by price desc";
            }
            else{
                $stmt = "Select *, id as item_id from `items` where name like '%".$key."%'";
            }
            $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
            $num_rows = mysqli_num_rows($result);
            if ($num_rows){
                $count = 4;
                $global_count=0;
                $flag=FALSE;
                if($num_rows%4){
                    $flag=True;
                }
                while($row = mysqli_fetch_array($result)){
                    $global_count+=1;
                    $count = ($count==4) ? 1 : $count+1;
                        if($count==1){
                            echo "<div class='row text-center'>";
                        }
                        echo "<div class='col-md-3 col-sm-6 home-feature'>
                        <div class='thumbnail product__box'>
                            <img src= ".$row['photo']. " alt=''>
                            <div class='caption'>
                                <h3 class='product__name'>".strtolower(substr($row['name'],0,17))."...". "</h3>
                                <p class='product__price'>Price: $".$row["price"]. "</p>";
                                echo '<a href='."product_details.php?id=".$row["item_id"]. ' name="add" value="add" class="details__btn">Product Details</a>';
                        
                            echo "</div>
                        </div>
                    </div>
                        ";
                    if($count==4){
                        echo "</div>";
                    }
                    
                    if($flag && $global_count==$num_rows){
                        echo "</div>";
                    }
                
                }
            }
            else{
                echo "<div class='container row' style='margin-bottom:287px;'>
                    </hr>
                    <h3>No Results Found!</h3>
                    </hr>    
                </div>";
            }
        ?>
       </div> 
    <?php include("includes/footer.php") ?>
</body>
</html>