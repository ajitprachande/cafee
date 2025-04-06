<?php include('partials/menu.php'); ?>
<?php
ob_start();
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="#" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="6" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Price in INR">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

<?php 
                            //create code display categories from d/b
                            //1.create sql to get all active categories  from d/b
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            //count rows to chk whether we havecategory or not

                            $count = mysqli_num_rows($res);

                            if($count>0){
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
?>
                                    <option value="<?php  echo $id; ?>"><?php echo $title;  ?></option>
                                    
<?php

                                }
                            }
                            else{

?>
                                <option value="0">No Category Found</option>

<?php
                            }

                            //2.display on dropdown  
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" id="featured-yes">
                        <label for="featured-yes">Yes</label>
                        <input type="radio" name="featured" value="No" id="featured-no">
                        <label for="featured-no">No</label>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                     <td>
                        <input type="radio" name="active" value="Yes" id="active-yes">
                        <label for="active-yes">Yes</label>
                        <input type="radio" name="active" value="No" id="active-no">
                        <label for="active-no">No</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            //
            if(isset($_POST['submit']))
            {
                //echo "clickeddd";
                //1.getthe data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //chk whether radio btn for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }
                //2. upload the img
                //
                if(isset($_FILES['image']['name']))
                {
                    //get the details selected img
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        //img is selected 
                        //A.rename img
                        //$ext = end(explode('.',$image_name));
                        $image_parts = explode('.', $image_name);
                        $ext = end($image_parts);

                        //crete new name img
                        $image_name = "Food-Name".rand(0000,9999).".".$ext; //new img name

                        //B.upload the img
                        //get the src. path dest. path

                        //src path is the current location of the img
                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/food/".$image_name;

                        //finally upload food img
                        $upload = move_uploaded_file($src, $dst);

                        //chk whether img uploades the img or not
                        if($upload==false){
                            //failed to upload img
                            //redirect to add food page with error msg
                            $_SESSION['upload'] = "<div class='fail-msg'> Failed To Upload image.</div>";
                            header('location:'.SITEURL.'Admin/add-food.php');
                            //stopthe process
                            die();
                        }
                    }

                }
                else
                {
                    $image_name = ""; //setting default  value as blank
                }
                //3.insert into d/b
                //
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
                //execute the qry
                $res2 = mysqli_query($conn, $sql2);

                //4.redirect with message to manage-food page
                if($res2==true)
                {
                    //data insertedd
                    $_SESSION['add'] = "<div class='success-msg'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }
                else{
                    //failed to insert data
                    $_SESSION['add'] = "<div class='fail-msg'>Failed To Add Food.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }
            } 
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>
<?php
ob_end_flush(); 
?>