<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1><br>
        <a href="<?php echo SITEURL; ?>Admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <table class="tbl-manage-admin">
        <tr>
                <th>S.n</th>    
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
                //crt sql qry to get all food
                $sql = "SELECT * FROM tbl_food";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                //create serial number variable and set default value 1
                $sn=1;


                if($count>0)
                {
                    //we have food un d/b
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get values from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                         <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>₹<?php echo $price; ?></td>
                            <td>
                                <?php
                                    //chk whether wehave img or not
                                    if($image_name=="") 
                                    {
                                        echo "<div class='success-msg'>Image Not Added</div>";
                                    }
                                    else{
                                        //
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px;">
                                        <?php
                                        
                                    }
                                
                                ?>
                            </td>
                            <td><?php  echo $featured; ?> </td>
                            <td><?php echo $active; ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>Admin/update-food.php?id=<?php echo $id;?>" class="btn-update">Update Food</a>
                            <a href="<?php echo SITEURL; ?>Admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete Food</a>
                            </td>
                         </tr>

                        <?php


                    }

                }
                else{
                    //food not added in d/b
                    echo "<tr> <td colspan='7' class='fail-msg'>Food Not Added Yet. </td> </tr>";
                }

             ?>

        </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>