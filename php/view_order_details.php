<?php
require_once '../php/db_connect.php';

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    $sql = "SELECT oi.item_name, oi.quantity, oi.price 
            FROM order_items oi
            WHERE oi.order_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$orderId]);
    $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <h2>Order Details (Order ID: <?php echo $orderId; ?>)</h2>

    <table class="order-details-table"> 
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price (LKR)</th>
                <th>Subtotal (LKR)</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $item): ?>
                <tr>
                    <td><?php echo $item['item_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity'] * $item['price']; ?></td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
} else {
    echo "Order ID not provided.";
}
?>