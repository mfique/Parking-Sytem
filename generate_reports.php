<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
    <link rel="stylesheet" href="generate_reports.css">
</head>
<body>
    <div class="container">
        <h2>Generate Reports</h2>

        <form action="generate_reports.php" method="POST">
            <label for="reportDate">Select Date:</label>
            <input type="date" id="reportDate" name="reportDate" required>
            <button type="submit">Generate Report</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reportDate'])) {
            $reportDate = $_POST['reportDate'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "vehicle_parking_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sqlAdded = "SELECT * FROM vehicles WHERE DATE(entry_time) = '$reportDate'";
            $resultAdded = $conn->query($sqlAdded);

            $sqlExited = "SELECT * FROM vehicles WHERE DATE(exit_time) = '$reportDate'";
            $resultExited = $conn->query($sqlExited);

            echo "<h3>Added Vehicles on $reportDate</h3>";
            echo "<table>";
            echo "<thead><tr><th>Owner's Name</th><th>License Plate</th><th>Vehicle Type</th><th>Manufactured Country</th><th>Entry Time</th></tr></thead>";
            echo "<tbody>";
            while ($row = $resultAdded->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["owner_name"] . "</td>";
                echo "<td>" . $row["license_plate"] . "</td>";
                echo "<td>" . $row["vehicle_type"] . "</td>";
                echo "<td>" . $row["manufactured_country"] . "</td>";
                echo "<td>" . $row["entry_time"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<h3>Exited Vehicles on $reportDate</h3>";
            echo "<table>";
            echo "<thead><tr><th>Owner's Name</th><th>License Plate</th><th>Vehicle Type</th><th>Manufactured Country</th><th>Exit Time</th></tr></thead>";
            echo "<tbody>";
            while ($row = $resultExited->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["owner_name"] . "</td>";
                echo "<td>" . $row["license_plate"] . "</td>";
                echo "<td>" . $row["vehicle_type"] . "</td>";
                echo "<td>" . $row["manufactured_country"] . "</td>";
                echo "<td>" . $row["exit_time"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            $conn->close();
        }
        ?>

    </div>
</body>
</html>
