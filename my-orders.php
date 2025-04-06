<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login_number'])) {
    // If not logged in, redirect to index
    header("Location: index.php");
    exit();
}    

// Use include_once to prevent duplicate includes
include_once("config/constants.php");

// No need to manually connect to the database since it's already done in constants.php
// $conn should already be available from constants.php

// 3. Fetch the customer's login number from session
$customer_login_no = $_SESSION['login_number'];

// 4. Fetch orders for this customer
$sql = "SELECT * FROM tbl_order 
        WHERE customer_login_no = '$customer_login_no' 
        ORDER BY id DESC"; // Show latest orders first
$res = mysqli_query($conn, $sql);

// 5. Check if any orders exist
$has_orders = (mysqli_num_rows($res) > 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="images/cofffee_image.png">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Bachelore's Cafee</title>
    <link rel="stylesheet" href="css/style-order.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .orders-container {
            padding: 50px 0;
            background: #f8f9fa;
            margin-left: 200px;
            width: calc(100% - 200px);
            min-height: calc(100vh - 85px);
        }
        
        .orders-title {
            text-align: center;
            color: #333;
            margin-top: 50px;
            margin-bottom: 40px;
            font-size: 2.5em;
        }
        
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .order-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            top: 0;
            border: 1px solid transparent;
        }
        
        .order-card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            top: -5px;
            border-color: #f0f0f0;
        }
        
        .order-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        
        .order-id {
            color: #6D5DFB;
            font-weight: bold;
            font-size: 1.2em;
        }
        
        .order-date {
            color: #666;
            font-size: 0.9em;
        }
        
        .order-details {
            margin-bottom: 15px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #444;
        }
        
        .order-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .status-ordered {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .status-delivered {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .payment-id {
            font-size: 0.8em;
            color: #666;
            margin-top: 10px;
        }
        
        .total-amount {
            font-size: 1.2em;
            font-weight: bold;
            color: #2e7d32;
            margin-top: 15px;
            text-align: right;
        }
        
        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            width: 200px;
            height: calc(100vh - 85px);
            background: #3b141c;
            left: 0;
            top: 85px;
            z-index: 999;
            transition: all 0.3s ease;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        .sidebar ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .sidebar ul li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar ul li a {
            color: #fff;
            display: block;
            text-decoration: none;
            transition: 0.3s;
            padding: 15px;
        }
        
        .sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar ul li a:hover {
            color: #f3961c;
            padding-left: 20px;
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 95px;
            left: 15px;
            background: #3b141c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            z-index: 1000;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        /* Responsive Media Queries */
        @media screen and (max-width: 1024px) {
            .orders-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
            }
        }
        
        @media screen and (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .sidebar {
                left: -250px;
                width: 250px;
            }
            
            .sidebar.active {
                left: 0;
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
            }
            
            .orders-container {
                margin-left: 0;
                width: 100%;
                padding: 70px 15px 30px;
            }
            
            .orders-title {
                font-size: 2em;
                margin-bottom: 25px;
            }
            
            .orders-grid {
                grid-template-columns: 1fr;
                padding: 10px 0;
            }
            
            .order-card {
                margin-bottom: 15px;
            }
            
            /* Improve tap targets for mobile */
            .sidebar ul li a {
                padding: 15px;
                min-height: 44px;
                display: flex;
                align-items: center;
            }
        }
        
        @media screen and (max-width: 480px) {
            .orders-title {
                font-size: 1.5em;
                margin-bottom: 20px;
            }
            
            .order-item {
                flex-direction: column;
                gap: 5px;
                border-bottom: 1px dashed #eee;
                padding-bottom: 8px;
            }
            
            .order-item:last-child {
                border-bottom: none;
            }
            
            .order-card {
                padding: 15px;
            }
            
            .mobile-menu-toggle {
                top: 90px;
                padding: 8px 10px;
                left: 10px;
            }
            
            .order-id {
                font-size: 1.1em;
            }
            
            .total-amount {
                font-size: 1.1em;
            }
            
            .order-status {
                padding: 4px 12px;
                font-size: 0.85em;
            }
        }
        
        /* Overlay for sidebar when it's active on mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 998;
        }
        
        @media screen and (max-width: 768px) {
            .sidebar-overlay.active {
                display: block;
            }
        }
        
        /* Empty orders message */
        .no-orders {
            text-align: center;
            padding: 50px 20px;
            font-size: 1.2em;
            color: #666;
        }
    </style>
</head>
<body>
<?php include("partial/order-navigationbar.php"); ?>

<!-- Mobile menu toggle button -->
<button class="mobile-menu-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i> Menu
</button>

<!-- Sidebar overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <ul>
        <li><a href="olduser.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="profile.php"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
        <li><a href="my-orders.php"><i class="fas fa-shopping-cart"></i> My Orders</a></li>
        <li><a href="help.php"><i class="fas fa-question-circle"></i> Help</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<section class="orders-container">
    <h1 class="orders-title">My Orders</h1>
    
    <?php if($has_orders): ?>
    <div class="orders-grid">
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
            <div class="order-card">
                <div class="order-header">
                    <div class="order-id">Order #<?php echo $row['id']; ?></div>
                    <div class="order-date"><?php echo date('M d, Y H:i', strtotime($row['order_date'])); ?></div>
                </div>
                <div class="order-details">
                    <div class="order-item">
                        <span>Food Item:</span>
                        <span><?php echo htmlspecialchars($row['food']); ?></span>
                    </div>
                    <div class="order-item">
                        <span>Price:</span>
                        <span>₹<?php echo $row['price']; ?></span>
                    </div>
                    <div class="order-item">
                        <span>Quantity:</span>
                        <span><?php echo $row['qty']; ?></span>
                    </div>
                </div>
                <div class="total-amount">
                    Total: ₹<?php echo $row['total']; ?>
                </div>
                <div class="order-status <?php echo strtolower($row['status']) == 'delivered' ? 'status-delivered' : 'status-ordered'; ?>">
                    <?php echo $row['status']; ?>
                </div>
                <div class="payment-id">
                    Payment ID: <?php echo $row['payment_id']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php else: ?>
    <div class="no-orders">
        <p>You don't have any orders yet. <a href="foods.php">Browse our menu</a> to place your first order!</p>
    </div>
    <?php endif; ?>
</section>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');
        
        // Toggle sidebar when button is clicked
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        // Close sidebar when clicking outside
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    });
</script>
</body>
</html>
