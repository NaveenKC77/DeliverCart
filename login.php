<?php
require("includes/common.php");
// Redirects the user to products page if logged in.
if (isset($_SESSION['user'])) {
    header('location: products.php');
}
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | DevlierCart</title>
    <script src="https://kit.fontawesome.com/a8faa41592.js" crossorigin="anonymous"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="login-form">
        <div class="login-div">
            <div class="form-user-icon">
                <span></span>
                <div class="form-logo"><i class="far fa-user"></i></div>
                <span></span>
            </div>
            <form action="login_submit.php" class="fields-form" method="POST">
                <div class="input-fields__form">
                    <i class="far fa-user"></i>
                    <input type="email" class="form-control" placeholder="Email" name="e-mail" required="true">
                </div>
                <div class="input-fields__form">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                </div>
                <div class="form-btn">
                    <button type="submit" name="submit" class="login-btn">Login</button><br><br>
                </div>
                    <?php if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    } ?>
            </form>
            <div class="signup-link__div">
                <p>Don't have an account? <a href="signup.php">Register</a></p>
            </div>


        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>