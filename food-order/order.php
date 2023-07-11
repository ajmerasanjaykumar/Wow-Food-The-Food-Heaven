<?php include('partials-front/menu.php');?>

<?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>


<?php

    if(isset($_GET['food_id']))
    {

        // get details of food 
        $food_id=$_GET['food_id'];
        $sql="SELECT * FROM tbl_food WHERE id=$food_id";
        $res=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);

            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }

        // get details

        


    }
    else
    {
        // unfortunately i will just redirect to home but not to previos page
        header('location:'.SITEURL);
    }


?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <!-- image there or not -->
                        <?php
                            if($image_name!="")
                            {
                                ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Available</div>";
                            }

                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Sanjay Kumar" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 1234xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@sanjay.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country( INDIA :) )" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php 
             ini_set('display_errors', 1);
             ini_set('display_startup_errors', 1);
             error_reporting(E_ALL);

                // check if submit is clicked
                if(isset($_POST['submit']))
                {
                    // get details of order
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total= $price * $qty ; // total amount
                    $ordered_date= date("Y-m-d h:i:s") ; // ordered date
                    $status="Ordered";
                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];

                    // save order in database

                    $sql2="INSERT INTO tbl_order SET
                    food='$food' ,
                    price=$price ,
                    qty=$qty ,
                    total=$total ,
                    ordered_date= '$ordered_date' ,
                    status='$status' ,
                    customer_name='$customer_name' ,
                    customer_contact='$customer_contact' ,
                    customer_email='$customer_email' ,
                    customer_address='$customer_address' 
                    ";

                    $res2=mysqli_query($conn,$sql2);

                    if($res2==TRUE)
                    {
                        // succesffullly seent to database
                        $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully</div>";
                        header('location:'.SITEURL);

                    }
                    else
                    {
                        $_SESSION['order']="<div class='error text-center'>Failed To Order</div>";
                        header('location:'.SITEURL);
                    }

                }

            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>