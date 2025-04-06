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
          <li><a href="services.php">Services</a></li>
          <li><a href="categories.php">Categories</a></li>
          <li><a href="foods.php">foods</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <!-- <li><a href="Admin/index.php">Admin</a></li> -->
         <!-- <li><a href="admin_login.php">Report</a></li> -->
        </ul>
      </nav>
    </header>
    <!-- Hero Section -->
    <section class="hero_section">
      <div class="section_container">
        <div class="hero_container">
          <div class="text_section">
		  
		  <div class="logout" style="font-size: 30px; color: var(--secondary-color); margin-bottom:50px; "> 
		  
            welcome :	<?php echo $_SESSION['login_number']; ?>
			
			</div>
			
            <h2>Fuel Your Passion</h2>
            <h3>Discover the Magic in Every Cup</h3>
            <p>
              Welcome to our coffee paradise, where every bean tells a story and
              every cup sparks.
            </p>

            <div class="hero_section_button">
              <a href="contact.php"class="button">Contact</a>
			        <a href="login.php?logout" class="button">logout</a>
            </div>
          </div>

          <div class="image_section">
            <img src="images/cofffee_image.png" alt="Coffee" />
          </div>
        </div>
      </div>
    </section>
    <!-- Footer Section -->
    <?php include("partial/footeredit.php");?>
   
  </body>
</html>
