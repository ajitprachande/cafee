<?php
ob_start(); // Start output buffering
session_start(); // Start session if needed
?>

<?php include("partials/menu.php");?>
<div class="main-section">
    <div class="content">
        <h1>Update Order</h1>
        <br>
        <?php 
            if(isset($_GET['id'])){
                //get order detail
                $id = $_GET['id'];

                //sql query to get the order page
                $sql = "SELECT * FROM tbl_order WHERE id = $id";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //detail avail
                    $row = mysqli_fetch_assoc($res);

                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                }
                else{
                    //detail not avail
                     //redirect to manage order page
                header("location:".SITEURL."Admin/manage-order.php");
                }
            }
            else{
                //redirect to manage order page
                header("location:".SITEURL."Admin/manage-order.php");
            }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <b> ₹ <?php echo $price; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On delivery"){echo "selected"; } ?> value="On delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected"; } ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected"; } ?> value="Cancelled">Canceled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td>
                       <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            //chk whether update buttons is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "click";
                //get the all values
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name =$_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email =$_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                //update the value
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id = $id;
                ";
                //execute qery
                $res2 = mysqli_query($conn, $sql2);
                //chk update or not
                if($res2==true)
                {
                    //updated seccuss
                    $_SESSION['update'] = "<div class='success-msg'>Order Updated Successfully.</div>";
                    header("location:".SITEURL.'Admin/manage-order.php');
                }
                else{
                    //fail to update
                    $_SESSION['update'] = "<div class='fail-msg'>Failed To Update Order.</div>";
                    header("location:".SITEURL.'Admin/manage-order.php');
                }

                //and redirect to mange order with message

            }
        ?>
    </div>
</div>
<?php include("partials/footer.php"); ?>
<?php ob_end_flush(); ?>
