<?php
ob_start();

session_start(); // Start the session at the beginning
if (!isset($_SESSION['login_number'])){
    header("Location: index.php");
}

//include("config/constants.php"); // Ensure database connection
include("partial/order-navigationbar.php");

// Check if food_id is provided and valid
if (isset($_GET['food_id'])) {
    $food_id = intval($_GET['food_id']); // Ensure it's an integer

    // Get food details
    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header("location: index.php"); // Redirect if food not found
        exit();
    }
} else {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food</title>
    <link rel="stylesheet" href="css/style-order.css">
    <style>
        /* Responsive styles for order page */
        .food-search {
            background-image: url(images/bg.jpg);
            background-size: cover;
            background-position: center;
            padding: 5% 0;
            min-height: auto;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-white {
            color: white;
        }
        
        .order {
            width: 90%;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        }
        
        fieldset {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: white;
        }
        
        legend {
            font-weight: bold;
            font-size: 1.3rem;
            padding: 0 10px;
            color: #333;
        }
        
        .food-menu-img {
            width: 35%;
            float: left;
        }
        
        .food-menu-img img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .food-menu-desc {
            width: 60%;
            float: left;
            margin-left: 5%;
        }
        
        .food-menu-desc h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .food-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #f3961c;
            margin: 10px 0;
        }
        
        .order-label {
            font-weight: bold;
            margin: 15px 0 5px;
            display: block;
            color: #333;
        }
        
        .input-responsive {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .btn-payment {
            background: linear-gradient(135deg, #6D5DFB, #4B3BF5);
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: block;
            width: 100%;
            margin-top: 20px;
            font-weight: bold;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(75, 59, 245, 0.3);
        }
        
        .btn-payment:hover {
            background: linear-gradient(135deg, #4B3BF5, #6D5DFB);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(75, 59, 245, 0.4);
        }
        
        .btn-payment:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(75, 59, 245, 0.4);
        }
        
        .fail_msg {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            background-color: #ffeded;
            color: #d32f2f;
        }
        
        /* Media queries for responsive design */
        @media screen and (max-width: 1024px) {
            .order {
                width: 95%;
                padding: 20px;
            }
            
            .food-search h2 {
                font-size: 2rem;
            }
        }
        
        @media screen and (max-width: 768px) {
            .food-search {
                padding: 40px 0;
            }
            
            .food-search h2 {
                font-size: 1.8rem;
                padding-bottom: 20px;
            }
            
            .order {
                width: 100%;
                padding: 15px;
            }
            
            fieldset {
                padding: 15px;
            }
            
            legend {
                font-size: 1.2rem;
            }
        }
        
        @media screen and (max-width: 576px) {
            .food-search h2 {
                font-size: 1.5rem;
                padding-bottom: 15px;
            }
            
            .food-menu-img, .food-menu-desc {
                width: 100%;
                float: none;
                margin: 0 0 15px 0;
                text-align: center;
            }
            
            .food-menu-img img {
                max-width: 200px;
                margin: 0 auto;
                display: block;
            }
            
            .food-menu-desc h3 {
                font-size: 1.3rem;
                text-align: center;
            }
            
            .food-price {
                text-align: center;
                font-size: 1.2rem;
            }
            
            fieldset {
                padding: 12px;
            }
            
            legend {
                font-size: 1.1rem;
            }
            
            .order-label {
                font-size: 0.95rem;
            }
            
            .input-responsive {
                padding: 10px;
                font-size: 0.95rem;
            }
            
            .btn-payment {
                padding: 12px 20px;
                font-size: 1rem;
            }
        }
        
        @media screen and (max-width: 400px) {
            .food-search h2 {
                font-size: 1.3rem;
                padding-bottom: 10px;
            }
            
            .food-menu-desc h3 {
                font-size: 1.2rem;
            }
            
            .food-price {
                font-size: 1.1rem;
            }
            
            .order-label {
                font-size: 0.9rem;
            }
            
            .input-responsive {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <?php //echo htmlspecialchars($_SESSION['login_number']); ?>

        <form id="orderForm" class="order">
    <fieldset>
        <legend>Selected Food</legend>

        <div class="food-menu-img">
            <?php if ($image_name == "") { ?>
                <div class="fail_msg">Image Not Available.</div>
            <?php } else { ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" 
                    alt="<?php echo htmlspecialchars($title); ?>" 
                    class="img-responsive img-curve">
            <?php } ?>
        </div>

        <div class="food-menu-desc">
            <h3><?php echo $title; ?></h3>
            <input type="hidden" name="food" value="<?php echo htmlspecialchars($title); ?>">
            <p class="food-price">₹<?php echo $price; ?></p>
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
            
            <div class="order-label">Quantity</div>
            <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
        </div>
        <div style="clear: both;"></div>
    </fieldset>

    <fieldset>
        <legend>Delivery Details</legend>
        <div class="order-label">Full Name</div>
        <input type="text" name="customer_name" placeholder="Enter your full name" class="input-responsive" required>

        <div class="order-label">Phone Number</div>
        <input type="tel" name="customer_contact" placeholder="Enter your phone number" class="input-responsive" required>

        <div class="order-label">Email</div>
        <input type="email" name="customer_email" placeholder="Enter your email" class="input-responsive" required>

        <div class="order-label">Address</div>
        <textarea name="customer_address" rows="5" placeholder="Enter your delivery address" class="input-responsive" required></textarea>

        <input type="hidden" name="status" value="Ordered">
        <input type="hidden" name="order_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
        
        <input type="hidden" name="customer_login_no" value="<?php echo htmlspecialchars($_SESSION['login_number']); ?>">


        <!-- Confirm Order Button (Replaced with Razorpay Payment) -->
        <button type="button" id="rzp-button1" class="btn-payment">Pay Now</button>
    </fieldset>
</form>

     </div>
</section>

<?php include("partial/footeredit.php");?>

        <!-- Razorpay Checkout Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('rzp-button1').onclick = function(e) {
    // Form validation
    const form = document.getElementById('orderForm');
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#ff3e3e';
            isValid = false;
        } else {
            input.style.borderColor = '#ddd';
        }
    });
    
    if (!isValid) {
        alert('Please fill all required fields');
        return;
    }

    e.preventDefault(); // Prevent form submission

    var fullName = document.querySelector("input[name='customer_name']").value;
    var email = document.querySelector("input[name='customer_email']").value;
    var contact = document.querySelector("input[name='customer_contact']").value;
    var address = document.querySelector("textarea[name='customer_address']").value;
    var food = document.querySelector("input[name='food']").value;
    var price = document.querySelector("input[name='price']").value;
    var qty = document.querySelector("input[name='qty']").value;
    var customerLoginNo = document.querySelector("input[name='customer_login_no']").value; // New fiel
    var total = price * qty; // Calculate total price

    var options = {
        "key": "rzp_test_TpvzlvEgINGWPh", // Your Razorpay test key
        "amount": total * 100, // Convert INR to paisa
        "currency": "INR",
        "name": "Bachelor's Cafe",
        "description": "Order Payment",
        "handler": function (response) {
            var paymentID = response.razorpay_payment_id;
            
            // Show loading indicator
            const button = document.getElementById('rzp-button1');
            button.disabled = true;
            button.textContent = 'Processing...';
            
            // Send order details to process-order.php using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process-order.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Payment Successful. Order Placed!");
                    window.location.href = "index.php"; // Redirect to success page
                } else if (xhr.readyState === 4) {
                    button.disabled = false;
                    button.textContent = 'Pay Now';
                    alert("An error occurred. Please try again.");
                }
            };
            // Send order details to process-order.php using AJAX
            xhr.send("food=" + encodeURIComponent(food) + 
                "&price=" + encodeURIComponent(price) + 
                "&qty=" + encodeURIComponent(qty) + 
                "&total=" + encodeURIComponent(total) +
                "&order_date=<?php echo date('Y-m-d H:i:s'); ?>" + 
                "&status=Ordered&customer_name=" + encodeURIComponent(fullName) +
                "&customer_contact=" + encodeURIComponent(contact) + 
                "&customer_email=" + encodeURIComponent(email) +
                "&customer_address=" + encodeURIComponent(address) + 
                "&payment_id=" + encodeURIComponent(paymentID) + 
                "&customer_login_no=" + encodeURIComponent(customerLoginNo));
        },
        "prefill": {
            "name": fullName,
            "email": email,
            "contact": contact
        },
        "theme": {
            "color": "#6D5DFB"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
};

// Add touch-friendly interaction for mobile
document.addEventListener('DOMContentLoaded', function() {
    // Improve input field focus on mobile
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 0 2px rgba(109, 93, 251, 0.3)';
        });
        
        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });
    
    // Fix for iOS devices to ensure proper scrolling on focus
    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
        document.querySelector('.food-search').style.minHeight = 'auto';
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                setTimeout(() => {
                    window.scrollTo(0, this.getBoundingClientRect().top + window.pageYOffset - 100);
                }, 300);
            });
        });
    }
});
</script>
</body>
</html>
<?php ob_end_flush(); ?>
