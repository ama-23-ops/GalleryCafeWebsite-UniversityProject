<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in and has Admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header('Location: unauthorized.php'); // Redirect to an unauthorized page or login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data and sanitize it
    $itemName = htmlspecialchars($_POST['item_name']);
    $description = htmlspecialchars($_POST['description']);
    $itemPrice = floatval($_POST['item_price']); 
    $cuisine = htmlspecialchars($_POST['cuisine']);
    $imageUrl = htmlspecialchars($_POST['image_url']); 

    // Validate the form data 
    if (empty($itemName) || empty($description) || $itemPrice <= 0 || empty($cuisine)) {
        // Handle validation errors 
        echo "Error: Please fill in all fields correctly."; 
        exit; 
    }

    // Prepare the SQL INSERT statement
    $sql = "INSERT INTO menu_items (item_name, description, item_price, cuisine, image_url) 
            VALUES (:item_name, :description, :item_price, :cuisine, :image_url)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item_name', $itemName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':item_price', $itemPrice);
        $stmt->bindParam(':cuisine', $cuisine);  
        $stmt->bindParam(':image_url', $imageUrl);

        // Execute the statement
        $stmt->execute(); 

        // Redirect to admin_menu.php 
        header("Location: admin_menu.php"); 
        exit; 

    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage(); 
        exit; 
    }
} else {
    // Handle invalid requests (not POST)
    echo "Invalid request."; 
    exit;
}

?>