<?php
//session_start();
require_once("lib/function.php");

if (!isset($_SESSION['login_number'])) {
    echo "<div style='color:red;'>Session expired! Please log in again.</div>";
    exit();
}

$db = new db_functions();
$old_number = $_SESSION['login_number'];

// Get POST Data
$new_name     = $_POST['name'];
$new_email    = $_POST['email'];
$new_number   = $_POST['number'];
$new_password = trim($_POST['password']); // Empty means no password change
$new_textarea = $_POST['textarea'];

// Update User Data
$result = $db->update_user_by_number($old_number, $new_name, $new_email, $new_number, $new_password, $new_textarea);

if ($result) {
    $_SESSION['login_number'] = $new_number; // Update session if number changes
    echo "<div style='color:green;'>Profile updated successfully!</div>";
} else {
    echo "<div style='color:red;'>Profile update failed!</div>";
}
?>
