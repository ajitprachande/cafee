<?php include('partials/menu.php'); ?>

<style>
    .main-section {
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        background-color: #f8f9fa;
    }
    
    .content {
        width: 100%;
        overflow-x: auto;
    }
    
    .manage-order-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px; /* Ensure table has minimum width due to many columns */
    }
    
    .manage-order-table th, .manage-order-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .manage-order-table th {
        background-color: #007bff;
        color: white;
    }
    
    .manage-order-table tr:hover {
        background-color: #f5f6fa;
    }
</style>

<div class="main-section">
    <div class="content">
        <br><br>
        <?php 
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <h1>Manage Order</h1>
        <table class="manage-order-table">
            <tr>
                <th>S.n</th>    
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th> 
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>    
                <th>Payment ID</th> <!-- Added New Column for Payment ID -->
                <th>Customer Login No</th> <!-- New column header -->
                <th>Actions</th>
            </tr>

            <?php
                // Get all orders from the database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Displaying latest order first
                // Execute query
                $res = mysqli_query($conn, $sql);
                // Count the rows
                $count = mysqli_num_rows($res);

                $sn = 1; // Serial number

                if ($count > 0) {
                    // Orders available
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        $payment_id = $row['payment_id']; // Payment ID
                        $customer_login_no = $row['customer_login_no']; // New field
                    
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php 
                                    if ($status == "Ordered") {
                                        echo "<label>$status</label>";
                                    } elseif ($status == "On delivery") {
                                        echo "<label style='color: orange;'>$status</label>";
                                    } elseif ($status == "Delivered") {
                                        echo "<label style='color: green;'>$status</label>";
                                    } elseif ($status == "Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td><?php echo $payment_id; ?></td>
                            <td><?php echo $customer_login_no; ?></td> <!-- Display Customer Login Number -->
                            <td>
                                <a href="<?php echo SITEURL; ?>Admin/update-order.php?id=<?php echo $id; ?>" class="btn-update">Update Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                    

                } else {
                    // No orders available
                    echo "<tr><td colspan='13' class='fail-msg'>Order Not Available.</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
