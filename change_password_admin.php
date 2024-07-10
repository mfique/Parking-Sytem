<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $currentPassword = mysqli_real_escape_string($conn, $currentPassword);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);
    $confirmPassword = mysqli_real_escape_string($conn, $confirmPassword);

    $username = $_SESSION['username'];
    $sql = "SELECT password FROM admin_users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if ($currentPassword === $storedPassword) {
            if ($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateSql = "UPDATE admin_users SET password = '$hashedPassword' WHERE username = '$username'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "Password changed successfully.";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "New password and confirm password do not match.";
            }
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "Admin user not found.";
    }
}

$conn->close();
?>
