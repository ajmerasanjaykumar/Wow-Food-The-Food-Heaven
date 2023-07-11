<?php include('../config/constants.php') ?>


<?php

    //1. destroy the session
    session_destroy(); // unsets $_SESSION['user']


    // 2.redirect to loginpage
    header('location:'.SITEURL.'admin/login.php');

?>
