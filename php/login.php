<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gallery Café</title>
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

        .login-container {
            background-color: #fff;
            padding: 40px 30px;
            width: 100%;
            max-width: 380px;
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
        input[type="password"] {
            padding: 14px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #981e2e;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
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
            .login-container {
                padding: 30px 20px;
            }

            input[type="text"],
            input[type="password"] {
                padding: 12px;
            }

            input[type="submit"] {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <h2>User Login</h2>

    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>

    <?php
    session_start();
    include('db_connect.php'); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute the query using PDO
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            // Redirect based on user role
            if ($user['role'] == 'Admin') {
                header('Location: admin_dashboard.php');
            } elseif ($user['role'] == 'Staff') {
                header('Location: staff_dashboard.php');
            } else {
                header('Location: customer_dashboard.php');
            }
            exit();
        } else {
            echo "Invalid credentials!";
        }
    }
    ?>
</body>
</html>