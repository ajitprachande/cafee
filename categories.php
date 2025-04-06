<!-- Navbar Section Starts Here -->
<?php include("partial/order-navigationbar.php");?>

    <!-- Navbar Section Ends Here -->
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
        /* Additional responsive styles for categories page */
        .categories {
            padding: 60px 0;
            min-height: calc(100vh - 85px);
        }
        
        .categories .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        
        .categories h1 {
            font-size: 2.2rem;
            margin-bottom: 40px;
            color: #333;
            position: relative;
            padding-bottom: 10px;
            width: 100%; /* Ensure the heading takes full width in flex container */
        }
        
        .categories h1:after {
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
        
        .box-3 {
            width: 450px;
            height: 400px;
            margin: 25px 15px; /* Increased margin for better spacing */
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            float: none; /* Remove float as we're using flexbox */
        }
        
        .box-3:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .box-3 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .box-3:hover img {
            transform: scale(1.1);
        }
        
        .float-text {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            padding: 15px;
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .fail_msg {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        
        /* Media queries for responsive design */
        @media screen and (max-width: 1024px) {
            .box-3 {
                width: 45%;
                height: 350px;
                margin: 20px 10px; /* Adjusted spacing for tablet */
            }
            
            .categories h1 {
                font-size: 2rem;
            }
        }
        
        @media screen and (max-width: 768px) {
            .categories {
                padding: 40px 0;
            }
            
            .categories .container {
                width: 95%;
            }
            
            .box-3 {
                width: 45%;
                height: 300px;
                margin: 15px 8px; /* Smaller gap on smaller screens */
            }
            
            .float-text {
                font-size: 1.5rem;
                padding: 12px;
            }
        }
        
        @media screen and (max-width: 576px) {
            .categories h1 {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }
            
            .box-3 {
                width: 90%;
                height: 300px;
                margin: 15px auto; /* Center single column items */
            }
            
            .float-text {
                bottom: 15px;
                font-size: 1.4rem;
            }
        }
        
        @media screen and (max-width: 400px) {
            .categories h1 {
                font-size: 1.5rem;
            }
            
            .box-3 {
                height: 250px;
            }
        }
    </style>
</head>

<body>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h1 class="text-center">Explore Foods</h1>
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
                                                        echo "<div class='error'>Image not Available</div>";
                                                    }
                                                    else{
                                                        //image availble
                                                        ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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
    <?php include("partial/footeredit.php");?>
    
    <script>
        // Add touch-friendly interaction for mobile
        document.addEventListener('DOMContentLoaded', function() {
            // Make category boxes more touch-friendly
            const categoryBoxes = document.querySelectorAll('.box-3');
            categoryBoxes.forEach(box => {
                box.addEventListener('touchstart', function() {
                    this.style.opacity = '0.8';
                });
                
                box.addEventListener('touchend', function() {
                    this.style.opacity = '1';
                });
            });
        });
    </script>
</body>
</html>