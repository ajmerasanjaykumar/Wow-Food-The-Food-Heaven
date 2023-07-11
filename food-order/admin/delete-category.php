
<?php

// echo "delete page" ;
include('../config/constants.php');


if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // get the value and delete
    // echo "get delete";

    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    // remove the physical image if available 
    if($image_name!="")
    {
        $path="../images/category/".$image_name;

        $remove=unlink($path);

        if($remove==FALSE)
        {
            $_SESSION['remove']="<div class='error'>Failed to remove Category Image.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }
        
         // remove data from database
        $sql="DELETE FROM tbl_category WHERE id=$id";
        $res=mysqli_query($conn,$sql);

        // redirect
        if($res==TRUE)
        {
            $_SESSION['delete']="<div class='success'>Successfully Removed Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed to remove Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    

   

    
}
else 
{
    // redirect to manage category page

    header('location:'.SITEURL.'admin/manage-category.php');
}





?>