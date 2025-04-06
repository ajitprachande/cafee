<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login_number'])) {
    // If not logged in, redirect to index
    header("Location: index.php");
    exit();
}

require_once('lib/function.php');
$db = new db_functions();
	   
// Initialize $var_edit_id
$var_edit_id = 0;
	   
if(isset($_GET['edit_id']))
{
    $var_edit_id  = $_GET['edit_id'];
    
    $_SESSION['edit_id']  =  $var_edit_id;  
}
else if(isset($_SESSION['edit_id']))
{
    $var_edit_id  =  $_SESSION['edit_id'];
}
else if(isset($_SESSION['login_number'])) 
{
    // If no specific edit_id is set, get data by user's phone number
    $user_data = $db->get_user_data_by_number($_SESSION['login_number']);
    if ($user_data) {
        $var_edit_id = $user_data['id'];
    }
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
// Initialize variables with default empty values
$res_name = '';
$res_email = '';
$res_number = '';
$res_password = '';
$res_textarea = '';
	   
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
<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile | Bachelore's Cafee</title> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/png" href="images/cofffee_image.png">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    /* Sidebar Styling */
    .sidebar {
        position: fixed;
        width: 200px;
        height: calc(100vh - 85px);
        background: #3b141c;
        left: 0;
        top: 85px;
        z-index: 999;
        transition: all 0.3s ease;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    
    .sidebar ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }
    
    .sidebar ul li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .sidebar ul li a {
        color: #fff;
        display: block;
        text-decoration: none;
        transition: 0.3s;
        padding: 15px;
    }
    
    .sidebar ul li a i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    .sidebar ul li a:hover {
        color: #f3961c;
        padding-left: 20px;
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    /* Mobile Menu Toggle */
    .mobile-menu-toggle {
        display: none;
        position: fixed;
        top: 95px;
        left: 15px;
        background: #3b141c;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        z-index: 1000;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    /* Overlay for sidebar when it's active on mobile */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 998;
    }
    
    /* Contact form and section styling - Modified for responsiveness */
    .contact {
        margin-left: 200px;
        width: calc(100% - 200px);
        padding: 40px 20px;
    }
    
    .section_title {
        margin-top: 20px;
    }
    
    .contact_container {
        display: flex;
        flex-wrap: wrap;
    }
    
    .contact_form {
        flex: 1;
        min-width: 300px;
        padding-right: 30px;
    }
    
    .contact_text {
        flex: 1;
        min-width: 300px;
    }
    
    /* Responsive Media Queries */
    @media screen and (max-width: 768px) {
        .mobile-menu-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar {
            left: -250px;
            width: 250px;
        }
        
        .sidebar.active {
            left: 0;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        
        .sidebar-overlay.active {
            display: block;
        }
        
        .contact {
            margin-left: 0;
            width: 100%;
            padding-top: 70px;
        }
        
        /* Improve tap targets for mobile */
        .sidebar ul li a {
            padding: 15px;
            min-height: 44px;
            display: flex;
            align-items: center;
        }
        
        .contact_container {
            flex-direction: column;
        }
        
        .contact_form {
            padding-right: 0;
            margin-bottom: 30px;
        }
    }
</style>
</head>
<body>
<?php include("partial/order-navigationbar.php"); ?>

<!-- Mobile menu toggle button -->
<button class="mobile-menu-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i> Menu
</button>

<!-- Sidebar overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <ul>
        <li><a href="olduser.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="profile.php"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
        <li><a href="my-orders.php"><i class="fas fa-shopping-cart"></i> My Orders</a></li>
        <li><a href="help.php"><i class="fas fa-question-circle"></i> Help</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>
		
<!-- Contact Section -->
<section class="contact" id="contact">
    <h2 class="section_title">Edit Profile</h2>
	  
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
	  
    <div class="section_container">
        <div class="contact_container">
            <div class="contact_form">
                <form action="profile.php" method="post">
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
                        <label for="textarea">Address</label>
                            
                        <textarea
                            name="textarea"
                            id="textarea"
                            placeholder="Your Address" 
                            required 
                            value="<?php echo $res_textarea; ?>"
                        ><?php echo $res_textarea; ?></textarea>
                        
                    </div>

                    <button class="button" name="submit_btn" id="submit_btn">Update My Profile</button>
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
    
<script>
// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    
    // Toggle sidebar when button is clicked
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });
    
    // Close sidebar when clicking outside
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });
});
</script>
</body>
</html>