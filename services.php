<?php

  require_once('lib/function.php');
  $db = new db_functions();
 // echo $_SESSION['login_number'];

 //session_start(); // Start session to access session variables
// Check if the session key exists before using it
if (!isset($_SESSION['login_number'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}
?>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
  	<!-- menu section start -->
    <?PHP  include("partial/order-navigationbar.php"); ?>
<!-- Services Section -->
    <section class="services" id="service">
      <h2 class="section_title">Our Services</h2>
      <div class="section_container">
        <div class="service_container">
          <div class="services_items">
            <img src="images/hot_beverages.png" alt="Hot Beverages" />
            <div class="services_text">
              <h3>Hot Beverages</h3>
              <p>
                Wide range of Steaming hot coffees to make you fresh and light.
              </p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/cold_beverages.png" alt="Cold Beverages" />
            <div class="services_text">
              <h3>Cold Beverages</h3>
              <p>
                Creamy and frothy cold coffee to make you feel cool from inside.
              </p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/refreshment.png" alt="Refreshment" />
            <div class="services_text">
              <h3>Refreshment</h3>
              <p>Fruit and icy refreshing drink to make you feel good.</p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/special_combos.png" alt="Special Combos" />
            <div class="services_text">
              <h3>Special Combos</h3>
              <p>
                Now it's really easy to chose your favourite eating and drinking
                combinations.
              </p>
            </div>
          </div>
          <div class="services_items">
            <img
              src="images/burger_frenchFries.png"
              alt="Burger & French Fries"
            />
            <div class="services_text">
              <h3>Burger & French Fries</h3>
              <p>Yummy! Quick bites to satisfy your small size hunger.</p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/dessert.png" alt="Desserts" />
            <div class="services_text">
              <h3>Desserts</h3>
              <p>
                This for sure would satiate your palate and take you on a
                culinary treat.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
     <!-- footer section -->
     <?php include("partial/footeredit.php");?>
</body>
</html>
	