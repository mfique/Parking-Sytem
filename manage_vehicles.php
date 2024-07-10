<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>
    <link rel="stylesheet" href="manage_vehicles.css">
</head>
<body>
    
<div class="container">
    <h2>Manage Vehicles</h2>
    <table>
        <thead>
            <tr>
                <th>Owner's Name</th>
                <th>License Plate</th>
                <th>Vehicle Type</th>
                <th>Manufactured Country</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
                <th>Parking Charge</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "vehicle_parking_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
                $vehicleId = $_GET['id'];
                $sql = "DELETE FROM vehicles WHERE vehicle_id = $vehicleId";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Vehicle deleted successfully');</script>";
                } else {
                    echo "Error deleting vehicle: " . $conn->error;
                }
            }
            
            $sql = "SELECT * FROM vehicles";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['owner_name']}</td>";
                    echo "<td>{$row['license_plate']}</td>";
                    echo "<td>{$row['vehicle_type']}</td>";
                    echo "<td>{$row['manufactured_country']}</td>";
                    echo "<td>{$row['entry_time']}</td>";
                    echo "<td>{$row['exit_time']}</td>";
                    echo "<td>{$row['parking_charge']}</td>";
                    echo "<td>";
                    echo "<a href='update_vehicle.php?id={$row['vehicle_id']}'>Update</a> | ";
                    echo "<a href='manage_vehicles.php?action=delete&id={$row['vehicle_id']}'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No vehicles found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
