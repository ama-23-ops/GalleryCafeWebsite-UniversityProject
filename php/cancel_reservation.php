<?php
session_start();
require_once 'db_connect.php'; 

// Authorization Check for Admin and Staff
if (!isset($_SESSION['role']) || 
    !in_array($_SESSION['role'], ['Admin', 'Staff'])) { 
    header('Location: login.php'); // Or an unauthorized page
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $reservationId = $_GET['id']; 

    // Update reservation status to 'cancelled'
    $sql = "UPDATE reservations SET status = 'cancelled' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $reservationId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to admin_reservations.php 
        header("Location: admin_reservations.php"); 
        exit;
    } else {
        echo "Error cancelling reservation."; 
    } 

} else {
    echo "Invalid reservation ID."; 
}
?>