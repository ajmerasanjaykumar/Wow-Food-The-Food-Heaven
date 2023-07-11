<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // sql query 
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                
                // execute sql query 
                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);
                
                if($count>0)
                {
                    // categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get data (id , title, image_name) 
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL ;?>category-foods.php?&category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    
                                    <?php 
                                    if($image_name!="")
                                    {
                                        ?>
                                        <img src="<?php SITEURL?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve" height="300px" width="300px">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                        </a>

                                                    


                        <?php 
                    }
                }
                else
                {
                    // no categories available
                    echo "<div class='error'>No Category Added</div>";

                }



            ?>


            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php');?>