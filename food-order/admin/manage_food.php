<?php include('partials/menu.php'); ?>


<div class="main-content">

                <div class="wrapper" >
                   <h1>Manage Food</h1>
                   <br>
                   <br>

                   <?php
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add']; // session message displayed 
                            unset($_SESSION['add']); // removing session message 
                        }
                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete']; // session message displayed 
                            unset($_SESSION['delete']); // removing session message 
                        }
                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload']; // session message displayed 
                            unset($_SESSION['upload']); // removing session message 
                        }
                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update']; // session message displayed 
                            unset($_SESSION['update']); // removing session message 
                        }

                        if(isset($_SESSION['remove']))
                        {
                            echo $_SESSION['remove']; // session message displayed 
                            unset($_SESSION['remove']); // removing session message 
                        }
                        if(isset($_SESSION['no-food-found']))
                        {
                            echo $_SESSION['no-food-found']; // session message displayed 
                            unset($_SESSION['no-food-found']); // removing session message 
                        }

                    ?>
                    <br>
                   <br>
                
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                   <br>
                   <br>
                <table class="tbl-full" >
                    <tr >
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image Name</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>


                    <?php 

                        $sql="SELECT * FROM tbl_food";
                        $res=mysqli_query($conn,$sql);

                        $count=mysqli_num_rows($res);

                        if($count>0)
                        {
                            $sn=0;
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $title=$row['title'];
                                $price=$row['price'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>$ <?php echo $price; ?></td>
                                        <td>
                                            <?php
                                                if($image_name!="")
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" width="100px">
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<div class='error'> Image Not Added Yet.</div>";
                                                } 
                                            ?>
                                        
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a> 
                                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a> 
                                        </td>
                                    </tr>



                                <?php

                            }
                        }
                        else
                        {
                            echo "<tr> <td colspan='7' class='error'> No Food Added Yet.</td></tr>";
                        }

                    ?>

                    <!-- <tr>
                        <td>1. </td>
                        <td>Sanjay</td>
                        <td>Sanjay77</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a> 
                            <a href="#" class="btn-danger">Delete Admin</a> 
                        </td>
                    </tr> -->



                </table>

                </div>



            </div> 


<?php include('partials/footer.php'); ?>