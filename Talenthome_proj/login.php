<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if 'email' and 'pass' are provided
    if (!isset($_GET['email']) || !isset($_GET['pass'])) {
        echo "Email and password not provided.";
        exit();
    }
    
    // Retrieve form data
    $email = $_GET['email'];
    $password = $_GET['pass'];
    
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'bookdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_name, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Bind the result columns to variables
        $stmt->bind_result($userName, $hashedPassword);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Set session variable for the logged in user
            $_SESSION['user'] = $userName;
            echo "<script type='text/javascript'>alert(" . json_encode($_SESSION['user']) . ");</script>";


            // Redirect to the home page
            header("Location:home.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
