<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
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

    .header-navbar a{
        color: #515779;
        
    }

    .header-navbar .navbar-brand,.header-navbar .dropdown-toggle, .link{
        color: #fff;
    }
    .header-navbar .dropdown-toggle{
        background-color: #112;
    }
    .header-navbar .dropdown-toggle:focus{
        color: #112;
    }
    .header-navbar .dropdown-toggle:hover{
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

    .header-navbar .login-link{
        background-color: #fff;
        border-radius: 1rem;
    }


    .navbar-toggle .icon-bar {
        width: 25px;
        height: 3px;
        background-color: #fff;
    }
    #myNavbar{
        width: 100%;
        margin: auto;
        overflow: hidden;
    }

    .login-link{
        margin-left: 1rem;
        margin-right: 1rem;
    }
</style>


<header class="header-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="home.php">Admin Panel</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
            <li><a class="dropdown-toggle" href = "all-category.php">Category</a>
            </li>
            <li><a class="dropdown-toggle" href = "all-item.php">Products</a>
            </li>
         
                    <li><a class="dropdown-toggle" href = "logout_script.php"><span class = "glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</header>