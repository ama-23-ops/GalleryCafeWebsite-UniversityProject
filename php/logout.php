<?php
session_start();
session_destroy(); // Destroy the session
header('Location: ../php/homepage.php'); // Redirect to login page 
exit();
?>