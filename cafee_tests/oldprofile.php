<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="images/cofffee_image.png">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Bachelore's Cafee |</title>

</head>
<?php 
    include("lib/function.php");
    $db = new db_functions();
?>
<?php include("partial/order-navigationbar.php"); ?>
<?php
// Check if user is logged in via phone number
if (!isset($_SESSION['login_number'])) {
    header("Location: login.php");
    exit();
}

$db = new db_functions();

// Get the old phone number from session
$old_number = $_SESSION['login_number'];

// Fetch user data by phone number
$user = $db->get_user_data_by_number($old_number);

if (!$user) {
    echo "<div style='color:red;'>User not found!</div>";
    exit();
}
?>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="olduser.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="profile.php"><i class="fas fa-home"></i>Edit_profile</a></li>
            <li><a href="my-orders.php"><i class="fas fa-shopping-cart"></i> My Orders</a></li>
            <li><a href="help.php"><i class="fas fa-question-circle"></i> Help</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
    <h2>User Profile</h2>

<div id="message"></div> <!-- Success/Error messages will be displayed here -->

<form id="updateProfileForm">
    <div class="input-icon">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        <i class="fas fa-user"></i>
    </div>

    <div class="input-icon">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <i class="fas fa-envelope"></i>
    </div>

    <div class="input-icon">
        <label for="number">Phone Number</label>
        <input type="text" name="number" id="number" value="<?php echo htmlspecialchars($user['number']); ?>" required>
        <i class="fas fa-phone"></i>
    </div>

    <div class="input-icon">
        <label for="password">New Password (Leave blank to keep existing)</label>
        <input type="password" name="password" id="password" placeholder="Enter new password">
        <i class="fas fa-lock"></i>
    </div>

    <div class="input-icon">
        <label for="textarea">Message / Bio</label>
        <textarea name="textarea" id="textarea"><?php echo htmlspecialchars($user['textarea']); ?></textarea>
        <i class="fas fa-comment"></i>
    </div>

    <button type="submit"><i class="fas fa-save"></i>Update Profile</button>
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
</form>
    

<script>
    $(document).ready(function() {
        $("#updateProfileForm").submit(function(e) {
            e.preventDefault(); // Prevent form from refreshing the page
            
            $.ajax({
                type: "POST",
                url: "update_profile.php",
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    $("#message").html(response);
                },
                error: function() {
                    $("#message").html("<div style='color:red;'>Error updating profile!</div>");
                }
            });
        });
    });
</script>
        
    </div>
</body>
</html>
