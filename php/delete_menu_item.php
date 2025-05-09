<?php
session_start();
require_once 'db_connect.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $menuItemId = $_GET['id'];

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM menu_items WHERE menu_item_id = ?";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $menuItemId, PDO::PARAM_INT);

        // Execute the DELETE statement
        if ($stmt->execute()) {
            // Redirect back to admin_menu.php (or display a success message)
            header("Location: admin_menu.php");
            exit;
        } else {
            echo "Error: Could not delete menu item."; 
        }

    } catch (PDOException $e) {
        // Handle database errors 
        echo "Error: " . $e->getMessage(); 
        exit;
    }

} else {
    // Handle case where 'id' parameter is missing or invalid
    echo "Error: Invalid menu item ID.";
}

$conn = null;
?>