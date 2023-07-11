
<?php

    // include constants.php file here (because we need to use define key word " $conn " from constants folder which is in another folder )
    include('../config/constants.php');

    // echo "hello";
    // 1. get the ID of admin to be deleted (through GET)
    $id = $_GET['id'];


    // 2. create SQL query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id" ;
    
    
    //execute the sql query to manipulate database
    $res=mysqli_query($conn,$sql);

    if($res==TRUE)
    {
        // query executed succefully and admin deleted
        // echo "succesfull";

        //creating a session message 
        $_SESSION['delete'] =  "<div class='success'>Admin Deleted Successfully</div>";
        
        // now lets redirect to desired page i.e manage admin
        header('location:'.SITEURL.'admin/manager-admin.php');
    
    }
    else
    {
        // query failed to delete
        // echo "Unsuccesfull";

         //creating a session message 
         $_SESSION['delete'] =  "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        
         // now lets redirect to desired page i.e manage admin
         header('location:'.SITEURL.'admin/manager-admin.php');
     
    }



     







?>
