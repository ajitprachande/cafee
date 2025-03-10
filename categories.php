<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Bachelore's Cafee |</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style-order.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
     <?php include("partial/order-navigationbar.php"); ?>
    <!-- Navbar Section Ends Here -->
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                //display all categories
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //category availble
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                         <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name==""){
                                        //image not availble
                                    }
                                    else{
                                        //image availble
                                        ?>
                                         <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php

                                    }
                                
                                ?>
                               

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else{
                    //category not available
                    echo "<div class='fail_msg'>Category Not Added.</div>";
                }
            
            ?>

           
          
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
    <?php include("partial/footer.php"); ?>
</body>
</html>