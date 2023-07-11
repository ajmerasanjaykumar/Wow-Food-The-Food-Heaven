
<?php

//  echo "delete page" ;
include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // process to delete
        // echo "delete hojayega";

        // 0. get id and image from get method
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        

        // 1.if image is there delete it from folder
        // what if there is no image present due to some error ,how this will behave //
        if($image_name!="")
        {
            // you have someone to delete then please delete stroage why to waste please do delete 
            $remove_path="../images/food/".$image_name;
            $remove=unlink($remove_path);

            if($remove==false)
            {
                // didnot delete
                $_SESSION['remove']="<div class='error'>Failed to remove Food Image.</div>";
                // header('location:'.SITEURL.'admin/manage_food.php'); 
                // die();
            }

        }

        // 2.remove that from database 
        $sql="DELETE FROM tbl_food WHERE id=$id";
        $res=mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $_SESSION['delete']="<div class='success'>Successfully Deleted Food.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed To Remove Food.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }
    }
    else
    {
        // redirect
        $_SESSION['delete']="<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }

?>