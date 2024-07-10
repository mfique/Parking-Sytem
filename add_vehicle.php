<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $ownerName = $_POST['ownerName'];
    $licensePlate = $_POST['licensePlate'];
    $vehicleType = $_POST['vehicleType'];
    $manufacturedCountry = $_POST['manufacturedCountry'];
    $entryTime = $_POST['entryTime'];
    $exitTime = $_POST['exitTime'];
    $parkingCharge = $_POST['parkingCharge'];

    $checkSql = "SELECT * FROM vehicles WHERE license_plate = '$licensePlate'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {

        echo "Error: License plate already exists.";
    } else {

        $sql = "INSERT INTO vehicles (owner_name, license_plate, vehicle_type, manufactured_country, entry_time, exit_time, parking_charge)
                VALUES ('$ownerName', '$licensePlate', '$vehicleType', '$manufacturedCountry', '$entryTime', '$exitTime', '$parkingCharge')";

        if ($conn->query($sql) === TRUE) {

            header("Location: manage_vehicles.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
