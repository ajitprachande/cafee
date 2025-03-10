
 <?PHP  include("partial/menu.php"); ?>
<?php
      require_once('lib/function.php');
       $db = new db_functions();
	   
	   
	   if(isset($_GET['edit_id']))
	   {
		   $var_edit_id  = $_GET['edit_id'];
		   
           $_SESSION['edit_id']  =  $var_edit_id;  
	   }
	   else if(isset($_SESSION['edit_id']))
	   {
		   $var_edit_id  =  $_SESSION['edit_id'];
	   }
	   //echo $_SESSION['edit_id'];
	   $flag = 0;
	   if(isset($_POST['submit_btn']))
	   {
		  $var_name = $_POST['name'];
          $var_email = $_POST['email'];
          $var_number = $_POST['number'];
		  $var_password = $_POST['password'];
          $var_textarea = $_POST['textarea'];
		  
          if($db->update_user_record($var_name,$var_email,$var_number,$var_password,$var_textarea,$var_edit_id))
		  {
			  $flag = 1;
		  }
		  else
		  {
			  $flag = 2;
		  }
           		   
	   }
	   
	   $user_record_data = array();
	   $user_record_data = $db->get_user_data_from_id($var_edit_id);
	   
	   if(!empty($user_record_data))
	   {
		     $res_id = $user_record_data[0];
			 $res_name = $user_record_data[1];
			 $res_email = $user_record_data[2];
			 $res_number = $user_record_data[3];
			 $res_password = $user_record_data[4];
			 $res_textarea = $user_record_data[5];
	   }
	   
?>
<html>
<head>
<title>contact us</title> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
		
 <!-- Contact Section -->
    <section class="contact" id="contact">
      <h2 class="section_title">Contact Us Edit</h2>
	  
 <?php
	          if($flag==1)
		      {
	      ?>
		       <div class="success_msg">Record Updated Successfull</div>
       	<?php
		       }
		       else if($flag==2)
		       {
	    ?>
	            <div class="fail_msg">failed To Update</div>
        <?php		
	        	}			
	    ?>
      <!-- menu section start -->
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
          <li><a href="admin_login.php">Report</a></li>
        </ul>
      </nav>
    </header>

       <!-- menu section end -->
	  
      <div class="section_container">
        <div class="contact_container">
          <div class="contact_form">
            <form action="editpage.php"  method="post">
              <div class="field">
                <label for="Name">Full Name</label>
                <input type="text" name="name" id="Name" placeholder="Your Name" required value="<?php echo $res_name; ?>" />
              </div>
              <div class="field">
                <label for="email">Your Email</label>
                <input
                  type="text"
				  name="email"
                  id="email"
                  placeholder="Your Email"
                  required value="<?php echo $res_email; ?>"
                />
              </div>
              <div class="field">
                <label for="number">Your Number</label>
                <input
                  type="number"
				  name="number"
                  id="number"
                  placeholder="Your Contact Number"
                  required value="<?php echo $res_number; ?>"
                />
			
              </div>
			   <div class="field">
                <label for="password">Your password</label>
                <input
                  type="password"
				  name="password"
                  id="password"
                  placeholder="Your password"
                  required value="<?php echo $res_password; ?>"
                />
			
              </div>
              <div class="field">
                <label for="textarea">Textarea</label>
					
                <textarea
                  name="textarea"
                  id="textarea"
                  placeholder="Your Message" 
				  required 
				  value="<?php echo $res_textarea; ?>"
                ><?php echo $res_textarea; ?></textarea>
				
              </div>

              <button class="button" name="submit_btn" id="submit_btn">Update My Record</button>
            </form>
          </div>
		  
          <div class="contact_text">
            <div class="contact_items">
              <i class="bx bx-current-location"></i>
              <div class="contact_details">
                <h3>Our Location</h3>
                <p>Aasra, Solapur</p>
              </div>
            </div>
            <div class="contact_items">
              <i class="bx bxs-envelope"></i>
              <div class="contact_details">
                <h3>General Enquries</h3>
                <p>coffeeshop@xyz.com</p>
              </div>
            </div>
            <div class="contact_items">
              <i class="bx bxs-phone-call"></i>
              <div class="contact_details">
                <h3>Call Us</h3>
                <p>+91 1122334455</p>
              </div>
            </div>
            <div class="contact_items">
              <i class="bx bxs-time-five"></i>
              <div class="contact_details">
                <h3>Our Timing</h3>
                <p>Mon-Sun : 10:00 AM - 7:00 PM</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
     <!-- footer section -->
 <?PHP  include("partial/footer.php"); ?>
</body>
</html>