<?php
session_start();

// Authorization Check for Admin and Staff
if (!isset($_SESSION['role']) || 
    !in_array($_SESSION['role'], ['Admin', 'Staff'])) { 
    header('Location: login.php'); // Or an unauthorized page
    exit();
}

$userId = $_SESSION['user_id']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard | The Gallery Café</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    
/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9; 
    margin: 0;
    padding: 0;
}

h1, h2, h3 {
    color: #981e2e;
}

/* Dashboard Layout */
.staff-dashboard {
    display: flex;
    min-height: 100vh; 
}

/* Sidebar Styling */
.sidebar {
    width: 250px;
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #fff; 
    font-size: 24px; 
    border: none; 
}


.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 15px;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #444;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.sidebar ul li a:hover {
    background-color: #555;
}

/* Adding Font Awesome Icons */
.sidebar ul li a i {
    margin-right: 10px;
}
/* Main Content */
.content {
    flex: 1; 
    padding: 20px;
    background-color: #fff; 
}

/* Basic Table Styling */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px; 
}

th, td {
    border: 1px solid #ddd; 
    padding: 8px; 
}

th {
    background-color: #f2f2f2; 
    text-align: left; 
}

/* Style for success and error messages */
.success {
    color: green;
}

.error {
    color: red; 
}


        </style>
</head>
<body>

    <div class="staff-dashboard">
        <aside class="sidebar">
            <h2>Staff Panel</h2>
            <ul>
            <li><a href="staff_dashboard.php?view=reservations"><i class="fas fa-calendar-alt"></i> Reservation Management</a></li>
            <li><a href="staff_dashboard.php?view=orders"><i class="fas fa-shopping-cart"></i> Order Management</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>            </ul>
        </aside>

        <main class="content">
            <?php
            // Dynamically include content based on the selected navigation item
            if (isset($_GET['view'])) {
                $view = $_GET['view'];

                switch ($view) {
                    case 'reservations':
                        include 'admin_reservations.php'; 
                        break;
                    case 'orders':
                        include 'admin_orders.php';
                        break;
                    default:
                        echo "<h1>Welcome to the Staff Dashboard!</h1>"; 
                        break;
                }
            } else {
                echo "<h1>Welcome to the Staff Dashboard!</h1>"; 
            }
            ?>
        </main>
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
</body>
</html>