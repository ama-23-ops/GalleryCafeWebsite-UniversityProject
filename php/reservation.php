<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation | The Gallery Café</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
    <section id="hero-reservation">
        <div class="hero-content">
            <h1>Reserve your spot and experience fine dining your way.</h1>
            <p>Reservation</p>
        </div>
    </section>

    <!-- Availability Section start-->
<div class="availability-section">
    <div class="table-availability">
        <img src="../img/3.png" alt="Restaurant Layout" class="availability-image"> 
        <div class="available-tables">
            <h2>Available Tables: <span id="availableTablesCount">6</span></h2> 
        </div>
    </div>

    <div class="parking-availability">
        <img src="../img/2.png" alt="Parking Area" class="availability-image">
        <div class="available-parking">
            <h2>Available Parking: <span id="availableParkingCount">15</span></h2> 
        </div>
    </div>

    <div class="order-availability">
        <img src="../img/5.png" alt="Order Area" class="availability-image">
        <div class="available-order">
            <h2><a href="../php/menu.php" class="order-link">Order Now</a></h2> 
        </div>
    </div>
</div>
<!-- Availability Section close-->

    <!-- Reservation Section -->
    <div class="reservation-section">
        <h2 class="section-title">Make a Reservation</h2>
        <div class="reservation-container">
            <div class="reservation-image">
                <img src="../img/2(4).png" alt="Reservation Image">
            </div>
            <div class="reservation-form-container">
                <form id="reservationForm" class="reservation-form">
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required aria-describedby="nameError">
                        <small class="error-message" id="nameError" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required aria-describedby="phoneError">
                        <small class="error-message" id="phoneError" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" aria-describedby="emailError">
                        <small class="error-message" id="emailError" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="date">Reservation Date:</label>
                        <input type="date" id="date" name="date" required aria-describedby="dateError">
                        <small class="error-message" id="dateError" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="time">Reservation Time:</label>
                        <input type="time" id="time" name="time" required aria-describedby="timeError">
                        <small class="error-message" id="timeError" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="guests">Number of Guests:</label>
                        <input type="number" id="guests" name="guests" min="1" required aria-describedby="guestsError">
                        <small class="error-message" id="guestsError" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="table">Choose table type:</label>
                        <select id="table" name="table" class="form-control">
                            <option value="">Select table type</option>
                            <option value="2">Table for 2</option>
                            <option value="4">Table for 4</option>
                            <option value="6">Table for 6</option>
                            <option value="8">Table for 8</option>
                        </select>
                        <small class="error-message" id="tableError" aria-live="polite"></small> 
                    </div>                    
                    <div class="form-group">
                        <label for="parking">Need Parking?</label> 
                        <input type="checkbox" id="parking" name="parking" value="yes"> Yes 
                        <small class="error-message" id="parkingError" aria-live="polite"></small>
                    </div>
                    <div class="form-group full-width">
                        <button type="button" id="submitReservation">Reserve Now</button>
                    </div>
                    <div class="form-group full-width">
                        <div id="formMessage" class="success-message"> </div> 
                    </div>
                </form>
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

    <script src="../js/rev.js"></script>
</body>
</html>
