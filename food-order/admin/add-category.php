<?php include('partials/menu.php');?>

<div class="main-content">

    <div class="wrapper">

        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
             echo $_SESSION['add']; // session message displayed 
             unset($_SESSION['add']); // removing session message 
            }

            if(isset($_SESSION['upload']))
            {
             echo $_SESSION['upload']; // session message displayed 
             unset($_SESSION['upload']); // removing session message 
            }

         ?>

            <br><br>

            <!-- enctype="multipart/form-data" for uploading image -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);


            if(isset($_POST['submit']))
            {
                // echo "clicked";
                
                $title=$_POST['title'];

                // for radio type we need check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    // get values from form
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";
                }

                if(isset($_POST['active']))
                {
                    // get values from form
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";
                }

                // print_r($_FILES['image']);
                // die();

                if(isset($_FILES['image']['name']))
                {
                    // upload the image
                    // to upload image we need image_name , source path and destination path
                    $image_name=$_FILES['image']['name'];

                    if( $image_name!="")
                    {

                    

                        $ext=end(explode('.',$image_name));

                        $image_name="Food_category_".rand(000,999).".".$ext;
                        

                        //   echo $image_name;
                        // echo "came1";

                        // source
                        $source_path=$_FILES['image']['tmp_name'];

                        // destination 
                        $destination_path="../images/category/".$image_name;

                        $upload=move_uploaded_file($source_path,$destination_path);
                        // echo $destination_path ;

                        if($upload==false)
                        {
                            //   echo $destination_path ;

                            // set mesg
                            $_SESSION['upload']="<div class='error'>Failed To Upload Image.</div>";
                            // redirect
                            header("location:".SITEURL."admin/add-category.php"); 
                        // stop 
                            die();   
                        }

                    }
                }
                else
                {
                    // don't upload image just set image_name value as blank
                    $image_name="";
                    // echo "came";
                }




                // wasted 1 hour (NO)
                // nono analysed one hour how to get rid of errors what are techniques (YES)
                // sql query to add category into database
                // defaultly set image name coloumn to NULL as there is nothing set to it 

                $sql="INSERT INTO tbl_category SET
                 title='$title',
                 image_name='$image_name',
                 featured='$featured',
                 active='$active' 
                 ";

                // // execute query 
                $res=mysqli_query($conn,$sql);

                // check if query executed succesfully or not
                // echo $res ;
                if($res==true)
                {
                     $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";
                     header("location:".SITEURL."admin/manage-category.php");
                }
                else
                {
                    $_SESSION['add']="<div class='error'>Failed To Add Category.</div>";
                    header("location:".SITEURL."admin/add-category.php");
                }
            }
        
        ?>


    </div>

</div>

<?php include('partials/footer.php');?>

