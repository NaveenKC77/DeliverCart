<?php
    require "includes/common.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/modal.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/review.js"></script>
</head>

<body>

    <?php include("includes/header.php");
        include 'includes/backdrop.php';
        include("includes/check-if-added.php");
    ?>
    <?php
        $id=$_GET["id"];
        $stmt = "Select * from items where id=".$id;
        $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
        $product = mysqli_fetch_array($result);
    ?>
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="<?=$product["photo"]?>" /></div>
                        </div>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title"><?=$product["name"]?></h3>
                        <p class="product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa
                            consequatur laudantium autem, nihil veniam esse sequi perspiciatis vitae, a odit earum cum
                            minus nobis eius impedit dicta saepe debitis itaque?</p>
                        <h4 class="price">current price: <span>&dollar;<?=$product["price"]?></span></h4>
                        <form method="POST">
                        <h4 class="price">Quantity: <span style="color:grey"> <input type="number" name="quan" value="1" style="width: 135px; height:40px; font-size: 16px; padding: 10px;" placeholder="Quantity"></span></h4>
                     

                        <div class="action">
                            <?php
                            $stmt = "select category_id from items where id=".$_GET["id"];
                            $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
                            $cat_id = mysqli_fetch_array($result)["category_id"];
                            $stmt = "select category.name as name , supplier.name as name, supplier.id as supplier_id from category inner join supplier on category.id = supplier.cat_id where cat_id=".$cat_id;
                            $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
                            $availability = true;
                            if (!(mysqli_num_rows($result))){
                                $availability=false;
                            }
                                if (!isset($_SESSION['email'])){
                                    echo "<p><a href='login.php' role='button' class='add-to-cart btn btn-default'>Buy Now</a></p>";
                                }
                                else {
                                    //We have created a function to check whether this particular product is added to cart or not.
                                    if (check_if_added_to_cart($product["id"])) {
                                    echo "<a href='' class='btn btn-default btn-success' disabled>Added to cart</a>";
									}
                                    elseif(!$availability){
                                        echo "<a href='' class='btn btn-default btn-danger' disabled>Currently Not Available</a>";   
                                    }
                                    else{
							          echo '<button href="" class="add-to-cart btn btn-default" name="submit">add to cart</button>';
                                      
								?>
                                </form>

                                <?php 
                                if (isset($_POST['submit'])) {
                                          echo $quan = $_POST['quan'];
                                          $user_id = $_SESSION['user'];
                                          $query = "INSERT INTO users_items(user_id, item_id, status, quantity) VALUES('$user_id', '$id', 'Added to cart', '$quan')";
   $q= mysqli_query($con, $query) or die(mysqli_error($con));
    if($q){
       ?>
       <script type="text/javascript">
           location.replace("cart.php");
       </script>

       <?php
    }
}
                                    }
                                }

                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Review Section -->
        <?php if (isset($_SESSION["user"])) {?>
        <div class="row" style="margin-top:0px;">
            <div class="col-md-12">
                <div class="well well-sm">
                    <div class="text-right">
                        <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a
                            Review</a>
                    </div>

                    <div class="row" id="post-review-box" style="display:none;">
                        <div class="col-md-12">
                            <form accept-charset="UTF-8" action="review_submit.php?id=<?=$id?>" method="post">
                                <input id="ratings-hidden" name="rating" type="hidden">
                                <textarea class="form-control animated" cols="50" id="new-review" name="comment"
                                    placeholder="Enter your review here..." rows="5"></textarea>

                                <div class="text-right">
                                    <div class="stars starrr" data-rating="0"></div>
                                    <a class="btn btn-danger btn-sm" href="#" id="close-review-box"
                                        style="display:none; margin-right: 10px;">
                                        <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Review-list-->
        <div class="row decor_bg">
            <div class="col-md-12">
                <?php
					 $stmt = "Select review.comment As comment, users.name As name from review Inner Join users on review.user_id=users.id where review.item_id=".$id;
					 $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
					 $num_rows = mysqli_num_rows($result);
					if ($num_rows){
					?>
                <table class="table table-striped">
                    <?php
						while($row=mysqli_fetch_array($result)){
							echo "<tr><td><span class='glyphicon glyphicon-user'></span> ".$row["name"]."</td>
							<td>".$row["comment"]."</td>
							</tr>";
						}
						?>
                </table>
                <?php } 
					else { ?>
                <div class="jumbotron">
                    <h4>No review found for this product.</h4>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
	<?php include("includes/footer.php"); ?>
</body>

</html>