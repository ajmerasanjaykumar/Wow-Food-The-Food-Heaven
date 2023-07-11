

<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <!-- <input type="search" name="search" placeholder="Search for Food.." required>: This line creates an input field of type "search" within the form. The name attribute specifies the name of the input field, which is set to "search". When the form is submitted, the value entered in this input field will be sent with the name "search". The placeholder attribute provides a hint to the user about the expected input. The required attribute indicates that this field must be filled out before the form can be submitted. -->
        <!-- <form action=" echo SITEURLfood-search.php " method="POST">: This line defines the start of a form. The action attribute specifies the URL or file where the form data will be sent when the form is submitted. In this case, it is set to echo SITEURL ; food-search.php, which suggests that the URL is dynamically generated using PHP. The method attribute specifies the HTTP method to be used when submitting the form, which is set to POST in this case. -->
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->



    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>



            <?php 
                // sql query 
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 ";
                
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




    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

                        

                            <?php
                            
                            $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                
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

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php');?>

   