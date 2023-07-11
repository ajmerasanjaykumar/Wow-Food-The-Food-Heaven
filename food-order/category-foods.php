<?php include('partials-front/menu.php');?>


        <?php

            if(isset($_GET['category_id']))
            {
                // id sent through get
                $category_id=$_GET['category_id'];
                // faster and only coloumn title is taken from database with reqired id
                $sql="SELECT title FROM tbl_category WHERE id=$category_id";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $category_title=$row['title'];
                }
                else
                {
                    header('location:'.SITEURL);
                }

            }
            else
            {
                // not sen id so go back
                header('location:'.SITEURL);
            }
        
        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



                    <?php
                        // getting value of search keyword by post action of form

                        $sql2="SELECT * FROM tbl_food WHERE category_id  LIKE '%$category_id%' ";

                        $res2=mysqli_query($conn,$sql2);

                        $count2=mysqli_num_rows($res2);

                        if($count2>0)
                        {
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