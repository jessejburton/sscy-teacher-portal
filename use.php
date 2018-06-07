<?php
    require_once('header.php');

    if(!isset($_SESSION['loggedin'])){
        require_once('templates/login/login.php');
    }

    require_once('footer.php');
?>
