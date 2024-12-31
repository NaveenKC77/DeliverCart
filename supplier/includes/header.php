<script type="text/JavaScript">
    function myDelete(){
        var modal = document.getElementById("modal");
        var overlay = document.getElementById("overlay");
        modal.style.visibility = "visible";
        overlay.style.visibility = "visible";
    }
</script>
<script type="text/JavaScript">
    function myDelete(){
        var modal = document.getElementById("modal");
        var overlay = document.getElementById("overlay");
        modal.style.visibility = "visible";
        overlay.style.visibility = "visible";
    }
</script>
<style>
    body {
        font-family: 'poppins', sans-serif;
    }

    .header-navbar {
        padding-bottom: 1.4rem;
        background-color: #112;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 999;
    }

    .header-navbar a {
        color: #515779;

    }

    .header-navbar .navbar-brand,
    .header-navbar .dropdown-toggle {
        color: #fff;
    }

    .header-navbar .dropdown-toggle {
        background-color: #112;
    }

    .header-navbar .dropdown-toggle:focus {
        color: #112;
    }

    .header-navbar .dropdown-toggle:hover {
        color: #112;
    }

    .dropdown-menu {
        padding: 0 1rem;
        background-color: #141425;
        color: #fff;
    }

    .dropdown-menu li a {
        color: #fff;
        font-size: 1.6rem;
        margin: 1rem 0;
    }

    .header-navbar .login-link {
        background-color: #fff;
        border-radius: 1rem;
    }


    .navbar-toggle .icon-bar {
        width: 25px;
        height: 3px;
        background-color: #fff;
    }

    #myNavbar {
        width: 100%;
        margin: auto;
        overflow: hidden;
    }

    .login-link {
        margin-left: 1rem;
        margin-right: 1rem;
    }
</style>
<script src="https://kit.fontawesome.com/a8faa41592.js" crossorigin="anonymous"></script>
<header class="header-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">DELIVERCART</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['email'])) {
                ?>
                        <li><a href="update_info.php"><span class="glyphicon glyphicon-user"></span> Update Supplier </a></li>
                        <li onclick="myDelete()"><a><span class="glyphicon glyphicon-remove"></span> Delete Account </a></li>
                        <li><a href="settings.php"><span class="glyphicon glyphicon-user"></span> Reset Password</a></li>
                        <li><a href="logout_script.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <?php
                } else {
                ?>
                    <!-- Signup options -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signup <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../signup.php">Customer Signup</a></li>
                            <li><a href="../supplier/signup.php">Supplier Signup</a></li>
                        </ul>
                    </li>
                    <li><a class="login-link" href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php
                }
                ?>


            </ul>
        </div>
    </div>
</header>
<?php include "../includes/backdrop.php" ?>