<?php

  require_once('lib/function.php');
  $db = new db_functions();
 // echo $_SESSION['login_number'];

 session_start(); // Start session to access session variables
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
    <?PHP  include("partial/menu.php"); ?>
	
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
    <?PHP  include("partial/footer.php"); ?>
   
  </body>
</html>
