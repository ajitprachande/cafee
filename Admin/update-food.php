<?php 
include('partials/menu.php'); 
ob_start(); // Start output buffering to prevent "headers already sent" error

// Check whether id is set or not
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to get food details
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2) {
        $row2 = mysqli_fetch_assoc($res2);  
        if ($row2) {
            // Get food details
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            header('location:'.SITEURL.'Admin/manage-food.php');
            exit();
        }
    }
} else {
    header('location:'.SITEURL.'Admin/manage-food.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo htmlspecialchars($description); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                        if($current_image == "") {
                            // Image not available
                            echo "<div class='fail-msg'>Image not Available.</div>";
                        } else {
                            // Display current image
                            echo "<img src='".SITEURL."images/food/$current_image' alt='$title' width='90px' height='90px'>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                            // Query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count > 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    ?>
                                    <option value="<?php echo $category_id; ?>" <?php if($current_category == $category_id) echo "selected"; ?>><?php echo $category_title; ?></option>
                                    <?php
                                }
                            } else {
                                echo "<option value='0'>Category Not Available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No") echo "checked"; ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 
                        <input type="submit" name="submit" value="Update Food" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        if(isset($_POST['submit'])) {
            // Get all details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $current_image = $_POST['current_image'];

            $image_name = $current_image;

            // Check if new image is selected
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $image_parts = explode('.', $image_name);
                $ext = end($image_parts);

                $image_name = "Food-Name" . rand(0000, 9999) . '.' . $ext;
                $src_path = $_FILES['image']['tmp_name'];
                $dest_path = "../images/food/" . $image_name;

                // Upload the image
                if (move_uploaded_file($src_path, $dest_path)) {
                    // Remove old image if exists
                    if ($current_image != "" && file_exists("../images/food/" . $current_image)) {
                        unlink("../images/food/" . $current_image);
                    }
                } else {
                    $_SESSION['upload'] = "<div class='fail-msg'>Failed to Upload New Image.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                    exit();
                }
            }

            // Update the food in database
            $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id = $id";

            $res3 = mysqli_query($conn, $sql3);

            if($res3) {
                $_SESSION['update'] = "<div class='success-msg'>Food Updated Successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='fail-msg'>Failed to Update Food.</div>";
            }

            header('location:'.SITEURL.'Admin/manage-food.php');
            exit();
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); // End output buffering ?>
