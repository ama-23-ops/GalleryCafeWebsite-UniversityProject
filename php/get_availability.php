<?php
// Enable error reporting (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection 
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "gallery_cafe"; 

try {
    // Initialize $conn inside the try block
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get total counts 
$totalTables = 10; 
$totalParkingSlots = 20; 

// Get reserved counts for the current date 
$reservedTablesQuery = "SELECT COUNT(*) FROM reservations WHERE reservation_date = CURDATE() AND table_preference IS NOT NULL"; // Removed DISTINCT
$reservedParkingQuery = "SELECT COUNT(*) FROM reservations WHERE reservation_date = CURDATE() AND parking_preference = 1";

$reservedTables = $conn->query($reservedTablesQuery)->fetchColumn();
$reservedParking = $conn->query($reservedParkingQuery)->fetchColumn();

// Calculate available counts
$availableTables = $totalTables - $reservedTables;
$availableParking = $totalParkingSlots - $reservedParking;

    // Set the Content-Type header to JSON
    header('Content-Type: application/json');

    // Return the counts as JSON
    echo json_encode([
        'availableTables' => $availableTables,
        'availableParking' => $availableParking
    ]);

    // Close the database connection 
    $conn = null;

} catch(PDOException $e) {
    // Handle the error 
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>