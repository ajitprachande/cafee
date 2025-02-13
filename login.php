<?php
  require_once('lib/function.php');
  $db = new db_functions();
  
  //logout code
  if(isset($_GET['logout']))
  {
	  unset($_SESSION['login_number']);
  }
  
  //login code	
  $flag = 0;
  if(isset($_POST['submit_btn']))
  {
    $var_number = $_POST['number'];
	$var_password = $_POST['password'];
	
    $db_password = $db->get_password_from_number($var_number);
	
	//for captcha code
	$var_original_captcha = $_POST['original_captcha'];
	$var_user_captcha = $_POST['user_captcha'];
	
	if($var_original_captcha==$var_user_captcha)
	{
	  if($db_password==$var_password)
	  {
		//echo "login success";
		$flag = 1;
		
		//put mobile number in to session
		$_SESSION['login_number'] =  $var_number;
		
		//auto redirect to next page
		header("location:dashboard.php");
		
	  }
	  else
	  {
		//echo "wrong password";
		$flag = 2;
	  }
	}
	//captcha code
	else
	{
		$flag = 3;
		
	}
	
  }
?>

<html>
<head>
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
      <h2 class="section_title">Sign In</h2>
	
       	<?php
		        if($flag==2)
		       {
	    ?>
	            <div class="fail_msg" style="background-color:red; border:3px solid #DFDFDF;">wrong password or not registered</div>
        <?php		
	        	}	
				else if($flag==3)
				{
	    ?>
		          <div class="fail_msg" style="background-color:red; border:3px solid #DFDFDF;"> please Re-enter captcha code</div>
		<?php 
				}
		?>
	  
      <div class="section_container">
        <div class="contact_container">
          <div class="contact_form">
            <form action="login.php"  method="post">
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
			  
			  <?php 
			  function generateRandomString($length = 4)
			  {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                     $randomString = '';
                     for ($i = 0; $i < $length; $i++)  
					 {
                          $randomString .= $characters[random_int(0, $charactersLength - 1)];
                     }
                     return $randomString;
              }
			  $original_captcha = generateRandomString();
			  
			  ?>
			  
			  <div class="field">
			  <label for="">Enter below given captcha code:</label>
                <input
                  type="text"
				  name="original_captcha"
                  id="original_captcha"
				  value="<?php echo $original_captcha; ?>"
				  readonly 
				  style="width:50%; text-align:center; color:red;";
                />
			
              </div>
			  <div class="field">
                <input
                  type="text"
				  name="user_captcha"
                  id="user_captcha"
				  
				  style="width:50%; text-align:center; color:black;";
                />
			
              </div>
              <button class="button" name="submit_btn" id="submit_btn">Log In</button>
            </form>
          </div>
		  
		<script type="text/javascript">
	       $(document).ready(function(){
			  
               $("#user_captcha").keyup(function(){
				   
				   var var_user_captcha = $("#user_captcha").val();
				   var var_original_captcha = $("#original_captcha").val();
				   
				 //  alert(var_user_captcha + " = " +var_original_captcha);
				 
				 if(var_user_captcha==var_original_captcha)
				 {
					 $("#user_captcha").css("background-color","#C8EFD4");
					 
				 }
				 else
				 {
					 $("#user_captcha").css("background-color","#FBCFD0");
					 
				 }
			   });			  
		          
		
	      });
	   </script>
	  
</body>
</html>
