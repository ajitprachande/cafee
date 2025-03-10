    <!-- Navbar Section Starts Here -->
    <?php include("partial/order-navigationbar.php"); ?>
    <!-- Navbar Section Ends Here -->
     <?php
        //chk whether id is pass or not
        if(isset($_GET['category_id']))
        {
            //category id is set and get the id
            $category_id = $_GET['category_id'];
            //get the category title based on category id
            $sql = "SELECT title FROM tbl_category WHERE id = $category_id";

            $res = mysqli_query($conn, $sql);
            //get the value from d/b
            $row = mysqli_fetch_assoc($res);

            $category_title = $row['title'];

        }
        else{
            //IF category not passed
            //redirect to home page
            header('location:'.SITEURL);
        }
     ?>
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


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //crete sql qry to get food baed on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
                //execute query
                $res2 = mysqli_query($conn,$sql2);

                $count2 = mysqli_num_rows($res);
                //chk whether food is avail ot not
                if($count2>0)
                {
                    //food is avail
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        //img not avail
                                        echo "<div class='fail_msg'>Image Not Available.</div>";
                                    }
                                    else{
                                        //img avail
                                        ?>
                                         <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                 ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">₹<?php echo $price;?></p>
                                <p class="food-detail">
                                 <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php

                    }
                }
                else{
                    //food not avail
                    echo "<div class='fail_msg'>Food Not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php include("partial/footer.php"); ?>
    <!-- footer Section Ends Here -->

</body>
</html>