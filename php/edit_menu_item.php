<?php
session_start();
require_once 'db_connect.php';

// 1. Get the menu item ID to edit (from the URL query parameter)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $menuItemId = $_GET['id'];

    // 2. Fetch the existing menu item data from the database
    $sql = "SELECT * FROM menu_items WHERE menu_item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $menuItemId, PDO::PARAM_INT); // Use bindValue() 
    $stmt->execute();

    //  Fetch the data as an associative array
    $menuItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($menuItem) { // Check if a menu item was found

        // 3. Display the edit form with pre-filled data
        ?>
        <h2>Edit Menu Item</h2>
        <form action="update_menu_item.php" method="post">
            <input type="hidden" name="menu_item_id" value="<?php echo $menuItem['menu_item_id']; ?>">

            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" id="item_name" value="<?php echo $menuItem['item_name']; ?>" required><br><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo $menuItem['description']; ?></textarea><br><br>

            <label for="item_price">Price:</label>
            <input type="number" name="item_price" id="item_price" min="0" step="0.01" value="<?php echo $menuItem['item_price']; ?>" required><br><br>

            <label for="cuisine">Cuisine:</label>
            <select name="cuisine" id="cuisine" required>
                <option value="">Select Cuisine</option>
                <option value="Sri Lankan" <?php echo ($menuItem['cuisine'] == 'Sri Lankan') ? 'selected' : ''; ?>>Sri Lankan</option>
                <option value="Chinese" <?php echo ($menuItem['cuisine'] == 'Chinese') ? 'selected' : ''; ?>>Chinese</option>
                <option value="Italian" <?php echo ($menuItem['cuisine'] == 'Italian') ? 'selected' : ''; ?>>Italian</option>
                <option value="Mexican" <?php echo ($menuItem['cuisine'] == 'Mexican') ? 'selected' : ''; ?>>Mexican</option>
                <option value="Japanese" <?php echo ($menuItem['cuisine'] == 'Japanese') ? 'selected' : ''; ?>>Japanese</option>
                <option value="Indian" <?php echo ($menuItem['cuisine'] == 'Indian') ? 'selected' : ''; ?>>Indian</option>
            </select><br><br>

            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url" id="image_url" value="<?php echo $menuItem['image_url']; ?>"><br><br>

            <button type="submit">Update Item</button>
        </form>
        <?php
    } else {
        // Handle case where the menu item ID is not found
        echo "Error: Menu item not found.";
    }

} else {
    // Handle case where 'id' parameter is missing or invalid
    echo "Error: Invalid menu item ID.";
}

$conn = null;
?>