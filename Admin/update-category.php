<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php 
            //chk whether the id is set or not
            if(isset($_GET['id']))
            {
               //echo "getting the data"; 
               $id = $_GET['id'];
               $sql = "SELECT * FROM tbl_category WHERE id = $id";

               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);
               if($count==1){
                  
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];


               }
               else{
                    $_SESSION['no-category-found'] = "<div class='fail-msg'>Category not Found</div>";
                    header('location:'.SITEURL.'Admin/manage-category.php');
               }


            }
            else{
                header('location:'.SITEURL.'Admin/manage-category.php');
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="100px;">
                                <?php
                            }
                            else{
                                echo "<div class='fail-msg'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">YES

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">YES

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden"name="id" value="<?php echo $id;  ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit'])){
                //echo "clickee";
                //1.get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2.update new img if selected
                //chk whether the img selected or not
                if(isset($_FILES['image']['name'])){
                    //get the img detail
                    $image_name = $_FILES['image']['name'];

                    if($image_name != ""){
                        //img available
                             //A.upload the new img

                             //auto rename our image 
                                //get the extension of our image("jpg,png,gif")e.g "specialcoder.png"
                                $ext = end(explode('.',$image_name));

                                //rename the image 
                                $image_name = "Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.png
        
                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../images/category/".$image_name;

                                //finally upload the image
                                 $uplaod = move_uploaded_file($source_path, $destination_path);

                                 //chk whether the image is upload or not
                                 //and if image is not upload then we will stop the process and redirct with error msg
                                if($uplaod==false){
                                    //set msg
                                    $_SESSION['upload'] = "<div class='fail-msg'>Failed to Upload Image</div>";
                                    //redirct to aad category page
                                    header('location:'.SITEURL.'Admin/manage-category.php');
                                    //stop the process
                                    die();
                                }

                                 //B.remove the current img if available
                                if($current_image!=""){

                                    $remove_path = "../images/category/".$current_image;

                                    $remove = unlink($remove_path);

                                    //chk whether the image is removed or not
                                    //if failed to remove then display msg and stop the process
                                   if($remove==false){
                                       $_SESSION['failed-remove'] = "<div class='fail-msg'>Failed To Remove Current Image.</div>";
                                       header('location:'.SITEURL.'Admin/manage-category.php');
                                       die();//stop the process
                                   }
                                    
                                 }           
                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                //3.update the d/b
                $sql2 = "UPDATE tbl_category SET
                   title = '$title',
                   image_name = '$image_name',
                   featured = '$featured',
                   active = '$active'
                   WHERE id = $id
                ";

                $res2 = mysqli_query($conn, $sql2);

                //4.redirect to manage category with msg
                //chk whether executed  or not 
                if($res2==true){
                    //category updated
                    $_SESSION['update'] = "<div class='success-msg'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'Admin/manage-category.php');

                } 
                else{
                     // failed to update category
                     $_SESSION['update'] = "<div class='fail-msg'>Failed To Update Category.</div>";
                     header('location:'.SITEURL.'Admin/manage-category.php');
                }



            }


        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
