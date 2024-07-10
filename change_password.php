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
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $username = $_SESSION['username'];
    $sql = "SELECT password FROM users_user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];

            if ($currentPassword === $storedPassword) {
                if ($newPassword === $confirmPassword) {
                    // Update password directly with plain text
                    $updateSql = "UPDATE users_user SET password = '$newPassword' WHERE username = '$username'";
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
            echo "User not found.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
