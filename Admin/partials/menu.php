<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="../images/cofffee_image.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Bachelore's Cafee |</title>

    <link rel="stylesheet" href="../css/style2.css">
    
    <link rel="stylesheet" href="../css/style.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

  <!-- Custom responsive JavaScript -->
  <script src="../js/common.js" defer></script>
</head>
<body class="bg-gray-100">
    <!--HEADER/MENU section start -->
    <header class="header">
      <nav>
        <div class="nav_logo">
          <a href="#">
            <img src="../images/cofffee_image.png" alt="Coffee Logo" />
            <h2> Bachelore's Cafee</h2>
          </a>
        </div>

        <input type="checkbox" id="click" />
        <label for="click">
          <i class="menu_btn bx bx-menu"></i>
          <i class="close_btn bx bx-x"></i>
        </label>

        <ul>
    <li><a href="index.php"><i class="bx bx-home-alt"></i> Home</a></li>
    <li><a href="manage-admin.php"><i class="bx bx-user-circle"></i> Admin</a></li>
    <li><a href="manage-category.php"><i class="bx bx-category-alt"></i> category</a></li>
    <li><a href="manage-food.php"><i class="bx bx-food-menu"></i> Food</a></li>
    <li><a href="manage-order.php"><i class="bx bx-cart-alt"></i> Order</a></li>
    <li><a href="../admin_login.php"><i class="bx bx-pie-chart-alt-2"></i> Report</a></li>

        </ul>
      </nav>
    </header>
    <!--menu section end -->