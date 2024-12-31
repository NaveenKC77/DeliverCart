<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/modal.css" rel="stylesheet">
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>Signup Message</title>
    <style>
        .jumbotron{
            text-align: center;
            background-color: #fff;
        }
        
    </style>
</head>
<body>
    <?php
        include("includes/header.php");
    ?>
    <div class="container">
        <div class="jumbotron" style="margin-bottom:220px;">
            <h1 class="section__title">Welcome Supplier</h1>
            <p class="para" style="color: #222;font-weight: 500;">Give us some time to review your application and
            try logging in after sometime.</p>
        </div>
    </div>
    <?php
        include("../includes/footer.php")
    ?>
</body>
</html>