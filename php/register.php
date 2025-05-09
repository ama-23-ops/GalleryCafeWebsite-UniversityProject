<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Gallery Café</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif; 
            background: linear-gradient(135deg, rgba(240, 240, 240, 0.5), rgba(200, 200, 200, 0.5)), url('../img/1(4).png'); /* Gradient over an image */
            background-size: cover; 
            background-position: center; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
}

        .register-container {
            background-color: #fff;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); 
        }

        h2 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
            letter-spacing: 1px;
            position: relative;
        }

        h2::after {
            content: '';
            width: 50px;
            height: 3px;
            background-color: #981e2e; 
            display: block;
            margin: 10px auto 0;
            border-radius: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            padding: 14px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #981e2e;
            box-shadow: 0 0 8px rgba(98, 0, 234, 0.3);
        }

        input[type="submit"] {
            background-color: #981e2e;
            color: white;
            padding: 15px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #3700b3;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 15px;
        }

        a {
            color: #6200ea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #3700b3;
        }

        @media screen and (max-width: 400px) {
            .register-container {
                padding: 30px 20px;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            select {
                padding: 12px;
            }

            input[type="submit"] {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <h2>User Registration</h2>

    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>

    <?php
    
    // Include database connection file
    require_once 'db_connect.php'; 

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
        // Set role to 'Customer' by default
        $role = 'Customer';

        // Check for existing username or email (using prepared statements)
        $checkSql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->bindParam(':email', $email);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            echo "Username or Email already exists!"; 
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

            // Prepare the SQL INSERT statement using named placeholders 
            $insertSql = "INSERT INTO users (username, email, password, role) 
                          VALUES (:username, :email, :password, :role)";
            
            try {
                $stmt = $conn->prepare($insertSql); 

                // Bind parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email); 
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':role', $role);

                // Execute the statement 
                if ($stmt->execute()) {
                    // Registration success
                    echo "Registration successful! <a href='login.php'>Login here</a>"; 
                } else {
                    // Database error
                    echo "Error: " . $stmt->errorInfo()[2]; 
                }

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage(); 
            }
        }
    }
    ?>
</body>
</html>