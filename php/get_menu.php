<?php
require_once 'db_connect.php';

$sql = "SELECT menu_item_id, item_name, item_price, cuisine, image_url, description  FROM menu_items"; // Include 'cuisine' column
$stmt = $conn->prepare($sql);
$stmt->execute();
$menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($menuItems);
?>