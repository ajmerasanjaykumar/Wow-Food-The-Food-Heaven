

            <?php include('partials/menu.php'); ?>



            <div class="main-content">

                <div class="wrapper" >
                   <h1>Manage Admin</h1>
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

                     if(isset($_SESSION['update']))
                     {
                        echo $_SESSION['update']; // session message displayed 
                        unset($_SESSION['update']); // removing session message 
                     }

                     if(isset($_SESSION['user-not-found']))
                     {
                        echo $_SESSION['user-not-found']; // session message displayed 
                        unset($_SESSION['user-not-found']); // removing session message 
                     }

                     if(isset($_SESSION['pwd-not-matched']))
                     {
                        echo $_SESSION['pwd-not-matched']; // session message displayed 
                        unset($_SESSION['pwd-not-matched']); // removing session message 
                     }

                     if(isset($_SESSION['pwd-changed']))
                     {
                        echo $_SESSION['pwd-changed']; // session message displayed 
                        unset($_SESSION['pwd-changed']); // removing session message 
                     }


                   ?>


                   <br>
                   <br>
                   <br>


                
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                   <br>
                   <br>
                <table class="tbl-full" >
                    <tr >
                        <th>S.No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <!-- add admins here from data base -->

                    <?php 
                        // sql query to get all rows from table admin
                        $sql= "SELECT * FROM tbl_admin";

                        // execute query with this particular $conn and query type sql
                        $res=mysqli_query($conn,$sql);

                        // check whether query was executed or not
                        if($res==TRUE)
                        {
                            // query was done now 
                            // lets count number of rows in $res table 
                            $count=mysqli_num_rows($res); // function to get number of rows in partucular table of database selected in res
                            if($count>0)
                            {
                                // we have data in database 
                                $sn=1; // for row count 
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    // while loop runs as long as data is there in selected table $res

                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    ?>
                                    <!-- for html element we need to come out from php   -->
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $full_name ?></td>
                                        <td><?php echo $username ?></td>
                                        <td>
                                          <a href="<?php echo SITEURL;?>admin/change-password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                                          <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a> 
                                          <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a> 
                                        </td>
                                    </tr>

                                    <?php




                                }
                            }
                            else
                            {
                                // we do not have data in database 
                            }
                        }
                    
                    ?>


                    

                </table>

                </div>



            </div> 

            <?php include('partials/footer.php'); ?>