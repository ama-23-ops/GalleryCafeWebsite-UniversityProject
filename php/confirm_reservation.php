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

    try {
        // Begin transaction for data consistency
        $conn->beginTransaction(); 

        // Update reservation status to 'confirmed'
        $sql = "UPDATE reservations SET status = 'confirmed' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $reservationId, PDO::PARAM_INT);
        $stmt->execute();

        // Get customer email for sending confirmation 
        $customerEmailSql = "SELECT c.email 
                             FROM reservations r
                             JOIN customers c ON r.id = c.id
                             WHERE r.id = ?";
        $emailStmt = $conn->prepare($customerEmailSql);
        $emailStmt->bindValue(1, $reservationId, PDO::PARAM_INT);
        $emailStmt->execute();
        $customerEmail = $emailStmt->fetchColumn();

        // Send confirmation email
        if ($customerEmail) {
            $subject = "Reservation Confirmed - The Gallery Café";
            $message = "Your reservation for [Date] at [Time] has been confirmed. 
                        We look forward to seeing you at The Gallery Café!";
        }

        // Commit transaction if everything is successful
        $conn->commit(); 

        // Redirect to admin_reservations.php 
        header("Location: admin_reservations.php"); 
        exit;

    } catch (PDOException $e) {
        // Rollback if there's an error
        $conn->rollBack(); 
        echo "Error confirming reservation: " . $e->getMessage();
    }

} else {
    echo "Invalid reservation ID."; 
}

$conn = null;
?>