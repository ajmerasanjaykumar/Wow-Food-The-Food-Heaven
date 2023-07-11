<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php

            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
         ?>

        <form action="" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Enter Old Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm New Password">
                    </td>
                </tr>

                <tr >
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>



            </table>
        </form>

    </div>

</div>


<?php
        // if submit button was clicked then //
        if(isset($_POST['submit']))
        {
            // get all information that has entered in the form
            $id=$_POST['id'];
            $old_password=md5($_POST['old_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);


            // chech if id matches with password or not //
            // sql query for getting particular coloumn from particular row with certain specifications //
            $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$old_password' ";

            // execute the  query
            $res=mysqli_query($conn,$sql);

            // query executed or not
            
            if($res==TRUE)
            {
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    // echo "USER FOUND";

                    // check new and confirm matched or not //
                    if($new_password==$confirm_password)
                    {
                        // echo "new password matched" ;
                        // update password

                        // create sql query to update password
                        $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id ";

                        // query execution
                        $res2=mysqli_query($conn,$sql2);

                        if($res2==TRUE)
                        {
                            $_SESSION['pwd-changed']="<div class='success'>Password Changed Successfully</div>";
                            header('location:'.SITEURL."admin/manager-admin.php");
                        }
                        else
                        {
                            $_SESSION['pwd-not-changed']="<div class='error'>Password Not Changed</div>";
                            header('location:'.SITEURL."admin/manager-admin.php");
                        }

                        
                    }
                    else
                    {
                        // echo "new password didnot match twice ";
                        // rediret to manager admin page
                        $_SESSION['pwd-not-matched']="<div class='error'>Password Not Matched</div>";
                        header('location:'.SITEURL."admin/manager-admin.php");
                    }


                }
                else
                {
                    $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";
                    header('location:'.SITEURL."admin/manager-admin.php");
                }
            }
           




            // update query

            // redirect
            
        }

?>



<?php include('partials/footer.php');?>