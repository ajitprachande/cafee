<?php 
//session start 
session_start();
//create constants to store non repeting values
    define('SITEURL','http://localhost/cafee/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', "bachelor's_cafee");
    
    
    
        
 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //d/b connection
 $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting d/b


?>