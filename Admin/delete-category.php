<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Delete Category</h1>
        <br><br>

        <?php
        //chk whether the id and image_name value is set or not
        if(isset($_GET['id']) AND isset($_GET['image_name']))
        {
            //get the value and delete
            //echo "get the value and delete";
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            //remove the physical image file is available
            if($image_name != ""){
                //image is available. so remove it
                $path = "../images/category/".$image_name;
                //remove the image
                $remove = unlink($path);

                
                if($remove==false){
                    //set the session
                    $_SESSION['remove'] = "<div class='fail-msg'>Failed to Remove Category Image. </div>";
                    //redirect
                    header('location:'.SITEURL.'Admin/manage-category.php');
                    //stop the session
                    die();
                }
            }

            //delete data from d/b
            //sql query to delete datafrom d/b
            $sql = "DELETE FROM tbl_category WHERE id = $id";

            $res = mysqli_query($conn,$sql);

            //check whether the data is delete from d/b or not
            if($res==true){
                //redirect to manage category page with message
                $_SESSION['delete'] = "<div class='success-msg'>Category Deleted Successfully.</div>";
                 
                header('location:'.SITEURL.'Admin/manage-category.php');
            }
            else{
                 //set fail msg 
                 $_SESSION['delete'] = "<div class='fail-msg'>Failed To Delete CAtegory .</div>";
                 
                 header('location:'.SITEURL.'Admin/manage-category.php');
            }    
        }
        else{
            //redirect to manage category page
            header('location:'.SITEURL.'Admin/manage-category.php');
        }

        ?>
       

       

    </div>
</div>




<?php include('partials/footer.php'); ?>
