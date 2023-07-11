<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php
                // getting value of search keyword by post action of form
                // 
                $search=mysqli_real_escape_string($conn,$_POST['search']);

                ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
                // getting value of search keyword by post action of form
                $search=$_POST['search'];

                $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    while($row2=mysqli_fetch_assoc($res))
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