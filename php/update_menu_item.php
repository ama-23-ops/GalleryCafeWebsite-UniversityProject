<?php
session_start();
require_once 'db_connect.php'; 



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Get the form data and sanitize it
    $menuItemId = $_POST['menu_item_id']; 
    $itemName = htmlspecialchars($_POST['item_name']);
    $description = htmlspecialchars($_POST['description']);
    $itemPrice = floatval($_POST['item_price']);
    $cuisine = htmlspecialchars($_POST['cuisine']);
    $imageUrl = htmlspecialchars($_POST['image_url']);

    // 2. Validate the data 
    if (empty($itemName) || empty($description) || $itemPrice <= 0 || empty($cuisine)) {
        echo "Error: Please fill in all fields correctly.";
        exit;
    }

    // 3. Prepare the SQL UPDATE statement
    $sql = "UPDATE menu_items 
            SET item_name = :item_name,
                description = :description,
                item_price = :item_price,
                cuisine = :cuisine,
                image_url = :image_url
            WHERE menu_item_id = :menu_item_id"; 

    try {
        $stmt = $conn->prepare($sql); 
        $stmt->bindParam(':item_name', $itemName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':item_price', $itemPrice);
        $stmt->bindParam(':menu_item_id', $menuItemId); 
        $stmt->bindParam(':cuisine', $cuisine); // Bind the cuisine parameter
        $stmt->bindParam(':image_url', $imageUrl); // Bind the image_url parameter
        $stmt->bindParam(':menu_item_id', $menuItemId);  

        // 4. Execute the UPDATE statement
        $stmt->execute(); 

        // 5. Redirect back to admin_menu.php (or display a success message)
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