<?php include('partials/menu.php'); ?>


<div class="main-content">


    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            // when u tried to update but there was some error occured in updating //
            if(isset($_SESSION['update']))
            {
             echo $_SESSION['update']; // session message displayed 
             unset($_SESSION['update']); // removing session message 
            }

        ?>

        

        <?php 

            // 1.get the id of selected admin

            $id=$_GET['id'];

            // 2.create sql query to get admin details from database
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            $res=mysqli_query($conn,$sql);
            
            // check is query executed or not //
            if($res==TRUE)
            {
                // 
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    // echo "success";

                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username=$row['username'];




                }
                else
                {
                    //redirect to manage admin page 
                    header("location:".SITEURL."admin/manager-admin.php");
                }
            }
            else
            {

            }
         ?>

        <form action="" method="POST">


            <table class="tbl-30">

                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>

                </tr>






            </table>




        </form>



    </div>
</div>

<?php


    // check whether submit button is clicked
    if(isset($_POST['submit']))
    {
        // echo "succesfull u have updated man sanzuuuu";
        // get all values from form to  update 

        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];



        // create a sql query to update admin 
        $sql="UPDATE tbl_admin SET full_name='$full_name', username='$username'  WHERE id='$id' ";

        $res=mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $_SESSION['update']="<div class='success'>Updated Admin Successfully</div>";
            header("location:".SITEURL."admin/manager-admin.php");
        }
        else
        {
            $_SESSION['update']="<div class='error'>Failed to update Admin . Please try Later</div>";
            header("location:".SITEURL."admin/update-admin");

        }






    }
    


?>




<?php include('partials/footer.php'); ?>





