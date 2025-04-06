<?php 
//session start only if no session is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/kolkata');

//create constants to store non repeating values, only if they're not already defined
if (!defined('SITEURL')) {
    define('SITEURL','http://localhost/cafee/');
}

if (!defined('LOCALHOST')) {
    define('LOCALHOST','localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', "bachelor's_cafee");
}
    
// Database connection - only create if it doesn't exist
if (!isset($conn) || $conn === null) {
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Database selection
    $db_select = mysqli_select_db($conn, DB_NAME);
    if (!$db_select) {
        die("Database selection failed: " . mysqli_error($conn));
    }
}

?>
