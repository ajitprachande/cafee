<?php include("partial/menu.php");?>
<!-- below config file coment  -->
<?php //include("config/constants.php") ;?>

<?php
session_start(); // Start the session at the beginning
if (!isset($_SESSION['login_number'])):
?>
<!-- Hero Section -->
<section class="hero_section">
  <div class="section_container">
    <div class="hero_container">
      <div class="text_section">
        <h2 class="typewriter">Fuel Your Passion</h2>
        <h3>Discover the Magic in Every Cup</h3>
        <p>
          Welcome to our coffee paradise, where every bean tells a story and
          every cup sparks.
        </p>

        <div class="hero_section_button">
          <a href="login.php" class="button">Log In</a>
          <a href="contact.php" class="button">Contact</a>
        </div>
      </div>
      <div class="image_section">
      <img src="./images/cofffee_image.png" alt="Coffee" />
      </div>
    </div>
  </div>
</section>
<?php
else:
  include("partial/order-navigationbar.php");
?>
<section class="hero_section">
  <div class="section_container">
    <div class="hero_container">
      <div class="text_section">
        <div class="logout" style="font-size: 30px; color: var(--secondary-color); margin-bottom:50px;">
          Welcome: <?php echo htmlspecialchars($_SESSION['login_number']); ?>
        </div>
        <h2 class="typewriter">Fuel Your Passion</h2>
        <h3>Discover the Magic in Every Cup</h3>
        <p>
          Welcome to our coffee paradise, where every bean tells a story and
          every cup sparks.
        </p>

        <div class="hero_section_button">
        
          <a href="index.php?logout" class="button">Logout</a>
          <?php

            if (isset($_GET['logout'])) {
                // Unset the login session variable
                unset($_SESSION['login_number']);
                
                // Optionally destroy the entire session
                session_destroy();
                
                // Redirect to the login page (or any page you want)
                header("Location: index.php");
                exit();
            }
          ?>
                  <!-- The Logout link on your page -->
         </div>
      </div>

      <div class="image_section">
        <img src="./images/cofffee_image.png" alt="Coffee" />
      </div>
    </div>
  </div>
</section>
<?php
endif;
?> 
    <!-- Live Chat Button -->
<div id="chat-button" onclick="toggleChat()">
  <i class="bx bx-message-rounded-dots"></i>
</div>

<!-- Chatbox -->
<div id="chat-container" class="hidden">
  <div id="chat-header">
    <h3>Live Chat</h3>
    <button onclick="toggleChat()">✖</button>
  </div>
  <div id="chat-body">
    <div id="chat-messages"></div>
  </div>
  <div id="chat-footer">
    <input type="text" id="chat-input" placeholder="Type a message..." onkeypress="handleKeyPress(event)"/>
    <button onclick="sendMessage()">Send</button>
  </div>
</div>
    <!-- Footer Section start -->
<!-- footer section end -->
<!-- chat bot script code start -->
 <script>
    // Toggle Chatbox with Smooth Animation
function toggleChat() {
  const chatContainer = document.getElementById("chat-container");
  
  if (chatContainer.classList.contains("show")) {
    chatContainer.classList.remove("show");
    setTimeout(() => chatContainer.style.display = "none", 300);
  } else {
    chatContainer.style.display = "flex";
    setTimeout(() => chatContainer.classList.add("show"), 10);
  }
}

// Send Message when Clicking Send Button
function sendMessage() {
  let inputField = document.getElementById("chat-input");
  let message = inputField.value.trim();

  if (message === "") return;

  // Display user message
  appendMessage("user-message", message);

  // Generate bot response
  setTimeout(() => {
    let botResponse = getBotResponse(message);
    appendMessage("bot-message", botResponse);
  }, 1000);

  inputField.value = "";
}

// Allow Sending Message with "Enter" Key
function handleKeyPress(event) {
  if (event.key === "Enter") {
    sendMessage();
  }
}

// Append Message to Chatbox
function appendMessage(className, text) {
  let messageDiv = document.createElement("div");
  messageDiv.classList.add("chat-message", className);
  messageDiv.innerText = text;

  document.getElementById("chat-messages").appendChild(messageDiv);

  // Auto-scroll to bottom
  let chatBody = document.getElementById("chat-body");
  chatBody.scrollTop = chatBody.scrollHeight;
}

// Simple Bot Response Logic
// Simple Bot Response Logic
// Advanced Bot Response Logic
function getBotResponse(input) {
  input = input.toLowerCase().trim(); // Convert input to lowercase & remove extra spaces

  // Define keyword-response pairs
  const responses = [
    { keywords: ["hello", "hi", "hey"], response: "Hello! How can I assist you today?" },
    { keywords: ["menu", "what's on the menu"], response: "Our menu includes a variety of hot beverages, fresh pastries, and snacks. Check out our full menu on the 'Services' page!" },
    { keywords: ["speciality", "special", "what's the speciality"], response: "Our cafe specializes in freshly brewed coffee and our signature 'Bachelors' Special Sandwich'!" },
    { keywords: ["veg menu", "vegetarian menu"], response: "Our vegetarian menu includes delicious options like Veg Paneer Sandwich, Veggie Wrap, and the Veggie Delight Salad!" },
    { keywords: ["non-veg menu", "non vegetarian menu"], response: "Our non-vegetarian menu features dishes like Grilled Chicken Sandwich, Chicken Wrap, and Spicy Chicken Wings!" },
    { keywords: ["location", "address", "where are you"], response: "We are located at Aasra, Solapur. You can easily find us near the main market!" },
    { keywords: ["services"], response: "We offer dine-in, takeout, and delivery. Check out our full range of services on the 'Services' page!" }
  ];

  // Specific food item descriptions
  const foodDescriptions = {
    "veg paneer sandwich": "The Veg Paneer Sandwich is made with freshly grilled bread, creamy paneer, mixed veggies, and tangy sauces!",
    "grilled chicken sandwich": "Our Grilled Chicken Sandwich is packed with juicy grilled chicken, fresh veggies, and a smoky sauce, all between two toasted buns!",
    "bachelors special sandwich": "The Bachelors' Special Sandwich is a unique blend of spicy grilled chicken, creamy avocado, and our signature sauce!"
  };

  // Check for general responses
  for (let item of responses) {
    if (item.keywords.some(keyword => input.includes(keyword))) {
      return item.response;
    }
  }

  // Check for specific food descriptions
  for (let food in foodDescriptions) {
    if (input.includes(food)) {
      return foodDescriptions[food];
    }
  }

  // Fallback Response
  return "I'm here to help! Please ask me about our cafe, menu, services, or specialties.";
}
 </script> 
<!-- chat bot script code end -->
      
<!-- Navbar Section Starts Here -->
       <link rel="stylesheet" href="css/style-order.css">
       <section class="navbar">
        <div class="container">
           <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     <!-- below php code order success or fail msg -->
    <?php 
        if(isset($_SESSION['order']))
        {
          echo $_SESSION['order'];
          unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->   
 <?php 
//session_start(); // Ensure session is started at the top of the file
?>
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php 
            // Create SQL query to display categories from the database
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);

            // Count rows to check whether category is available or not
            $count = mysqli_num_rows($res);

            if($count > 0) {
                // Category available
                while($row = mysqli_fetch_assoc($res)) {
                    // Get values like id, title, and image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <!-- 
                      The anchor tag's href is conditionally set:
                      If the user is not logged in (i.e., $_SESSION['login_number'] is not set),
                      the link will direct to login.php.
                      Otherwise, it will direct to category-foods.php with the specific category_id.
                    -->
                    <a href="<?php echo (!isset($_SESSION['login_number'])) ? SITEURL . 'login.php' : SITEURL . 'category-foods.php?category_id=' . $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                // Check whether image is available or not
                                if($image_name == "") {
                                    echo "<div class='fail_msg'>Image Not Available.</div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php 
                }
            } else {
                // Category not available
                echo "<div class='fail_msg'>Category Not Added.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
    <!-- Categories Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
            // Getting food from the database that are active and featured
            $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0) {
                while($row = mysqli_fetch_assoc($res2)) {
                    // Retrieve values from the database
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name == "") {
                                    // Image not available
                                    echo "<div class='fail_msg'>Image Not Available.</div>";
                                } else {
                                    // Image is available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>  
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <!-- 
                              Conditionally set the link based on the user's login status:
                              If not logged in, direct to login.php, otherwise to order.php with food_id.
                            -->
                            <a href="<?php echo (!isset($_SESSION['login_number'])) ? SITEURL . 'login.php' : SITEURL . 'order.php?food_id=' . $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                // Food not available
                echo "<div class='fail_msg'>Food Not Available.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="foods.php">See All Foods</a> 
    </p>
</section>

    <!-- fOOD Menu Section Ends Here -->

  </body>
</html>

<?php include("partial/footeredit.php");?>
