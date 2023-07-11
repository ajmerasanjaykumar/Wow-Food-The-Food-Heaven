
<?php include('../config/constants.php') ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Login</h1>

            <br>
            <br>

            <?php

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

<br>
            <br>


            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">

                Username : <br>
                <input type="text" name="username" placeholder="Enter Username">
                <br><br>
                Password  :  <br>
                <input type="password" name="password" placeholder="Enter Passwod">
                <br><br>
                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>
            <br><br>


            <p class="text-center">Created By<a href="https://ajmerasanjaykumar.github.io/cv-sanju/">Sanjay</a></p>

        </div>
        

    </body>
</html>



<?php
    // once submit button is clicked then 
    if(isset($_POST['submit']))
    {
        // get data from login form

        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=md5($_POST['password']);

        // sql query for user with username and password  exist or not in database
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

        $res=mysqli_query($conn,$sql);

        $count= mysqli_num_rows($res);
        // donot make two users with same username //
        if($count==1)
        {
            // user available
            $_SESSION['login']="<div class='success'>Login Successfully</div>";
            $_SESSION['user']=$username; // to check whether the user is logged in or not and logged out will unset it

            header("location:".SITEURL."admin/");
        }
        else
        {
            // user not available
            $_SESSION['login']="<div class='error text-center' >Login Unsuccessfully</div>";
            header("location:".SITEURL."admin/login.php");
        }

    }


?>