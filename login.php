<?php
// Database connection settings
$host = "localhost"; // MySQL host
$dbname = "login_system"; // Database name
$username = "your_username"; // MySQL username
$password = "your_password"; // MySQL password

// Establishing MySQL connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Retrieve username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Query to fetch user details from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user exists and verify password
if ($user && password_verify($password, $user['password'])) {
    // Authentication successful, redirect to a dashboard page or perform other actions
    header("Location: dashboard.php");
    exit();
} else {
    // Authentication failed, redirect back to the login page with an error message
    header("Location: login.html?error=1");
    exit();
}
?>

