<?php include('partials/menu.php'); ?>


<div class="main-content">

                <div class="wrapper" >
                   <h1>Manage Category</h1>
                   <br>
                   <br>

                   <?php

                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add']; // session message displayed 
                            unset($_SESSION['add']); // removing session message 
                        }

                        if(isset($_SESSION['remove']))
                        {
                            echo $_SESSION['remove']; // session message displayed 
                            unset($_SESSION['remove']); // removing session message 
                        }

                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete']; // session message displayed 
                            unset($_SESSION['delete']); // removing session message 
                        }

                        if(isset($_SESSION['no-category-found']))
                        {
                            echo $_SESSION['no-category-found']; // session message displayed 
                            unset($_SESSION['no-category-found']); // removing session message 
                        }

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update']; // session message displayed 
                            unset($_SESSION['update']); // removing session message 
                        }

                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload']; // session message displayed 
                            unset($_SESSION['upload']); // removing session message 
                        }
                        // remove-current-image'
                        if(isset($_SESSION['remove-current-image']))
                        {
                            echo $_SESSION['remove-current-image']; // session message displayed 
                            unset($_SESSION['remove-current-image']); // removing session message 
                        }



                   ?>

                    <br><br>
                
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                   <br>
                   <br>
                <table class="tbl-full" >
                    <tr >
                        <th>S.No</th>
                        <th>title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Actions</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                            $sql="SELECT * FROM tbl_category";

                            $res=mysqli_query($conn,$sql);

                            $count=mysqli_num_rows($res);

                            if($count>0)
                            {
                                $sn=1;

                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    $image_name=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?> </td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                            <?php 
                                            // check if image exist or not
                                            if($image_name!="")
                                            {
                                                ?>

                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" width="100px">

                                                <?php
                                            }
                                            else
                                            {
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                            
                                            ?>
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo  $active; ?></td>
                                        <td>
                                           <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a> 
                                           <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ; ?>" class="btn-danger">Delete Category</a> 
                                        </td>
                                    </tr>

                                    <?php

                                    
                                }

                            }
                            else
                            {
                                ?> 
                                <tr>
                                    <td colspan="6"> <div class="error">No Category Added.</div></td>
                                </tr>
                                
                                <?php 
                            }
                    ?>


    



                </table>

                </div>



            </div> 



<?php include('partials/footer.php'); ?>