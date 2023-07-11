<?php include('partials/menu.php'); ?>



<div class="main-content">

    <div class="wrapper">
        <h1>Add Admin</h1>
        
        <br><br>

        <?php
            // checking the message is set or not
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // displayng session message 
                unset($_SESSION['add']); // removing displayed message
            }
        ?>

        <!-- method should be POST -->
        <form action="" method="POST" >

            <table class="tbl-30" >

                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>



            </table>


        </form>
    </div>



</div>


<?php include('partials/footer.php'); ?>


<?php 
// in th post method is submit is true or false 
    if(isset($_POST['submit']))
    {
        // echo "Button Clicked";

        // get data 
        $full_name = $_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        // save data to database
        // query is ready //
        $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";

        //  echo $sql;

        
        // executing query //
        $res = mysqli_query( $conn , $sql ) or die(mysqli_error()) ;
        
        if($res==TRUE)
        {
            // echo "data inserted";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Added Admin Succesfully</div>";

            // redirect page (we need to redirect to previous page )
            header("location:".SITEURL."admin/manager-admin.php");
        }
        else
        {
            // echo "data not inserted" ;
            // create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";

            // redirect page (redirect to same page again )
            header("location:".SITEURL."admin/add-admin.php");
        }


    }

?>
