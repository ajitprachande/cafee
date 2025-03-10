<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Delete Food</h1>
        <br><br>

        <?php
            if(isset($_GET['id']) AND isset($_GET['image_name'])){
                //process to delete
                //echo "item deleted";

                //1.get id nd image
                $id = $_GET['id'];
                $image_name = $_GET['image_name'];
                //2.remove img if available
                if($image_name != ""){
                    //
                    //get image path
                    $path = "../images/food/".$image_name;
                    //remove img file from folder
                    $remove = unlink($path);
                    //chk whether the img is removed or not
                    if($remove == false)
                    {
                        $_SESSION['upload'] = "<div class='fail-msg'>Failed To Remove image</div>";
                        header('location:'.SITEURL.'Admin/manage-food.php');
                        die();
                    }  
                }

                //3.delete food from d/b
                $sql = "DELETE FROM tbl_food WHERE id = $id";
                //execute query
                $res = mysqli_query($conn, $sql);
                //chk whether execute or not and set the session msg respectively
                //4.redirect to mange food with session msg
                if($res==true){
                    $_SESSION['delete'] = "<div class='success-msg'>Food Deleted Successfully.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');

                } 
                else{
                    //fail to delete
                    $_SESSION['delete'] = "<div class='fail-msg'>Failed To Delete Food.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }
                
            }
            else{
                //redirect to manage page
                // echo "Redirect to manage page";
                $_SESSION['unauthorize'] = "<div class='fail-msg'>Unauthorized Access.</div>";
                header('location:'.SITEURL.'Admin/manage-food.php');

            }
        ?>  
    </div>
</div>






<?php include('partials/footer.php'); ?>