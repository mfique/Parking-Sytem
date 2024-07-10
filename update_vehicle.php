<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $vehicleId = $_GET['id'];
    $sql = "SELECT * FROM vehicles WHERE vehicle_id = $vehicleId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Vehicle not found";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerName = $_POST['owner_name'];
    $licensePlate = $_POST['license_plate'];
    $vehicleType = $_POST['vehicle_type'];
    $manufacturedCountry = $_POST['manufactured_country'];
    $entryTime = $_POST['entry_time'];
    $exitTime = $_POST['exit_time'];
    $parkingCharge = $_POST['parking_charge'];

    $updateSql = "UPDATE vehicles SET 
                    owner_name = '$ownerName', 
                    license_plate = '$licensePlate', 
                    vehicle_type = '$vehicleType', 
                    manufactured_country = '$manufacturedCountry', 
                    entry_time = '$entryTime', 
                    exit_time = '$exitTime', 
                    parking_charge = '$parkingCharge' 
                  WHERE vehicle_id = $vehicleId";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Vehicle updated successfully'); window.location.href='manage_vehicles.php';</script>";
    } else {
        echo "Error updating vehicle: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vehicle</title>
    <link rel="stylesheet" href="add_vehicle.css">
</head>
<body>
<div class="container">
    <h2>Update Vehicle</h2>
    <form method="POST">
        <div class="ownersname">
            <div class="form-top">
                <label for="owner_name">Owner's Name:</label>
                <input type="text" id="owner_name" name="owner_name" value="<?php echo $row['owner_name']; ?>" required><br><br>
            </div>
        </div>
        <div class="cardetails">
            <div class="form-left">
                <label for="license_plate">License Plate:</label>
                <input type="text" id="license_plate" name="license_plate" value="<?php echo $row['license_plate']; ?>" required><br><br>

                <label for="vehicle_type">Type of Vehicle:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" value="<?php echo $row['vehicle_type']; ?>" required><br><br>

                <label for="manufactured_country">Country of Manufacture:</label>
                <input type="text" id="manufactured_country" name="manufactured_country" value="<?php echo $row['manufactured_country']; ?>" required><br><br>
            </div>
            <div class="form-right">
                <label for="entry_time">Entry Time:</label>
                <input type="datetime-local" id="entry_time" name="entry_time" value="<?php echo $row['entry_time']; ?>" required><br><br>

                <label for="exit_time">Exit Time:</label>
                <input type="datetime-local" id="exit_time" name="exit_time" value="<?php echo $row['exit_time']; ?>" required><br><br>

                <label for="parking_charge">Parking Charge:</label>
                <input type="number" id="parking_charge" name="parking_charge" value="<?php echo $row['parking_charge']; ?>" step="0.01" required><br><br>
            </div>
        </div>
        <button type="submit">Update Vehicle</button>
    </form>
</div>
</body>
</html>
