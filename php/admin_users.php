<?php 
// Include your database connection file 
require_once 'db_connect.php'; 

// Function to sanitize user input (using PDO)
function sanitizeInput($input, $conn) {
    return trim($input); 
}

// Handle User Actions 
$message = ''; // Initialize message variable
$error = '';   // Initialize error variable

if (isset($_POST['action'])) {
    $action = $_POST['action']; 

    switch ($action) {
        case 'add':
            // Add New User
            $username = sanitizeInput($_POST['username'], $conn);
            $email = sanitizeInput($_POST['email'], $conn);
            $password = password_hash(sanitizeInput($_POST['password'], $conn), PASSWORD_DEFAULT);
            $role = sanitizeInput($_POST['role'], $conn);

            try {
                $stmt = $conn->prepare("INSERT INTO users (username, email, role, password, created_at) 
                                        VALUES (:username, :email, :role, :password, NOW())");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                
                $message = "New user added successfully!"; 
            } catch(PDOException $e) {
                $error = "Error adding user: " . $e->getMessage();
            }
            break;

            case 'edit':
                // Edit Existing User
                $userId = sanitizeInput($_POST['user_id'], $conn);
                $username = sanitizeInput($_POST['username'], $conn); // Get username from hidden input
                $role = sanitizeInput($_POST['role'], $conn);       // Get role from hidden input
            
                try {
                    if (!empty($_POST['password'])) {
                        $password = password_hash(sanitizeInput($_POST['password'], $conn), PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET username=:username, password=:password, role=:role WHERE user_id=:user_id");
                        $stmt->bindParam(':password', $password);
                    } else {
                        $stmt = $conn->prepare("UPDATE users SET username=:username, role=:role WHERE user_id=:user_id");
                    }
            
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':role', $role);
                    $stmt->bindParam(':user_id', $userId);
                    $stmt->execute();
            
                    $message = "User updated successfully!";
                } catch(PDOException $e) {
                    $error = "Error updating user: " . $e->getMessage();
                }
                break;    

        case 'delete':
            // Delete User
            $userId = sanitizeInput($_POST['user_id'], $conn); 

            try {
                $stmt = $conn->prepare("DELETE FROM users WHERE user_id=:user_id");
                $stmt->bindParam(':user_id', $userId);
                $stmt->execute();

                $message = "User deleted successfully!";
            } catch(PDOException $e) {
                $error = "Error deleting user: " . $e->getMessage();
            }
            break;

        default: 
            $error = "Invalid action requested.";
            break;
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
<style> 
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
        /* Basic Table Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        h2, h3 {
            color: #981e2e; 
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #981e2e; 
            color: white;
            text-align: left;
        }

        /* Style for success and error messages */
        .success {
            color: green;
            margin: 10px 0;
        }

        .error {
            color: red; 
            margin: 10px 0;
        }

        /* Edit form styling */
        #editForm {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px; 
            background-color: #fff;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"],
        button {
            background-color: #981e2e; 
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #b92b3a;
        }

        /* Confirmation dialog */
        form {
            display: inline;
        }
    </style>
    </head>
<body>
    <h2>User Management</h2> 

    <!-- Display Success/Error Messages --> 
    <?php if (!empty($message)): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Add New User Form -->
    <h3>Add New User</h3>
    <form method="post" action="admin_users.php">
        <input type="hidden" name="action" value="add">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option> 
        </select><br>

        <input type="submit" value="Add User">
    </form>

    <!-- User List Table -->
    <h3>Existing Users</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th> 
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
                // Fetch Users from the Database
                $sql = "SELECT * FROM users";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                        echo "<tr>"; 
                        echo "<td>" . $row["user_id"] . "</td>"; 
                        echo "<td>" . htmlspecialchars($row["username"]) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row["role"]) . "</td>";
                        echo "<td>"; 
                        
                        // Edit User Button (calls JavaScript function)
                        echo "<button onclick='populateEditForm(" . $row["user_id"] . ", \"" . htmlspecialchars($row["username"]) . "\", \"" . htmlspecialchars($row["email"]) . "\", \"" . htmlspecialchars($row["role"]) . "\")'>Edit</button> ";
                       
                        // Delete User Button
                        echo "<form method='post' action='admin_users.php' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this user?\");'> 
                                <input type='hidden' name='action' value='delete'>
                                <input type='hidden' name='user_id' value='" . $row["user_id"] . "'>
                                <input type='submit' value='Delete'>
                              </form>"; 
                        
                        echo "</td>"; 
                        echo "</tr>"; 
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }
            ?>
        </tbody> 
    </table> 

    <!-- Edit Form Section (initially hidden) -->
    <div id="editForm" style="display: none;"> 
        <h3>Edit User</h3>
        <form method="post" action="admin_users.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="user_id" id="editUserId"> 

            <label for="editUsername">Username:</label>
            <input type="text" id="editUsername" name="username" required><br>

            <label for="editEmail">Email:</label>
            <input type="email" id="editEmail" name="email" required><br>

            <label for="editPassword">New Password (leave blank to keep old password):</label>
            <input type="password" id="editPassword" name="password"><br> 

            <label for="editRole">Role:</label>
            <select id="editRole" name="role">
                <option value="Admin">Admin</option>
                <option value="Staff">Staff</option>
            </select><br> 

            <input type="submit" value="Update User">
        </form>
    </div>

    <script>
    function populateEditForm(userId, username, email, role) {
        document.getElementById('editUserId').value = userId;
        document.getElementById('editUsername').value = username;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        document.getElementById('editForm').style.display = 'block';
    }
    </script>

</body>
</html>
