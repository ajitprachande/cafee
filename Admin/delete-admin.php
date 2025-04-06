<?php 
     //include constant file here
     include('../config/constants.php');
    //1/get the id of admin to be deleted 
    $id = $_GET['id'];
    //2.create sql query ti delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    //execute the query 
    $res = mysqli_query($conn, $sql);
    //chk query executed successfully or not 
    if($res == TRUE){
            //echo "admin deleted";
            //create session variable to display msg 
            $_SESSION['delete'] = "<div class='success-msg'>Admin Deleted Successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'Admin/manage-admin.php');
    }else{
            //echo "failed to delete admin";
            $_SESSION['delete'] = "<div class='fail-msg'>Failed to Delete Admin, Try again later.</div>";
            header('location:'.SITEURL.'Admin/manage-admin.php');
    }
    //3. redirect to admin page with msg (success/failed)
    


?>