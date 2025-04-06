<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="images/cofffee_image.png">
  <meta charset="UTF-8">
  <title>Help - Bachelores Cafe</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Base reset and body styling */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(135deg, #fdfbfb, #ebedee);
      color: #333;
      line-height: 1.6;
    }
    /* Header styling with background and animation */
    header {
      background: url('https://via.placeholder.com/1500x400?text=Bachelores+Cafe') no-repeat center center/cover;
      height: 150px;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    header:hover::after {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      /* background: rgba(0, 0, 0, 0.5); */
    }
    header h1 {
      position: relative;
      font-size: 3.5em;
      color: #fff;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
      animation: fadeInDown 1.5s ease-out;
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-50px); }
      to { opacity: 1; transform: translateY(0); }
    }
    /* Main container with slide-up animation */
    .help-container {
      max-width: 1100px;
      margin: 30px auto;
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      animation: slideUp 1s ease-out;
    }
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .help-section {
      margin-bottom: 40px;
    }
    .help-section h2 {
      color: #2c3e50;
      border-bottom: 3px solid #e74c3c;
      padding-bottom: 10px;
      margin-bottom: 20px;
      font-size: 2em;
      display: flex;
      align-items: center;
    }
    .help-section h2:hover{
        color: #3b141c;
    }
    /* Icon styling with hover animation */
    .help-section h2 .icon {
      margin-right: 15px;
      transition: transform 0.4s ease;
    }
    .help-section h2 .icon:hover {
      transform: scale(1.3) rotate(20deg);
    }
    .help-section p, .help-section li {
      font-size: 1.1em;
      margin-bottom: 15px;
    }
    /* FAQ list styling */
    .faq-list {
      list-style: none;
    }
    .faq-list li {
      margin-bottom: 20px;
      padding: 15px;
      background: #f9f9f9;
      border-left: 5px solid #e74c3c;
      border-radius: 5px;
      transition: background 0.3s ease;
    }
    .faq-list li:hover {
      background: #f1f1f1;
    }
    /* Experienced Chef section styling */
    .chef-section {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
    }
    .chef-section img {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      transition: transform 0.4s ease;
    }
    .chef-section img:hover {
      transform: scale(1.05);
    }
    .chef-details {
      flex: 1;
      margin-left: 30px;
    }
    /* Contact section styling */
    .contact-info {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin-top: 20px;
    }
    .contact-info div {
      flex: 1;
      min-width: 250px;
      margin: 10px;
      text-align: center;
      transition: transform 0.3s ease;
    }
    .contact-info div:hover {
      transform: translateY(-5px);
    }
    .contact-info i {
      font-size: 2.5em;
      margin-bottom: 10px;
      color: #e74c3c;
      transition: transform 0.4s ease;
    }
    .contact-info i:hover {
      transform: scale(1.2) rotate(360deg);
    }
    /* Footer styling */
    footer {
      text-align: center;
      padding: 20px;
      background: #2c3e50;
      color: #fff;
      margin-top: 40px;
    }
    /* Responsive design for smaller screens */
    @media (max-width: 768px) {
      .chef-section {
        flex-direction: column;
      }
      .chef-details {
        margin-left: 0;
        margin-top: 20px;
      }
      header h1 {
        font-size: 2.5em;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Help & Support</h1>
  </header>
  <div class="help-container">
    <!-- About Section -->
    <div class="help-section">
      <h2><i class="fas fa-info-circle icon"></i>About Bachelores Cafe</h2>
      <p>Welcome to Bachelores Cafe, your cozy haven for delicious coffee, delightful food, and a friendly atmosphere. We cater to students, professionals, and anyone looking for a comfortable space to relax or work.</p>
    </div>
    <!-- Frequently Asked Questions Section -->
    <div class="help-section">
      <h2><i class="fas fa-question-circle icon"></i>Frequently Asked Questions</h2>
      <ul class="faq-list">
        <li>
          <strong>Q: What are your opening hours?</strong>
          <p>A: We are open from 7 AM to 10 PM daily.</p>
        </li>
        <li>
          <strong>Q: Do you offer free Wi-Fi?</strong>
          <p>A: Yes, we provide complimentary Wi-Fi for all our guests.</p>
        </li>
        <li>
          <strong>Q: Can I book a table in advance?</strong>
          <p>A: Absolutely! You can reserve your table by calling or emailing us.</p>
        </li>
        <li>
          <strong>Q: Are there vegan or gluten-free options?</strong>
          <p>A: Yes, our diverse menu includes several options for various dietary needs.</p>
        </li>
      </ul>
    </div>
    <!-- Experienced Chef Section -->
    <div class="help-section">
      <h2><i class="fas fa-user-tie icon"></i>Meet Our Experienced Chef</h2>
      <div class="chef-section">
        <img src="images/chef1.jpg" alt="Our Chef">
        <div class="chef-details">
          <p>Our head chef, Alyssa Healy, brings over 15 years of culinary expertise to the cafe. Trained in world-class kitchens, Chef John combines traditional techniques with modern flavors to create unique dishes that delight our customers.</p>
          <p>His passion for food is evident in every plate, ensuring that every meal at Bachelores Cafe is a memorable experience.</p>
        </div>
      </div>
      <div class="chef-section">
        <img src="images/chef2.jpg" alt="Our Chef">
        <div class="chef-details">
          <p>Our Co-head chef, Rajesh Sharma, brings over 18 years of culinary expertise to the cafe. At Bachelores Cafe, he delights patrons with dishes that celebrate India's culinary heritage, from aromatic curries to inventive street food-inspired creations..</p>
        </div>
      </div>
    </div>
    <!-- Contact Section -->
    <div class="help-section">
      <h2><i class="fas fa-phone-alt icon"></i>Contact Us</h2>
      <div class="contact-info">
        <div>
          <i class="fas fa-phone"></i>
          <p>+91 9579489585</p>
        </div>
        <div>
          <i class="fas fa-envelope"></i>
          <p>bachelorescafe@lovestoblog.com</p>
        </div>
        <div>
          <i class="fas fa-map-marker-alt"></i>
          <p>123 Cafe Street,<br> City, Country</p>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <p>&copy; 2025 Bachelores Cafe. All rights reserved.</p>
  </footer>
</body>
</html>
