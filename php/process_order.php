<?php
session_start();
require_once 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userId = $_SESSION['user_id']; 
    $items = $_POST['items']; 
    $totalPrice = 0;

    try {
        $conn->beginTransaction(); // Start a transaction

        // Insert into the orders table
        $orderSql = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
        $orderStmt = $conn->prepare($orderSql);
        $orderStmt->execute([$userId, $totalPrice]);

        $orderId = $conn->lastInsertId(); // Get the last inserted order ID

        // Insert into the order_items table
        $orderItemSql = "INSERT INTO order_items (order_id, item_id, item_name, quantity, price) 
                         VALUES (?, ?, ?, ?, ?)";
        $orderItemStmt = $conn->prepare($orderItemSql);

        foreach ($items as $item) {
            $totalPrice += $item['price'] * $item['quantity']; // Calculate total price
            $orderItemStmt->execute([$orderId, $item['id'], $item['name'], $item['quantity'], $item['price']]);
        }
        
        // Update the total price in the orders table
        $updateTotalPriceSql = "UPDATE orders SET total_price = ? WHERE order_id = ?";
        $updateTotalPriceStmt = $conn->prepare($updateTotalPriceSql);
        $updateTotalPriceStmt->execute([$totalPrice, $orderId]);

        $conn->commit(); // Commit transaction if all is successful

        echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);

    } catch (PDOException $e) {
        $conn->rollBack(); 
        error_log("Error placing order: " . $e->getMessage()); 
        echo json_encode(['success' => false, 'message' => 'Error placing order.']); 
    }
}
?>