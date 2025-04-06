    <!-- Navbar Section Starts Here -->
    <?php include("partial/order-navigationbar.php"); ?>
    <!-- Navbar Section Ends Here -->
     <?php 
        if(isset($_GET['food_id']))
        {
           // get the food id and is set or not
           $food_id = $_GET['food_id'];
           //get teh details of yhe selected food
           $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
           $res= mysqli_query($conn, $sql);
           $count = mysqli_num_rows($res);
           if($count==1){
            //we have food
            //GET the data from d/b
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

           }
           else{
                //food not avail
                //redirect to home page
                header("location:".SITEURL);
           }
        }
        else{
            header("location:".SITEURL);
        }
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style-order.css">
</head>
<body>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //chk whether img avail or not
                            if($image_name=="")
                            {
                                //img not avial
                                echo "<div class='fail_msg'>Image Not Available.</div>";
                            }
                            else{
                                //img is avail
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                                      
                </fieldset>
            </form>
            <?php
                //chk submit btn is vlick or not
                if(isset($_POST['submit']))
                {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; 

                    $order_date = date("Y-m-d h:i:sa"); //order date

                    $status = "Oredered"; //oredered, on delivered, canceled 

                    $customer_name = $_POST['full-name'];

                    $customer_contact = $_POST['contact'];

                    $customer_email = $_POST['email'];

                    $customer_address = $_POST['address'];

                    //save the order in d/b
                    //create sql  to save the d/b
                    $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    ";
                    // echo $sql2;  die();
                  
                    //execute query
                    $res2 = mysqli_query($conn, $sql2);
                    
                    if($res2==true)
                    {
                        //query executed and ordered saves
                        $_SESSION['order'] = "<div class='success_msg'>Food Ordered Successfully.</div>";
                        header("location:".SITEURL);
                    }
                    else{
                        //failed to save order
                        $_SESSION['order'] = "<div class='fail_msg'>Failed To Order Food.</div>";
                        header("location:".SITEURL);
                    }

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- footer Section Starts Here -->
    <?php include("partial/footeredit.php");?>
    <!-- footer Section Ends Here -->
</body>
</html>