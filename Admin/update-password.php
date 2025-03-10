<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
         <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
         ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Old Password:</td>
                    <td>
                        <input type="password"  name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Passsword">

                    </td>
                </tr>
                <tr>
                    <td>Confirm Passsword:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" id="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="change password" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
        //chk whether the submit btn click or not
        if(isset($_POST['submit']))
        {
           //echo "clicked";
           //1.get data from form
           $id = $_POST['id'];
           $current_password = md5($_POST['current_password']);
           $new_password = md5($_POST['new_password']);
           $confirm_password = md5($_POST['confirm_password']);

           //2.chk whether user with current id and password exist or not
           $sql = "SELECT * FROM tbl_admin WHERE id = $id AND PASSWORD = '$current_password'";
            
           //execut qry
           $res = mysqli_query($conn, $sql);

           if($res == true){
            $count = mysqli_num_rows($res);
            if($count==1){
                //user exist and password can be changed
                //echo "user found";
                //chk whether new password and confirm pass match or not
                if($new_password == $confirm_password){
                    //update the password
                    $sql2 = "UPDATE tbl_admin SET
                    password = '$new_password'
                    WHERE id = $id
                    ";
                    //execute qry
                    $res2 = mysqli_query($conn,$sql2);

                    //chk whether the query execute or not
                    if($res2==true){
                        //display success msg
                        //redirect to manage admin page woth error msg
                        $_SESSION['change-pass'] = "<div class='success-msg'>Password Change Successfully .</div>";
                        //redirect user
                        header('location:'.SITEURL.'Admin/manage-admin.php');


                    }
                    else{
                        //display error msg
                        //redirect to manage admin page woth error msg
                        $_SESSION['change-pass'] = "<div class='fail-msg'>Failed to Change Password.</div>";
                        //redirect user
                        header('location:'.SITEURL.'Admin/manage-admin.php');

                    }

                }
                else{
                    //redirect to manage admin page woth error msg
                    $_SESSION['pass-not-match'] = "<div class='fail-msg'>Password did not match.</div>";
                    //redirect user
                    header('location:'.SITEURL.'Admin/manage-admin.php');

                }
            }
            else{
                //user does not exist set msg redirect
                $_SESSION['user-not-found'] = "<div class='fail-msg'>User Not Found.</div>";
                //redirect user
                header('location:'.SITEURL.'Admin/manage-admin.php');
            }
           }

            //3.chk whether new password and confirm pass matchor not

            //4.change passsword if all above is true
        }
?>




<?php include('partials/footer.php'); ?>
