<?php

require_once 'db_connect.php'; 

?>

<h2>Menu Management</h2>

<a href="#add-new-item" class="add-item-btn">Add New Item</a>

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

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
    vertical-align: middle;
}

table th {
    background-color: #981e2e; 
    color: white;
}

table td img {
    display: block;
    width: 100px;
    height: auto;
    border-radius: 5px;
}

table tr:nth-child(even) {
    background-color: #f9f9f9; 
}

table a {
    color: #337ab7;
    text-decoration: none;
}

table a:hover {
    text-decoration: underline;
}

/* Form for adding new menu items */
form {
    background-color: #f5f5f5;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    max-width: 600px;
    margin-bottom: 30px;
}

form label {
    font-weight: bold;
    color: #333;
}

form input[type="text"],
form input[type="number"],
form input[type="url"],
form select,
form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

form textarea {
    resize: vertical;
    height: 100px;
}

form button {
    background-color: #981e2e;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

form button:hover {
    background-color: #7f1722; 
}

.add-item-btn {
            background-color: #981e2e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none; 
            display: inline-block; 
            margin-bottom: 20px;
        }

        .add-item-btn:hover {
            background-color: #7f1722; 
        }

/* Responsive Design */
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }

    table td img {
        width: 80px;
    }

    form {
        max-width: 100%;
        padding: 15px;
    }

    form input,
    form select,
    form textarea {
        font-size: 14px;
    }
}

        </style>
        </head></html>

<?php
// Fetch Menu Items from Database
$menuItemsSql = "SELECT * FROM menu_items ORDER BY item_name";
$menuItemsStmt = $conn->prepare($menuItemsSql); // Prepare the statement
$menuItemsStmt->execute(); // Execute the statement
$menuItems = $menuItemsStmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows 

// Display Menu Items in a Table
if (count($menuItems) > 0) { 
    echo "<table>";
    echo "<thead><tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Cuisine</th>
            <th>Image</th>
            <th>Actions</th>
          </tr></thead>";

    echo "<tbody>";
    foreach ($menuItems as $row) {
        echo "<tr>";
        echo "<td>" . $row['menu_item_id'] . "</td>";
        echo "<td>" . $row['item_name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['item_price'] . "</td>";
        echo "<td>" . $row['cuisine'] . "</td>";
        echo "<td><img src='" . $row['image_url'] . "' alt='" . $row['item_name'] . "' style='width: 100px; height: auto;'></td>";
        // Add Edit/Delete buttons 
        echo "<td>
                <a href='edit_menu_item.php?id=" . $row['menu_item_id'] . "'>Edit</a> |
                <a href='delete_menu_item.php?id=" . $row['menu_item_id'] . "' 
                   onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No menu items found.</p>";
}

// Add a form to add new menu items
?>
<h3 id="add-new-item">Add New Menu Item</h3>
<form action="add_menu_item.php" method="post"> 
    <label for="item_name">Item Name:</label>
    <input type="text" name="item_name" id="item_name" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea><br><br>

    <label for="item_price">Price:</label>
    <input type="number" name="item_price" id="item_price" min="0" step="0.01" required><br><br>

    <label for="cuisine">Cuisine:</label>
    <select name="cuisine" id="cuisine" required>
        <option value="">Select Cuisine</option> 
        <option value="Sri Lankan">Sri Lankan</option>
        <option value="Chinese">Chinese</option>
        <option value="Italian">Italian</option>
        <option value="Mexican">Mexican</option>
        <option value="Japanese">Japanese</option>
        <option value="Indian">Indian</option>
    </select><br><br>

    <label for="image_url">Image URL:</label>
    <input type="url" name="image_url" id="image_url"><br><br>

    <button type="submit">Add New Item</button>
</form>