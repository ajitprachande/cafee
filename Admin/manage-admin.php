<?php include('partials/menu.php'); ?>
    <!-- main section start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1><br><br>

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];//displaying session msg
                        unset($_SESSION['add']); //removing session msg
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pass-not-match'])){
                        echo $_SESSION['pass-not-match'];
                        unset($_SESSION['pass-not-match']);
                    }
                    if(isset($_SESSION['change-pass'])){
                        echo $_SESSION['change-pass'];
                        unset($_SESSION['change-pass']);
                    }

                ?>
                <br><br>

            <!-- button to add admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br><br>

                <table class="tbl-manage-admin">
                 <tr>
                        <th>S.n</th>    
                        <th>full_name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        //execute the query
                        $res = mysqli_query($conn,$sql);

                        //chk query execute or not
                        if($res == TRUE){
                            $count = mysqli_num_rows($res);  //function to get all the rows in d/b
                            
                            $sn=1; //create a variable and assign the value
                            //chk num of rows
                            if($count>0){
                                //we have data in d/b
                                while($rows=mysqli_fetch_assoc($res)){
                                    //using while loop to get all the data from d/b
                                    //and while loop will run as long as we have data in d/b

                                    // get individual data
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    
                                    //display values in our php
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php SITEURL; ?>update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php SITEURL; ?>update-admin.php?id=<?php echo $id; ?>" class="btn-update">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>Admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-delete">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        else{

                        }
                        }


                    ?>
                </table>
      
        </div>
       
    </div>
      <!-- main section end -->
       
    <?php include('partials/footer.php'); ?>