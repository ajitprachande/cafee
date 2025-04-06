<?php
     require("lib/adminConnection.php");
?>
<html>
<head>
<link rel="icon" type="image/png" href="images/cofffee_image.png">
<title>Sign In</title> 
<link rel="stylesheet" type="text/css" href="css/style.css" />

<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>

<style>
.contact {
    background: var(--light-gray-color);
    padding: 100px 35px 260px;
	min-height:700px;
}

</style>
</head>
<body>
		
 <!-- Contact Section -->
    <section class="contact" id="contact">
      <h2 class="section_title">ADMIN SIGN IN</h2>

      <div class="section_container">
        <div class="contact_container">
          <div class="contact_form">

		      <form  method="POST">
              <div class="field">
                <label for="number">Your Number</label>
                <input
                  type="number"
				          name="AdminNumber"
                  id="number"
                  placeholder="Your Contact Number"
                  
                />
              </div>
			          <div class="field">
                <label for="password">Your password</label>
                <input
                  type="password"
				          name="AdminPassword"
                  id="password"
                  placeholder="Your password"  
                />
              </div>  
              <button class="button" name="submit_btn" id="submit_btn">Log In</button>
			     </form>
          </div>

<?php
     if(isset($_POST['submit_btn']))
     {
      $query = "SELECT * FROM `adminlogin` WHERE `Admin_number`='$_POST[AdminNumber]' AND `Admin_password`='$_POST[AdminPassword]'";
      $result=mysqli_query($con, $query);
      if(mysqli_num_rows($result)==1)
      {
        //echo "correct";
        session_start();
        $_SESSION['AdminLoginId']=$_POST['AdminNumber'];
        header("location:table.php");

      }
      else{
        echo "<script>alert('Incorrect Password');</script>";
      }

     }
     	
?>
</body>
</html>
