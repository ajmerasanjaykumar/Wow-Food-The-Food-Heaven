<?php include('partials/menu.php'); ?>


    <div class="main-content">

        <div class="wrapper">

            <h1>Update Category</h1>

            <br> <br>

            <!-- collecting data from database  using get id-->
            <?php

                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];

                    $sql="SELECT * FROM tbl_category WHERE id=$id ";

                    $res=mysqli_query($conn,$sql);


                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {

                        $row=mysqli_fetch_assoc($res);
                        $title=$row['title'];
                        $current_image = $row['image_name'];
                        $featured= $row['featured'];
                        $active= $row['active'];

                    }
                    else
                    {
                        $_SESSION['no-category-found']="<div class='error'>No Category Found</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }
                else
                {
                    // $_SESSION['']="<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!="")
                        {
                            ?>

                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" alt="" width="100px">

                            <?php
                        }
                        else
                        {
                            echo "<div class='error'>Image Not Found</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No") {echo "checked";} ?>  type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td >
                        <input type="hidden" name="current_image" value="<?php  echo $current_image;?>" >
                        <input type="hidden" name="id" value="<?php  echo $id;?>" >
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>

        <?php

        if(isset($_POST['submit']))
        {
            //  echo "done";


            // get data from post
            $id=$_POST['id'];
            $title=$_POST['title'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];
            $current_image=$_POST['current_image'];

            // update image if it requires with current name itself

            // is image selected or not 
            if(isset($_FILES['image']['name']))
            {
                $image_name=$_FILES['image']['name'];

                // check whether image is available or not 
                if($image_name!="")
                {



                    // 1) upload the image first that has provided 
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
                            header("location:".SITEURL."admin/manage-category.php"); 
                        // stop 
                            die();   
                        }



                         // 2) remove that old image if new image was added
                         // check if previously there was a image or in that category 
                        if($current_image!="")
                        {
                            $remove_path="../images/category/".$current_image ;
                            $remove=unlink($remove_path);

                            if($remove==FALSE)
                            {
                                $_SESSION['remove-current-image']="<div class='error'>Failed to remove Current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                }
                else
                {
                    $image_name=$current_image;
                }


            }
            else
            {
                $image_name=$current_image;
            }

            
            // update database
            $sql2="UPDATE tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id=$id
            ";

            $res2=mysqli_query($conn,$sql2);



            // redirect to category with message

            if($res2==true)
            {
                // echo "done";
                $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
                header("location:".SITEURL."admin/manage-category.php");
            }
            else
            {
                // echo "dnoone";
                // failed to update
                $_SESSION['update']="<div class='error'>Failed To Update Category </div>";
                header("location:".SITEURL."admin/manage-category.php");
            }
        }

        ?>




        </div>
    </div>


<?php include('partials/footer.php'); ?>
