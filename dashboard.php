<?php
  require_once('lib/function.php');
  $db = new db_functions();

 // echo $_SESSION['login_number'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bachelore's Cafee | </title>
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
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="why.php">Why Us</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="table.php">Report</a></li>
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
			  <a href="login.php?logout"class="button">logout</a>
            </div>
          </div>

          <div class="image_section">
            <img src="images/cofffee_image.png" alt="Coffee" />
          </div>
        </div>
      </div>
    </section>
    <!-- Footer Section -->
    <footer>
      <div class="section_container">
        <div class="footer_section">
          <div class="footer_logo">
            <a href="index.php">
              <img src="images/coffee_logo.png" alt="Coffee Logo" />
              <h2>Coffee</h2>
            </a>
          </div>

          <div class="useful_links">
            <h3>Useful Links</h3>
            <ul>
              <li><a href="about.php">About</a></li>
              <li><a href="services.php">Services</a></li>
              <li><a href="why.php">Why Us</a></li>
              <li><a href="gallery.php">Gallery</a></li>
              <li><a href="contact.php">Contact</a></li>
			  <li><a href="table.php">Report</a></li>
            </ul>
          </div>

          <div class="contact_us">
            <h3>Contact</h3>
            <ul>
              <li>
                <i class="bx bx-current-location"></i>
                <span>Aasra, Solapur</span>
              </li>
              <li>
                <i class="bx bxs-phone-call"></i> <span>+91 1122334455</span>
              </li>
              <li>
                <i class="bx bxs-time-five"></i>
                <span>Mon-Sun : 10:00 AM - 7:00 PM</span>
              </li>
            </ul>
          </div>

          <!--<div class="follow_us">
            <h3>Follow</h3>
            <i class="bx bxl-facebook-circle"></i>
            <i class="bx bxl-twitter"></i>
            <i class="bx bxl-instagram-alt"></i>
          </div> -->
        </div>
      </div>
    </footer>
  </body>
</html>
