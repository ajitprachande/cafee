<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="images/cofffee_image.png">
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

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //food avial
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                          <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //chk whether img availble or not
                                    if($image_name=="")
                                    {
                                        //image not avail
                                        echo "<div class='fail_msg'>Image Not Available.</div>";
                                    }
                                    else{
                                        //img availble
                                        ?>
                                         <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                     </div>
                        <?php
                    }
                }
                else{
                    //food not avail
                    echo "<div class='fail_msg'>Food Not Found.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   

    <!-- footer Section Starts Here -->
    <?php include("partial/footeredit.php");?>
    <!-- footer Section Ends Here -->

</body>
</html>