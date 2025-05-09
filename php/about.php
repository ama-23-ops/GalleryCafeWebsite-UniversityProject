<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | The Gallery Café</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>

        <!-----------Header start------------>
        <header>
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <p>The Gallery Café</p>
                    </div>
                    <nav>
                        <div class="clsBtn">
                            <i class="fas fa-times close-btn"></i>
                        </div>
        
                        <li><a href="homepage.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="reservation.php">Reservations</a></li>
        
                        <?php
                        session_start();
                        // Check if the user is logged in
                        if (isset($_SESSION['user_id'])) {
                            // If logged in, show "Profile" and "Logout"
                            echo '
                            <li><a href="customer_dashboard.php">Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>';
                        } else {
                            // If not logged in, show "Login"
                            echo '<li><a href="../php/login.php">Login</a></li>';
                        }
                        ?>
                    </nav>
                    <div class="menuBtn">
                        <i class="fas fa-bars menu-btn"></i>
                    </div>
                </div>
            </div>
        </header>
        
        <!-----------Header close------------>

    <!-- Hero Section -->
    <section id="hero-about">
        <div class="hero-content">
            <h1>Where every bite tells a story of flavor and passion</h1>
            <p>About Us</p>
        </div>
    </section>

    <!-----------Intro Start------------>
    <div class="intro">
        <div class="container">
           <div class="row">
              <!-- First Image Column -->
              <div class="col-xl-4 col-md-6 intro_col">
                 <div class="intro_image1">
                    <img src="../img/intro_1.jpg" alt="Intro Image 1">
                 </div>
              </div>
              <!-- Second Image Column -->
              <div class="col-xl-4 col-md-6 intro_col">
                 <div class="intro_image2">
                    <img src="../img/intro_2.jpg" alt="Intro Image 2">
                 </div>
              </div>
              <!-- Content Box Column -->
              <div class="col-xl-4 col-md-6 intro_content">
                 <div class="intro_subtitle">Discover more</div>
                 <div class="intro_title">
                    <h2>About Us</h2>
                 </div>
                 <div class="intro_text">
                    <p>Welcome to The Gallery Café in Colombo! Enjoy a cozy atmosphere and a menu of fresh, delicious 
                       dishes from around the world. Whether for a quick coffee or a special meal, we're here to make 
                       your visit memorable.
                    </p>
                 </div>
              </div>
           </div>
        </div>
     </div>
    <!-----------Intro close------------>

    <!-- Chef Section -->
    <div class="chef-section">
        <h2 class="title_chef">Meet Our Chefs</h2>
        <div class="chef-grid-wrapper">
            <div class="chef-grid">
               <!-- Chef 1 -->
                <div class="chef-card">
                    <div class="chef-image">
                       <img src="../img/chef-3.jpg" alt="Chef John Doe">
                    </div>
                    <div class="chef-info">
                      <h3>Chef John Doe</h3>
                      <p>Executive Chef</p>
                      <p>Chef John brings over 20 years of culinary experience to The Gallery Café. Known for his innovation and dedication to perfection, he creates mouth-watering dishes using the finest ingredients from around the world.</p>
                    <div class="chef-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <!-- Chef 2 -->
            <div class="chef-card">
                <div class="chef-image">
                    <img src="../img/chef-4.jpg" alt="Chef Maria Lopez">
                </div>
                <div class="chef-info">
                    <h3>Chef Maria Lopez</h3>
                    <p>Pastry Chef</p>
                    <p>With a passion for desserts, Maria creates visually stunning and delicious pastries that are loved by all. Her secret lies in the perfect balance of flavors and textures.</p>
                    <div class="chef-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <!-- Chef 3 -->
            <div class="chef-card">
                <div class="chef-image">
                    <img src="../img/chef-2.jpg" alt="Chef Hiroshi Tanaka">
                </div>
                <div class="chef-info">
                    <h3>Chef Hiroshi Tanaka</h3>
                    <p>Sushi Specialist</p>
                    <p>Chef Hiroshi masters the art of sushi, blending traditional Japanese techniques with fresh, high-quality ingredients to create unforgettable sushi dishes.</p>
                    <div class="chef-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Customer Review Section -->
    <div class="review-section"> 
        <h2 class="section-title">Customer Reviews</h2>
        <div class="review-container">
            <div class="review-wrapper">
                <!-- Review 1 -->
                <div class="review-card">
                    <div class="customer-info">
                        <img src="../img/chef-2.jpg" alt="Customer 1" class="customer-image">
                        <div>
                            <h3 class="customer-name">John Doe</h3>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="review-text">
                        "Amazing experience! The food was delightful and the service top-notch. Highly recommend to everyone!"
                    </div>
                </div>
                
                <!-- Review 2 -->
                <div class="review-card">
                    <div class="customer-info">
                        <img src="../img/chef-3.jpg" alt="Customer 2" class="customer-image">
                        <div>
                            <h3 class="customer-name">Jane Smith</h3>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="review-text">
                        "Lovely ambiance and great food! A perfect place for a family dinner or a casual hangout."
                    </div>
                </div>
    
                <!-- Review 3 -->
                <div class="review-card">
                    <div class="customer-info">
                        <img src="../img/chef-4.jpg" alt="Customer 3" class="customer-image">
                        <div>
                            <h3 class="customer-name">Alice Brown</h3>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half"></i>
                            </div>
                        </div>
                    </div>
                    <div class="review-text">
                        "The food was great, but the service could have been a little faster. Overall, a good experience."
                    </div>
                </div>
    
                <!-- Review 4 -->
                <div class="review-card">
                    <div class="customer-info">
                        <img src="../img/chef-4.jpg" alt="Customer 4" class="customer-image">
                        <div>
                            <h3 class="customer-name">Robert Wilson</h3>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="review-text">
                        "Great flavors, cozy atmosphere, but the prices were a bit steep for the portion sizes."
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
        <!-----------Footer start------------>
        <footer class="footer">
            <div class="footer-container">
                <!-- About Section -->
                <div class="footer-about">
                    <h3>About The Gallery Café</h3>
                    <p>Located in the heart of Colombo, The Gallery Café offers a unique dining experience with a blend of delicious meals, art, and history. Join us for a meal and a memory.</p>
                </div>
        
                <!-- Navigation Links -->
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="homepage.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="reservation.php">Reservations</a></li>
                        <li><a href="login.php">Profiile</a></li>
                    </ul>
                </div>
        
                <!-- Contact Information -->
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>123 Main Street, Colombo</li>
                        <li>Email: info@gallerycafe.com</li>
                        <li>Phone: +94 11 123 4567</li>
                    </ul>
                </div>
        
                <!-- Social Media Links -->
                <div class="footer-social">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        
            <!-- Copyright Section -->
            <div class="footer-bottom">
                <p>&copy; 2024 The Gallery Café. All rights reserved.</p>
            </div>
        </footer>
        
        <!-----------Footer close------------>
            
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../js/srpt.js"></script>
</body>
</html>