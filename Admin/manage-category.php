<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1><br>
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
              echo  $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>
        
        <br><br>

        <a href="<?php echo SITEURL; ?>Admin/add-category.php" class="btn-primary">Add Category</a><br><br><br>

<table class="tbl-manage-admin">
 <tr>
        <th>S.n</th>    
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
        <?php 
            //qry to get all category from d/b
            $sql = "SELECT * FROM tbl_category";

            //execute qry
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //create serial number variable and assign value as 1
            $sn=1;

            //chk whether we have data in d/b
            if($count>0){
                //we have data in d/b
                //get the data and display
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                            //chk whether img name is available or not 
                            if($image_name!="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="90px">
                                <?php

                            }
                            else{
                                //display the msg
                                echo "<div class='fail-msg'>Image Not Added.</div>";

                            }
                            
                            
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>Admin/update-category.php?id=<?php echo $id;?>" class="btn-update">Update Category</a>
                        <a href="<?php echo SITEURL; ?>Admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete Category</a>
                        </td>
                    </tr>
         <?php

                }
            }
            else{
                //we do not have data
                //we will display  msg inside table
                
        ?>
                <tr>
                   <td colspan="6">
                      <div class="fail-msg">No Category Added.</div>
                  </td>

                </tr>

        <?php
            }
         ?>
</table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>