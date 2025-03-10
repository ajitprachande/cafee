    <!-- menu section start -->
   <div class="menu text-center">
      <div class="wrapper">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">category</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Order</a></li>


          </ul>
      </div>  
    </div>
    <!-- menu section end -->
    /* CSS for Menu */
.menu{
    border: 1px solid gray;
}
.menu ul{
    list-style-type: none;
}

.menu ul li{
    display: inline;
    padding: 1%;

}
.menu ul li a{
    text-decoration: none;
    font-weight: bold;
    color: #ff6b81;
}
.menu ul li a:hover{
    color: #ff4757;
}

          <!-- footer section start -->
          <div class="footer">
            <div class="wrapper">
                <p class="text-center">2025 All reserved, <a href="#">Bachelore's cafee</a> </p>
            
            </div>
        </div>
            <!-- footer section end -->
/* footer css code */
.footer{
    background-color: black;
    color: aliceblue;

}
edited on style.css line {530}



footer css code main pagefooter {
    background: #1b1b1b;
    color: var(--white-color);
    padding: 60px 20px;
}

.footer_section {
    display: flex;
    justify-content: space-between;
}

.footer_section h3 {
    font-size: 22px;
    margin-bottom: 16px;
    font-weight: 600;
}

.footer_section .footer_logo a {
    display: flex;
    gap: 15px;
    align-items: center;
    color: var(--white-color);
}

.footer_section .footer_logo a img {
    max-width: 55px;
}

.footer_section .footer_logo a h2 {
    font-weight: 600;
}

.footer_section .useful_links ul li {
    margin: 20px 0;
}

.footer_section .useful_links ul li a {
    color: var(--white-color);
    font-size: 20px;
}

.footer_section .useful_links ul li a:hover {
    text-decoration: none;
    color: var(--primary-color);
    background-color: var(--secondary-color);
}

.footer_section .contact_us ul li {
    margin: 20px 0;
    display: flex;
    align-items: center;
    gap: 20px;
}

.footer_section .contact_us ul li i {
    font-size: 25px;
}
.footer_section .contact_us ul li i:hover{
    color: var(--secondary-color);
}

.footer_section .contact_us ul li span {
    font-size: 17px;
}

.footer_section .follow_us i {
    font-size: 26px;
    margin-right: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.footer_section .follow_us i:hover {
    color: var(--secondary-color);
}

<!-- footer css code -->
/* Footer Styles */
footer {
    background: #1b1b1b;
    color: white;
    padding: 60px 20px;
    font-family: 'Poppins', sans-serif;
}

/* Footer Container */
.section_container {
    max-width: 1200px;
    margin: auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
}

/* Footer Sections */
.footer_section {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 100%;
}

/* Logo Section */
.footer_logo {
    flex: 1;
    text-align: left;
    min-width: 200px;
}

.footer_logo a {
    display: flex;
    align-items: center;
    gap: 15px;
    text-decoration: none;
    color: white;
}

.footer_logo img {
    max-width: 60px;
    border-radius: 10px;
}

.footer_logo h2 {
    font-size: 24px;
    font-weight: 700;
    color: #f1c40f;
}

/* Useful Links */
.useful_links, .contact_us {
    flex: 1;
    min-width: 200px;
}

.useful_links h3, .contact_us h3, .follow_us h3 {
    font-size: 20px;
    margin-bottom: 16px;
    font-weight: 700;
    text-transform: uppercase;
    color: #f1c40f;
}

.useful_links ul, .contact_us ul {
    list-style: none;
    padding: 0;
}

.useful_links ul li, .contact_us ul li {
    margin-bottom: 10px;
}

.useful_links ul li a {
    color: white;
    font-size: 18px;
    text-decoration: none;
    transition: 0.3s;
    display: block;
    padding: 5px 0;
}

.useful_links ul li a:hover {
    color: #f1c40f;
    text-decoration: underline;
}

/* Contact Information */
.contact_us ul li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 17px;
}

.contact_us ul li i {
    font-size: 22px;
    color: #f1c40f;
}

.contact_us ul li i:hover {
    color: #e67e22;
}

/* Social Media Icons */
.follow_us {
    margin-top: 20px;
}

.follow_us a {
    margin: 0 10px;
    font-size: 24px;
    color: white;
    transition: 0.3s;
}

.follow_us a:hover {
    color: #f1c40f;
    transform: scale(1.1);
}

/* Footer Bottom */
.footer_bottom {
    text-align: center;
    margin-top: 40px;
    font-size: 14px;
    color: #ccc;
}

/* Responsive Footer */
@media (max-width: 768px) {
    .section_container {
        flex-direction: column;
        text-align: center;
    }
  
    .footer_logo, .useful_links, .contact_us {
        text-align: center;
        margin-bottom: 20px;
    }
  
    .follow_us {
        display: flex;
        justify-content: center;
    }
}
