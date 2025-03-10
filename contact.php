<?PHP  include("partial/menu.php"); ?>
<?php
  require_once('lib/function.php');
  $db = new db_functions();

    $flag = 0;
if(isset($_POST['submit_btn'])) 
{
    $var_name = $_POST['name'];
    $var_email = $_POST['email'];
    $var_number = $_POST['number'];
	  $var_password = $_POST['password'];
    $var_textarea = $_POST['textarea'];                                                    
    
    if($db->registration_data($var_name, $var_email, $var_number, $var_password, $var_textarea)) 
	 {  
        $flag = 1;
      //  echo "work posted succesfully";
     }
	else 
	{
		$flag = 2;
      // echo "work not submiitted"; 
    }
}		

?>
<html>
<head>
<title>contact us</title> 
<link rel="stylesheet" type="text/css" href="css/style.css" />

<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>

</head>
<body>
		
 <!-- Contact Section -->
    <section class="contact" id="contact">
      <h2 class="section_title">Contact Us</h2>
	  
	  <?php
	          if($flag==1)
		      {
	      ?>
		       <div class="success_msg">Thank You For Visiting</div>
       	<?php
		       }
		       else if($flag==2)
		       {
	    ?>
	            <div class="fail_msg">Registration failed</div>
        <?php		
	        	}			
	    ?>
	  
	  
	  <form action="contact.php" method="post">
	        <div class="section_container">
        <div class="contact_container">
          <div class="contact_form">
            <form action="contact.php"  method="post">
              <div class="field">
                <label for="Name">Full Name</label>
                <input type="text" name="name" id="Name" placeholder="Your Name" required />
              </div>
              <div class="field">
                <label for="email">Your Email</label>
                <input
                  type="text"
				  name="email"
                  id="email"
                  placeholder="Your Email"
                  required
                />
              </div>
              <div class="field">
                <label for="number">Your Number</label>
                <input
                  type="number"
				           name="number"
                  id="number"
                  placeholder="Your Contact Number"
                  required
                />
			
              </div>
			          <div class="field">
                <label for="password">Your password</label>
                <input
                  type="password"
				         name="password"
                  id="password"
                  placeholder="Your password"
                  required
                />
				
              </div>
              <div class="field">
                <label for="textarea">Textarea</label>
                <textarea
                  name="textarea"
                  id="textarea"
                  placeholder="Your Message"
                ></textarea>
              </div>

              <button type="submit" class="button" name="submit_btn" id="submit_btn">Submit</button>
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
                <p>bachelores_cafee@gmail.com</p>
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
	
	<script type="text/javascript">
	$(document).ready(function(){
		
	});
	</script>
	  
	  </form>
	
</body>
</html>