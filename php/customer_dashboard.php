<?php
session_start();
require_once 'db_connect.php';

// Authorization Check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Customer') {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch Reservations 
$reservationsSql = "SELECT * FROM reservations WHERE user_id = ? ORDER BY reservation_date, reservation_time";
$reservationsStmt = $conn->prepare($reservationsSql);
$reservationsStmt->bindValue(1, $userId, PDO::PARAM_INT);
$reservationsStmt->execute();
$reservations = $reservationsStmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all reservations

// Fetch Orders
$ordersSql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC"; // Latest orders first
$ordersStmt = $conn->prepare($ordersSql);
$ordersStmt->bindValue(1, $userId, PDO::PARAM_INT);
$ordersStmt->execute();
$orders = $ordersStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard | The Gallery Café</title>
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>

/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    color: #333;
}

.container {
    width: 90%;
    margin: 0 auto;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table thead {
    background-color: #333;
    color: black;
}

table th, table td {
    padding: 10px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Success Message */
.success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
}

/* Media Queries for Responsive Design */
@media (max-width: 768px) {
    .navbar nav {
        display: none;
    }

    .menuBtn {
        display: block;
        color: white;
        cursor: pointer;
    }

    .hero-content h1 {
        font-size: 2rem;
    }

    .hero-content p {
        font-size: 1rem;
    }

    .customer-dashboard h2 {
        font-size: 1.5rem;
    }
}

@media (max-width: 600px) {
    table th, table td {
        padding: 8px 10px;
    }

    .customer-dashboard h2 {
        font-size: 1.2rem;
    }

    section h3 {
        font-size: 1.2rem;
    }
}
        </style>
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
                    <li><a href="customer_dashboard.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
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
            <h1>Explore the rich variety of cuisines we offer</h1>
            <?php
                        // Check if the user is logged in
                        if (isset($_SESSION['user_id'])) {
                            echo '<p>Welcome, ' . $_SESSION['username'] . '!</p>';
                        } else {
                            // If not logged in, show "Login"
                            echo '';
                        }
                        ?>
        </div>
    </section>

    <main>
    <section class="customer-dashboard">
            <div class="container">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

<!-- Reservations Section -->
<h3>Your Upcoming Reservations</h3>
<?php if (count($reservations) > 0): ?> 
    <table>
        <thead>
            <tr>
                <th>Reservation Date</th>
                <th>Reservation Time</th>
                <th>Guests</th>
                <th>Table Preference</th>
                <th>Parking</th>
                <th>Status</th> <div id="formMessage" class="success-message"> </div> 
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservations as $reservation): ?> 
                <tr>
                    <td><?php echo $reservation['reservation_date']; ?></td>
                    <td><?php echo $reservation['reservation_time']; ?></td>
                    <td><?php echo $reservation['guests']; ?></td>
                    <td><?php echo $reservation['table_preference'] ? 'Table for ' . $reservation['table_preference'] : 'Any'; ?></td>
                    <td><?php echo $reservation['parking_preference'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $reservation['status']; ?></td> 
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>You have no upcoming reservations.</p>
<?php endif; ?>

        </section>
        
        <section class="customer-orders">
            <h3>Your Orders</h3>
            <?php if (count($orders) > 0): ?>
                <table class="order-table"> 
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Total Price (LKR)</th> 
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['total_price']; ?></td> 
                                <td><?php echo $order['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have no previous orders.</p>
            <?php endif; ?>
        </div>
    </section>
    </main>

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
   
</html>