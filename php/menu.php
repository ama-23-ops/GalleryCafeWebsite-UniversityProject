<?php
session_start(); 
require_once 'db_connect.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | The Gallery Café</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> 
    <style>
/* Modal Styles */
.modal {
    display: none; 
    position: fixed; 
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7); 
}

/* Modal Content */
.modal-content {
    background-color: #ffffff; 
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888; 
    border-radius: 8px; 
    width: 80%; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Close Button */
.close-modal {
    color: #aaa; 
    float: right; 
    font-size: 28px; 
    font-weight: bold; 
    cursor: pointer; 
}

.close-modal:hover,
.close-modal:focus {
    color: #000;
    text-decoration: none; 
    cursor: pointer;
}

/* Modal Header */
h2 {
    margin-top: 0; 
}

/* Cart Table Styles */
#cartItems {
    width: 100%; 
    border-collapse: collapse;
    margin-bottom: 20px; 
}

/* Cart Table Header Styles */
#cartItems thead {
    background-color: #981e2e;
}

#cartItems th {
    color: white; 
    padding: 10px; 
    text-align: left; 
    border-bottom: 2px solid #fff; 
}

#cartItems th:hover {
    background-color: #b43c4e; 
}

#cartItems tr:hover {
    background-color: #f1f1f1;
}

/* Cart Total Styles */
#cartTotal {
    font-size: 18px; 
    font-weight: bold; 
    margin-bottom: 20px; 
}

/* Checkout Button */
#checkoutBtn {
    background-color: #981e2e;
    color: white;
    padding: 10px 15px;
    border: none; 
    border-radius: 5px;
    cursor: pointer; 
    font-size: 16px; 
}

#checkoutBtn:hover {
    background-color: #b43c4e; 
}

</style>
</head>
<body>
    <!-----------Header start------------>
    <header>
        <div class="container">
            <div class="navbar">
                <div class="logo">
                      <p>The Gallery Café</P>
                </div>
                <nav>
                    <div class="clsBtn">
                        <i class="fas fa-times close-btn"></i>
                    </div>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservation.php">Reservations</a></li>
                    <li>
                        <a href="#" id="cart-link">
                            <i class="fas fa-shopping-cart"></i> Cart 
                            <span id="cart-count">0</span> </a>
                    </li>
                    <li>
                          <?php
                         // Check if user is logged in 
                         if (isset($_SESSION['user_id'])) { 
                            echo '
                            <li><a href="customer_dashboard.php">Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>';
                         } else {
                             echo '<a href="login.php">Login</a>'; 
                         }
                          ?>
                    </li>
                </nav>
                <div class="menuBtn">
                    <i class="fas fa-bars menu-btn"></i>
                </div>
            </div>
        </div>
    </header>
    <!-----------Header close------------>

    <!-- Hero Section -->
    <section id="hero-menu">
        <div class="hero-content">
            <h1>Explore the rich variety of cuisines we offer</h1>
            <p>Our Delicious Menu</p>
        </div>
    </section>
    
    <!-- Menu Section with Tab Navigation -->
    <section id="menu-section">
        <div class="container">
            <!-- Tab Navigation -->
            <div class="menu-tabs">
                <button class="tab-btn" onclick="openMenu(event, 'srilankan')">Sri Lankan</button>
                <button class="tab-btn" onclick="openMenu(event, 'chinese')">Chinese</button>
                <button class="tab-btn" onclick="openMenu(event, 'italian')">Italian</button>
                <button class="tab-btn" onclick="openMenu(event, 'mexican')">Mexican</button>
                <button class="tab-btn" onclick="openMenu(event, 'japanese')">Japanese</button>
                <button class="tab-btn" onclick="openMenu(event, 'indian')">Indian</button>
            </div>

            <!-- Menu Content for each cuisine -->
            <div id="srilankan" class="tab-content">
                <h2>Sri Lankan Menu</h2>
                <div class="menu-grid">
                    <div class="menu-item" data-item-id="1" data-item-name="Fish Ambul Thiyal" data-item-price="1400">
                        <img src="../img/15(1).png" alt="Fish Ambul Thiyal" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Fish Ambul Thiyal</h3>
                            <p>A traditional Sri Lankan sour fish curry.</p>
                            <span>Rs. 1400</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="2" data-item-name="Egg Hopper with Sambol" data-item-price="800">
                        <img src="../img/9(2).png" alt="Egg Hopper with Sambol" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Egg Hopper with Sambol</h3>
                            <p>A delightful egg-filled hopper served with spicy sambol.</p>
                            <span>Rs. 800</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="3" data-item-name="Polos (Jackfruit Curry)" data-item-price="1200">
                        <img src="../img/6(5).png" alt="Polos (Jackfruit Curry)" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Polos (Jackfruit Curry)</h3>
                            <p>Slow-cooked jackfruit curry, rich in spices.</p>
                            <span>Rs. 1200</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="4" data-item-name="Kottu Roti" data-item-price="900">
                        <img src="../img/6(6).png" alt="Kottu Roti" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Kottu Roti</h3>
                            <p>Chopped roti stir-fried with vegetables and chicken.</p>
                            <span>Rs. 900</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="5" data-item-name="Sri Lankan Crab Curry" data-item-price="2500">
                        <img src="../img/14(1).png" alt="Sri Lankan Crab Curry" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Sri Lankan Crab Curry</h3>
                            <p>Fresh crab cooked in a spicy curry sauce.</p>
                            <span>Rs. 2500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="6" data-item-name="Coconut Sambol" data-item-price="500">
                        <img src="../img/7(7).png" alt="Coconut Sambol" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Coconut Sambol</h3>
                            <p>A spicy coconut relish with chili and lime.</p>
                            <span>Rs. 500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="chinese" class="tab-content" style="display:none;">
                <h2>Chinese Menu</h2>
                <div class="menu-grid">
                    <div class="menu-item" data-item-id="7" data-item-name="Kung Pao Chicken" data-item-price="1500">
                        <img src="../img/7(7).png" alt="Kung Pao Chicken" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Kung Pao Chicken</h3>
                            <p>Spicy stir-fried chicken with peanuts and vegetables.</p>
                            <span>Rs. 1500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="8" data-item-name="Vegetable Spring Rolls" data-item-price="600">
                        <img src="../img/7(7).png" alt="Vegetable Spring Rolls" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Vegetable Spring Rolls</h3>
                            <p>Crispy rolls stuffed with vegetables and noodles.</p>
                            <span>Rs. 600</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="9" data-item-name="Beef Chow Mein" data-item-price="1300">
                        <img src="../img/7(7).png" alt="Beef Chow Mein" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Beef Chow Mein</h3>
                            <p>Stir-fried noodles with beef and vegetables.</p>
                            <span>Rs. 1300</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="10" data-item-name="Sweet and Sour Pork" data-item-price="1400">
                        <img src="../img/7(7).png" alt="Sweet and Sour Pork" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Sweet and Sour Pork</h3>
                            <p>Deep-fried pork in a tangy sweet and sour sauce.</p>
                            <span>Rs. 1400</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="11" data-item-name="Peking Duck" data-item-price="2500">
                        <img src="../img/7(7).png" alt="Peking Duck" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Peking Duck</h3>
                            <p>Crispy roasted duck served with pancakes.</p>
                            <span>Rs. 2500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="12" data-item-name="Mapo Tofu" data-item-price="1100">
                        <img src="../img/7(7).png" alt="Mapo Tofu" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Mapo Tofu</h3>
                            <p>Spicy tofu with minced pork in a Sichuan sauce.</p>
                            <span>Rs. 1100</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="italian" class="tab-content" style="display:none;">
                <h2>Italian Menu</h2>
                <div class="menu-grid">
                    <div class="menu-item" data-item-id="13" data-item-name="Lasagna" data-item-price="1800">
                        <img src="../img/7(7).png" alt="Lasagna" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Lasagna</h3>
                            <p>Layers of pasta, cheese, and beef ragu.</p>
                            <span>Rs. 1800</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="14" data-item-name="Margherita Pizza" data-item-price="1500">
                        <img src="../img/7(7).png" alt="Margherita Pizza" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Margherita Pizza</h3>
                            <p>Classic pizza with tomato, mozzarella, and basil.</p>
                            <span>Rs. 1500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="15" data-item-name="Fettuccine Alfredo" data-item-price="1600">
                        <img src="../img/7(7).png" alt="Fettuccine Alfredo" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Fettuccine Alfredo</h3>
                            <p>Fettuccine pasta in a creamy Alfredo sauce.</p>
                            <span>Rs. 1600</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="16" data-item-name="Risotto" data-item-price="1700">
                        <img src="../img/7(7).png" alt="Risotto" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Risotto</h3>
                            <p>Creamy rice dish with mushrooms and parmesan.</p>
                            <span>Rs. 1700</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="17" data-item-name="Tiramisu" data-item-price="900">
                        <img src="../img/7(7).png" alt="Tiramisu" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Tiramisu</h3>
                            <p>Classic Italian dessert made with coffee and mascarpone.</p>
                            <span>Rs. 900</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="18" data-item-name="Bruschetta" data-item-price="700">
                        <img src="../img/7(7).png" alt="Bruschetta" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Bruschetta</h3>
                            <p>Toasted bread with fresh tomatoes and basil.</p>
                            <span>Rs. 700</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            

            <div id="mexican" class="tab-content" style="display:none;">
                <h2>Mexican Menu</h2>
                <div class="menu-grid">
                    <div class="menu-item" data-item-id="19" data-item-name="Beef Burrito" data-item-price="1100">
                        <img src="../img/7(7).png" alt="Beef Burrito" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Beef Burrito</h3>
                            <p>A large tortilla filled with spiced beef, beans, and rice.</p>
                            <span>Rs. 1100</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="20" data-item-name="Nachos with Salsa" data-item-price="900">
                        <img src="../img/7(7).png" alt="Nachos with Salsa" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Nachos with Salsa</h3>
                            <p>Crispy nachos topped with fresh salsa and melted cheese.</p>
                            <span>Rs. 900</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="21" data-item-name="Guacamole and Chips" data-item-price="700">
                        <img src="../img/7(7).png" alt="Guacamole and Chips" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Guacamole and Chips</h3>
                            <p>Fresh guacamole served with tortilla chips.</p>
                            <span>Rs. 700</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="22" data-item-name="Tacos al Pastor" data-item-price="1200">
                        <img src="../img/7(7).png" alt="Tacos al Pastor" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Tacos al Pastor</h3>
                            <p>Tacos filled with marinated pork, pineapple, and onions.</p>
                            <span>Rs. 1200</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="23" data-item-name="Chicken Quesadilla" data-item-price="1000">
                        <img src="../img/7(7).png" alt="Chicken Quesadilla" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Chicken Quesadilla</h3>
                            <p>A grilled tortilla filled with spiced chicken and cheese.</p>
                            <span>Rs. 1000</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="24" data-item-name="Churros with Chocolate Sauce" data-item-price="800">
                        <img src="../img/7(7).png" alt="Churros with Chocolate Sauce" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Churros with Chocolate Sauce</h3>
                            <p>Crispy fried dough sticks served with rich chocolate sauce.</p>
                            <span>Rs. 800</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="japanese" class="tab-content" style="display:none;">
                <h2>Japanese Menu</h2>
                <div class="menu-grid">
                    <div class="menu-item" data-item-id="25" data-item-name="Ramen Noodles" data-item-price="1300">
                        <img src="../img/7(7).png" alt="Ramen Noodles" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Ramen Noodles</h3>
                            <p>Rich and flavorful ramen noodles served in broth.</p>
                            <span>Rs. 1300</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="26" data-item-name="Tempura Shrimp" data-item-price="1700">
                        <img src="../img/7(7).png" alt="Tempura Shrimp" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Tempura Shrimp</h3>
                            <p>Lightly battered and fried shrimp served with dipping sauce.</p>
                            <span>Rs. 1700</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="27" data-item-name="Sashimi Platter" data-item-price="2000">
                        <img src="../img/7(7).png" alt="Sashimi Platter" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Sashimi Platter</h3>
                            <p>Fresh slices of raw fish served with soy sauce and wasabi.</p>
                            <span>Rs. 2000</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="28" data-item-name="Chicken Teriyaki" data-item-price="1500">
                        <img src="../img/7(7).png" alt="Chicken Teriyaki" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Chicken Teriyaki</h3>
                            <p>Grilled chicken glazed with sweet and savory teriyaki sauce.</p>
                            <span>Rs. 1500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="29" data-item-name="Miso Soup" data-item-price="600">
                        <img src="../img/7(7).png" alt="Miso Soup" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Miso Soup</h3>
                            <p>Traditional Japanese soup with tofu and seaweed.</p>
                            <span>Rs. 600</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="30" data-item-name="Sushi Rolls" data-item-price="1800">
                        <img src="../img/7(7).png" alt="Sushi Rolls" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Sushi Rolls</h3>
                            <p>Rolls of sushi filled with fish, rice, and vegetables.</p>
                            <span>Rs. 1800</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="indian" class="tab-content" style="display:none;">
                <h2>Indian Menu</h2>
                <div class="menu-grid">
                    <div class="menu-item" data-item-id="31" data-item-name="Butter Chicken" data-item-price="1500">
                        <img src="../img/7(7).png" alt="Butter Chicken" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Butter Chicken</h3>
                            <p>Succulent chicken in a creamy tomato-based curry.</p>
                            <span>Rs. 1500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="32" data-item-name="Biryani" data-item-price="1200">
                        <img src="../img/7(7).png" alt="Biryani" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Biryani</h3>
                            <p>Spiced rice with tender pieces of chicken or mutton.</p>
                            <span>Rs. 1200</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="33" data-item-name="Chana Masala" data-item-price="1100">
                        <img src="../img/7(7).png" alt="Chana Masala" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Chana Masala</h3>
                            <p>Chickpeas cooked in a spicy and tangy tomato-based sauce.</p>
                            <span>Rs. 1100</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="34" data-item-name="Tandoori Chicken" data-item-price="1400">
                        <img src="../img/7(7).png" alt="Tandoori Chicken" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Tandoori Chicken</h3>
                            <p>Marinated chicken grilled to perfection in a tandoor.</p>
                            <span>Rs. 1400</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="35" data-item-name="Paneer Butter Masala" data-item-price="1300">
                        <img src="../img/7(7).png" alt="Paneer Butter Masala" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Paneer Butter Masala</h3>
                            <p>Rich and creamy curry with paneer (Indian cottage cheese).</p>
                            <span>Rs. 1300</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                    <div class="menu-item" data-item-id="36" data-item-name="Gulab Jamun" data-item-price="500">
                        <img src="../img/7(7).png" alt="Gulab Jamun" class="menu-item-img">
                        <div class="menu-item-info">
                            <h3>Gulab Jamun</h3>
                            <p>Sweet and soft milk-based dumplings soaked in syrup.</p>
                            <span>Rs. 500</span>
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Hero Section -->
    <section id="banner-menu">
        <div class="banner-content">
            <p>Beverages and Dessert</p>
        </div>
    </section>

    <!-- Beverages Section -->
<div id="beverages" class="menu-section">
    <div class="container">
        <h2>Beverages</h2>
      <div class="menu-grid">
        <div class="menu-item" data-item-id="37" data-item-name="Fresh Coconut Juice" data-item-price="500">
            <img src="../img/7(7).png" alt="Fresh Coconut Juice" class="menu-item-img">
            <div class="menu-item-info">
                <h3>Fresh Coconut Juice</h3>
                <p>Refreshing and hydrating coconut water served fresh from the shell.</p>
                <span>Rs. 500</span>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>
        <div class="menu-item" data-item-id="38" data-item-name="Espresso Martini" data-item-price="1500">
            <img src="../img/7(7).png" alt="Espresso Martini" class="menu-item-img">
            <div class="menu-item-info">
                <h3>Espresso Martini</h3>
                <p>A sophisticated cocktail combining espresso and vodka.</p>
                <span>Rs. 1500</span>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>
      </div>
    
    </div>
</div>

<!-- Desserts Section -->
<div id="desserts" class="menu-section">
    <div class="container">
       <h2>Desserts</h2>
     <div class="menu-grid">
        <div class="menu-item" data-item-id="39" data-item-name="Chocolate Mousse" data-item-price="600">
            <img src="../img/7(7).png" alt="Chocolate Mousse" class="menu-item-img">
            <div class="menu-item-info">
                <h3>Chocolate Mousse</h3>
                <p>A rich and creamy chocolate dessert topped with whipped cream.</p>
                <span>Rs. 600</span>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>
        <div class="menu-item" data-item-id="40" data-item-name="Mango Sticky Rice" data-item-price="800">
            <img src="../img/7(7).png" alt="Mango Sticky Rice" class="menu-item-img">
            <div class="menu-item-info">
                <h3>Mango Sticky Rice</h3>
                <p>A sweet Thai dessert made with ripe mango and coconut-infused sticky rice.</p>
                <span>Rs. 800</span>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>
     </div> 
    </div>
    
</div>


    <!-- Cart Modal -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">×</span>
            <h2>Your Cart</h2>
            <table id="cartItems">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
                    <!-- Cart items will be added here -->
                </tbody>
            </table>
            <div id="cartTotal">Total: Rs. 0</div>
            <button id="checkoutBtn">Checkout</button>
        </div>
    </div>

<script>
    // JavaScript to handle tab navigation
    $(document).on('click', '.tab-btn', function(event) { // Use event delegation
    var cuisineName = $(this).text().toLowerCase().replace(/\s+/g, ''); // Get cuisine from button text
    openMenu(event, cuisineName);
 });

 function openMenu(evt, cuisineName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        // Ensure tablinks[i] is not null before accessing className
        if (tablinks[i]) { 
            tablinks[i].className = tablinks[i].className.replace(" active", ""); 
        }
    }
    document.getElementById(cuisineName).style.display = "block";
    $(this).addClass('active'); // Add active class using jQuery 
 }

    // Function to fetch and display menu items
    function loadMenu() {
        $.ajax({
            url: "../php/get_menu.php",
            type: "GET",
            dataType: "json",
            success: function (menuItems) {
                console.log("Menu items fetched:", menuItems);
                displayMenu(menuItems);
            },
            error: function (error) {
                console.error("Error fetching menu:", error);
                $("#menu-section").html("<p>Error loading menu. Please try again later.</p>");
            }
        });
    }

    // Function to organize and display menu items by cuisine
    function displayMenu(menuItems) {
        var cuisines = {};
        menuItems.forEach(function (item) {
            var normalizedCuisine = item.cuisine.toLowerCase().replace(/\s+/g, '');
            if (!cuisines[normalizedCuisine]) {
                cuisines[normalizedCuisine] = [];
            }
            cuisines[normalizedCuisine].push(item);
        });

        for (var cuisine in cuisines) {
            var cuisineId = cuisine;
            var $cuisineSection = $("#" + cuisineId);

            if ($cuisineSection.length === 0) {
                // Create the tab button dynamically
                var $tabBtn = $("<button>", {
                    class: "tab-btn",
                    text: cuisine,
                    click: function (event) {
                        openMenu(event, cuisineId);
                    }
                });
                $(".menu-tabs").append($tabBtn);

                // Create the tab content div dynamically
                $cuisineSection = $("<div>", {
                    id: cuisineId,
                    class: "tab-content",
                    style: "display:none;"
                }).append("<h2>" + cuisine + " Menu</h2><div class='menu-grid'></div>");
                $("#menu-section .container").append($cuisineSection);

                // Add menu items from the database
                var $grid = $cuisineSection.find('.menu-grid');
                cuisines[cuisine].forEach(function (item) {
                    var $menuItem = $(
                        '<div class="menu-item" data-item-id="' + item.id + '" data-item-name="' + item.item_name + '" data-item-price="' + item.item_price + '">' +
                        '<img src="' + item.image_url + '" alt="' + item.item_name + '" class="menu-item-img">' +
                        '<div class="menu-item-info">' +
                        '<h3>' + item.item_name + '</h3>' +
                        '<p>' + item.description + '</p>' +
                        '<span>Rs. ' + item.item_price + '</span>' +
                        '<button class="add-to-cart">Add to Cart</button>' +
                        '</div>' +
                        '</div>'
                    );
                    $grid.append($menuItem);
                });
            } else {
                var $existingItems = $cuisineSection.find('.menu-item');

                cuisines[cuisine].forEach(function (item) {
                    var itemId = item.menu_item_id;
                    var $existingItem = $existingItems.filter('[data-item-id="' + itemId + '"]');

                    if ($existingItem.length === 0) {
                        var $menuItem = $(
                            '<div class="menu-item" data-item-id="' + item.id + '" data-item-name="' + item.item_name + '" data-item-price="' + item.item_price + '">' +
                            '<img src="' + item.image_url + '" alt="' + item.item_name + '" class="menu-item-img">' +
                            '<div class="menu-item-info">' +
                            '<h3>' + item.item_name + '</h3>' +
                            '<p>' + item.description + '</p>' +
                            '<span>Rs. ' + item.item_price + '</span>' + 
                            '<button class="add-to-cart">Add to Cart</button>' +
                            '</div>' +
                            '</div>'
                        );
                        $cuisineSection.find('.menu-grid').append($menuItem);
                    }
                });
            }
        }

        setTimeout(function() {
         // Check if ANY tab is already active
          if ($('.tab-btn.active').length === 0) { 
           // If NO tab is active, activate the first one
              $('.tab-btn:first').click(); 
            }
        }, 0);
    }

    // Document Ready 
    $(document).ready(function () {
        loadMenu(); // Call loadMenu to populate the menu
    });


    // Cart Functionality 
    var cart = []; 

    $(document).ready(function() {
        loadMenu();
        loadCart(); // Load cart from local storage on page load

        // Add to Cart button click
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var $menuItem = $(this).closest('.menu-item');
            var itemId = $menuItem.data('item-id');
            var itemName = $menuItem.data('item-name');
            var itemPrice = $menuItem.data('item-price');

            addItemToCart(itemId, itemName, itemPrice);
        });

        // Cart Modal Open/Close
        $('#cart-link').click(function(e) {
            e.preventDefault();
            $('#cartModal').show();
        });

        $('.close-modal').click(function() {
            $('#cartModal').hide();
        });

        // Checkout Button Click
        $('#checkoutBtn').click(function() {
            processCheckout();
        });
    });

    // Function to add items to the cart array
    function addItemToCart(itemId, itemName, itemPrice) {
        var existingItem = cart.find(item => item.id === itemId);

        if (existingItem) {
            existingItem.quantity++; 
        } else {
            cart.push({
                id: itemId,
                name: itemName,
                price: itemPrice,
                quantity: 1
            });
        }
        updateCartCount();
        saveCart(); // Save cart to local storage 
    }

    // Function to update cart count in the header
    function updateCartCount() {
        var cartCount = cart.reduce((total, item) => total + item.quantity, 0); 
        $('#cart-count').text(cartCount);
    }

    // Function to save the cart to local storage
    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay(); // Update the cart display
    }

    // Function to load the cart from local storage
    function loadCart() {
        var storedCart = localStorage.getItem('cart');
        if (storedCart) {
            cart = JSON.parse(storedCart);
            updateCartCount(); 
        }
    }
    
    // Function to update the cart modal display
    function updateCartDisplay() {
        var $cartItemsTbody = $('#cartItems tbody');
        $cartItemsTbody.empty();

        var totalPrice = 0;

        cart.forEach(function(item) {
            var subtotal = item.price * item.quantity;
            totalPrice += subtotal;

            var $newItemRow = $('<tr>' +
                '<td>' + item.name + '</td>' +
                '<td>Rs. ' + item.price + '</td>' +
                '<td><input type="number" min="1" value="' + item.quantity + '" data-item-id="' + item.id + '"></td>' +
                '<td>Rs. ' + subtotal + '</td>' +
                '<td><button class="remove-item" data-item-id="' + item.id + '">Remove</button></td>' +
                '</tr>');
            $cartItemsTbody.append($newItemRow);
        });

        $('#cartTotal').text('Total: Rs. ' + totalPrice);

        // Event listener for quantity changes
        $cartItemsTbody.find('input[type="number"]').on('change', function() {
            var itemId = $(this).data('item-id');
            var newQuantity = parseInt($(this).val(), 10);

            updateCartItemQuantity(itemId, newQuantity);
        });

        // Event listener for remove item buttons
        $cartItemsTbody.find('.remove-item').on('click', function() {
            var itemId = $(this).data('item-id');

            removeItemFromCart(itemId);
        });
    }

    // Function to update the quantity of an item in the cart
    function updateCartItemQuantity(itemId, newQuantity) {
        var itemToUpdate = cart.find(item => item.id === itemId);
        if (itemToUpdate) {
            if (newQuantity <= 0) {
                // If quantity is zero or less, remove the item
                removeItemFromCart(itemId);
            } else {
                itemToUpdate.quantity = newQuantity;
                saveCart(); // Update local storage and display
            }
        }
    }

    // Function to remove an item from the cart
    function removeItemFromCart(itemId) {
        cart = cart.filter(item => item.id !== itemId);
        saveCart(); // Update local storage and display
    }

    // Function to process the checkout (send data to server)
    function processCheckout() {
        if (cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }
        console.log("Cart to submit:", cart);

        // Prepare data for AJAX request
        var orderData = {
            items: cart 
        };
    
        $.ajax({
            url: '../php/process_order.php', // Create this PHP file
            type: 'POST',
            data: orderData, 
            dataType: 'json', 
            success: function(response) {
                console.log("Order processed successfully:", response);
                
                if (response.success) {
                    alert('Order placed successfully!');
                    localStorage.removeItem('cart'); // Clear the cart
                    cart = []; // Clear the cart array
                    updateCartCount(); 
                    updateCartDisplay(); 
                    $('#cartModal').hide();
                } else {
                    alert('Error placing order: ' + response.message);
                }
            },
            error: function(error) {
                console.error("Error processing order:", error);
                alert("An error occurred while processing your order. Please try again later."); 
            }
        });
    }


</script>

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
    
</body>
</html>


