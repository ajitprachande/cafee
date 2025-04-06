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
    <style>
        /* Additional responsive styles for category foods page */
        .food-search {
            background-image: url(../images/bg.jpg);
            background-size: cover;
            background-position: center;
            padding: 7% 0;
            color: white;
            min-height: 200px;
            display: flex;
            align-items: center;
            margin-top: 0;
        }
        
        .food-search .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .food-search h2 {
            font-size: 2.2rem;
            margin-bottom: 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }
        
        .food-search a.text-white {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
        }
        
        .food-menu {
            padding: 60px 0;
            background-color: #f8f9fa;
            min-height: calc(100vh - 85px - 200px);
        }
        
        .food-menu .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .food-menu h2 {
            font-size: 2.2rem;
            margin-bottom: 40px;
            color: #333;
            position: relative;
            padding-bottom: 10px;
        }
        
        .food-menu h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: #f3961c;
            border-radius: 2px;
        }
        
        .food-menu-box {
            width: 48%;
            margin: 1%;
            padding: 20px;
            float: left;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .food-menu-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .food-menu-img {
            width: 25%;
            float: left;
            margin-right: 3%;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .food-menu-img img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .food-menu-box:hover .food-menu-img img {
            transform: scale(1.1);
        }
        
        .food-menu-desc {
            width: 70%;
            float: left;
            margin-left: 2%;
        }
        
        .food-menu-desc h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .food-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #f3961c;
            margin: 5px 0;
        }
        
        .food-detail {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        
        .btn-primary {
            background-color: #f3961c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #e5851a;
            transform: translateY(-2px);
        }
        
        .fail_msg {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            background-color: #ffeded;
            color: #d32f2f;
        }
        
        /* Media queries for responsive design */
        @media screen and (max-width: 1024px) {
            .food-menu-box {
                width: 48%;
                padding: 15px;
            }
            
            .food-search h2, .food-menu h2 {
                font-size: 2rem;
            }
        }
        
        @media screen and (max-width: 768px) {
            .food-search {
                padding: 5% 0;
                min-height: 150px;
            }
            
            .food-menu {
                padding: 40px 0;
            }
            
            .food-menu .container, .food-search .container {
                width: 95%;
            }
            
            .food-menu-box {
                width: 100%;
                margin: 15px 0;
                padding: 15px;
            }
            
            .food-menu-img {
                width: 30%;
            }
            
            .food-menu-desc {
                width: 65%;
            }
            
            .food-search h2 {
                font-size: 1.8rem;
            }
            
            .food-menu h2 {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }
        }
        
        @media screen and (max-width: 576px) {
            .food-search h2 {
                font-size: 1.5rem;
            }
            
            .food-menu h2 {
                font-size: 1.5rem;
                margin-bottom: 25px;
            }
            
            .food-menu-box {
                padding: 12px;
                margin: 12px 0;
                flex-direction: column;
                text-align: center;
            }
            
            .food-menu-img {
                width: 80%;
                margin: 0 auto 15px;
                float: none;
            }
            
            .food-menu-desc {
                width: 100%;
                margin-left: 0;
                float: none;
            }
            
            .food-price {
                font-size: 1.1rem;
            }
            
            .food-detail {
                font-size: 0.85rem;
            }
            
            .btn-primary {
                width: 100%;
                text-align: center;
                padding: 10px;
            }
        }
        
        @media screen and (max-width: 400px) {
            .food-search h2 {
                font-size: 1.3rem;
            }
            
            .food-menu h2 {
                font-size: 1.3rem;
            }
            
            .food-menu-img img {
                height: 80px;
            }
            
            .food-menu-desc h4 {
                font-size: 1.1rem;
            }
        }
    </style>
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

                $count2 = mysqli_num_rows($res2);
                //chk whether food is avail ot not
                if($count2>0)
                {
                    //food is avail
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
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
                                         <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

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

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
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
    <?php include("partial/footeredit.php");?>
    <!-- footer Section Ends Here -->
    
    <script>
        // Add touch-friendly interaction for mobile
        document.addEventListener('DOMContentLoaded', function() {
            // Make food items more touch-friendly
            const foodItems = document.querySelectorAll('.food-menu-box');
            foodItems.forEach(item => {
                item.addEventListener('touchstart', function() {
                    this.style.opacity = '0.9';
                });
                
                item.addEventListener('touchend', function() {
                    this.style.opacity = '1';
                });
            });
            
            // Prevent zoom on mobile devices when pressing order button
            const orderButtons = document.querySelectorAll('.btn-primary');
            orderButtons.forEach(button => {
                button.addEventListener('touchend', function(e) {
                    if (window.innerWidth <= 576) {
                        e.preventDefault();
                        window.location = this.getAttribute('href');
                    }
                });
            });
        });
    </script>

</body>
</html>