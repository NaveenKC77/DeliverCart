<?php
require_once("../includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings | DevlierCart</title>
    <link href="../css/login.css" rel="stylesheet">
    <style>
        .title__form {
            color: #fff;
            text-align: center;
        }
    </style>
    <?php include "includes/styles_js_links.php" ?>
</head>

<body>
    <?php include 'includes/header.php';
    include '../includes/backdrop.php'; ?>
    <div class="login-form" id="content">
        <div class="row">
                <h4 class="title__form">Change Password</h4>
                <form action="settings_script.php" class="fields-form" method="POST">
                    <div class="input-fields__form">
                        <i class="fas fa-key"></i>
                        <input type="password" class="form-control" name="old-password" placeholder="Old Password" required="true">
                    </div>
                    <div class="input-fields__form">
                        <i class="fas fa-key"></i>
                        <input type="password" class="form-control" name="password" placeholder="New Password" required="true">
                    </div>
                    <div class="input-fields__form">
                        <i class="fas fa-key"></i>
                        <input type="password" class="form-control" name="password1" placeholder="Re-type New Password" required="true">
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="login-btn">Change</button><br><br>
                    </div>
                    <?php if (isset($_GET['error'])) {
                        echo "<br><br><b class='red'>" . $_GET['error'] . "</b>";
                    }
                    ?>
                </form>
        </div>
    </div>
    <?php include("../includes/footer.php"); ?>
</body>

</html>