<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!-- add category form start -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes" id="featured-yes">
                            <label for="featured-yes">YES</label>
                            <input type="radio" name="featured" value="No" id="featured-no">
                            <label for="featured-no">NO</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes" id="active-yes">
                            <label for="active-yes">YES</label>
                            <input type="radio" name="active" value="No" id="active-no">
                            <label for="active-no">NO</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-update" >
                        </td>
                    </tr>
                    
                </table>
            </form>
         <!-- add category form ends -->
          <?php
          //chk whether the submit btn is clicked or not
            if(isset($_POST['submit'])){
                //echo "clickeddd";
                //1.get the value from category form
                $title = $_POST['title'];

                //for radio input, we need to check the btn is selected or not
                if(isset($_POST['featured'])){
                    //get value from form
                    $featured = $_POST['featured'];
                }
                else{
                    //get default value
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    //get value from form
                    $active = $_POST['active'];
                }
                else{
                    //get default value
                    $active = "No";
                }
                //chk whether the image select or not and set the value for image name accordingly
                //print_r($_FILES['image']);
                //die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                         //upload the image
                         //to upload image we need img name ,source path and destination path
                         $image_name = $_FILES['image']['name'];
                         //upload the img only if image is selected
                        if($image_name != "")
                        {
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
                                $_SESSION['upload'] = "<div class='fail-msg'>Failed to Upload Image </div>";
                                //redirct to aad category page
                                header('location:'.SITEURL.'Admin/add-category.php');
                                //stop the process
                                die();
                            } 
                        }
                }
                else{
                    //don't upload the image and set the image name value as blank
                    $image_name = "";
                    
                }


                //2.crete sql qry to insert categiory into d/b
                $sql = "INSERT INTO tbl_category SET 
                title='$title',
                image_name= '$image_name',
                featured= '$featured',
                active= '$active'
                ";
                //3.execute the query save into d/b
                $res = mysqli_query($conn, $sql);

                //4.chk whether the qry execute or not and data added or not
                if($res==true){
                    //qry xecuted and category added
                    $_SESSION['add'] = "<div class='success-msg'>Category Added Successfully.</div>";
                    //MANAGE to manage-category page
                    header('location:'.SITEURL.'Admin/manage-category.php');
                }
                else{
                    //failed to add category
                    $_SESSION['add'] = "<div class='fail-msg'>Failed Add Category.</div>";
                    //return redirect to add-category page
                    header('location:'.SITEURL.'Admin/add-category.php');
                }
            }
          ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>
