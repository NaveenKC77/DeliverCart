<?php require("../includes/common.php");
if (!isset($_SESSION["supplier"])) {
    header('location : ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Supplier | DevlierCart</title>
    <link href="../css/login.css" rel="stylesheet">
    <style>
        .title__form{
            color: #fff;
        }
    </style>
    <?php include "includes/styles_js_links.php"; ?>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="login-form" id="content">
        <div class="row">
            <?php if (isset($_GET["m3"])) {
                echo $_GET['m3'];
            } ?>
            <h2 class="title__form">Update User Information</h2>
            <form action="update_script.php" class="fields-form" method="POST">
                <div class="input-fields__form">
                <i class="far fa-user"></i>
                    <input class="form-control" placeholder="Name" name="name" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$">
                </div>
                <div class="input-fields__form">
                <i class="fas fa-phone-square-alt"></i>
                    <input type="text" class="form-control" placeholder="Contact" maxlength="10" size="10" name="contact" required="true"><?php if (isset($_GET["m2"])) {echo $_GET['m2'];} ?>
                </div>
                <div class="input-fields__form">
                <i class="fas fa-map-marker-alt"></i>
                    <input type="text" class="form-control" placeholder="Address" name="address" required="true">
                </div>
                <div class="form-btn">
                        <button type="submit" name="submit" class="login-btn">Submit</button>
                    </div>
            </form>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
</body>

</html>