<?php

require_once 'db_connect.php'; 

// Authorization Check for Admin and Staff
if (!isset($_SESSION['role']) || 
    !in_array($_SESSION['role'], ['Admin', 'Staff'])) { 
    header('Location: login.php'); // Or an unauthorized page
    exit();
}

// Fetch Reservation Data 
$reservationsSql = "SELECT r.*, u.username, u.email 
                   FROM reservations r
                   JOIN users u ON r.user_id = u.user_id 
                   ORDER BY r.reservation_date, r.reservation_time";   
$reservationsStmt = $conn->prepare($reservationsSql);
$reservationsStmt->execute(); 
$reservations = $reservationsStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | The Gallery Café</title>
    <link rel="stylesheet" href="../css/styleS.css">
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

/* General Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #981e2e;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9f9f9; 
}

tr:hover {
    background-color: #f1f1f1; 
}

/* Action Links */
a {
    color: #981e2e; 
    text-decoration: none;
}

a:hover {
    text-decoration: underline; 
}

/* Confirmation Prompts */
a[onclick] {
    cursor: pointer; 
}

/* Responsive Design */
@media (max-width: 768px) {
    th, td {
        font-size: 14px; 
        padding: 10px;
    }
}

</style>
</head>
<body>
<h2>Reservation Management</h2>

<?php if (count($reservations) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Customer Username</th> 
                <th>Name</th> 
                <th>Phone</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Table Preference</th>
                <th>Parking</th> 
                <th>Status</th>
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['username']; ?></td> 
                    <td><?php echo $reservation['name']; ?></td>
                    <td><?php echo $reservation['phone']; ?></td>
                    <td><?php echo $reservation['email']; ?></td>
                    <td><?php echo $reservation['reservation_date']; ?></td>
                    <td><?php echo $reservation['reservation_time']; ?></td>
                    <td><?php echo $reservation['guests']; ?></td>
                    <td><?php echo $reservation['table_preference'] ? 'Table for ' . $reservation['table_preference'] : 'Any'; ?></td>
                    <td><?php echo $reservation['parking_preference'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $reservation['status']; ?></td> 
                    <td>
                        <!-- Action Buttons (Confirm/Deny, Cancel) -->
                        <?php if ($reservation['status'] == 'pending'): ?>
                            <a href="confirm_reservation.php?id=<?php echo $reservation['id']; ?>" 
                               onclick="return confirm('Are you sure you want to confirm this reservation?')">Confirm</a> |
                            <a href="deny_reservation.php?id=<?php echo $reservation['id']; ?>" 
                               onclick="return confirm('Are you sure you want to deny this reservation?')">Deny</a> | 
                        <?php endif; ?>
                        <a href="cancel_reservation.php?id=<?php echo $reservation['id']; ?>"
                           onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</a>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No reservations found.</p> 
<?php endif; ?>

</body>
</html>