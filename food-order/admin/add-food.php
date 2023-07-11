<?php include('partials/menu.php');?>

<div class="main-content">

    <div class="wrapper">

        <h1>Add Food</h1>
        <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">

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

        <table class="tbl-30">

            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Enter Title">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description"  cols="30" rows="5" placeholder="Description"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                <input type="number" name="price" placeholder="Enter Price" required>
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <!-- we need to display all categories from database  -->
                    <select name="category" >
                        <?php
                            // create php code to display categories from datbase
                            // 1.create sql queries 

                            $sql="SELECT * FROM tbl_category WHERE active='Yes' ";
                            $res=mysqli_query($conn,$sql);

                            $count=mysqli_num_rows($res);

                            // if count is greater than zero , we have categories else we donot have categories 
                            if($count>0)
                            {
                                // we have some active categories

                                while($row=mysqli_fetch_assoc($res))
                                {
                                    
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                // no  active categories
                                ?>
                                    <option value="0" >No Category Found</option>
                                <?php 
                            }


                         ?>

                    </select>
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
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>


        </table>


        </form>




        <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

                // check if button clicked

                if(isset($_POST['submit']))
                {
                    // add food into data base
                    // echo "submitted";

                    // 1.get value from post

                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];// price must and should select else error will come 
                    $category=$_POST['category'];
                    
                    // if he selected or should i put it defalut
                    // 
                    // if(isset($_POST['price']))
                    // {
                    //     // get values from form
                    //     $price=$_POST['price'];
                    // }
                    // else
                    // {
                    //     $price=NULL;
                    // }

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

                    // if(isset($_POST['category']))
                    // {
                    //     // get values from form
                    //     $category=$_POST['category'];
                    // }
                    // else
                    // {
                    //     $category=0;
                    // }




                        // man dont forget to write the enctype properly //
                    //  print_r($_FILES['image']);
                    //     die();

                    // 2.upload image if selected

                    // check whether image button(:) button) is clicked or not 
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name=$_FILES['image']['name'];

                        // check if image is selected or not
                        if($image_name!="")
                        {
                            // image is selected
                            // 1. change name of image selected using explode 
                            $ext=end(explode('.',$image_name));
                            $image_name="Food_Name_".rand(0000,9999).".".$ext;
                            // echo $image_name;
                            // echo "camehere2";
                            
                           //  2.upload image from xampp --> ../ images / food category
                            // source
                            $source_path=$_FILES['image']['tmp_name'];

                            // destination 
                            $destination_path="../images/food/".$image_name;

                            $upload=move_uploaded_file($source_path,$destination_path);

                            if($upload==false)
                            {
                                //   echo $destination_path ;

                                // set mesg
                                $_SESSION['upload']="<div class='error'>Failed To Upload Image.</div>";
                                // redirect
                                header("location:".SITEURL."admin/add-food.php"); 
                            // stop 
                                die();   

                            }
                        }
                        else
                        {
                            // echo "camehere1";
                             $image_name="";
                        }
                        
                    }
                    else
                    {
                        // echo "camehere3";
                        $image_name="";
                    }

                    // 3.sql query for data into database

                    $sql2="INSERT INTO tbl_food SET 
                    title = '$title' ,
                    description = '$description' , 
                    price = $price , 
                    image_name = '$image_name', 
                    category_id = $category ,
                    featured = '$featured',
                    active = '$active'
                      ";

                    //   echo $sql2;

                    $res2=mysqli_query($conn,$sql2);


                    // // 4.redirect to food category 
                    if($res2==TRUE)
                    {
                        //  echo "done";
                        // query successfully done
                        $_SESSION['add']="<div class='success'>Successfully Added Food.</div>";
                        header("location:".SITEURL."admin/manage_food.php"); 
                    }
                    else
                    {
                        //  echo "notdone";
                        // query failed 
                        $_SESSION['add']="<div class='error'>Failed To Add Food.</div>";
                        header("location:".SITEURL."admin/add-food.php");
                    }

                }
                
        ?>



    </div>

</div>

<?php include('partials/footer.php');?>