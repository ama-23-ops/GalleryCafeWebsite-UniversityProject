<?php
session_start();
require_once 'db_connect.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $reservationId = $_GET['id'];

    // Update reservation status to 'denied'
    $sql = "UPDATE reservations SET status = 'denied' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $reservationId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to admin_reservations.php
        header("Location: admin_reservations.php"); 
        exit;
    } else {
        echo "Error denying reservation."; 
    }

} else {
    echo "Invalid reservation ID."; 
}
?>