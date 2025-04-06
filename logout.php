<?php
session_start();

// Unset the login session variable
unset($_SESSION['login_number']);

// Or optionally destroy the entire session
session_destroy();

// Redirect to index or login
header("Location: index.php");
exit();
?>
