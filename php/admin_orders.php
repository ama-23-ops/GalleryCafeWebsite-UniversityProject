<?php
require_once '../php/db_connect.php';
// Function to update an order status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    // Basic validation
    if (!in_array($newStatus, ['Pending', 'Confirmed', 'Cancelled'])) {
        echo "Invalid status provided.";
        exit(); 
    }

    try {
        $updateSql = "UPDATE orders SET status = ? WHERE order_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute([$newStatus, $orderId]);

        echo '<div class="success-message">Order status updated successfully!</div>';
    } catch (PDOException $e) {
        echo "Error updating order status: " . $e->getMessage();
    }
}

// Fetch all orders with customer details 
$sql = "SELECT o.*, u.username AS customer_name 
        FROM orders o
        JOIN users u ON o.user_id = u.user_id 
        ORDER BY o.order_date DESC"; // Get latest orders first 
$stmt = $conn->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | The Gallery Café</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Sidebar Styling */
.sidebar {
    width: 250px;
    background-color: #333; 
    color: #fff;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #fff; 
    font-size: 24px;
    border: none; 
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 15px;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #444;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.sidebar ul li a:hover {
    background-color: #555;
}

/* Adding Font Awesome Icons */
.sidebar ul li a i {
    margin-right: 10px;
}

/* Style for the Order Management table */
.order-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.order-table th, .order-table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
    vertical-align: middle;
}

.order-table th {
    background-color: #981e2e; 
    color: white;
}

.order-table tr:nth-child(even) {
    background-color: #f9f9f9; 
}

.order-table tr:hover {
    background-color: #f1f1f1;
}

/* Style for the select dropdown */
.order-table select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

/* Style for the update button */
.order-table button {
    background-color: #981e2e; 
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.order-table button:hover {
    background-color: #7f1722; 
}

/* Style for success message */
.success-message {
    background-color: #d4edda; 
    color: #155724; 
    padding: 15px;
    border: 1px solid #c3e6cb; 
    border-radius: 5px;
    margin-bottom: 20px;
}

/* Responsive design */
@media (max-width: 768px) {
    .order-table th, .order-table td {
        font-size: 14px; 
        padding: 10px;
    }

    .order-table button {
        font-size: 12px;
    }

    .success-message {
        font-size: 14px;
    }
}

</style>
</head>
<body>

<h2>Order Management</h2>

<table class="order-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th> 
            <th>Order Date</th>
            <th>Total Price (LKR)</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?> 
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['customer_name']; ?></td> 
            <td><?php echo $order['order_date']; ?></td>
            <td><?php echo $order['total_price']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Confirmed" <?php echo $order['status'] == 'Confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                        <option value="Cancelled" <?php echo $order['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>
            <td>
                <a href="view_order_details.php?order_id=<?php echo $order['order_id']; ?>">View Details</a> 
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
    </body>
</html>