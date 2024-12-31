<?php
require("includes/common.php");
if (isset($_SESSION['user'])) {
    header('location: products.php?cat=all-products');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup | DevlierCart</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>


    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="login-form">
        <div class="login-div">
            <div class="form-user-icon">
                <div class="form-logo">SIGN UP</div>
            </div>
            <form action="signup_script.php" method="POST" class="fields-form">
                <div class="input-fields__form">
                    <i class="fab fa-adn"></i>
                    <input class="form-control" placeholder="Name" name="name" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$">
                </div>
                <div class="input-fields__form">
                    <i class="far fa-user"></i>
                    <input type="email" class="form-control" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="e-mail" required="true"><?php if (isset($_GET["m1"])) {
                                                                                                                                                                    } ?>
                </div>
                <div class="input-fields__form">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-control" placeholder="Password" pattern=".{6,}" name="password" required="true">
                </div>
                <div class="input-fields__form">
                    <i class="fas fa-phone-square-alt"></i>
                    <input type="text" class="form-control" placeholder="Contact" maxlength="10" size="10" name="contact" required="true"><?php if (isset($_GET["m2"])) {
                                                                                                                                            } ?>
                </div>
                <div class="input-fields__form">
                    <i class="fas fa-building"></i>
                    <input type="text" class="form-control" placeholder="City" name="city" required="true">
                </div>
                <div class="input-fields__form">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" class="form-control" placeholder="Address" name="address" required="true">
                </div>
                <div class="form-btn">
                    <button type="submit" name="submit" class="login-btn">Submit</button>
                </div>
            </form>>
            <hr>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>