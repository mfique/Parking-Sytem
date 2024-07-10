<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["category_id"] . "</td>";
        echo "<td>" . $row["category_name"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>Actions</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No categories found</td></tr>";
}

$conn->close();
?>
