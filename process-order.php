<?php
// 1. Include DB connection
include("config/constants.php");

// 2. Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Sanitize/escape input data
    $food = mysqli_real_escape_string($conn, $_POST['food']);
    $price = floatval($_POST['price']);
    $qty = intval($_POST['qty']);
    $total = $price * $qty;
    
    // If you want to use the posted order_date/status, you can capture them as well:
    // $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    // $status = mysqli_real_escape_string($conn, $_POST['status']);
    // Otherwise, you can keep these fixed or generated:
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";
    
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
    $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']); 
   
    // 4. Fetch and sanitize the new field: customer_login_no
    $customer_login_no = mysqli_real_escape_string($conn, $_POST['customer_login_no']);

    // 5. Insert into tbl_order
    $sql = "INSERT INTO tbl_order (
                food,
                price,
                qty,
                total,
                order_date,
                status,
                customer_name,
                customer_contact,
                customer_email,
                customer_address,
                payment_id,
                customer_login_no
            ) VALUES (
                '$food',
                $price,
                $qty,
                $total,
                '$order_date',
                '$status',
                '$customer_name',
                '$customer_contact',
                '$customer_email',
                '$customer_address',
                '$payment_id',
                '$customer_login_no'
            )";

    // 6. Execute and handle response
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<script>alert('Payment Successful! Order Placed.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Order Failed! Error: " . mysqli_error($conn) . "'); window.location.href='order.php';</script>";
    }
}
?>
