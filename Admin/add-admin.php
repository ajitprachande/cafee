<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>
        <?php   
            if(isset($_SESSION['add']))//chk whether the session is set or not
            {
                echo $_SESSION['add'];//displaying session msg if set
                unset($_SESSION['add']);//remove session msg
            }
        ?>

        <form action="#" method="POST">
              <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-update">
                    </td>
                </tr>
             </table> 
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<!-- password toogle script code -->

<?php
//process the value from Form and save itin D/B
//chk whether the btn is clicked or not
if(isset($_POST['submit'])){
   // echo "btn clickeddd";

   //1.get data from forms
   $full_name = $_POST['full_name'];
   $username = $_POST['username'];
   $password = md5($_POST['password']); //pass encryption with md5

   //2.sql query to save into d/b
   $sql = "INSERT INTO tbl_admin SET
   full_name = '$full_name',
   username = '$username',
   password = '$password'
   ";
  //3.Execute query and ssave in d/b
   $res = mysqli_query($conn,$sql) or die(mysqli_error());

   //4. chk whether the data is insertted or not and display appropriate msg
   if($res==TRUE){
    //echo "data inserted";
    //create session variable to display msg
    $_SESSION['add'] = "<div class='success-msg'>Admin Added Successfully.</div>";
    //redirect page MANAGE ADMIN
    header("location:".SITEURL.'Admin/manage-admin.php');   

   }
   else{
    //echo "data not insertedd";
     //create session variable to display msg
     $_SESSION['add'] = "<div class='fail-msg'>Failed To Add Admin.</div>";
     //redirect page ADD ADMIN
     header("location:".SITEURL.'add-admin.php');
 
   }
}
?>