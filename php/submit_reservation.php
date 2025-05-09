<?php
// Enable error reporting (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "gallery_cafe"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = array(); 

        // Sanitize and validate form data
        $name = isset($_POST['name']) ? trim(htmlspecialchars($_POST['name'])) : '';
        $phone = isset($_POST['phone']) ? trim(htmlspecialchars($_POST['phone'])) : '';
        $email = isset($_POST['email']) ? trim(htmlspecialchars($_POST['email'])) : '';
        $date = isset($_POST['date']) ? trim(htmlspecialchars($_POST['date'])) : '';
        $time = isset($_POST['time']) ? trim(htmlspecialchars($_POST['time'])) : '';
        $guests = isset($_POST['guests']) ? (int)$_POST['guests'] : 0; 
        $tablePreference = isset($_POST['table']) ? (int)$_POST['table'] : null; 
        $parking = isset($_POST['parking']) && $_POST['parking'] === 'yes' ? 1 : null;

        // Validation Rules
        if (empty($name) || !preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $errors['name'] = "Please enter a valid name.";
        }

        if (empty($phone) || !preg_match("/^\d{10}$/", $phone)) {
            $errors['phone'] = "Please enter a valid 10-digit phone number.";
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        }

        $today = date("Y-m-d");
        if (empty($date) || $date < $today) {
            $errors['date'] = "Please select a valid future date.";
        }

        if (empty($errors)) {
            // Get logged-in user's ID 
            $userId = $_SESSION['user_id']; 
        
            $sql = "INSERT INTO reservations (id, user_id, name, phone, email, reservation_date, reservation_time, guests, table_preference, parking_preference, status) 
                    VALUES (NULL, :user_id, :name, :phone, :email, :date, :time, :guests, :tablePreference, :parkingPreference, 'pending')"; // Default status
        
            $stmt = $conn->prepare($sql); 
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT); // Bind user_id 
            $stmt->bindParam(':name', $name); 
            $stmt->bindParam(':phone', $phone); 
            $stmt->bindParam(':email', $email); 
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':guests', $guests, PDO::PARAM_INT); 
            $stmt->bindParam(':tablePreference', $tablePreference, PDO::PARAM_INT); 
            $stmt->bindParam(':parkingPreference', $parking, PDO::PARAM_INT); 

            if ($stmt->execute()) {
                // Set Content-Type header before sending JSON
                header('Content-Type: application/json');
                echo json_encode(array('success' => true, 'message' => "Reservation successful!"));
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('success' => false, 'message' => "Database error: Could not process reservation."));
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('success' => false, 'message' => "There were validation errors.", 'errors' => $errors)); 
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => "Invalid request method.")); 
    }

} catch(PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => "Database error: " . $e->getMessage())); 
}

$conn = null; 
?>