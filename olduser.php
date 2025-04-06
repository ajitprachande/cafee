<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login_number'])) {
    // If not logged in, redirect to index
    header("Location: index.php");
    exit();
}

// Include functions
include("lib/function.php");
$db = new db_functions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="images/cofffee_image.png">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Bachelore's Cafee |</title>
    <link rel="stylesheet" href="css/style-order.css">
    <style>
        /* Sidebar and layout styling */
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .main-content {
            background: #f8f9fa;
            margin-left: 200px;
            width: calc(100% - 200px);
            min-height: calc(100vh - 85px);
            padding: 40px;
        }
        
        .main-content h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2.2em;
        }
        
        .main-content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
            max-width: 800px;
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
            
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 70px 15px 30px;
            }
            
            .main-content h1 {
                font-size: 1.8em;
            }
            
            /* Improve tap targets for mobile */
            .sidebar ul li a {
                padding: 15px;
                min-height: 44px;
                display: flex;
                align-items: center;
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

    <div class="main-content">
        <h1>Welcome to Your Profile</h1>        
        <p>Manage your details and track your orders here.</p>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['login_number']); ?>!</p>
    </div>

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
