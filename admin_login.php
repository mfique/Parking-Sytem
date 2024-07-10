<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_parking_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            // Password is correct
            $_SESSION['username'] = $username;
            header("Location: rightside.php");
            exit;
        } else {
            // Incorrect password
            $errorMsg = "Invalid username or password.";
        }
    } else {
        // No matching username
        $errorMsg = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>

<div class="container">
    <form action="admin_login.php" method="POST" class="form">
        <h2>Login</h2>
        
        <?php
        if (!empty($errorMsg)) {
            echo '<p style="color: red;">' . $errorMsg . '</p>';
        }
        ?>
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

</body>
</html>
