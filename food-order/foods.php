<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



                    <?php
                            
                            $sql2="SELECT * FROM tbl_food WHERE active='Yes'";
                
                            // execute sql query 
                            $res2=mysqli_query($conn,$sql2);
            
                            $count2=mysqli_num_rows($res2);
                            
                            if($count2>0)
                            {
                                // categories available
                                while($row2=mysqli_fetch_assoc($res2))
                                {
                                    // get data (id , title, image_name) 
                                    $food_id=$row2['id'];
                                    $food_title=$row2['title'];
                                    $food_description=$row2['description'];
                                    $food_price=$row2['price'];
                                    $food_image_name=$row2['image_name'];

                                    ?>

                                        <div class="food-menu-box">
                                                <div class="food-menu-img">

                                                    <?php 
                                                    if($food_image_name!="")
                                                    {
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $food_image_name; ?>" alt="" class="img-responsive img-curve">
                                                       <?php 
                                                    } 
                                                    else
                                                    {
                                                        echo "<div class='error'>Image Not Available</div>";
                                                    }
                                                    ?>
                                                    
                                                </div>

                                                <div class="food-menu-desc">
                                                    <h4><?php echo $food_title;?></h4>
                                                    <p class="food-price">$<?php echo $food_price;?></p>
                                                    <p class="food-detail">
                                                        
                                                        <?php

                                                        if($food_description!="")
                                                        {
                                                            echo $food_description;
                                                        }
                                                        else
                                                        {
                                                            echo "No Description";
                                                        }
                                                        

                                                        
                                                        ?>
                                                    </p>
                                                    <br>

                                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                                                </div>
                                        </div>




                                    <?php

                                }


                            }
                            else
                            {
                                echo "<div class='error'>No Food Available</div>";
                            }


                    ?>


            
            
                   

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>