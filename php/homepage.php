<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>The Gallery Café</title>
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


    <!-----------Hero start------------>
    <main>
        <article>
            <section class="hero text-center" aria-label="Home" id="home">
                <div class="swiper-container hero-slider" data-hero-slider>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slider-bg">
                                <img src="../img/b7.png" alt="hro" class="img-cover">
                            </div>
                            <p class="section-subtitle animate-fade-in">Welcome to The Gallery Café<br><br><br></p>
                            <h1 class="hero-title animate-fade-in">Discover Our Unique Flavors</h1>
                            <p class="hero-text animate-fade-in"><br><br>Indulge in a world of exquisite cuisine.</p>
                            <a href="reservation.php" class="btn-reservation">
                                <span class="text-1">Make a Reservation</span>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <div class="slider-bg">
                                <img src="../img/3(4).png" alt="hro" class="img-cover">
                            </div>
                            <p class="section-subtitle animate-fade-in">Welcome to The Gallery Café<br><br><br></p>
                            <h1 class="hero-title animate-fade-in">Experience Fine Dining</h1>
                            <p class="hero-text animate-fade-in"><br><br>Join us for an unforgettable culinary journey.</p>
                            <a href="reservation.php" class="btn-reservation">
                                <span class="text-1">Make a Reservation</span>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <div class="slider-bg">
                                <img src="../img/5(4).png" alt="hro" class="img-cover">
                            </div>
                            <p class="section-subtitle animate-fade-in">Welcome to The Gallery Café<br><br><br></p>
                            <h1 class="hero-title animate-fade-in">Experience Fine Dining</h1>
                            <p class="hero-text animate-fade-in"><br><br>Join us for an unforgettable culinary journey.</p>
                            <a href="reservation.php" class="btn-reservation">
                                <span class="text-1">Make a Reservation</span>
                            </a>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </section>
            </article>
    </main>
    <!-----------Hero close------------>
  
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
                 <a href="about.php" class="intro-btn">Learn More</a> 
              </div>
           </div>
        </div>
     </div>
    <!-----------Intro close------------>

    
    

    <!-----------Special food and beverages start------------>
    <section class="featured-menu">
        <h3 class="subtitle_1">Featured Dishes</h3>
        <h2 class="title_1">Discover Our Special food and beverages!</h2>
        <div class="card-container">
            <div class="card">
                <img src="../img/6(6).png" alt="Sri Lankan Chicken Kottu Roti" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Sri Lankan Chicken Kottu Roti</h3>
                    <p class="card-description">A flavorful stir-fried blend of chopped roti, chicken, and vegetables.
                    </p>
                    <p class="card-price">Rs1200.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/1(6).png" alt="Chinese Fried Rice with Prawns" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Chinese Fried Rice with Prawns</h3>
                    <p class="card-description">Stir-fried rice with prawns, vegetables, and a hint of soy sauce.</p>
                    <p class="card-price">Rs.2000.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/7(7).png" alt="Italian Risotto Alla Milanese" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Italian Risotto Alla Milanese</h3>
                    <p class="card-description">Creamy saffron-flavored risotto with Parmesan cheese.</p>
                    <p class="card-price">Rs.800.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/10(2).png" alt="Mexican Chicken Tacos" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Mexican Chicken Tacos</h3>
                    <p class="card-description">Soft tortillas filled with marinated chicken, fresh salsa, and guacamole.</p>
                    <p class="card-price">Rs.700.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/12(2).png" alt="Japanese Sushi Platter" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Japanese Sushi Platter</h3>
                    <p class="card-description">An assortment of sushi rolls and sashimi served with soy sauce, wasabi, and pickled ginger.</p>
                    <p class="card-price">Rs.800.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/14(1).png" alt="Indian Paneer Tikka Masala" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Indian Paneer Tikka Masala</h3>
                    <p class="card-description">Grilled paneer cubes cooked in a rich tomato and yogurt sauce, served with rice.</p>
                    <p class="card-price">Rs.1500.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/16(1).png" alt="Fresh Coconut Juice" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Fresh Coconut Juice</h3>
                    <p class="card-description">Chilled coconut water served straight from the fruit.</p>
                    <p class="card-price">Rs.500.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../img/17.png" alt="Espresso Martini" class="card-img">
                <div class="card-content">
                    <h3 class="card-title">Espresso Martini</h3>
                    <p class="card-description">A bold coffee-flavored cocktail, made with espresso and vodka.</p>
                    <p class="card-price">Rs.600.00</p>
                    <div class="card-buttons">
                        <a href="../php/menu.php" class="card-btn details-btn">View Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-----------Special food and beverages close------------>

    <!-----------Special promo start------------>
    <aside id="promo">
        <div class="container">
            <div class="tab-nav">
                <button class="tab-btn" onclick="openPromo(event, 'sriLankanCurry')">Sri Lankan Curry</button>
                <button class="tab-btn" onclick="openPromo(event, 'mexicanSalad')">Mexican Salad</button>
                <button class="tab-btn" onclick="openPromo(event, 'chineseSpringRolls')">Chinese Spring Rolls</button>
                <button class="tab-btn" onclick="openPromo(event, 'italianPasta')">Italian Pasta</button>
                <button class="tab-btn" onclick="openPromo(event, 'japaneseTempura')">Japanese Tempura</button>
                <button class="tab-btn" onclick="openPromo(event, 'indianButterChicken')">Indian Butter Chicken</button>
            </div>
    
            <!-- Sri Lankan Curry Promotion -->
            <div id="sriLankanCurry" class="tab-content" style="display:none;">
                <div class="promo_cards">
                    <div class="left_side_content">
                        <div class="img_of_left">
                            <img src="../img/15(1).png" alt="" />
                        </div>
                    </div>
                    <div class="right_side_content">
                        <h1>Special Promotion</h1>
                        <h2>Sri Lankan Curry</h2>
                        <p>A vibrant and aromatic dish, the Sri Lankan Curry is a celebration of spices. 
                            Slow-cooked with a combination of hand-ground spices like cumin, coriander, and turmeric, 
                            this curry brings together tender pieces of chicken or vegetables in a rich, creamy coconut 
                            milk base. The curry is served alongside fragrant basmati rice or traditional roti, offering 
                            a perfect balance of heat and flavor. With each bite, you’ll experience the authentic tastes 
                            of Sri Lankan cuisine, from its unique spice blends to its tropical influences. A must-try 
                            for those who crave bold and comforting dishes.</p>
                        <div class="price">
                            <p>Rs.1100</p>
                        </div>
                        <div class="promo_timer">
                            <p>Offer ends in: <span id="countdown-sri-lankan"></span></p>
                        </div>
                        <div class="promo_btn">
                            <a href="../php/menu.php" class="promo">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Chinese Spring Rolls Promotion -->
            <div id="chineseSpringRolls" class="tab-content" style="display:none;">
                <div class="promo_cards">
                    <div class="left_side_content">
                        <div class="img_of_left">
                            <img src="../img/15.png" alt="" />
                        </div>
                    </div>
                    <div class="right_side_content">
                        <h1>Special Promotion</h1>
                        <h2>Chinese Spring Rolls</h2>
                        <p>Crispy on the outside and bursting with savory goodness on the inside, these Chinese Spring 
                            Rolls are a true culinary delight. Each roll is packed with finely chopped vegetables, 
                            seasoned with ginger, garlic, and soy sauce, then wrapped in delicate rice paper and fried 
                            to perfection. Accompanied by a sweet and tangy dipping sauce, these spring rolls offer a 
                            satisfying crunch in every bite. Whether as a snack or an appetizer, they promise to deliver 
                            the authentic flavors of Chinese street food, transporting you to the bustling markets of 
                            China with every taste.</p>
                        <div class="price">
                            <p>Rs.750</p>
                        </div>
                        <div class="promo_timer">
                            <p>Offer ends in: <span id="countdown-chinese"></span></p>
                        </div>
                        <div class="promo_btn">
                            <a href="../php/menu.php" class="promo">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Italian Pasta Promotion -->
            <div id="italianPasta" class="tab-content" style="display:none;">
                <div class="promo_cards">
                    <div class="left_side_content">
                        <div class="img_of_left">
                            <img src="../img/7(7).png" alt="" />
                        </div>
                    </div>
                    <div class="right_side_content">
                        <h1>Special Promotion</h1>
                        <h2>Italian Pasta</h2>
                        <p>Dive into the world of Italian culinary traditions with our signature Italian Pasta dish. 
                            This hearty meal features al dente pasta coated in a rich, slow-cooked tomato and basil 
                            sauce, simmered for hours to bring out deep, robust flavors. A sprinkle of freshly grated 
                            Parmesan cheese on top adds a salty, nutty element, while fresh basil leaves lend a fragrant
                             touch. Served with garlic bread and a side of crisp salad, this dish is a perfect representation 
                             of the simple yet profound tastes of Italy, crafted to satisfy pasta lovers and gourmands alike.</p>
                        <div class="price">
                            <p>Rs.1300</p>
                        </div>
                        <div class="promo_timer">
                            <p>Offer ends in: <span id="countdown-italian"></span></p>
                        </div>
                        <div class="promo_btn">
                            <button class="promo">Order Now</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Japanese Tempura Promotion -->
            <div id="japaneseTempura" class="tab-content" style="display:none;">
                <div class="promo_cards">
                    <div class="left_side_content">
                        <div class="img_of_left">
                            <img src="../img/14(1).png" alt="" />
                        </div>
                    </div>
                    <div class="right_side_content">
                        <h1>Special Promotion</h1>
                        <h2>Japanese Tempura</h2>
                        <p>Experience the light and delicate flavors of Japan with our Japanese Tempura. Each piece of 
                            seafood or vegetable is lightly battered and fried until golden brown, creating a perfect 
                            crispy exterior that encases the fresh, tender ingredients inside. Paired with a special 
                            tempura dipping sauce, made from dashi broth, soy sauce, and mirin, the dish strikes a 
                            harmonious balance of textures and flavors. Whether it’s prawns, sweet potatoes, or zucchini,
                             every bite offers a delightful crunch followed by a burst of umami. This is Japanese comfort 
                             food at its finest, elegant yet approachable.</p>
                        <div class="price">
                            <p>Rs.1400</p>
                        </div>
                        <div class="promo_timer">
                            <p>Offer ends in: <span id="countdown-japanese"></span></p>
                        </div>
                        <div class="promo_btn">
                            <a href="../php/menu.php" class="promo">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mexican Salad Promotion -->
            <div id="mexicanSalad" class="tab-content">
                <div class="promo_cards">
                    <div class="left_side_content">
                        <div class="img_of_left">
                            <img src="../img/11(2).png" alt="" />
                        </div>
                    </div>
                    <div class="right_side_content">
                        <h1>Special Promotion</h1>
                        <h2>The Mexican Salad</h2>
                        <p>A refreshing and colorful dish, our Mexican Salad is packed with vibrant flavors and textures 
                            that will leave you feeling energized. Crisp lettuce, juicy tomatoes, crunchy corn, and black 
                            beans are tossed together with sliced avocados and tangy feta cheese. The salad is then drizzled 
                            with a zesty lime and cilantro dressing, adding a burst of fresh, citrusy flavor. This is a salad 
                            that is as hearty as it is healthy, offering a satisfying meal that’s perfect for a light lunch 
                            or a flavorful side dish. A true celebration of Mexican ingredients, this salad is a refreshing 
                            take on traditional Mexican cuisine.</p>
                        <div class="price">
                            <p>Rs.1200</p>
                        </div>
                        <div class="promo_timer">
                            <p>Offer ends in: <span id="countdown-mexican"></span></p>
                        </div>
                        <div class="promo_btn">
                            <a href="../php/menu.php" class="promo">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Indian Butter Chicken Promotion -->
            <div id="indianButterChicken" class="tab-content" style="display:none;">
                <div class="promo_cards">
                    <div class="left_side_content">
                        <div class="img_of_left">
                            <img src="../img/15(1).png" alt="" />
                        </div>
                    </div>
                    <div class="right_side_content">
                        <h1>Special Promotion</h1>
                        <h2>Indian Butter Chicken</h2>
                        <p>Rich, creamy, and full of flavor, our Indian Butter Chicken is a feast for the senses. Tender 
                            pieces of chicken are marinated in yogurt and spices, then simmered in a velvety sauce made 
                            from tomatoes, cream, and aromatic Indian spices like garam masala, cumin, and fenugreek. 
                            The dish is served with warm, buttery naan bread or basmati rice, allowing you to soak up 
                            every bit of the flavorful sauce. The blend of creamy textures and spicy undertones makes 
                            this dish both comforting and exciting, a true reflection of the diversity and depth of 
                            Indian cuisine.</p>
                        <div class="price">
                            <p>Rs.1500</p>
                        </div>
                        <div class="promo_timer">
                            <p>Offer ends in: <span id="countdown-indian"></span></p>
                        </div>
                        <div class="promo_btn">
                            <a href="../php/menu.php" class="promo">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-----------Special promo close------------>

    <!-----------Event slider start------------>
    <section id="events">
        <div class="container swiper mySwiper">
            <h3 class="subtitle_1">Upcoming events</h3>
            <h2 class="title_1">Month of September</h2>
            <div class="event_cards_container swiper-wrapper">
                <div class="event_card swiper-slide">
                    <img src="../img/4(5).png" alt="" />
                    <div class="event_content">
                        <h3 class="event_title">Live Jazz Night</h3>
                        <p class="event_date">September 15, 2024</p>
                        <p class="event_description">
                            Enjoy an evening of live jazz music at The Gallery Café with local artists, cocktails, 
                            and gourmet appetizers.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <div class="event_card swiper-slide">
                    <img src="../img/2(4).png" alt="" />
                    <div class="event_content">
                        <h3 class="event_title">Wine & Dine</h3>
                        <p class="event_date">September 22, 2024</p>
                        <p class="event_description">
                            Savor a special menu paired with fine wines at our exclusive Wine & Dine event. 
                            Reserve your table for a night of culinary delight.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <div class="event_card swiper-slide">
                    <img src="../img/8(4).png" alt="" />
                    <div class="event_content">
                        <h3 class="event_title">Sri Lankan Food Festival</h3>
                        <p class="event_date">September 29, 2024</p>
                        <p class="event_description">
                            Experience the rich flavors of Sri Lanka with traditional dishes, cultural performances, 
                            and local delicacies.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <div class="event_card swiper-slide">
                    <img src="../img/10(1).png" alt="" />
                    <div class="event_content">
                        <h3 class="event_title">Italian Cuisine Week</h3>
                        <p class="event_date">October 05, 2024</p>
                        <p class="event_description">
                            Enjoy a week of Italian cuisine with classic pasta dishes and desserts, showcasing 
                            the best of Italian gastronomy.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <div class="event_card swiper-slide">
                    <img src="../img/13.png" alt="" />
                    <div class="event_content">
                        <h3 class="event_title">Gourmet Burger Night</h3>
                        <p class="event_date">October 10, 2024</p>
                        <p class="event_description">
                            Join us for Gourmet Burger Night featuring handcrafted burgers with unique toppings and sides. 
                            Enjoy craft beers and a relaxed evening at The Gallery Café.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <div class="event_card swiper-slide">
                    <img src="../img/6(4).png" alt="" />
                    <div class="event_content">
                        <h3 class="event_title">Holiday Brunch</h3>
                        <p class="event_date">December 15, 2024</p>
                        <p class="event_description">
                            Celebrate Christmas with our Holiday Brunch, featuring a buffet, live cooking stations, 
                            and a visit from Santa.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-----------Event slider close------------>


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