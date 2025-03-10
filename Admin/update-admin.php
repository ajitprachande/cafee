<?php include('partials/menu.php'); ?>
 <div class="main-content">
    <div class="wrapper">
        <h1>UPDADTE ADMIN</h1>
        <br><br>
        <?php 
            //1.get id of selected admin
            $id = $_GET['id'];
            //2.create sql query to get detail
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            $res = mysqli_query($conn,$sql);

            //chkwhether the query is exexuted or not
            if($res==true){
                $count = mysqli_num_rows($res);

                if($count==1){
                   // echo "Admin available"; 
                   $row = mysqli_fetch_assoc($res);

                   $full_name = $row['full_name'];
                   $username = $row['username'];

                }else{
                    header('location'.SITEURL.'Admin/manage-admin.php');
                }

            }

        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name:" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
 </div>

 <?php
 //chk whether submit btn click or not 
    if(isset($_POST['submit'])){
        //echo "butonnnn cllickedd";
        $id= $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //create sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = $id 
        ";

        //execute query
        $res = mysqli_query($conn, $sql);

        if($res == true){
            //qry executed and admin updadte
            $_SESSION['update'] = "<div class='success-msg'>Admin updated successfully.</div>";
            //redirect to manage adminpage
            header('location:'.SITEURL.'Admin/manage-admin.php');
        }
        else{
            //failed to update
            $_SESSION['update'] = "<div class='fail-msg'>Failed to Delete Admin.</div>";
            //redirect to manage adminpage
            header('location:'.SITEURL.'manage-admin.php');

        }
    }


 ?>




<?php include('partials/footer.php'); ?>
