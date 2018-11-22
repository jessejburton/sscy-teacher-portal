<?php 
    session_start(); 

    // Logout if necessary
    if( isset($_GET['logout']) ){
        session_destroy();
        header("Location: index.php");
    }
    
?>

<!doctype html>
<html class="no-js" lang="en" ng-app="SSCY">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="mobile-web-app-capable" content="yes">
        <title>SALT SPRING CENTRE OF YOGA - TEACHERS PORTAL</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- ICONS -->
        <script src="js/vendor/fontawesome-all.min.js"></script>

        <!-- JQUERY UI -->
        <link rel="stylesheet" href="css/vendor/jquery-ui.min.css"> 

        <!-- Angular DatePicker -->
        <link rel="stylesheet" href="css/vendor/angular-datepicker.css">
        
        <!-- Slider -->
        <link rel="stylesheet" href="css/vendor/angular-slider.css">                
        
        <!-- STYLES -->
        <link rel="stylesheet" href="css/style.min.css">
        <link rel="stylesheet" id="google_fonts-css" href="https://fonts.googleapis.com/css?family=Crimson+Text%3A400i%7CRoboto%3A300%2C400&amp;ver=4.9.6" type="text/css" media="all">
    </head>

    <body>

        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!--
            HEADER
            Site header.
        -->
        <header class="header bright-background">
            <!-- Menu Header -->
            <nav class="menu-header">
                <?php if(isset($_SESSION["user_id"])) { ?>
                    <a class="menu-header__link home-link" href="#" title="Home">
                        <span class="screen-reader">Home</span><?php require('lotus-white-svg.php'); ?>
                    </a>
                    <a class="mobile-nav" href="#" title="toggle menu" onclick="toggleMenu(0)">MENU</a>
                    <div class="menu-main-menu-container">
                        <ul id="menu-main-menu" class="menu" ng-controller="navigationController">
                            <li class="menu-item" ng-repeat="item in navItems track by item.id" ng-cloak>
                                <a href="{{item.link}}">{{item.text}}</a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </nav>

            <!-- Welcome and Log Out -->
            <div class="profile_links">
                <?php if(isset($_SESSION["user_id"])) { ?>
                    <span class="welcome">Welcome <strong><?php echo $_SESSION["name"]; ?></strong></span> | 
                    <a href="index.php?logout">logout</a>
                    <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" id="hidden_user_id" />
                <?php } ?>
            </div>
        </header>

        <!-- .header -->

<!--
    MAIN SECTION
    Contains the main content of the site.
-->
<main>

<!-- Get user to log in if needed -->
<?php 
    if(!isset($_SESSION['user_id'])) {
        require_once('templates/login/login.php');
        require_once('footer.php');
        die();
    } 
?>