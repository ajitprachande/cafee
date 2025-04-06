<?php include("config/constants.php") ;?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" type="image/png" href="images/cofffee_image.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>| Bachelore's Cafee | </title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="olduser.css">
    <!-- Box Icon Link for Icons -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- below link for profile.php -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom responsive JavaScript -->
    <script src="js/common.js" defer></script>
    <!-- Mobile navigation specific script -->
    <script src="js/mobile-nav.js" defer></script>
  </head>
  <body>
    <!-- Header & Navbar Section -->
    <header>
      <nav>
        <div class="nav_logo">
          <a href="index.php">
            <img src="images/cofffee_image.png" alt="Coffee Logo" />
            <h2>Bachelore's Cafee</h2>
          </a>
        </div>

        <input type="checkbox" id="click" />
        <label for="click">
          <i class="menu_btn bx bx-menu"></i>
          <i class="close_btn bx bx-x"></i>
        </label>

        <ul>
          <li><a href="index.php"><i class="bx bx-home"></i> Home</a></li>
          <li><a href="services.php"><i class="bx bx-server"></i> Services</a></li>  
          <li><a href="categories.php"><i class="bx bx-category"></i> Categories</a></li>
          <li><a href="foods.php"><i class="bx bx-food-menu"></i> Foods</a></li>
          <li><a href="olduser.php"><i class="bx bx-user"></i> <?php echo htmlspecialchars($_SESSION['login_number']); ?></a></li>
        </ul>
      </nav>
    </header> 