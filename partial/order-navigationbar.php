<?php include("config/constants.php") ;?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>| Bachelore's Cafee | </title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Box Icon Link for Icons -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Header & Navbar Section -->
    <header>
      <nav>
        <div class="nav_logo">
          <a href="#">
            <img src="images/logo.webp" alt="Coffee Logo" />
            <h2> Bachelore's Cafee</h2>
          </a>
        </div>

        <input type="checkbox" id="click" />
        <label for="click">
          <i class="menu_btn bx bx-menu"></i>
          <i class="close_btn bx bx-x"></i>
        </label>

        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="categories.php">Categories</a></li>
          <!-- <li><a href="category-foods.php">Category Foods</a></li> -->
          <li><a href="foods.php">Foods</a></li>
          <li><a href="order.php">Order</a></li>
          <li><a href="Admin/index.php">Admin</a></li>
         <!-- <li><a href="admin_login.php">Report</a></li> -->
        </ul>
      </nav>
    </header>